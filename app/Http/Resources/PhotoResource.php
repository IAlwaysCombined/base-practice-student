<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class PhotoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    #[ArrayShape([
        'id' => "string",
        'url' => "string"
    ])] public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'url' => $this->url
        ];
    }
}
