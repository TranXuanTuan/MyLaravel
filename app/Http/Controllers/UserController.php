<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}
    public function profile()
    {
        $user = Auth::user();
        $profile = $user->profile;

        $userInfo = [
        	"id" => $user->id,
        	"name" => $user->name,
        	"email" => $user->email,
        ];

        return response()->json($userInfo);
    }
}
