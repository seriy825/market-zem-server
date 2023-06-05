<?php

namespace App\Repositories\User;

use App\Http\Requests\User\UserUpdateRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
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
        return $user->listings()->with('user','city','assignment','images')->paginate(15);
    }
}
