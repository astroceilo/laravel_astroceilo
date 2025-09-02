@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">Data Rumah Sakit</h2>
    </div>

    <!-- Tombol Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#hospitalModal">
        <i class="bi bi-plus-circle"></i> Tambah Rumah Sakit
    </button>

    <!-- Tabel -->
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Rumah Sakit</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="hospitalTable">
                    @foreach ($hospitals as $hospital)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $hospital->name }}</td>
                            <td>{{ $hospital->address }}</td>
                            <td>{{ $hospital->email }}</td>
                            <td>{{ $hospital->phone }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#edithospitalModal{{ $hospital->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $hospital->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @foreach ($hospitals as $hospital)
        <!-- Modal Edit -->
        <div class="modal fade" id="edithospitalModal{{ $hospital->id }}" tabindex="-1">
            <div class="modal-dialog">
                <form action="{{ route('hospitals.update', $hospital->id) }}" method="POST" class="modal-content">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Rumah Sakit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Rumah Sakit</label>
                            <input type="text" name="name" class="form-control" value="{{ $hospital->name }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="address" class="form-control">{{ $hospital->address }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input name="email" class="form-control" value="{{ $hospital->email }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telepon</label>
                            <input type="text" name="phone" class="form-control" value="{{ $hospital->phone }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <!-- Modal Tambah -->
    <div class="modal fade" id="hospitalModal" tabindex="-1" aria-labelledby="hospitalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hospitalModalLabel">Tambah Rumah Sakit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="hospitalForm">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Rumah Sakit</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea class="form-control" id="address" name="address" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Telepon</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Delete pakai Ajax
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function() {
                if (confirm('Yakin hapus data rumah sakit ini?')) {
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
    </script>
@endpush
