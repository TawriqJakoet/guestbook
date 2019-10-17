@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm text-center">
            <h1>Welcome!</h1>
            <p>Please @if (Route::has('register'))<u><a href="{{ route('register') }}">register</a></u>@endif if you do not yet have an account.</p>
        </div>
    </div>
</div>
@endsection
