<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Get profile for user
     *
     */
    public function profile(Request $request): \Illuminate\Http\JsonResponse
    {
        $users = User::all();
        $profileArray = [];

        foreach ($users as $key => $user) {
            $profileArray[] = ([
                'user' => $user,
                'profile' => $user->profile
            ]);
        }
        return response()->json($profileArray);
    }

    public function test(Request $request)
    {
        echo('works????');
    }
}
