@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @if($errors->has('name')) is-invalid @endif" name="name" value="{{ old('name') }}" autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @if($errors->has('email')) is-invalid @endif" name="email" value="{{ old('email') }}">

                                @if($errors->has('email'))
                                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @if($errors->has('password')) is-invalid @endif" name="password" >

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control @if($errors->has('password_confirmation')) is-invalid @endif" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                                @endif
                                
                            </div>
                        </div>

                        {{--birthday--}}
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Birthday</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control @if($errors->has('birthday')) is-invalid @endif" name="birthday">
                                @if ($errors->has('birthday'))
                                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('birthday') }}</strong></span>
                                @endif
                                <!-- @error('birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                @enderror -->
                            </div>
                        </div>

                        {{--gender--}}
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Gender</label>

                            <div class="col-md-6">
                                @php $genders = config('common.genders');
                                $errorClass = '';
                                if ($errors->has('gender')) {
                                    $errorClass = ' is-invalid';
                                }
                                @endphp
                                <?php  //$genders = config('common.genders');  ?>
                                {{ Form::select('gender', [null => 'Please choose gender'] + $genders, old('gender'), ['class' => 'form-control' . $errorClass]) }}

                                @if ($errors->has('genders'))
                                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('genders') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        {{--address--}}
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Address</label>

                            <div class="col-md-6">
                                <input type="text" name="address" class="form-control @if($errors->has('address')) is-invalid @endif" name="address">

                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('address') }}</strong></span>
                                @endif
                                <!-- @error('address')
                                <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                @enderror -->
                            </div>
                        </div>

                        {{--avtar--}}
                        <div class="form-group row">
                            <label for="customFile" class="col-md-4 col-form-label text-md-right">Avatar</label>
                            <div class="col-md-6">
                                <input type="file" class="custom-file-input" id="customFile" name="avatar">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
