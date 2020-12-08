@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container" style="width: 51%; padding-left: 12px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-arrow">
                <li class="breadcrumb-item"><a href="{{ route('login') }}">Login</a></li>
                <li class="breadcrumb-item active" aria-current="page">Reset Password</li>
            </ol>
        </nav> 
    </div>
    <div class="row justify-content-center"> 
        <div class="col-md-6">
            <div class="card">
                <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Reset Password</h4></div>

                <div class="card-body" style="min-height: 400px">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group row">
                            <div class="col-md-9 ml-5">
                            <label for="email" class="col-form-label">{{ __('E-Mail Address') }}<i class="fa fa-envelope fa-lg ml-2"></i></label>
                                <input id="email" type="email" placeholder="enter email address" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-9 ml-5">
                                <label for="password" class="col-form-label">{{ __('New Password') }}<i class="fa fa-unlock-alt fa-lg ml-2"></i></label>
                                <input id="password" placeholder="enter new password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-9 ml-5">
                                <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}<i class="fa fa-unlock-alt fa-lg ml-2"></i></label>
                                <input id="password-confirm" placeholder="confirm your password" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-9 ml-5">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}<i class="fa fa-repeat fa-lg ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="mt-5"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
