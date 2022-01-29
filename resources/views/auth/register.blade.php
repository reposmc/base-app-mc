@extends('layouts.app')

@section('content')

    {{-- LOGIN SV --}}
    @if (env('LOGIN_SV_LOGIN'))
        <div class="container mb-4" ref="top">
            <div class="row justify-content-center">
                <div class="col-md-5 col-12">
                    <div class="card-body shadow card-rounded">
                        <div class="row">
                            <div class="col-3 pb-5 mx-auto pl-0 pr-0">
                                <img src="{{ asset('/img/Escudo_D.svg') }}" class="img-fluid logo-size" alt="Escudo_D" />
                            </div>
                        </div>
                        <h3 class="color-primary text-center">
                            Ingresa tus datos para registrarte
                        </h3>
                        <h6 class="color-primary text-center">
                            o <a href="/login" class="no-decoration">inicia sesión aquí</a> si
                            ya tienes cuenta.
                        </h6>
                        <div class="auth">
                            <div class="form-group row mb-0">
                                <div class="col-md-12 text-center">
                                    <a href="/redirectToProvider" class="btn btn-normal shadow-none text-uppercase">
                                        Registrarse con LoginSV
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- END LOGIN SV --}}

    @if (env('LOCAL_LOGIN'))
        <register />
    @endif
@endsection
