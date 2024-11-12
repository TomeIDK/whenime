@extends('layouts.base')

@section('title', 'Whenime')

@section('content')
    <div class="hero min-h-svh hero-gradient">
        <div class="hero-content flex flex-col lg:flex-row justify-center items-center">
            <div class="flex-col justify-center lg:w-1/2 text-center lg:text-left">
                <h1 class="text-5xl font-bold drop-shadow-md text-white">Track airing anime with <strong
                        class="text-primary">Whenime</strong></h1>
                <p class="py-6 text-text drop-shadow-md">
                    Personalized calendars for your favorite airing anime.
                </p>
                <x-cta-nav-link route="{{ route('register') }}" text="Get Started" />
            </div>
                        <div class="flex justify-center lg:w-1/2">
            <img src="https://placehold.co/1200?text=Hello+World&font=roboto" class="rounded-lg shadow-2xl" />
            </div>
        </div>
    </div>
@endsection
