<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\QR;
use App\Models\Trap;
use App\Models\User;
use MatanYadaev\EloquentSpatial\Objects\Point;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\DomCrawler\Crawler;

class AdminController extends Controller
{

    const BASE_URL = "https://trap.nz";
    const LOGIN_URL = self::BASE_URL . "/user/login?destination=my-projects";
    const TRAP_URL = self::BASE_URL . "/project/trap_overview.json";


    public function index(){
        $unmaped_traps = Trap::where('qr_id', null)->get();
        $unmaped_qr = QR::whereNull('trap_id')->get();
        $users = User::with(['projects'=>function ($query){
            return $query->count();
        }])->get();
        $all_traps = Trap::with('project','qrCode')->get();

        return Inertia::render('Admin/Index',[
            'unmaped_traps' => $unmaped_traps,
            'unmaped_qr' => $unmaped_qr,
            'users' => $users,
            'all_traps' => $all_traps,
        ]);
    }

    public function generate_qr(Request $request) {
        $validated_data = $request->validate([
            'count' => 'required|integer',
        ]);

        $ids = [];
        for ($i = 0; $i < $validated_data['count']; $i++) {
            $qr_code = getUniqueTrapId();
            QR::create(['qr_code' => $qr_code]);
        }

        return back();
    }

    public function unmapped_codes(Request $request){

        return Inertia::render('Admin/GenerateQr',[
            'qrs' => QR::whereNull('trap_id')
                ->orderBy('qr_code')
                ->filter($request->only('search'))
                ->paginate(10)
                ->withQueryString(),
            'filters' => $request->all(['search']),
        ]);
    }


    public function unmapped_traps(Request $request){
        return Inertia::render('Admin/UnmapedTraps',[
            'qrs' => QR::whereNull('trap_id')
                ->orderBy('qr_code')
                ->get(),
            'traps' => Trap::select('id', 'project_id', 'nz_trap_id', 'name', 'coordinates', 'qr_id')
                ->filter($request->only('search'))
                ->noCode()->with('project')
                ->paginate(10)
                ->withQueryString(),
            'filters' => $request->all(['search']),
        ]);
    }

    public function map_trap(Request $request){
        $validated_data = $request->validate([
            'qr_id' => 'required|exists:qr,qr_code',
            'nz_id' => 'required|exists:traps,nz_trap_id'
        ]);
        $qr = QR::where('qr_code', $validated_data['qr_id'])->first();
        $trap = Trap::where('nz_trap_id', $validated_data['nz_id'])->first();
        $oldQR = QR::where('qr_code', $trap->qr_id)->first();

        $trap->qr_id = $qr->qr_code;
        $qr->trap_id = $trap->id;
        $trap->update();
        $qr->update();

        // Remove old mapping in QR table
        if($oldQR) {
            $oldQR->trap_id = null;
            $oldQR->update();
        }

        return back();
    }

    public function all_traps(Request $request){
        return Inertia::render('Admin/AllTraps',[
            'qrs' => QR::whereNull('trap_id')
                ->orderBy('qr_code')
                ->get(),
            'traps' => Trap::select('id', 'project_id', 'nz_trap_id', 'name', 'coordinates', 'qr_id')
                ->orderBy('nz_trap_id','desc')
                ->filter($request->only('search'))
                ->mapped()
                ->with('project')
                ->paginate(10)
                ->withQueryString(),
            'filters' => $request->all(['search']),
        ]);
    }

    public function users(Request $request){
        return Inertia::render('Admin/Users',[
            'users'=>User::with('projectsAll')
                ->orderBy('id','desc')
                ->filter($request->only('search'))
                ->paginate(10)
                ->withQueryString(),
            'filters' => $request->all(['search']),
            'projects' => Project::all()
        ]);
    }

    public function start_scrap(Request $request) {
        $loginNeeded = false;
        $client = new Client();
        $cookieJar = new CookieJar();
        try {
            $response = $client->get(self::BASE_URL . '/my-projects', [
                'cookies' => $cookieJar
            ]);
        } catch(\Exception $e) {
            if($e->getCode() === 403) {
                $loginNeeded = true;
            }
        }
        if($loginNeeded) {
            $response = $client->post(self::LOGIN_URL, [
                'form_params' => [
                    'name' => env('TRAP_NZ_USERNAME', 'dylan'),
                    'pass' => env('TRAP_NZ_PASSWORD', 'notmypassword'),
                    'form_build_id' => '',
                    'form_id' => 'user_login',
                    'op' => 'Log+in'
                ],
                'allow_redirects' => true,
                'cookies' => $cookieJar
            ]);
        }

        $response = $client->get(self::BASE_URL . '/my-projects', [
            'cookies' => $cookieJar
        ]);
        $htmlString = (string) $response->getBody();
        $crawler = new Crawler($htmlString);

        $projects = [];
        /*
         * Get Basic Trap Information
         */
        foreach ($crawler->filter('tbody > tr') as  $node) {
            $crawler = new Crawler($node);
            $project = [];
            $project['link'] = $crawler->children()->eq(0)->children()->eq(0)->attr('href');
            $project['name'] = $crawler->children()->eq(0)->text();
            $project['members'] = $crawler->children()->eq(1)->text();
            $project['role'] = $crawler->children()->eq(2)->text();
            $project['notes'] = $crawler->children()->eq(3)->text();
            $project['area'] = $crawler->children()->eq(4)->text();
            $projects[] = $project;
        }

        /*
         * Get Trap Data
         */
        $added_traps = 0;
        $skipped_traps = 0;
        foreach ($projects as $index => $project) {
            $traps = [];
            $link = self::BASE_URL . $project['link'];
            // Set project in cookie
            $response = $client->get($link, [
                'cookies' => $cookieJar
            ]);
            $existing_project = Project::where('name', $project['name'])->first();
            if(! $existing_project) {
                $existing_project = Project::create([
                    'name' => $project['name'],
                    'description' => 'Fetch test'
                ]);
            }
            // Fetch Trap List
            $response = $client->get(self::TRAP_URL, [
                'cookies'=> $cookieJar
            ]);
            if ($response->getBody()) {
                $trapDta = json_decode($response->getBody(), true);
                foreach ($trapDta['features'] as $trap) {
                    $newTrap = [];
                    $newTrap['coordinates'] = $trap['geometry']['coordinates'];
                    $newTrap['name'] = $trap['properties']['name'];
                    $newTrap['nid'] = $trap['properties']['nid'];
                    $traps[] = $newTrap;
                    $trap = Trap::where('nz_trap_id', $newTrap['nid'])->first();
                    if(! $trap) {
                        $added_traps+=1;
                        Trap::create([
                            'nz_trap_id' => $newTrap['nid'],
                            'project_id' => $existing_project->id,
                            'name' => $newTrap['name'],
                            'coordinates' => new Point($newTrap['coordinates'][0], $newTrap['coordinates'][1])
                        ]);
                    } else {
                        $skipped_traps+=1;
                    }
                }
                $projects[$index]['traps'] = $traps;
            }
        }

        session()->flash('message',[
            'added' => $added_traps,
            'skipped' => $skipped_traps,
            'projects' => $projects
        ]);
        return back();
    }


}
