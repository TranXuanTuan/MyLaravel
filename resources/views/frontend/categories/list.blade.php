@extends('frontend.layouts.content')

@section('content')
    @if(empty($categories))
        <p class="error">Data empty</p>
    @else
        <div class="row">
            @foreach($categories as $key => $category)
                <div class="col-3">
                    <div class="category-content">
                        <h2 class="category-name">{{ $category->name }}</h2>
                        <p class="book-number">Số quyển sách: {{ $category->books()->count() }}</p>
                        <p class="read-more"><a href="{{ route('book-index', ['category_id' => $category->id]) }}">Xem chi tiết</a></p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@stop