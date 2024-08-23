<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
   
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white text-center">
                            <h4>{{ __('Register') }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
    
                                <!-- Name -->
                                <div class="mb-3">
                                    <x-input-label for="name" :value="__('Name')" class="form-label" />
                                    <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('name')" class="text-danger mt-2" />
                                </div>
    
                                <!-- Email Address -->
                                <div class="mb-3">
                                    <x-input-label for="email" :value="__('Email')" class="form-label" />
                                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="text-danger mt-2" />
                                </div>
    
                                <!-- Password -->
                                <div class="mb-3">
                                    <x-input-label for="password" :value="__('Password')" class="form-label" />
                                    <x-text-input id="password" class="form-control"
                                                  type="password"
                                                  name="password"
                                                  required autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password')" class="text-danger mt-2" />
                                </div>
    
                                <!-- Confirm Password -->
                                <div class="mb-3">
                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="form-label" />
                                    <x-text-input id="password_confirmation" class="form-control"
                                                  type="password"
                                                  name="password_confirmation" required autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger mt-2" />
                                </div>
    
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <a class="text-sm text-primary" href="{{ route('login') }}">
                                        {{ __('Already registered?') }}
                                    </a>
    
                                    <x-primary-button class="btn btn-primary">
                                        {{ __('Register') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   
</body>
</html>