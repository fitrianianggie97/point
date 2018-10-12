<?php

namespace App\Http\Resources\HumanResource\Kpi\KpiCategory;

use App\Http\Resources\ApiResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\HumanResource\Kpi\KpiGroup\KpiGroupResource;

class KpiResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'date' => $this->date,
            'employee' => new ApiResource($this->employee),
            'weight' => $this->weight,
            'target' => $this->target,
            'score' => $this->score,
            'score_percentage' => $this->score_percentage,
            'scorer' => new ApiResource($this->scorer),
            'groups' => KpiGroupResource::collection($this->groups),
        ];
    }
}
