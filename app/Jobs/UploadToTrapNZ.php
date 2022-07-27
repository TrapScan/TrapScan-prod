<?php

namespace App\Jobs;

use App\Models\Inspection;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class UploadToTrapNZ implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Inspection $inspection;
    public int $tries = 2;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Inspection $inspection)
    {
        $this->inspection = $inspection;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $BASE_URL = "https://trap.nz";
        $LOGIN_URL = $BASE_URL . "/user/login?destination=my-projects";

        Log::debug('Attempting to upload inspection', $this->inspection->toArray());

        $loginNeeded = false;
        $client = new Client();
        $cookieJar = new CookieJar();
        try {
            $response = $client->get($BASE_URL . '/my-projects', [
                'cookies' => $cookieJar
            ]);
        } catch(\Exception $e) {
            if($e->getCode() === 403) {
                $loginNeeded = true;
            }
        }
        if($loginNeeded) {
            $response = $client->post($LOGIN_URL, [
                'form_params' => [
                    'name' =>  env('TRAP_NZ_USERNAME', 'dylan'),
                    'pass' => env('TRAP_NZ_PASSWORD', 'notmypassword'),
                    'form_build_id' => '',
                    'form_id' => 'user_login',
                    'op' => 'Log+in'
                ],
                'allow_redirects' => true,
                'cookies' => $cookieJar
            ]);
        }

        $project_id = $this->inspection->trap->project->nz_id;
        // Visit the correct project page to be allowed access to the submit form
        $project_url = $BASE_URL . "/node/" . $project_id;
        $project_response = $client->get($project_url, [
            'cookies' => $cookieJar
        ]);

        $id = $this->inspection->trap->nz_trap_id;
        $url = $BASE_URL . "/node/add/trap-record?field_trap_record_trap=${id}&destination=node/${id}";

        $response = $client->get( $url, [
            'cookies' => $cookieJar
        ]);
        $htmlString = (string) $response->getBody();
        $crawler = new Crawler($htmlString);
        $formBuildID = $crawler->filter('.col-md-12 > input:nth-child(2)')->attr('value');
        $formToken = $crawler->filter('.col-md-12 > input:nth-child(3)')->attr('value');
        $formID = $crawler->filter('.col-md-12 > input:nth-child(4)')->attr('value');

        $response = $client->request('POST', $url, [
            'cookies' => $cookieJar,
            'multipart' => [
                [
                    'name' => 'field_trap_record_date[und][0][value][date]',
                    'contents' => $this->inspection->created_at->format('d M Y')
                ],
                [
                    'name' => 'field_trap_record_date[und][0][value][time]',
                    'contents' => $this->inspection->created_at->format('H:i')
                ],
                [
                    'name' => 'field_trap_record_recorded_by[und][0][value]',
                    'contents' => $this->inspection->user->name
                ],
                [
                    'name' => 'field_trap_record_notes[und][0][value]',
                    'contents'=> 'TrapScan '.$this->inspection->notes ?? 'TrapScan'
                ],
                [
                    'name' => 'field_trap_record_species_caught[und]',
                    'contents' => '' . $this->speciesToValue($this->inspection->species_caught)
                ],
                [
                    'name' => 'field_gender[und]',
                    'contents' => '_none'
                ],
                [
                    'name' => 'field_maturity[und]',
                    'contents' => '_none'
                ],
                [
                    'name' => 'field_images[und][0][_weight]',
                    'contents' => "0"
                ],
                [
                    'name' => 'field_images[und][0][fid]',
                    'contents' => "0"
                ],
                [
                    'name' => 'field_images[und][0][display]',
                    'contents' => '1'
                ],
                [
                    'name' => 'field_trap_record_status[und]',
                    'contents' => '' . $this->statusToValue($this->inspection->status)
                ],
                [
                    'name' => 'field_strikes[und][0][value]',
                    'contents' => '1'
                ],
                [
                    'name' => 'field_trap_record_trap_condition[und]',
                    'contents' => 'OK'
                ],
                [
                    'name' => 'field_trap_record_rebaited[und]',
                    'contents' => 'Yes'
                ],
                [
                    'name' => 'field_trap_record_bait_type[und][]',
                    'contents' => '' . $this->baitToValue($this->inspection->bait_type)
                ],
                [
                    'name' => 'field_bait_sub_type[und][0][value]',
                    'contents' => ''
                ],
                [
                    'name' => 'changed',
                    'contents' => ''
                ],
                [
                    'name' => 'form_build_id',
                    'contents' => $formBuildID
                ],
                [
                    'name' => 'form_token',
                    'contents' => $formToken
                ],
                [
                    'name' => 'form_id',
                    'contents' => $formID
                ],
                [
                    'name' => 'additional_settings__active_tab',
                    'contents' => ''
                ],
                [
                    'name' => 'op',
                    'contents' => 'Save'
                ],
            ]
        ]);
        if($response->getStatusCode() != 200) {
            Log::error('Failed to upload to TrapNZ with status: ' . $response->getStatusCode(), [
                $response->getStatusCode(),
                $response->getHeaders(),
                $response->getBody()
            ]);
            $this->fail();
        } else {
            Log::debug('Upload to trap NZ finished with status code:  ' . $response->getStatusCode(), [
                $response->getStatusCode(),
                $response->getHeaders(),
                $response->getBody()
            ]);
        }
    }

    private function speciesToValue($species) {
        switch ($species) {
            case "None":
                return 82;
            case "Unspecified":
                return 103;
            case "Bird":
                return 29;
            case "Cat":
                return 27;
            case "Deer":
                return 1073;
            case "Dog":
                return 104;
            case "Ferret":
                return 20;
            case "Goat":
                return 3449;
            case "Hare":
                return 2682;
            case "Hedgehog":
                return 25;
            case "Magpie":
                return 309;
            case "Mouse":
                return 24;
            case "Peafowl":
                return 2987;
            case "Pig":
                return 1072;
            case "Possum":
                return 19;
            case "Pūkeko":
                return 4430;
            case "Rabbit":
                return 26;
            case "Rat":
                return 23;
            case "Rat - Kiore":
                return 3409;
            case "Rat - Norway":
                return 3410;
            case "Rat - Ship":
                return 3411;
            case "Stoat":
                return 22;
            case "Turkey":
                return 2988;
            case "Other":
                return 30;
            case "Weasel":
                return 21;
            default:
                return 'Undefined';
        }
    }

    private function statusToValue($status) {
        switch($status) {
            case "Removed for Repair":
                return 2615;
            case "Sprung":
                return 2;
            case "Trap Replaced":
                return 2616;
            case "Still set, bait OK":
                return 1;
            case "Still set, bait missing":
                return 3;
            case "Still set, bait bad":
                return 91;
            case "Trap gone":
                return 4;
            case "Trap interfered by stock":
                return 5;
            default:
                return 'Undefined';
        }
    }

    private function baitToValue($bait) {
        switch($bait) {
            case "Carrot":
                return 98;
            case "Lure-it Salmon Spray":
                return 2484;
            case "Smooth":
                return 1065;
            case "Terracotta Lures":
                return 2485;
            case "Cereal":
                return 106;
            case "Cheese":
                return 205;
            case "Chocolate":
                return 99;
            case "Dehydrated Rabbit":
                return 80;
            case "Dried fruit":
                return 46;
            case "Ferret Bedding":
                return 100;
            case "Fresh Fruit":
                return 45;
            case "Fresh Meat":
                return 16;
            case "Fresh Possum":
                return 274;
            case "Fresh Rabbit":
                return 273;
            case "Golf ball":
                return 96;
            case "Goodnature Rat and Mouse Lure":
                return 821;
            case "Goodnature Stoat Lure":
                return 798;
            case "Lure":
                return 47;
            case "Mayo":
                return 824;
            case "Mustelid and Cat Lure":
                return 92;
            case "Nut":
                return 812;
            case "Nutella":
                return 1036;
            case "Peanut Butter":
                return 48;
            case "Possum Dough":
                return 850;
            case "Rat and Possum Lure":
                return 93;
            case "Rat oil":
                return 101;
            case "Salted meat":
                return 17;
            case "Salted Possum":
                return 275;
            case "Salted Rabbit":
                return 272;
            case "Tinned Sardines":
                return 768;
            case "Whole egg":
                return 15;
            case "None":
                return 83;
            case "Other (please specify)":
                return 18;
            default:
                return 'undefined';
        }
    }
}
