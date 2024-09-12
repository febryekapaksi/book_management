@extends('layout')

@section('title', 'Profile')

@section('content')
    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">My Profile</h5>
                        <div class="row">
                            <div class="col-md-2 flex-column align-items-center">
                                <img src="{{ asset('images/' . $user->image) }}" alt="Profile" class="rounded-circle"
                                    style="max-width: 150px; max-height: 150px">
                            </div>
                            <div class="col-md-10">
                                <!-- Validation Errors -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    <div class="row mb-3">
                                        <label for="title" class="col-md-2 col-form-label">Name</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ isset($user) ? $user->name : old('name') }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="title" class="col-md-2 col-form-label">Email</label>
                                        <div class="col-md-10">
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ isset($user) ? $user->email : old('email') }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="image" class="col-md-2 col-form-label">Image</label>
                                        <div class="col-md-10">
                                            <input type="file" class="form-control" id="image" name="image">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10">
                                            <button type="submit" class="btn btn-primary">Update Profile</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
