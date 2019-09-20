<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\RegisterRequest;
use App\Profile;
use App\Role;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected $user;
    protected $role;
    protected $profile;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(\App\User $user, Profile $profile, Role $role)
    {
        $this->middleware('guest');

        $this->user = $user;
        $this->profile = $profile;
        $this->role = $role;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(RegisterRequest $request)
    {
        $params = $request->all();
        // save data for table users
        $this->user->name = $params['name'];
        $this->user->email = $params['email'];
        $this->user->password = bcrypt($params['password']);
        $checkUser = $this->user->save();

        // save data for table profiles
        $this->profile->birthday = $params['birthday'];
        $this->profile->gender = $params['gender'];
        $this->profile->address = $params['address'];
        // check avatar ?
        if ($request->hasFile('avatar')) {
            $ext = $request->file('avatar')->getClientOriginalExtension();
            $this->profile->avatar = $request->file('avatar')->storeAs(
                'public/user_images', time() . '.' . $ext
            );
        }
        $checkProfile = $this->user->profile()->save($this->profile);

        // save data for table role_users
        $roles = config('common.roles');
        $role_id = $roles['member'];
        $checkRoleUser = $this->user->roles()->attach($role_id);

        return redirect(route('login'))->with('success', 'Login successful.');
    }
}
