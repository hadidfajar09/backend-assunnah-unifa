<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'email' => $this->email,
            'password' => $this->password,
            'name' => $this->name,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'alamat' => $this->alamat,
            'avatar' => env('ASSET_URL') . "/uploads/" . $this->avatar,


        ];
    }
}
