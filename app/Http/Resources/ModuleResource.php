<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ModuleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->document == NULL) {
            $document = NULL;
        } else {
            $document = env('ASSET_URL') . "/uploads/" . $this->document;
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'module_type' => $this->module_type,
            'file_type' => $this->file_type,
            'document' => $document,
            'youtube' => $this->youtube,
            'order' => $this->order,
            'view' => $this->view

        ];
    }
}
