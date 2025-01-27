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

   .main-div {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.logo_anchor{
        text-align: center !important;
    }

.img-logo {
    width: 30%;
    border-radius: 2%;
    margin-bottom: 30px;
    margin-top: 20px;
}


    .child-div {
        margin-top: 0;
    }
</style>


<div class="main-div">

    <a href="{{ route('front.home') }}" class="logo_anchor">
        <img class="d-flex justify-content-center align-item-center img-logo"
        src="{{ asset('uploads/logo/' . $settting['logo']) }}" alt="">
    </a>
    

    <div class="container child-div">


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
</div>



<!-- Add this script tag before your custom JavaScript code -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
