@extends('layout')
@section('title', "Home Page")
@section('content')
@auth
    Name: {{ auth()->user()->name }} <br>
    Email: {{ auth()->user()->email }} <br>
    Profile Picture: <img src="{{ auth()->user()->profile_picture }}" alt="Profile Picture"> <br>
    Date of Registration: {{ auth()->user()->created_at }}
@endauth
@endsection