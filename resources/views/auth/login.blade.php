@extends('layouts.app')

@section('content')

<div class="container" style="width: 42%; padding-left: 12px;">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('index') }}">Index</a></li>
            <li class="breadcrumb-item active" aria-current="page">Login</li>
        </ol>
    </nav> 
</div>

<div class="container marginTop">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="bg-mybg pt-2">
                    <h4 class="text-center text-primary"><strong>Login</strong></h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="form-group row">
                            <img style="margin-left: 43%" src="{{ url('graphics/loginimage.png')}}" alt="image not found" width="100" height="100">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-9 ml-5">
                                <label for="email" class="col-form-label">Email Address<i class="fa fa-envelope fa-lg ml-2"></i></label>
                                <input id="email" type="email" placeholder="enter email address" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-9 ml-5">
                                <label for="password" class="col-form-label">Password<i class="fa fa-unlock-alt fa-lg ml-2"></i></label>
                                <input id="password" type="password" placeholder="enter password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-9 ml-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">Remember Me</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-10 ml-5">
                                <button type="submit" class="btn btn-primary pl-4 pr-4">login<i class="fa fa-sign-in fa-lg ml-2"></i></button>
                            </div>
                            <div class="col-md-10 ml-4">
                                @if (Route::has('password.request'))
                                <a class="btn btn-link pl-4 pt-2" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                                <a class="btn btn-link pt-2" href="{{ route('register') }}">
                                    {{ __('Register Account') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="marginTop"></div>
            </div>
        </div>
    </div>
</div>
@endsection
