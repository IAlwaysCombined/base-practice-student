<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'surname'       => $this->surname,
            'patronymic'    => $this->patronymic,
            'email'         => $this->email,
            'phone'         => $this->phone,
            'bday'          => $this->bday,
            'avatar'        => $this->avatar,
            'speciality_id' => $this->speciality_id,
            'course'        => $this->course,
        ];
    }

}
