@extends('frontend.layouts.content')

@section('content')

<h2>Category List</h2>
@if(empty($categories))
	<p class="errors">Data Empty</p>
@else
	<table class="table table-bordered">
		<tr>
			<th>ID</th>
			<th>Name</th>
		</tr>
		@foreach($categories as $key => $category)
		<tr>
			<td>{{$key+1}}</td>
			<td>{{$category->name}}</td>
		</tr>
		@endforeach
	</table>
@endif

@endsection