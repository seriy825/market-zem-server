<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\CityRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CityController extends Controller
{
    private CityRepositoryInterface $cityRepository;
    public function __construct(CityRepositoryInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }
    public function regions()
    {
        $regions = $this->cityRepository->getRegions();
        return response()->json($regions,200);
    }
    public function distincts($region)
    {
        $distincts = $this->cityRepository->getDistincts($region);
        return response()->json($distincts,200);
    }
    public function cities($region,$distinct)
    {
        $cities = $this->cityRepository->getCities($region,$distinct);
        return response()->json($cities,200);
    }
    public function view($cityId)
    {
        $city = $this->cityRepository->getCity($cityId);
        return response()->json($city,200);
    }
}
