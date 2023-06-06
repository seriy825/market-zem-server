<?php

namespace App\Interfaces;

use App\Http\Requests\Favorites\AddToFavoritesRequest;
use App\Http\Requests\Favorites\RemoveFromFavoritesRequest;
use App\Http\Requests\User\UserUpdateRequest;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function getUser($token);
    public function updateUser($id,UserUpdateRequest $user);
    public function getListingsByUser($id);
    public function getFavoritedListings($id);
    public function addToFavorites($listingId,AddToFavoritesRequest $addToFavoritesRequest);
    public function removeFromFavorites($listingId,RemoveFromFavoritesRequest $removeFromFavoritesRequest);
}
