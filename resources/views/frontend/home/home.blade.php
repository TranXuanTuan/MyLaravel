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

    @if(empty($categories))
        <p class="error">Data empty</p>
    @else
        @foreach($categories as $key => $category)
            @php
                $books = $category->books;
            @endphp
            <h2 class="category-title">{{ $category->name }}</h2>
            <div class="row">
                    @foreach($books as $book)
                        <div class="col-3">
                        <div class="book-info">
                            <h3 class="book-title">{{ $book->name }}</h3>
                            <div class="book-picture">
                                @if(!empty($book->picture) && Storage::disk('local')->exists($book->picture))
                                    <img src="{{ Storage::disk('local')->url($book->picture) }}"
                                         alt="{{ $book->picture }}" class="img-fluid">
                                @else
                                    <img src="/images/no-image.png" alt="no image">
                                @endif
                            </div>
                            <p class="book-order">
                                <a href="{{ route('order', $book->id) }}" class="btn btn-dark">Order Book</a>
                            </p>
                        </div>
                        </div>
                    @endforeach             
            </div>
        @endforeach
    @endif
@stop
