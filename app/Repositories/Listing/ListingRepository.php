<?php

namespace App\Repositories\Listing;

use App\Http\Requests\Listing\CreateListingRequest;
use App\Interfaces\ListingRepositoryInterface;
use App\Models\Image;
use App\Models\Listing;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Http\Request;

class ListingRepository implements ListingRepositoryInterface
{
    public function getListings(Request $request){
        $query = Listing::query();

        if ($request->filled('region')){
            $query=$query->regionFilter($request->region);
            if ($request->filled('distinct')){
                $query=$query->communityFilter($request->region,$request->distinct);
                if ($request->filled('city')){
                    $query=$query->cityFilter($request->region,$request->distinct,$request->city);
                }
            }
        }
        $query=$query->orderBy('created_at','desc');
        if ($request->filled('approved')){
            $query=$query->approvedFilter($request->approved);
        }
        if ($request->filled('priceFrom')){
            $query=$query->priceFromFilter($request->priceFrom);
        }
        if ($request->filled('priceTo')){
            $query=$query->priceToFilter($request->priceTo);
        }
        if ($request->filled('squareFrom')){
            $query=$query->squareFromFilter($request->squareFrom);
        }
        if ($request->filled('squareTo')){
            $query=$query->squareToFilter($request->squareTo);
        }
        if ($request->filled('createSort')){
            $query=$query->orderBy('created_at',$request->createSort);
        }
        if ($request->filled('priceSort')){
            $query=$query->orderBy('rental_price',$request->priceSort);
        }
        if ($request->filled('limit')){
            return $query->with('user','city','assignment','images')->paginate($request->limit);
        }
        return $query->with('user','city','assignment','images')->paginate(15);
    }
    public function getListing($listingId){

        return Listing::query()->with('user','city','assignment','images')->where('id',$listingId)->first();
    }
    public function create(CreateListingRequest $listingDetails){
        $user = PersonalAccessToken::findToken($listingDetails->token)->tokenable()->first();
        $listingDetails['user_id']=$user->id;
        unset($listingDetails->token);
        $images=[];
        $files = $listingDetails->file('images');
        foreach($files as $file){
            $url = cloudinary()->upload($file->getRealPath())->getSecurePath();
            array_push($images,Image::create(['url'=>$url])->id);
        }
        $listing = Listing::create($listingDetails->all());
        $listing->images()->sync($images);
        return $listing;
    }
    public function update($listingId){
        return Listing::findOrFail($listingId)->update(['approved'=>true]);
    }
    public function delete($listingId){
        $listing = Listing::findOrFail($listingId);
        $listing->images()->delete();
        return Listing::destroy($listingId);
    }
}
