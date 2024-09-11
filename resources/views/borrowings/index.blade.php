@extends('layout')

@section('title', 'Borrowings')

@section('content')
<div class="pagetitle">
    <h1>Borrowing Records</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active">Borrowing</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Borrowings List</h5>

                    <a href="{{ route('borrowings.create') }}" class="btn btn-sm btn-success"><i class="ri-add-circle-line"></i> Make a Borrowing</a>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User</th>
                                <th scope="col">Borrow Date</th>
                                <th scope="col">Books</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($borrowings as $borrowing)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $borrowing->name}}</td>
                                <td>{{ date('d F Y', strtotime($borrowing->borrow_date)) }}</td>
                                <td>
                                    <ul>
                                        @foreach($borrowing->books as $book)
                                            <li>{{ $book->title }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    @if(is_null($borrowing->return_date))
                                        <span class="badge bg-warning">Borrowed</span>
                                    @else
                                        <span class="badge bg-success">Returned at {{date('d F Y', strtotime($borrowing->return_date))}}</span>
                                    @endif
                                </td>
                                <td>
                                    @if(is_null($borrowing->return_date))
                                    <a href="{{ route('borrowings.edit', $borrowing->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                    @endif
                                    <button class="btn btn-danger btn-sm" title="Delete" onclick="confirmationDialog('delete-form-{{ $borrowing->id }}', 'Are you sure?', 'This book will be permanently deleted!', 'Yes, delete it!')"><i class="bi bi-trash"></i></button>

                                    <form id="delete-form-{{ $borrowing->id }}" action="{{ route('borrowings.destroy', $borrowing->id) }}" method="POST" style="display: none;">
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
