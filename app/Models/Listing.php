<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
        'cadastral_number',
        'rental_status',
        'square',
        'rental_price',
        'price',
        'user_id',
        'city_id',
        'assignment_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }
    public function scopeRegionFilter($query,$region)
    {
        $cities=City::select('id')->where('region',$region)->get();
        return $query->whereIn('city_id',$cities);
    }
    public function scopeCommunityFilter($query,$region,$community)
    {
        $cities=City::select('id')->where('region',$region)->where('community',$community)->get();
        return $query->whereIn('city_id',$cities);
    }
    public function scopeCityFilter($query,$region,$community,$city)
    {
        $city=City::where('region',$region)->where('community',$community)->where('name',$city)->first();
        return $query->where('city_id',$city->id);
    }
}
