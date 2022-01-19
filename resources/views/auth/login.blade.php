@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-12">
            <div class="">
                {{-- <div class="card-header">{{ __('Login') }}</div> --}}

                <div class="card-body card-rounded shadow">
                    <div class="row mb-0 mt-0">
                            <div class="col-md-12 text-center pt-3 pb-3">
                                <img src="{{ asset('logos/Escudo_D.svg') }}" class="logo-size" alt="Escudo_D">
                            </div>
                        </div>
                     <h3 class="color-primary text-center">Ingresa tus datos para iniciar</h3>
                        <h6 class="color-primary text-center mb-3">o <a href="{{ route('register') }}" class="no-decoration">regístrate
                                aquí</a> si aún no tienes
                            cuenta.</h6>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-0 mt-0">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label> --}}

                            <div class="col-md-10 offset-md-1 pt-2 pb-2">
                                <input placeholder="Correo Electrónico" id="email" type="email" class="shadow-none form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                <input placeholder="Contraseña" id="password" type="password" class="shadow-none form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0 mt-0">
                            <div class="col-md-12 offset-md-4 pt-2 pb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label text-muted" for="remember" style="font-size: 12px">
                                        {{ __('Recordar Mis Datos') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0 mt-0">
                            <div class="col-md-12 pt-2 pb-2 text-center">
                                <button type="submit" class="btn btn-normal-forms shadow-none">
                                    {{ __('ENTRAR') }}
                                </button>
                            </div>
                            <div class="col-md-12 pt-2 pb-2 text-center">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link shadow-none" href="{{ route('password.request') }}">
                                        {{ __('¿Olvidaste tu contraseña?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
