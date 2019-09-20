@extends('backend.layouts.content')

@section('content')
    <form action="{{ route('admin-book-add') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name of book</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label>Publisher</label>
                            <input type="text" name="publisher" class="form-control" value="{{ old('publisher') }}">
                        </div>

                        <div class="form-group">
                            <label>Author of books</label>
                            <input type="text" name="author" class="form-control" value="{{ old('author') }}">
                        </div>

                        <div class="form-group">
                            <label>Num Of Page</label>
                            <input type="text" name="num_of_page" class="form-control" value="{{ old('num_of_page') }}">
                        </div>

                        <div class="form-group">
                            <label for="customFile">Picture</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="picture">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Category ID</label>
                            {{ Form::select('category_id', [null => 'Please choose category'] + $categories, old('category_id'), ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group">
                            <label>Maximum number of date you can borrow this book</label>
                            <input type="text" name="maxdate" class="form-control" value="{{ old('maxdate') }}">
                        </div>

                        <div class="form-group">
                            <label>Number of copy of book in the library</label>
                            <input type="text" name="num" class="form-control" value="{{ old('num') }}">
                        </div>

                        <div class="form-group">
                            <label>Summary</label>
                            <textarea name="summary" rows="5" class="form-control">{{ old('summary') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group text-center">
            <a href="{{ route('admin-book-index') }}" class="btn btn-secondary">Book List</a>
            <input type="submit" value="Add" name="submit" class="btn btn-success">
        </div>
    </form>
@endsection