@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="">
                    <div class="card-body p-4">
                        <h3 class="card-title color-primary">{{ __('Verify Your Email Address') }}</h3>
                        @if (session('resent'))
                            <div class="alert alert-primary" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        <br>
                        {{ __('If you did not receive the email') }},
                        <br>

                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-normal mt-3">{{ __('Enviar otro email') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
