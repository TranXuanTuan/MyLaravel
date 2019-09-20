@extends('frontend.layouts.content')

@section('content')
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

    <h2>{{ $book->name }}</h2>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label>Publisher</label>
                <input type="text" name="publisher" class="form-control" value="{{ $book->publisher }}" disabled>
            </div>

            <div class="form-group">
                <label>Author of books</label>
                <input type="text" name="author" class="form-control" value="{{ $book->author }}" disabled>
            </div>

            <div class="form-group">
                <label>Num Of Page</label>
                <input type="text" name="num_of_page" class="form-control" value="{{ $book->num_of_page }}" disabled>
            </div>

            <div class="form-group">
                <label for="customFile">Picture</label><br>
                @if(!empty($book->picture) && Storage::disk('local')->exists($book->picture))
                    <img src="{{ Storage::disk('local')->url($book->picture) }}" alt="{{ $book->picture }}" class="img-fluid">
                @else
                    <img src="/images/no-image.png" alt="no image">
                @endif
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label>Category ID</label>
                <input type="text" name="category_id" value="{{ $book->category->name }}" disabled class="form-control">
            </div>

            <div class="form-group">
                <label>Maximum number of date you can borrow this book</label>
                <input type="text" name="max_date" class="form-control" value="{{ $book->max_date }}" disabled>
            </div>

            <div class="form-group">
                <label>Number of copy of book in the library</label>
                <input type="text" name="num" class="form-control" value="{{ $book->num }}" disabled>
            </div>

            <div class="form-group">
                <label>Summary</label>
                <textarea name="summary" rows="5" class="form-control" disabled>{{ $book->summary }}</textarea>
            </div>
        </div>
    </div>
    <ul class="book-action-list">
        <li><a href="{{ route('book-index') }}" class="btn btn-secondary">Book List</a></li>
        <li><a href="{{ route('order', $book->id) }}" class="btn btn-success">Order Book</a></li>
    </ul>
@stop
