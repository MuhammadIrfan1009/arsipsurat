@extends('layouts.sidebar')

@section('title', 'Home')

@section('content')
<div class="container">
    <h1>Selamat datang di E-Komdigi</h1>

    @if (Auth::check())
        <!-- Content wrapper -->
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <!-- Welcome & Statistics Section -->
                    <div class="col-lg-8 mb-4">
                        <div class="card">
                            <div class="d-flex align-items-end row">
                                <div class="col-sm-7">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">
                                            Welcome, {{ Auth::user()->username }}! 🎉   
                                        </h5>
                                        <h5 class="card-title text-primary">
                                            Your role is: {{ Auth::user()->role }}
                                        </h5>
                                        <p class="mb-4">
                                            Kita Punya Total 
                                            <span class="fw-bold">{{ $totalSuratMasuk }}</span> Surat Masuk, 
                                            <span class="fw-bold">{{ $totalSuratKeluar }}</span> Surat Keluar, dan 
                                            <span class="fw-bold">{{ $totalNotaDinas }}</span> Nota Dinas.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-5 text-center text-sm-left">
                                    <img src="../assets/img/illustrations/dashboard-image.png" height="140" alt="Dashboard Image" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Cards -->
                    <div class="col-12 col-md-8 col-lg-4">
                        <div class="row">
                            <!-- Total Users Card -->
                            <div class="col-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <span>Users</span>
                                        <h3 class="card-title mb-2">{{ $totalUsers }}</h3>
                                    </div>
                                </div>
                            </div>
                            <!-- Surat Masuk Card -->
                            <div class="col-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <span class="fw-semibold d-block mb-1">Surat Masuk</span>
                                        <h3 class="card-title mb-2">{{ $totalSuratMasuk }}</h3>
                                    </div>
                                </div>
                            </div>
                            <!-- Surat Keluar Card -->
                            <div class="col-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <span>Surat Keluar</span>
                                        <h3 class="card-title mb-2">{{ $totalSuratKeluar }}</h3>
                                    </div>
                                </div>
                            </div>
                            <!-- Nota Dinas Card -->
                            <div class="col-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <span class="fw-semibold d-block mb-1">Nota Dinas</span>
                                        <h3 class="card-title mb-2">{{ $totalNotaDinas }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Charts Section -->
                <div class="row mt-5">
                    <!-- Diagram Lingkaran Status -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Jenis Layanan Surat Masuk</h5>
                                <canvas id="jenisLayananSuratMasukChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Jenis Layanan Surat Keluar</h5>
                                <canvas id="jenisLayananSuratKeluarChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Jenis Layanan Nota Dinas</h5>
                                <canvas id="jenisLayananNotaDinasChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Diagram Lingkaran Statistik User -->
                    <div class="col-md-4 mb-4 d-flex justify-content-center">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Statistik User</h5>
                                <canvas id="userChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Line Chart -->
                    <div class="col-md-8 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Monthly Document Trends</h5>
                                <canvas id="monthlyTrendsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p>Mohon <a href="{{ route('auth.login') }}">login</a> untuk mengakses dashboard.</p>
    @endif
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart Data and Rendering Functions

    // Status Surat Masuk
    new Chart(document.getElementById('jenisLayananSuratMasukChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: {!! json_encode(array_keys($jenisLayananSuratMasuk->toArray())) !!},
            datasets: [{
                data: {!! json_encode(array_values($jenisLayananSuratMasuk->toArray())) !!},
                backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56', '#8E44AD']
            }]
        }
    });

    // Status Surat Keluar
    new Chart(document.getElementById('jenisLayananSuratKeluarChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: {!! json_encode(array_keys($jenisLayananSuratKeluar->toArray())) !!},
            datasets: [{
                data: {!! json_encode(array_values($jenisLayananSuratKeluar->toArray())) !!},
                backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56', '#8E44AD']
            }]
        }
    });

    // Status Nota Dinas
    new Chart(document.getElementById('jenisLayananNotaDinasChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: {!! json_encode(array_keys($jenisLayananNotaDinas->toArray())) !!},
            datasets: [{
                data: {!! json_encode(array_values($jenisLayananNotaDinas->toArray())) !!},
                backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56', '#8E44AD']
            }]
        }
    });

    // User Statistics
    new Chart(document.getElementById('userChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: {!! json_encode(array_keys($roleUsers->toArray())) !!},
            datasets: [{
                data: {!! json_encode(array_values($roleUsers->toArray())) !!},
                backgroundColor: ['#4BC0C0', '#FF9F40']
            }]
        }
    });

    // Monthly Document Trends
    new Chart(document.getElementById('monthlyTrendsChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: {!! json_encode(array_keys($suratMasukMonthly->toArray())) !!},
            datasets: [
                {
                    label: 'Surat Masuk',
                    data: {!! json_encode(array_values($suratMasukMonthly->toArray())) !!},
                    borderColor: '#36A2EB',
                    fill: false
                },
                {
                    label: 'Surat Keluar',
                    data: {!! json_encode(array_values($suratKeluarMonthly->toArray())) !!},
                    borderColor: '#FF6384',
                    fill: false
                },
                {
                    label: 'Nota Dinas',
                    data: {!! json_encode(array_values($notaDinasMonthly->toArray())) !!},
                    borderColor: '#FFCE56',
                    fill: false
                }
            ]
        }
    });
</script>
@endsection
