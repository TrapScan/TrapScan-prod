<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'roles' => $this->roles ?? [],
            'inspections' => $this->inspections()->count(),
            'catches' => $this->catches(),
            'stats_per_day' => $this->catches_per_day(),
            'settings' => $this->settings
        ];
    }
}
