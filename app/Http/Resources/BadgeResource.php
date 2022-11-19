<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BadgeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $isAchieved = $this->resource->hasBeenAchievedBy(auth()->user());
        $data = [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'description' => $this->resource->description,
            'image_url' => url('/img/badges/' . $this->resource->id . '.svg'),
            'progress' => $isAchieved ? 1 : 0,
            'is_achieved' => $isAchieved
        ];
        if ($data['is_achieved']) {
            $data['achieved_at'] = auth()->user()->badges()->where('badge_id', $this->resource->id)->first()->pivot->created_at;
        }

        return $data;
    }
}
