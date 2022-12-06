<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $dailyReports = $this->dailyReports->map(function($report) {
            return [
                'id' => $report->id, 
                'task_id' => $report->task_id,
                'employee_id' => $report->employee_id,
                'description' => $report->description,
                'date' => $report->date,
                'start' => $report->start,
                'end' => $report->end,
                'total_minutes' => $report->total_minutes,
                'blocker' => $report->blocker,
                'todo' => $report->todo,
            ];
        });
        
        // $dailyReports = [];
        // foreach($this->dailyReports as $report) {
        //     $dailyReports[] = [
        //         'id' => $report->id, 
        //         'task_id' => $report->task_id,
        //         'employee_id' => $report->employee_id,
        //         'description' => $report->description,
        //         'date' => $report->date,
        //         'start' => $report->start,
        //         'end' => $report->end,
        //         'total_minutes' => $report->total_minutes,
        //         'blocker' => $report->blocker,
        //         'todo' => $report->todo,
        //     ];
        // }

        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'name' => $this->name,
            'description' => $this->description,
            'est_hours' => $this->est_hours,
            'daily_reports' => $dailyReports
        ];
    }
}
