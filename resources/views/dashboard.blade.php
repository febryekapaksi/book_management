@extends('layout')

@section('title', 'Dashboard')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Book Lending Chart</h5>
                        <form action="{{ route('dashboard') }}" method="GET" class="mb-4">
                            <div class="row">
                                <div class="col-md-auto">
                                    <label for="year" class="form-label">Select Year</label>
                                </div>
                                <div class="col-md-4">
                                    <select name="year" id="year" class="form-select">
                                        @for ($y = date('Y'); $y >= 2000; $y--)
                                            <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>
                                                {{ $y }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>
                        <canvas id="borrowingChart" width="400" height="150"></canvas>

                        <h5 class="card-title">Books Borrowing Percentage</h5>
                        <canvas id="bookPieChart" style="max-height: 300px; max-width: 100;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Data untuk chart -->
    <script>
        var ctx = document.getElementById('borrowingChart').getContext('2d');
        var borrowingChart = new Chart(ctx, {
            type: 'line', // Tipe chart (bar, line, dll)
            data: {
                labels: [
                    'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                    'October', 'November', 'December'
                ],
                datasets: [{
                    label: 'Borrowings per Month in {{ $year }}',
                    data: [
                        @foreach (range(1, 12) as $m)
                            {{ $borrowings->firstWhere('month', $m)->total ?? 0 }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        min: 0,
                        max: 50,
                    }
                }
            }
        });
    </script>
    <script>
        var ctx = document.getElementById('bookPieChart').getContext('2d');
        var bookPieChart = new Chart(ctx, {
            type: 'pie', // Tipe chart (pie chart)
            data: {
                labels: [
                    @foreach ($bookData as $book)
                        "{{ $book['title'] }} ({{ round($book['percentage'], 2) }}%)",
                    @endforeach
                ],
                datasets: [{
                    label: 'Book Borrowing Percentage',
                    data: [
                        @foreach ($bookData as $book)
                            {{ $book['borrowed'] }},
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' times borrowed';
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
