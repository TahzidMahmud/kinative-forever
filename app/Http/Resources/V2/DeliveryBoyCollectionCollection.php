<?php

namespace App\Http\Resources\V2;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DeliveryBoyCollectionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($data) {
                return [
                    'id' => $data->id,
                    'delivery_boy_id' => $data->user_id,
                    'payment' => format_price($data->collection_amount),
                    'date' => Carbon::parse($data->created_at)->format('d-m-Y'),
                ];
            })
        ];
    }
}
