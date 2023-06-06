<?php

namespace App\Repositories\User;

use App\Http\Requests\Favorites\AddToFavoritesRequest;
use App\Http\Requests\Favorites\RemoveFromFavoritesRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;

class UserRepository implements UserRepositoryInterface
{

    public function getUser($token){
        $user = PersonalAccessToken::findToken($token)->tokenable()->first();
        if (!$user)
            return[
                'user'=>null,
                'status'=>302,
            ];
        return [
            'user'=>$user,
            'status'=>200
        ];
    }
    public function updateUser($id,UserUpdateRequest $userUpdateRequest){
        $user = User::findOrFail($id);
        $user->update($userUpdateRequest->all());
        return $user;
    }
    public function getListingsByUser($id){
        $user = User::findOrFail($id);
        return $user->listings()->orderBy('created_at','desc')->with('user','city','assignment','images','favorites')->paginate(15);
    }
    public function getFavoritedListings($id){
        $user = User::findOrFail($id);
        return $user->favorites()->orderBy('created_at','desc')->with('user','city','assignment','images','favorites')->paginate(15);
    }
    public function addToFavorites($listingId,AddToFavoritesRequest $addToFavoritesRequest){
        $user = PersonalAccessToken::findToken($addToFavoritesRequest->token)->tokenable()->first();
        $listing = Listing::findOrFail($listingId);
        if ($user){
            if ($user->favorites()->where('listing_id',$listingId)->get()->isEmpty()){
                $user->favorites()->attach($listing);
                return true;
            }
        }
        return false;
    }
    public function removeFromFavorites($listingId,RemoveFromFavoritesRequest $removeFromFavoritesRequest){
        $user = PersonalAccessToken::findToken($removeFromFavoritesRequest->token)->tokenable()->first();
        if ($user){
            if ($user->favorites()->where('listing_id',$listingId)->get()){
                DB::table('listing_user')->where('listing_id',$listingId)->where('user_id',$user->id)->delete();
                return true;
            }
        }
        return false;
    }
}
