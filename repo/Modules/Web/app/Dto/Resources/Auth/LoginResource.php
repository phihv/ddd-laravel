<?php

namespace Modules\Web\app\Dto\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'order_id' => $this->id,
            'order_status' => $this->status,
            'order_total' => $this->totalAmount,
        ];
    }
}
