@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="">
                <div class="card-body">
                    <div class="card-title">{{ __('Panel administrativo') }}</div>
                    <hr>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Ha iniciado la sesión!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
