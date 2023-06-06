<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\User\UserUpdateRequest;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Favorites\AddToFavoritesRequest;
use App\Http\Requests\Favorites\RemoveFromFavoritesRequest;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function user($token)
    {
        $response = $this->userRepository->getUser($token);
        return response()->json($response,$response['status']);
    }
    public function update($id,UserUpdateRequest $registerRequest)
    {
        $response = $this->userRepository->updateUser($id,$registerRequest);
        return response()->json($response,200);
    }
    public function getListingsByUser($id){
        $response = $this->userRepository->getListingsByUser($id);
        return response()->json($response,200);
    }
    public function addToFavorites($listingId,AddToFavoritesRequest $addToFavoritesRequest){
        $response = $this->userRepository->addToFavorites($listingId,$addToFavoritesRequest);
        return response()->json($response,200);
    }
    public function removeFromFavorites($listingId,RemoveFromFavoritesRequest $removeFromFavoritesRequest){
        $response = $this->userRepository->removeFromFavorites($listingId,$removeFromFavoritesRequest);
        return response()->json($response,200);
    }
    public function getFavoritedListings($id){
        $response = $this->userRepository->getFavoritedListings($id);
        return response()->json($response,200);
    }
}
