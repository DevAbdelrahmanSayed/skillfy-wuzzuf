
@extends('layout.app')
@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center">
            @include('message')
            <div class="card">
                <div class="card-header">Verify Account</div>
                <div class="card-body">
                    <p>Your Account is not verified. Please verify your account first!
                    <a href="{{route('email.resend')}}">send verification email</a>
                    </p>

                </div>
            </div>
        </div>
    </div>

@endsection
