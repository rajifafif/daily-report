<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $tasks = $this->employee->tasks->map(function($report) {
            return [
                'id' => $report->id, 
                'parent_id' => $report->parent_id,
                'name' => $report->name,
                'description' => $report->description,
                'est_hours' => $report->est_hours
            ];
        });


        return [
            'id' => $this->id,
            'email' => $this->email,
            'password' => $this->password,
            'employee_id' => $this->employee_id,
            'token' => $this->token,
            'id' => $this->employee->id,
            'name' => $this->employee->name,
            'name_prefix' => $this->employee->name_prefix,
            'name_suffix' => $this->employee->name_suffix,
            'nik' => $this->employee->nik,
            'phone' => $this->employee->phone,
            'gender' => $this->employee->gender,
            'birth_date' => $this->employee->birth_date,
            'birth_place' => $this->employee->birth_place,
            'role_id' => $this->employee->role_id,
            'last_education' => $this->employee->last_education,
            'religion' => $this->employee->religion,
            'marital_status' => $this->employee->marital_status,
            'main_address_id' => $this->employee->main_address_id,
            'tasks' => $tasks
        ];
    }
}
