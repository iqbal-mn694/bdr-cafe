<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <div class="login">

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1>Login</h1>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <hr>
                <p>WebApp Caffe</p>
                <div>
                    <label for="">Email</label>
                    <input type="text" placeholder="contoh@gmail.com" name="email" value="{{ old('email') }}">
                </div>
                <div>
                    <label for="">Password</label>
                    <input type="password" placeholder="Password" name="password"  class="@error('password') is-invalid @enderror">
                    <a href="#">Lupa Password?</a> 
                </div>
                <button>Login</button>
                <p>
                    <a href="/register">Register?</a> 
                </p>
            </form>

        </div>
        <div class="right">
            <img src="{{ asset('assets/logo.svg') }}" alt="logo">
        </div>
    </div>
    
</body>
</html>