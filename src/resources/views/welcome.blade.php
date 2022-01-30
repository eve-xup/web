@extends('xup::layouts.app')

@section('page')

    <div class="w-100 flex justify-center">

        <div class="card lg:card-side border mt-5">
            <figure>
                <img src="{{ asset('web/images/hound.png') }}" class="object-scale-down h-48">
            </figure>
            <div class="card-body">
                <div class="card-title">{{config('APP_NAME')}}</div>
                <p>Join your fleet here!</p>
                <div class="card-actions">
                    <a href="{{ route('auth.public.redirect') }}">
                        <img src="{{ asset('web/images/eve-sso.png') }}" />
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
