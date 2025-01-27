<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href="{{ asset('front-login/login.css') }}" rel="stylesheet" type="text/css" />

</head>

<style>

    .error {

        color: red;

        text-align: center;

    }

</style>

<div class="container">
    <h1 class="login-title">Login</h1>

    <form class="form" id="LoginForm" action="{{ route('login') }}" method="POST">

        @csrf

        <div class="input-div">

            @error('details-invalid')

                <div class="error text-center">{{ $message }}</div>
            @enderror

            <input type="text" placeholder="Email" name="email">

            @error('email')

                <div class="error">{{ $message }}</div>

            @enderror

            <input type="password" placeholder="Password" name="password">

            @error('password')

                <div class="error">{{ $message }}</div>

            @enderror

        </div>

        <input class="next" type="submit" value="Login">

    </form>

</div>



<!-- Add this script tag before your custom JavaScript code -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

