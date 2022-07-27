<?php

namespace App\Http\Resources;

use App\Models\Project;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CoordinatorSettingsResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $projects = $this->collection;
        $data_array = [];
        if(count($projects)) {
            $builder_array = [];
            foreach ($projects as $project) {
                $builder_array['id'] = $project->id;
                $builder_array['notify_catches'] = $project->pivot->notify_catches;
                $builder_array['name'] = $project->name;
                $builder_array['catch_filter'] = $project->pivot->catch_filter ?? null;
                $builder_array['notify_problems'] = $project->pivot->notify_problems;
                $data_array[] = $builder_array;
            }
        }
        return $data_array;
    }

    /*
     * Previous format for dynamic coordination settings form
     */
    public function oldFormat($request)
    {
        $projects = $this->collection;
        $fields = Project::USER_PROJECT_COORDINATOR_SETTINGS;
        $labels = Project::USER_PROJECT_COORDINATOR_LABELS;
        $data_array = [];
        if(count($projects)) {
            foreach ($projects as $project) {
                $builderArray = [];
                $builderArray['id'] = $project->id;
                $builderArray['name'] = $project->name;
                $settingsArray = [];
                foreach ($fields as $key => $field) {
                    $settingsArray[] = [
                        'key' => $field,
                        'value' => $project->pivot[$field],
                        'label' => $labels[$key]
                    ];
                }
                $builderArray['settings'] = $settingsArray;
                $data_array[] = $builderArray;
            }
        }
        return $data_array;
    }
}

