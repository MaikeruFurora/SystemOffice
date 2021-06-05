{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

<div class="card-body">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div>
</div>
@endsection --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log in</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        .center-screen {
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            min-height: 100vh;
        }
    </style>
</head>

{{-- <body style="background-image: url('{{ asset('img/intro1.jpg') }}');background-repeat:no-repeat;background-size:cover">
--}}

<body style="background: #F8F1E5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 text-left center-screen">
                <form method="POST" action="{{ route('login') }}">
                    <div class="card p-2 shadow-lg" style="background: #426E86">
                        <div class="card-body">
                            <p class="lead text-center mb-2" style="font-size: 25px;color:white">Sign in <br>
                                <small class="lead text-center" style="font-size: 15px;color:white">to continue to
                                    Application</small></p>

                            {{-- <img class="card-img-top" src="{{ asset('img/1.png') }}" alt=""> --}}
                            @csrf
                            <div class="form-group">
                                <label class="lead" style="font-size: 15px;color:white" for="username">Username</label>
                                <input id="username" type="text"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}" required autocomplete="username" autofocus>
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="lead" style="font-size: 15px;color:white" for="exampleInputPassword1">Password</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label lead" style="font-size: 14px;color:white" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block lead">Log in</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row no-gutters">
            {{-- <div class="col-lg-4 col-md-6 col-sm-12  text-left">

            </div> --}}
            {{-- <div class="col-lg-8 col-md-6 col-sm-12 center-screen">
                <img src="{{ asset('img/s.png') }}" width="105%" alt="">
        </div> --}}
    </div>
    </div>
</body>

</html>