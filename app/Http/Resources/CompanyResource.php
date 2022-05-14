<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class CompanyResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     *
     * @return array
     */
    #[ArrayShape([
        'name'        => "mixed",
        'avatar'      => "mixed",
        'email'       => "mixed",
        'phone'       => "mixed",
        'address'     => "mixed",
        'description' => "mixed",
        'leader'      => "mixed",
    ])] public function toArray($request): array
    {
        return [
            'name'        => $this->name,
            'avatar'      => $this->avatar,
            'email'       => $this->email,
            'phone'       => $this->phone,
            'address'     => $this->address,
            'description' => $this->description,
            'leader'      => $this->leader,
        ];
    }

}
