@extends('backend.layouts.content')

@section('content')
    <h2>User list</h2>

    <div class="row">
        <div class="col-3">
            <p><a href="{{ route('admin-user-add') }}" class="btn btn-dark">Add User</a></p>
        </div>
        <div class="col-9">
            <form action="{{ route('admin-user-index') }}" method="get">
                <table class="table table-bordered">
                    <tr>
                        <td>User Name</td>
                        <td>
                            <input type="text" name="search_user_name" value="{{ $search_user_name }}"class="form-control">
                        </td>
                        <td>
                            <input type="submit" value="Search" class="btn btn-dark">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    {{--show message success--}}
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    {{--show message fail--}}
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    @if(empty($users))
        <p class="error">Data empty</p>
    @else
        <table class="table table-bordered">
            <tr>
                <th>STT</th>
                <th>User Name</th>
                <th>Role Name</th>
                <th>Avatar</th>
                <th colspan="3">Action</th>
            </tr>
            @foreach($users as $key => $user)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ empty($user->roles->first()->name) ? '' : $user->roles->first()->name }}</td>
                    <td>
                        @if(!empty($user->profile->avatar) && Storage::disk('local')->exists($user->profile->avatar))
                            <img src="{{ Storage::disk('local')->url($user->profile->avatar) }}" alt="{{ $user->profile->avatar }}" class="img-fluid">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin-user-detail', $user->id) }}" class="btn btn-dark">Detail</a>
                    </td>
                    <td>
                        <a href="{{ route('admin-user-edit', $user->id) }}" class="btn btn-success">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('admin-user-delete', $user->id) }}" method="post">
                            @csrf
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        {{ $users->links() }}
    @endif
@endsection