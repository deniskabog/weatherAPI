<?php

namespace App\Weather;

class WeatherAPI
{
    public array $cityData;

    public function isIssetCity($city): bool
    {
        $options = [
            'q' => $city,
            'limit' => '5',
            'appid' => $_ENV['API_KEY']
        ];

        $url = $_ENV['API_HOST'] . '/geo/1.0/direct';
        $response = $this->getResponse($url, $options);

        if ($response == '[]' || is_numeric($city)) {
            return false;
        } else {
            return true;
        }
    }

    public function getWeatherData($city, $days)
    {
        $url = $_ENV['API_HOST'] . '/data/2.5/forecast';

        $options = [
            'q' => $city,
            'appid' => $_ENV['API_KEY'],
            'units' => 'metric',
            'lang' => 'ru',
            'cnt' => $days
        ];

        $response = $this->getResponse($url, $options);
        file_put_contents('weather.json', $response);

        $data_weather = json_decode($response, true);
        $this->cityData = $data_weather['list'];
        return $this->cityData;
    }

    private function getResponse($url, $options)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($options));
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}
