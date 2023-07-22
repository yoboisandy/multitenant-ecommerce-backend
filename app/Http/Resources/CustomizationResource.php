<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomizationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "store_id" => $this->store_id,
            "theme" => $this->theme,
            "logo" => $this->logo,
            "favicon" => $this->favicon,
            "selected_hero" => $this->selected_hero,
            "hero_title" => $this->hero_title,
            "hero_subtitle" => $this->hero_subtitle,
            "hero_button_text" => $this->hero_button_text,
            "hero_button_url" => $this->hero_button_url,
            "hero_image" => $this->hero_image,
            "selected_navbar" => $this->selected_navbar,
            "topbar_text" => $this->topbar_text,
            "topbar_url" => $this->topbar_url,
        ];
    }
}
