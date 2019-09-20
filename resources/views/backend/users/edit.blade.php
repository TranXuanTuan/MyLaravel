@extends('backend.layouts.content')

@section('content')
    <form action="{{ route('admin-user-edit', $user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password_new" class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label for="customFile">Avatar</label><br>
                            @if(!empty($user->profile->avatar) && Storage::disk('local')->exists($user->profile->avatar))
                                <img src="{{ Storage::disk('local')->url($user->profile->avatar) }}" alt="{{ $user->profile->avatar }}" class="img-fluid">
                            @endif
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="avatar">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Role ID</label>
                            {{ Form::select('role_id', [null => 'Please choose a Role'] + $roles, $user->roles->first()->id, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group">
                            <label>Birthday</label>
                            <input type="text" name="birthday" class="form-control" value="{{ $user->profile->birthday }}">
                        </div>

                        <div class="form-group">
                            <label>Gender</label>
                            {{ Form::select('gender', [null => 'Please choose gender'] + $genders, $user->profile->gender, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" value="{{ $user->profile->address }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group text-center">
            <a href="{{ route('admin-user-index') }}" class="btn btn-secondary">User List</a>
            <input type="submit" value="Update" name="submit" class="btn btn-success">
        </div>
    </form>
@endsection