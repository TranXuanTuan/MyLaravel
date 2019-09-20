@extends('frontend.layouts.content')

@section('content')
    <h2>Cart Info</h2>

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
                        <a href="{{ route('cart-cancel', $book->id) }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            @endforeach
        </div>
        <p>
            <a href="{{ route('cart-complete') }}" class="btn btn-success">Thanh toán đơn hàng</a>
        </p>
    @endif
@endsection