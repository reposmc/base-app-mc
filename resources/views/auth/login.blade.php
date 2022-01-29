@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-12">
                <div class="">
                    <div class="card-body">
                        <div class="row mb-0 mt-0">
                            <div class="col-md-12 text-center pt-3 pb-3">
                                <img src="{{ asset('logos/Escudo_D.svg') }}" class="logo-size" alt="Escudo_D">
                            </div>
                        </div>
                        <h3 class="color-primary text-center">Ingresa tus datos para iniciar</h3>
                        <h6 class="color-primary text-center mb-3">o <a href="{{ route('register') }}"
                                class="no-decoration">regístrate
                                aquí</a> si aún no tienes
                            cuenta.</h6>

                        @if (env('LOCAL_LOGIN'))
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group row mb-0">

                                    <div class="col-md-10 offset-md-1">
                                        <v-text-field dense label="Correo" class="pt-1" outlined id="email"
                                            type="email" name="email" value="{{ old('email') }}" required
                                            autocomplete="email" autofocus>
                                        </v-text-field>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert" style="display: block;">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0 mt-0">
                                    <div class="col-md-10 offset-md-1 pt-0">
                                        <v-text-field dense label="Contraseña" class="pt-1" outlined id="password"
                                            type="password" name="password" required autocomplete="current-password">
                                        </v-text-field>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert" style="display: block;">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="row mb-0 mt-0">
                                    <div class="col-md-12 offset-md-4 pt-2 pb-2">
                                        <div class="form-check">
                                            <input class="form-check-input shadow-none" type="checkbox" name="remember"
                                                id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label text-muted" for="remember"
                                                style="font-size: 12px">
                                                {{ __('Recuerda mis datos') }}
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
                        @endif

                        {{-- LOGIN SV --}}
                        @if (env('LOGIN_SV_LOGIN'))
                            <div class="form-group row-fluid mb-0">
                                <div class="col-md-12 text-center">
                                    <a href="/redirectToProvider" class=" btn btn-normal shadow-none text-uppercase">
                                        {{ __('Iniciar sesión con LoginSV') }}
                                    </a>
                                </div>
                            </div>
                        @endif
                        {{-- END LOGIN SV --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/showPassword.js') }}" defer></script>
@endsection
