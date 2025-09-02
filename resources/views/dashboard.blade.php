@extends('layouts.app')

@section('content')
    <div
        class="d-flex justify-content-between 
                        flex-wrap flex-md-nowrap align-items-center 
                        pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Welcome, {{ auth()->user()->name }} 🎉</h1>
    </div>

    <!-- Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-hospital"></i> Rumah Sakit</h5>
                    <p class="card-text">Kelola data rumah sakit.</p>
                    <a href="#" class="btn btn-primary btn-sm">Manage</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-people"></i> Pasien</h5>
                    <p class="card-text">Kelola data pasien.</p>
                    <a href="#" class="btn btn-primary btn-sm">Manage</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Example -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-white">
            <h5 class="mb-0">Activity Logs</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Activity</th>
                        <th>User</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Login</td>
                        <td>{{ auth()->user()->username }}</td>
                        <td>{{ now()->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Opened Dashboard</td>
                        <td>{{ auth()->user()->username }}</td>
                        <td>{{ now()->format('d M Y H:i') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <h3>Welcome, {{ auth()->user()->username }} 🎉</h3>

    <div class="row">
        <div class="col-md-6">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-hospital"></i> Rumah Sakit</h5>
                    <p class="card-text">Jumlah: {{ $rsCount ?? 0 }}</p>
                    <a href="" class="btn btn-light btn-sm">Manage</a>
                    {{-- <a href="{{ route('rumah-sakit.index') }}" class="btn btn-light btn-sm">Manage</a> --}}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-people"></i> Pasien</h5>
                    <p class="card-text">Jumlah: {{ $pasienCount ?? 0 }}</p>
                    <a href="" class="btn btn-light btn-sm">Manage</a>
                    {{-- <a href="{{ route('pasien.index') }}" class="btn btn-light btn-sm">Manage</a> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
