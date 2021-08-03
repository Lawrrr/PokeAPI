<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile() {
        $user = Auth::user();
        if($user) {
            $response = [
                'user' => $user
            ];
        } else {
            $response = [
                'message' => "User not found..."
            ];
        }

        return response($response);
    }

    public function update(Request $request) {
        $user = Auth::user();
        if($user) {
            $user->first_name = $request['first_name'];
            $user->last_name = $request['last_name'];
            $user->date_of_birth = $request['date_of_birth'];
            $user->save(); 

            $response = [
                'message' => 'Profile successfully updated!'
            ];
        } else {
            $response = [
                'message' => 'Profile could not be updated...'
            ];
        }

        return response($response);
    }
}
