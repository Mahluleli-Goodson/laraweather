<?php

namespace App\Services;

use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class TemperatureService {

    /**
     * Fetch data from API
     *
     * @param  $latitude
     * @param  $longitude
     * @return mixed
     * @throws GuzzleException
     */
    public function callTempApi($latitude, $longitude)
    {
        $apiKey = env('API_KEY');
        $client = new Client();
        $response = $client->request(
            'GET',
            "api.openweathermap.org/data/2.5/weather?lat=$latitude&lon=$longitude&appid=$apiKey"
        );

        return json_decode($response->getBody(), true);
    }

    /**
     * Structure payload to proper response
     * @param  array  $payload
     * @return array
     */
    public function structureResults(array $payload)
    {
        try {
            $data = [
                "time" => Carbon::now()->format("M d Y H:i:s"),
                "name" => $payload["name"],
                "latitude" => $payload["coord"]["lat"],
                "longitude" => $payload["coord"]["lon"],
                "temp" => $payload["main"]["temp"], // todo: make helper convert to celsius
                "pressure" => $payload["main"]["pressure"],
                "humidity" => $payload["main"]["humidity"],
            ];
        } catch (Exception $exc) {
            app('log')->error($exc->getMessage());
            return [];
        }

        return $data;
    }

    /**
     * @param $place
     * @return array
     * @throws GuzzleException
     */
    public function getTempPerPlace($place)
    {
        $place = strtolower($place);

        $ourLocations = [
            "berlin mitte" => ["lat" => "52.520008", "lng" => "13.404954"],
            "berlin friedrichshain" => ["lat" => "52.515816", "lng" => "13.454293"],
        ];

        if (!isset($ourLocations[$place])) {
            app('log')->error("Unknown Place :: $place");
            return [];
        }

        $lat = $ourLocations[$place]["lat"];
        $lng = $ourLocations[$place]["lng"];

        $resp = $this->callTempApi($lat, $lng);

        return $this->structureResults($resp);
    }
}
