<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getAllUsers() {
        return User::all();
    }

    public function getUsersWithPaginate($per_page = 10) {
        return User::paginate($per_page);
    }

    public function createUser($data) {
        return User::create($data);
    }

    public function getUserByID($id) {
       return User::find($id);
    }

    public function getUserByEmail($email) {
        return User::where('email', $email)->first();
    }

    public function updateUser($data, $id) {

        $user = User::find($id);

        if($user) {
            $user->update($data);
        }

        return $user->refresh();
    }

    public function deleteUser($id) {

        $user = User::find($id);

        if($user) {
            $user->delete();
        }
    }
}