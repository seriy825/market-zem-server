<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Listing\CreateListingRequest;
use App\Interfaces\ListingRepositoryInterface;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    private ListingRepositoryInterface $listingRepository;
    public function __construct(ListingRepositoryInterface $listingRepository)
    {
        $this->listingRepository = $listingRepository;
    }
    public function index(Request $request)
    {
        $cities = $this->listingRepository->getListings($request);
        return response()->json($cities,200);
    }
    public function view($listingId)
    {
        $listing = $this->listingRepository->getListing($listingId);
        return response()->json($listing,200);
    }
    public function create(CreateListingRequest $listingData){
        $listing = $this->listingRepository->create($listingData);
        return response()->json($listing,200);
    }
    public function update($listingId){
        return response()->json($this->listingRepository->update($listingId),200);
    }
    public function delete($listingId){
        return response()->json($this->listingRepository->delete($listingId),200);
    }
}
