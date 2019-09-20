<?php

namespace App\Http\Controllers\Admin;

use App\Profile;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $user;
    protected $role;
    protected $profile;

    public function __construct(User $user, Profile $profile, Role $role)
    {
        $this->user = $user;
        $this->profile = $profile;
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];
        $pageTitle = 'User List';
        $data['pageTitle'] = $pageTitle;

        $sidebar = [
            'parent' => 'user',
            'child' => 'index'
        ];
        $data['sidebar'] = $sidebar;

        $users = $this->user;

        // search with user name
        $search_user_name = null;
        if ($request->search_user_name) {
            $search_user_name = $request->search_user_name;
            $users = $users->where('name', 'like', '%' . $search_user_name . '%');
        }
        $data['search_user_name'] = $search_user_name;

        $users = $users
            ->orderBy('id', 'desc')
            ->paginate(5);
        $data['users'] = $users;

        return view('backend.users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $sidebar = [
            'parent' => 'user',
            'child' => 'add'
        ];
        $data['sidebar'] = $sidebar;

        $roles = $this->role->pluck('name', 'id')->toArray();
        $data['roles'] = $roles;

        $genders = config('common.genders');
        $data['genders'] = $genders;

        return view('backend.users.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        $checkRoleUser = $this->user->roles()->attach($params['role_id']);

        if ($checkUser && $checkProfile && $checkRoleUser) {
            return redirect(route('admin-user-index'))->with('success', 'Insert User successful.');
        }

        // insert fail
        return redirect(route('admin-user-index'))->with('fail', 'Insert User fail.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];
        $sidebar = [
            'parent' => 'user',
            'child' => 'index'
        ];
        $data['sidebar'] = $sidebar;

        $roles = $this->role->pluck('name', 'id')->toArray();
        $data['roles'] = $roles;

        $genders = config('common.genders');
        $data['genders'] = $genders;

        $user = $this->user->find($id);
        $data['user'] = $user;
        return view('backend.users.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        $sidebar = [
            'parent' => 'user',
            'child' => 'index'
        ];
        $data['sidebar'] = $sidebar;

        $roles = $this->role->pluck('name', 'id')->toArray();
        $data['roles'] = $roles;

        $genders = config('common.genders');
        $data['genders'] = $genders;

        $user = $this->user->find($id);
        $data['user'] = $user;
        return view('backend.users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $params = $request->all();
        // save data for table users
        $this->user = $this->user->find($id);
        $this->user->name = $params['name'];
        $this->user->email = $params['email'];
        if (!empty($params['password_new'])) {
            $this->user->password = bcrypt($params['password_new']);
        }
        $checkUser = $this->user->save();

        // save data for table profiles
        $profile = [
            'birthday' => $params['birthday'],
            'gender' => $params['gender'],
            'address' => $params['address']
        ];
        // check avatar ?
        if ($request->hasFile('avatar')) {
            $ext = $request->file('avatar')->getClientOriginalExtension();
            $profile['avatar'] = $request->file('avatar')->storeAs(
                'public/user_images', time() . '.' . $ext
            );
        }
        $checkProfile = $this->profile->where('user_id', $this->user->id)->update($profile);

        // delete avatar old


        // save data for table role_users
        $checkRoleUser = $this->user->roles()->attach($params['role_id']);

        if ($checkUser && $checkProfile && $checkRoleUser) {
            return redirect(route('admin-user-index'))->with('success', 'Insert User successful.');
        }

        // insert fail
        return redirect(route('admin-user-index'))->with('fail', 'Insert User fail.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->roles()->detach();
        $user->profile()->delete();
        $check = $user->delete();
        if ($check) {
            return redirect(route('admin-user-index'))->withSuccess('Delete Successful.');
        }

        return redirect(route('admin-user-index'))->withError('Delete Fail.');
    }
}
