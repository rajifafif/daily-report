<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $permissions = $this->permissions->map(function($report) {
            return [
                'id' => $report->id, 
                'name' => $report->name,
                'guard_name' => $report->guard_name,
                'pivot' => $report->pivot,
            ];
        });

        return[
            'id' => $this->id,
            'name' => $this->name,
            'guard_name' => $this->guard_name,
            'permissions' => $permissions
        ];
    }
}
