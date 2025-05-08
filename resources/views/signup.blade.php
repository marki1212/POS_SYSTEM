<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/new.css') }}">

    <style>
        /* CSS */
        /* Change placeholder text color */
        .form-control::placeholder {
            color: #4c4a61;
            /* Use rgba for transparency */
        }
    </style>
</head>

<body>
    <div class="container-fluid d-flex vh-100 justify-content-center align-items-center" style="max-width: 1600px">
        <div class="row align-items-center" style="gap: 7rem">
            <div class="col">
                <div class="box d-flex flex-column justify-content-center align-items-center">
                    <div class="logo">
                        <img src="{{ asset('img/logo.png') }}" alt="logo" class="image-fluid" />
                    </div>
                    <div class="">
                        <h2 class="text-center text-white p-2">CHM POS</h2>
                        <p class="text-center text-light">
                            Welcome to CHM POS, where you can enjoy
                            <span class="text-warning">our delicious food </span> prepared
                            with care. Explore our menu and savor the flavors of our
                            <span class="text-warning">tasty food creations. </span> Join us
                            for an unforgettable dining experience
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-column justify-content-center shadow"
                    style="padding: 8em 3em; background-color: #1f1e2e; border-radius: 24px;">
                    <h2 class="text-center text-white mb-2">Sign Up</h2>
                    <p class="text-light text-center">CHM POS</p>
                    <form method="POST" action="{{ route('register') }}" class="text-white fw-bold">
                        @csrf
                        <div class="mb-3 px-5">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="name@example.com"
                                style="background-color: #1c1b2b; color: white; border: none; padding: 13px 5px;">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 px-5">
                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Username"
                                style="background-color: #1c1b2b; color: white; border: none; padding: 13px 5px;">
                            @error('username')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 px-5">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password"
                                style="background-color: #1c1b2b; color: white; border: none; padding: 13px 5px;">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 px-5">
                            <label for="confirm-password" class="form-label">Confirm Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="confirm-password"
                                name="password_confirmation" placeholder="Confirm Password"
                                style="background-color: #1c1b2b; color: white; border: none; padding: 13px 5px;">
                        </div>
                        <div class="d-grid p-5">
                            <button type="submit" class="btn text-white fw-bold" style="background-color: #e2b62f">Sign
                                Up</button>
                        </div>
                    </form>
                    <div class="text-center text-white">
                        Already have an account? <a href="{{ route('login') }}" class="text-warning">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
