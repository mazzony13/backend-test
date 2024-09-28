<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'avatar' => $this->getFirstMediaUrl('avatar'),
            'is_active' => $this->is_active,
            'type'=>  $this->type ?  \App\Enums\UserType::from($this->type)->value : null, // get user type
            'role'=>$this->roles()->first() ? $this->roles()->first()->name : null
        ];
    }
}
