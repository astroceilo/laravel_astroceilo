@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">Data Pasien</h2>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        {{-- Filter Rumah Sakit --}}
        <div class="mb-3">
            <label for="filterHospital" class="form-label">Filter berdasarkan Rumah Sakit:</label>
            <select id="filterHospital" class="form-select">
                <option value="">-- Semua Rumah Sakit --</option>
                @foreach ($hospitals as $hospital)
                    <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Button Tambah --}}
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPatientModal">
            <i class="bi bi-plus-circle"></i> Tambah Pasien
        </button>
    </div>

    {{-- Table --}}
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Pasien</th>
                        <th>Alamat</th>
                        <th>No Telepon</th>
                        <th>Rumah Sakit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="patientsTable">
                    @foreach ($patients as $patient)
                        <tr id="row-{{ $patient->id }}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->address }}</td>
                            <td>{{ $patient->phone }}</td>
                            <td>{{ $patient->hospital->name ?? '-' }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editPatientModal{{ $patient->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $patient->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @foreach ($patients as $patient)
        {{-- Modal Edit --}}
        <div class="modal fade" id="editPatientModal{{ $patient->id }}" tabindex="-1">
            <div class="modal-dialog">
                <form action="{{ route('patients.update', $patient->id) }}" method="POST" class="modal-content">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Pasien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Pasien</label>
                            <input type="text" name="name" class="form-control" value="{{ $patient->name }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="address" class="form-control">{{ $patient->address }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telepon</label>
                            <input type="text" name="phone" class="form-control" value="{{ $patient->phone }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rumah Sakit</label>
                            <select name="hospital_id" class="form-select">
                                @foreach ($hospitals as $hospital)
                                    <option value="{{ $hospital->id }}"
                                        {{ $patient->hospital_id == $hospital->id ? 'selected' : '' }}>
                                        {{ $hospital->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach


    {{-- Modal Tambah --}}
    <div class="modal fade" id="addPatientModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('patients.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pasien</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Pasien</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="text" name="telepon" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rumah Sakit</label>
                        <select name="hospital_id" class="form-select" required>
                            <option value="">-- Pilih Rumah Sakit --</option>
                            @foreach ($hospitals as $hospital)
                                <option value="{{ $hospital->id }}">{{ $hospital->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Delete pakai Ajax
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function() {
                if (confirm('Yakin hapus pasien ini?')) {
                    fetch(`/patients/${this.dataset.id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    }).then(res => {
                        if (res.ok) {
                            document.getElementById(`row-${this.dataset.id}`).remove();
                        } else {
                            alert('Gagal menghapus data');
                        }
                    });
                }
            });
        });

        // Filter Rumah Sakit (Ajax bisa ditambahkan nanti)
        document.getElementById('filterHospital').addEventListener('change', function() {
            let hospitalId = this.value;
            window.location.href = hospitalId ? `?hospital_id=${hospitalId}` : `{{ route('patients.index') }}`;
        });
    </script>
@endpush
