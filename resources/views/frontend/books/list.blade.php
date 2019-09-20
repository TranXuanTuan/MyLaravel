@extends('frontend.layouts.content')

@section('content')
    @if(empty($books))
        <p class="error">Data empty</p>
    @else
        <div class="row">
            @foreach($books as $key => $book)
                <div class="col-3">
                    <div class="book-content">
                        <h2 class="book-name">{{ $book->name }}</h2>
                        <p class="read-more"><a href="{{ route('book-detail', $book->id) }}">Chi tiết</a></p>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $books->links() }}
    @endif
@endsection