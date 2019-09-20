@extends('frontend.layouts.content')

@section('content')
    <h2>Cart Info</h2>
    @if(empty($books))
        <p class="error">Data empty.</p>
    @else
        <div class="row">
            @foreach($books as $book)
                <div class="col-3">
                    <div class="book-info">
                        <h3>{{ $book->name }}</h3>
                        <div class="book-picture">
                            @if(!empty($book->picture) && Storage::disk('local')->exists($book->picture))
                                <img src="{{ Storage::disk('local')->url($book->picture) }}" alt="{{ $book->picture }}" class="img-fluid">
                            @else
                                <img src="/images/no-image.png" alt="no image">
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection