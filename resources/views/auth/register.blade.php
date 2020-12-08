@extends('layouts.app')

@section('content')

<div class="container mybreadcrumb otherbreadcrumb" style="width: 42%; padding-left: 12px;">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('index') }}">Index</a></li>
            <li class="breadcrumb-item active" aria-current="page">Register</li>
        </ol>
    </nav>
</div>

<div class="container marginTop">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="bg-mybg pt-2">
                    <h4 class="text-center text-primary"><strong>Sign Up</strong></h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        
                        <div class="form-group row">
                            <img style="margin-left: 41%" src="{{ url('graphics/registerimage.png')}}" alt="image not found" width="100" height="100">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-9 ml-5">
                                <label for="name" class="col-form-label">username<i class="fa fa-user fa-lg ml-2"></i></label>
                                <input id="name" type="text" placeholder="enter your name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                <span id="nameSpan" class="text-danger"></span>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-9 ml-5">
                                <label for="email" class="col-form-label">email address<i class="fa fa-envelope fa-lg ml-2"></i></label>
                                <input id="email" type="email" placeholder="enter email address" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                <input id="type" type="hidden" name="type" value="U"/>
                                <span id="emailSpan" class="text-danger"></span>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-9 ml-5">
                                <label for="password" class="col-form-label">password<i class="fa fa-unlock-alt fa-lg ml-2"></i></label>
                                <input id="password" type="password" placeholder="enter password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                <span id="passwordSpan" class="text-danger"></span>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-9 ml-5">
                                <label for="password-confirm" class="col-form-label">confirm password<i class="fa fa-unlock-alt fa-lg ml-2"></i></label>
                                <input id="password-confirm" type="password" placeholder="confirm password" class="form-control" name="password_confirmation" required>
                                <span id="conSpan" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-9 ml-5">
                                <input type="hidden" name="token" value="{{Session::token()}}"/>
                                <button type="button" class="btn btn-primary" id="validateUserRegistrationBtn">next<i class="fa fa-arrow-right fa-lg ml-2"></i></button>
                                <button id="userRegisterBtn" type="submit" class="btn btn-primary pl-4 pr-4">register<i class="fa fa-user-plus fa-lg ml-2"></i></button>
                                <img id="myLoader" class="ml-2" src="{{ url('graphics/loader2.gif') }}" width="40" height="40"/>
                            </div>
                            <div class="col-md-9 ml-4 mt-2">
                                <span class="pl-4">Already have account?</span> 
                                <a class="btn btn-link" href="{{ route('login') }}">
                                    {{ __('Login') }}
                                </a>
                            </div>
                        </div>
                        
                    </form>
                    <div id="success"></div>
                </div>
                <div class="marginTop"></div>
            </div>
        </div>
    </div>
</div>
@endsection
