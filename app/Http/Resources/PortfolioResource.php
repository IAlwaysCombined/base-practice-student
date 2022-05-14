<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PortfolioResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     *
     * @return array
     */
    #[ArrayShape([
        'id'          => "int",
        'name'        => "string",
        'description' => "string",
        'url'         => "string",
        'photos'      => AnonymousResourceCollection::class,
    ])] public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'url'         => $this->url,
            'photos'      => PhotoPortfolioResource::collection($this->photo),
        ];
    }

}
