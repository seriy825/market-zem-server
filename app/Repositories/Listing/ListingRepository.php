<?php

namespace App\Repositories\Listing;

use App\Http\Requests\Listing\CreateListingRequest;
use App\Interfaces\ListingRepositoryInterface;
use App\Models\Listing;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Http\Request;

class ListingRepository implements ListingRepositoryInterface
{
    public function getListings(Request $request){
        $query = Listing::query();

        if ($request->filled('region')){
            $query=$query->regionFilter($request->region);
            if ($request->filled('community')){
                $query=$query->communityFilter($request->region,$request->community);
                if ($request->filled('city')){
                    $query=$query->cityFilter($request->region,$request->community,$request->city);
                }
            }
        }
        return $query->get();
    }
    public function getListing($listingId){
        return Listing::findOrFail($listingId);
    }
    public function create(CreateListingRequest $listingDetails){
        $user = PersonalAccessToken::findToken($listingDetails->token)->tokenable()->first();
        $listingDetails['user_id']=$user->id;
        unset($listingDetails->token);
        $listing = Listing::create($listingDetails->all());
        return $listing;
    }
    public function update($listingId){
        $listing = Listing::query()->where('id',$listingId)->get();
        $listing->update(['approved'=>true]);
        return true;
    }
}
