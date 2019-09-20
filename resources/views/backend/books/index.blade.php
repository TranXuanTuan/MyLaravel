@extends('backend.layouts.content')

@section('content')
    <h2>Book list</h2>

    <div class="row">
        <div class="col-2">
            <p><a href="{{ route('admin-book-add') }}" class="btn btn-dark">Add Book</a></p>
        </div>
        <div class="col-10">
            <form action="{{ route('admin-book-index') }}" method="get">
                <table class="table table-bordered">
                    <tr>
                        <td><label>Category Name</label></td>
                        <td>
                            {{ Form::select('category_id', [null => 'Please choose category'] + $categories, $category_id, ['class' => 'form-control']) }}
                        </td>
                        <td><label>Book Name</label></td>
                        <td>
                            <input type="text" name="search_book_name" value="{{ isset($search_book_name) ? $search_book_name : '' }}" class="form-control">
                        </td>
                        <td><input type="submit" value="Search" class="btn btn-dark"></td>
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

    @if(empty($books))
        <p class="error">Data empty</p>
    @else
        <table class="table table-bordered">
            <tr>
                <th>STT</th>
                <th>Name</th>
                <th>Category Name</th>
                <th>Thumbnail</th>
                <th colspan="3">Action</th>
            </tr>
            @foreach($books as $key => $book)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $book->name }}</td>
                    <td>{{ $book->category->name }}</td>
                    <td>
                        @if(!empty($book->picture) && Storage::disk('local')->exists($book->picture))
                            <img src="{{ Storage::disk('local')->url($book->picture) }}" alt="{{ $book->picture }}" class="img-fluid">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin-book-detail', $book->id) }}" class="btn btn-dark">Detail</a>
                    </td>
                    <td>
                        <a href="{{ route('admin-book-edit', $book->id) }}" class="btn btn-success">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('admin-book-delete', $book->id) }}" method="post">
                            @csrf
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        {{ $books->links() }}
    @endif
@endsection