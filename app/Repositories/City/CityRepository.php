<?php

namespace App\Repositories\City;

use App\Interfaces\CityRepositoryInterface;
use App\Models\City;
use Illuminate\Http\Request;

class CityRepository implements CityRepositoryInterface
{
    public function getRegions()
    {
        return City::query()->groupby('region')->havingRaw('COUNT(*)>=1')->pluck('region');;
    }
    public function getDistincts($region)
    {
        return City::query()->where('region',$region)->groupby('community')->havingRaw('COUNT(*)>=1')->pluck('community');;
    }
    public function getCities($region,$distinct)
    {
        return City::query()->select('id','name')->where('region',$region)->where('community',$distinct)->groupby('id','name')->havingRaw('COUNT(*)>=1')->get();
    }
    public function getCity($cityId)
    {
        return City::findOrFail($cityId);
    }
}
