<?php

namespace App\Http\Controllers;

use App\Services\TemperatureService;
use GuzzleHttp\Exception\GuzzleException;

class TemperatureController extends Controller
{
    /** @var TemperatureService  */
    private $tempService;

    public function __construct(TemperatureService $temperatureService)
    {
        $this->tempService = $temperatureService;
    }

    /**
     * get temperature of specific place
     * @param $place
     * @return array
     * @throws GuzzleException
     */
    public function temperature($place)
    {
        return $this->tempService->getTempPerPlace($place);
    }
}
