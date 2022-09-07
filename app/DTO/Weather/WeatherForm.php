<?php

namespace App\DTO\Weather;

use Illuminate\Http\Request;

class WeatherForm
{
    public string $city;
    public int $interval;

    public function __construct(string $city, int $interval)
    {
        $this->city = $city;
        $this->interval = $interval;
    }

    public static function fromRequest(Request $request): WeatherForm
    {
        return new static(
            $request->get('city'),
            $request->get('listWeather')
        );
    }
}
