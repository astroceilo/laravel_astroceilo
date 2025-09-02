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
                        <th>No</th>
                        <th>Nama Rumah Sakit</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hospitals as $hospital)
                        <tr id="row-{{ $hospital->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $hospital->name }}</td>
                            <td>{{ $hospital->address }}</td>
                            <td>{{ $hospital->email }}</td>
                            <td>{{ $hospital->phone }}</td>
                            <td>
                                <!-- Tombol Edit -->
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editHospitalModal{{ $hospital->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <!-- Tombol Delete -->
                                {{-- <form action="{{ route('hospitals.destroy', $hospital->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus rumah sakit ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form> --}}
                                <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $hospital->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $hospitals->links() }}
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="hospitalModal" tabindex="-1" aria-labelledby="hospitalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('hospitals.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="hospitalModalLabel">Tambah Rumah Sakit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Rumah Sakit</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="address" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    @foreach ($hospitals as $hospital)
        <div class="modal fade" id="editHospitalModal{{ $hospital->id }}" tabindex="-1">
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
                            <textarea name="address" class="form-control" required>{{ $hospital->address }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $hospital->email }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telepon</label>
                            <input type="text" name="phone" class="form-control" value="{{ $hospital->phone }}"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function() {
                if (confirm('Yakin hapus rumah sakit ini?')) {
                    fetch(`/hospitals/${this.dataset.id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    }).then(res => {
                        if (res.ok) {
                            location.reload();
                        } else {
                            alert('Gagal menghapus data rumah sakit');
                        }
                    }).catch(err => {
                        alert('Terjadi kesalahan: ' + err);
                    });
                }
            });
        });
    </script>
@endpush
