@extends('layout')

@section('title', 'Book Management')

@section('content')
<div class="pagetitle">
    <h1>Books Management</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active">Books</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Book List</h5>

                    <a href="{{ route('books.create') }}" class="btn btn-sm btn-success"><i class="ri-add-circle-line"></i> Add Book</a>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Cover</th> 
                                <th scope="col">Title</th>
                                <th scope="col">Author</th>
                                <th scope="col">Publisher</th>
                                <th scope="col">Published Date</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $book)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>
                                    @if ($book->image)
                                        <img src="{{ asset('images/'.$book->image) }}" alt="{{ $book->title }}" width="50" height="50">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->publisher }}</td>
                                <td>{{ date('d F Y', strtotime($book->published_date)) }}</td>
                                <td>{{ $book->stock }}</td>
                                <td>
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                    <button class="btn btn-danger btn-sm" title="Delete" onclick="confirmationDialog('delete-form-{{ $book->id }}', 'Are you sure?', 'This book will be permanently deleted!', 'Yes, delete it!')"><i class="bi bi-trash"></i></button>

                                    <form id="delete-form-{{ $book->id }}" action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
