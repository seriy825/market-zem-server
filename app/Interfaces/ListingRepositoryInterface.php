<?php

namespace App\Interfaces;
use App\Http\Requests\Listing\CreateListingRequest;
use Illuminate\Http\Request;

interface ListingRepositoryInterface
{
    public function getListings(Request $request);
    public function getListing($id);
    public function create(CreateListingRequest $listingDetails);
    public function update($id);
}
