<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class StackResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     *
     * @return array
     */
    #[ArrayShape([
        'id'    => "mixed",
        'name'  => "mixed",
        'url'   => "mixed",
        'photo' => "mixed",
    ])] public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'url'   => $this->url,
            'photo' => $this->photo,
        ];
    }

}
