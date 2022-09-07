<?php

namespace App\Http\Controllers;

use App\Weather\WeatherAPI;
use Illuminate\Http\Request;
use App\DTO\Weather;

class WeatherController extends Controller
{
    public function weatherData(Request $request, WeatherAPI $cityCheck)
    {
        $data = Weather\WeatherForm::fromRequest($request);

        if ($cityCheck->isIssetCity($data->city)) {
            return view('weather', ['weather' => $cityCheck->getWeatherData($data->city, $data->interval), 'cityName' => $data->city]);
        } else {
            return view('weather', ['cityWrongName' => $data->city]);
        }
    }

}
