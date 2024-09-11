@extends('layout')

@section('title', isset($book) ? 'Edit Book' : 'Create Book')

@section('content')
<div class="pagetitle">
    <h1>{{ isset($book) ? 'Edit Book' : 'Create New Book' }}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Books</a></li>
            <li class="breadcrumb-item active">{{ isset($book) ? 'Edit' : 'Create' }}</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ isset($book) ? 'Edit Book' : 'Add New Book' }}</h5>

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

                    <form action="{{ isset($book) ? route('books.update', $book->id) : route('books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($book))
                            @method('PUT')
                        @endif
                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label">Title</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="title" name="title" value="{{ isset($book) ? $book->title : old('title') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="author" class="col-md-4 col-form-label">Author</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="author" name="author" value="{{ isset($book) ? $book->author : old('author') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="publisher" class="col-md-4 col-form-label">Publisher</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="publisher" name="publisher" value="{{ isset($book) ? $book->publisher : old('publisher') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="published_date" class="col-md-4 col-form-label">Published Date</label>
                            <div class="col-md-8">
                                <input type="date" class="form-control" id="published_date" name="published_date" value="{{ isset($book) ? $book->published_date : old('published_date') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label">Book Cover Image</label>
                            <div class="col-md-8">
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                        </div>                    

                        <div class="row mb-3">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">{{ isset($book) ? 'Update Book' : 'Save Book' }}</button>
                                <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection
