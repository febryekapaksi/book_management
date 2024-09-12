@extends('auth.layouts.app')

@section('title', 'Register - Library')

@section('content')

                <div class="card mb-3">
    
                    <div class="card-body">
    
                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                            <p class="text-center small">Enter your personal details to create account</p>
                        </div>
    
                        <!-- Form Register Laravel -->
                        <form class="row g-3" method="POST" action="{{ route('register') }}">
                            @csrf
    
                            <!-- Name -->
                            <div class="col-12">
                                <label for="yourName" class="form-label">Your Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="yourName" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
    
                            <!-- Email Address -->
                            <div class="col-12">
                                <label for="yourEmail" class="form-label">Your Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="yourEmail" value="{{ old('email') }}" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
    
                            <!-- Password -->
                            <div class="col-12">
                                <label for="yourPassword" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="yourPassword" required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
    
                            <!-- Confirm Password -->
                            <div class="col-12">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                            </div>
    
                            <!-- Terms and Conditions -->
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" name="terms" type="checkbox" id="acceptTerms" required>
                                    <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                                    <div class="invalid-feedback">You must agree before submitting.</div>
                                </div>
                            </div>
    
                            <!-- Submit Button -->
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Create Account</button>
                            </div>
    
                            <div class="col-12">
                                <p class="small mb-0">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
                            </div>
                        </form>
                        <!-- End Form Register -->
    
                    </div>
                </div>

@endsection
