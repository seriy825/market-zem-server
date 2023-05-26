<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface CityRepositoryInterface
{
    public function getRegions();
    public function getDistincts($region);
    public function getCities($region,$distinct);
    public function getCity($id);
}
