@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                         <div class="row mb-0 mt-0">
                            <div class="col-md-12 text-center pt-3 pb-3">
                                <img src="{{ asset('logos/Escudo_D.svg') }}" class="logo-size" alt="Escudo_D">
                            </div>
                        </div>
                        <h3 class="color-primary text-center">Ingresa tus datos para registrarte</h3>
                        <h6 class="color-primary text-center mb-3">
                            o <a href="/login" class="no-decoration">inicia sesión aquí</a> si ya tienes cuenta.
                        </h6>
                        <div class="row mb-0 mt-0">
                            {{-- <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label> --}}

                            <div class="col-md-10 offset-md-1 pt-2 pb-2">
                                <input placeholder="Nombre" id="name" type="text" class="form-control shadow-none @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0 mt-0">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label> --}}

                            <div class="col-md-10 offset-md-1 pt-2 pb-2">
                                <input placeholder="Correo eletrónico" id="email" type="email" class="form-control shadow-none @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0 mt-0">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label> --}}
                            <div class="col-md-10 offset-md-1 pt-2 pb-2">
                                <div class="input-icons">
                                    <input placeholder="Contraseña" id="password" type="password" class="form-control shadow-none @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    <i class="bi bi-eye-slash icon-login" id="togglePassword"></i> 
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0 mt-0">
                            {{-- <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label> --}}
                            <div class="col-md-10 offset-md-1 pt-2 pb-2">
                                <input placeholder="Confirmar contraseña" id="password-confirm" type="password" class="form-control shadow-none" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0 mt-0">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-normal-forms shadow-none">
                                    {{ __('Registrarse') }}
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
