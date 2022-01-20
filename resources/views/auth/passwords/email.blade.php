@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="">
                <div class="card-body">
                    <div class="row mb-3">
                            <div class="col-md-12 text-center pt-2 pb-2">
                                <img src="{{ asset('logos/Escudo_D.svg') }}" class="logo-size" alt="Escudo_D">
                            </div>
                        </div>
                         <h3 class="color-primary text-center mb-3">Enviar enlace para estrablecer contraseña</h3>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label> --}}

                            <div class="col-md-10 offset-md-1">
                                <input placeholder="Correo electrónico" id="email" type="email" class="shadow-none form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-normal shadow-none">
                                    {{ __('Restablecer contraseña') }}
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
