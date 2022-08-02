<?php

namespace App\Jobs;

use App\Models\Trap;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use MatanYadaev\EloquentSpatial\Objects\Point;

class UpdateTraps implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $project_id;
    public $project_nz_id;
    public User $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($project_nz_id,$project_id, User $user)
    {
        $this->user = $user;
        $this->project_id = $project_id;
        $this->project_nz_id = $project_nz_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->notify(new \App\Notifications\RealTimeNotification('Sync trap.nz traps START'));
        try {
            $data = file_get_contents("https://io.trap.nz/geo/trapnz-projects/wfs/O2ZNGAUpOJ5cHNZPx7wF6RaNort9J72jzlnCNLvOQGQ/".$this->project_nz_id."?service=WFS&version=1.0.0&request=GetFeature&typeName=trapnz-projects:default-project-trap-records&outputFormat=json");
            \Log::alert($data);
            $json = json_decode($data, true);
            \Log::alert($json);

            $collection = collect();
            foreach($json['features'] as $item){
                $collection->push((object)[
                    'coordinates' => new Point($item['geometry']['coordinates'][0],$item['geometry']['coordinates'][1]),
                    'project'=>$item['properties']['project'],
                    'project_id'=>$item['properties']['project_id'],
                    'trap_code'=>$item['properties']['trap_code'],
                    'trap_id'=>$item['properties']['trap_id'],
                    'trap_type'=>$item['properties']['trap_type'],
                    'line'=>$item['properties']['line'],
                ]);
            }
            if ($collection->count() > 0){
                $count_add = 0;
                foreach ($collection as $item) {
                    if(!Trap::where('nz_trap_id',$item->trap_id)->exists()){
                        Trap::Create([
                            'nz_trap_id' => $item->trap_id,
                            'project_id' => $this->project_id,
                            'name' => $item->trap_code,
                            'coordinates' => $item->coordinates
                        ]);
                        $count_add += 1;
                    }
                }

                $this->user->notify(new \App\Notifications\RealTimeNotification('Sync done. Add '.$count_add.' traps'));
            }else{
                $this->user->notify(new \App\Notifications\RealTimeNotification('Nothing to sync'));
            }

        }catch (\Exception $e){
            $this->user->notify(new \App\Notifications\RealTimeNotification('Wops, error!'));
            \Log::alert($e);
        }
    }
}
