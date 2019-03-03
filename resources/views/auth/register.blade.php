@extends('layouts.master')
@section('title', 'Register')

@section('content')
<div class="wrapper">
    <div class="rte">
        <h1>Register</h1>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-fieldset">
            <input class="form-field" type="email" name="email" placeholder="Your e-mail">
        </div>
        <div class="form-fieldset">
            <input class="form-field" type="text" name="name" placeholder="Your name">
        </div>
        <div class="form-fieldset">
            <input class="form-field" type="password" name="password" placeholder="Password">
        </div>
        <div class="form-fieldset">
            <input class="form-field" type="password" name="password_confirmation"
                placeholder="Repeat password">
        </div>
        <button class="button">Submit</button>
    </form>
</div>
@endsection
