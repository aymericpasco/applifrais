<?php /** @noinspection ALL */

namespace App\Http\Resources;

use GoogleMaps\GoogleMaps;
use Illuminate\Http\Resources\Json\JsonResource;
use function MongoDB\BSON\fromJSON;

class OfficeResource extends JsonResource
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
            'street_number' => $this->street_number,
            'street_name' => $this->street_name,
            'city' => $this->city,
            'zip_code' => $this->zip_code,
            'latitude' => json_decode((new GoogleMaps)->load('geocoding')
                ->setParam(['address' => (string)$this->streer_number . " " . $this->streert_name . ", " . (string)$this->zip_code . " " . $this->city])
                ->get())->results[0]->geometry->location->lat,
            'longitude' => json_decode((new GoogleMaps)->load('geocoding')
                ->setParam(['address' => (string)$this->streer_number . " " . $this->streert_name . ", " . (string)$this->zip_code . " " . $this->city])
                ->get())->results[0]->geometry->location->lng,
        ];
    }

    /*public function with($request)
    {
        return [
            'latitude' => json_decode((new GoogleMaps)->load('geocoding')
                ->setParam(['address' => (string)$this->streer_number . " " . $this->streert_name . ", " . (string)$this->zip_code . " " . $this->city])
                ->get())->results[0]->geometry->location->lat,
            'longitude' => json_decode((new GoogleMaps)->load('geocoding')
                ->setParam(['address' => (string)$this->streer_number . " " . $this->streert_name . ", " . (string)$this->zip_code . " " . $this->city])
                ->get())->results[0]->geometry->location->lng,
        ];
    }*/
}
