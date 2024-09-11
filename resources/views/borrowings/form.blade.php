@extends('layout')

@section('title', isset($book) ? 'Edit Borrowing' : 'Create Borrowing')

@section('content')
<div class="pagetitle">
    <h1>{{ isset($book) ? 'Edit Borrowing' : 'Create New Borrowing' }}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('borrowings.index') }}">Borrowing</a></li>
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

                    <!-- Form for creating or editing a book -->
                    <form action="{{ isset($book) ? route('borrowings.update', $borrowing->id) : route('borrowings.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($book))
                            @method('PUT')
                        @endif
                    
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label">Name</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="name" name="name" value="{{ isset($borrow) ? $borrow->name : old('name') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="books" class="col-md-4 col-form-label">Select Books</label>
                            <div class="col-md-8">
                                <select class="form-select" id="books" name="books[]" multiple required>
                                    <option value="" disabled selected>Choose Your Books</option>
                                    @foreach($books as $book)
                                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="borrow_date" class="col-md-4 col-form-label">Borrow Date</label>
                            <div class="col-md-8">
                                <input type="date" class="form-control" id="borrow_date" name="borrow_date" value="{{ isset($borrowing) ? $borrowing->borrow_date : old('borrow_date') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">{{ isset($borrowing) ? 'Update Borrowing' : 'Save Borrowing' }}</button>
                                <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form><!-- End Form for creating or editing a book -->

                </div>
            </div>

        </div>
    </div>
</section>
@endsection
