@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Verify Email</h4></div>

                <div class="card-body" style="min-height: 400px">
                    <div class="container mt-3 col-md-8">
                        <div class="form-group row">
                            <img style="margin-left: 43%" src="{{ url('graphics/verifyimage.png')}}" alt="image not found" width="100" height="100">
                        </div>
                        

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }}, <a class="text-primary" href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
