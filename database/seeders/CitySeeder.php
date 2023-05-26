<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Storage::disk('local')->exists('Cities.json')){
            $cities = Storage::disk('local')->get('Cities.json');
            foreach (json_decode($cities) as $city){
                City::create([
                    'category'=>$city->object_category,
                    'name'=>$city->object_name,
                    'region'=>$city->region,
                    'community'=>$city->community,
                ]);
            }
        }
        else throw new FileNotFoundException('Cities.json!');
    }
}
