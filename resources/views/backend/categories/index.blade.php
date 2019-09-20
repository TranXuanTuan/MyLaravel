@extends('backend.layouts.content')

@section('content')
    <h2>Category list</h2>

    <div class="row">
        <div class="col-3">
            <p><a href="{{ route('admin-category-add') }}" class="btn btn-dark">Add Category</a></p>
        </div>
        <div class="col-9">
            <form action="{{ route('admin-category-index') }}" method="get">
                <table class="table table-bordered">
                    <tr>
                        <td>Category Name</td>
                        <td>
                            <input type="text" name="search_category_name" value="{{ isset($search_category_name) ? $search_category_name : '' }}"class="form-control">
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

    @if(empty($categories))
        <p class="error">Data empty</p>
    @else
        <table class="table table-bordered">
            <tr>
                <th>STT</th>
                <th>Category Name</th>
                <th colspan="4">Action</th>
            </tr>
            @foreach($categories as $key => $category)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $category->name }}</td>
                    <td><a href="{{ route('admin-book-index', ['category_id' => $category->id]) }}">Book List</a></td>
                    <td>
                        <a href="{{ route('admin-category-detail', $category->id) }}" class="btn btn-dark">Detail</a>
                    </td>
                    <td>
                        <a href="{{ route('admin-category-edit', $category->id) }}" class="btn btn-success">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('admin-category-delete', $category->id) }}" method="post">
                            @csrf
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        {{ $categories->links() }}
    @endif
@endsection