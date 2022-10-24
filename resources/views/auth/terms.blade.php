@extends('layouts.guest')
@section('title', __('Terms'))
@section('content')
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-zinc500" />
            </a>
        </x-slot>
        <div class="">
            # {{ __('Terms of Service') }}
            <div class="mt-6">
                <p>
                    {{ __('Edit this file to define the terms of service for your application.') }}
                </p>
            </div>
        </div>
    </x-auth-card>
@endsection
