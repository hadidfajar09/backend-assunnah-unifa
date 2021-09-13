<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'category' => $this->category->name,
            'mentor' => $this->user->name,
            'title' => $this->title,
            'description' => $this->description,
            'group' => $this->group,
            'thumbnail' => env('ASSET_URL') . "/uploads/" . $this->thumbnail

        ];
    }
}
