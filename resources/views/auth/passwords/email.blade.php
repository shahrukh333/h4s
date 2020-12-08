@extends('layouts.app')

@section('content')
<div class="container">

    <div class="container" style="width: 59%; padding-left: 12px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-arrow">
                <li class="breadcrumb-item"><a href="{{ route('login') }}">Login</a></li>
                <li class="breadcrumb-item active" aria-current="page">Forgot Password</li>
            </ol>
        </nav> 
    </div>

    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Forgot Password</h4></div> 

                <div class="card-body" style="min-height: 300px">

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        
                        <div class="form-group row mt-5">
                            <div class="col-md-9 ml-5">
                            <label for="email" class="col-form-label">{{ __('E-Mail Address') }}<i class="fa fa-envelope fa-lg ml-2"></i></label>
                                <input id="email" type="email" placeholder="enter your email address" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-9 ml-5">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}<i class="fa fa-reply fa-lg ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="container">
                        @if (session('status'))
                            <div class="alert alert-success mt-2 text-center" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
