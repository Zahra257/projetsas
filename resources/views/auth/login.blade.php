@extends('layouts.guest')

@section('title', 'My Kalapps - Login')

@section('content')
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Login -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="{{ route('login') }}" class="app-brand-link gap-2">
                                <span class="app-brand-text demo text-body fw-bolder">My Kalapps</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Welcome to Sneat! 👋</h4>
                        <p class="mb-4">Please sign-in to your account and start the adventure</p>

                        <!-- Error Toast -->
                        @if (session('error'))
                            <div class="bs-toast toast toast-placement-ex m-2 fade bg-danger bottom-0 end-0 show"
                                role="alert" aria-live="assertive" aria-atomic="true" id="errorToast">
                                <div class="toast-header">
                                    <i class="bx bx-bell me-2"></i>
                                    <div class="me-auto fw-semibold">Error</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast"
                                        aria-label="Close"></button>
                                </div>
                                <div class="toast-body">{{ session('error') }}</div>
                            </div>
                        @endif
                        <!-- End Error Toast -->


                        <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}"
                                    required autocomplete="email" autofocus />

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">{{ __('Password') }}</label>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">
                                            <small> {{ __('Forgot Your Password?') }}</small>
                                        </a>
                                    @endif
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" required autocomplete="current-password">
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember-me"> {{ __('Remember Me') }} </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">{{ __('Login') }}</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>New on our platform?</span>
                            <a href="{{ route('register') }}">
                                <span>Create an account</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Login -->
            </div>
        </div>
    </div>

    <!-- / Content -->
@endsection
