@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Welcome, {{ auth()->user()->name }} 🎉</h1>
    </div>

    <!-- Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-hospital"></i> Rumah Sakit</h5>
                    <p class="card-text">Kelola data rumah sakit. <br>Jumlah: {{ $hpCount ?? 0 }}</p>
                    <a href="{{ route('hospitals.index') }}" class="btn btn-primary btn-sm">Manage</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-people"></i> Pasien</h5>
                    <p class="card-text">Kelola data pasien. <br>Jumlah: {{ $ptCount ?? 0 }}</p>
                    <a href="{{ route('patients.index') }}" class="btn btn-primary btn-sm">Manage</a>
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
                    {{-- @foreach ($logs as $log)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $log->activity }}</td>
                            <td>{{ $log->user->username }}</td>
                            <td>{{ $log->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @endforeach --}}

                </tbody>
            </table>
        </div>
    </div>
@endsection
