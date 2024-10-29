<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SeatsRowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'A' => isset($this['A']) ? $this['A'] : [],
            'B' => isset($this['B']) ? $this['B'] : [],
            'C' => isset($this['C']) ? $this['C'] : [],
            'D' => isset($this['D']) ? $this['D'] : [],
            'E' => isset($this['E']) ? $this['E'] : [],
            'F' => isset($this['F']) ? $this['F'] : [],
            'G' => isset($this['G']) ? $this['G'] : [],
            'H' => isset($this['H']) ? $this['H'] : [],
            'I' => isset($this['I']) ? $this['I'] : [],
        ];
    }
}
