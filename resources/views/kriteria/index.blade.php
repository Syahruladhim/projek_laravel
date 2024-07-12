@extends('layouts.app')

@section('content')
    <style>
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6 !important;
        }
    </style>

    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2 class="text-center">{{ __('Kriteria') }}</h2>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card-styles mb-4">
        <div class="card-style-3">
            <div class="card-content">
                <div class="d-flex justify-content-between mb-3">
                    <h6 class="font-weight-bold text-primary text-center">Kriteria</h6>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Tambah Kriteria</button>
                </div>

                <table class="table table-bordered text-center">
                    <thead class="text-center">
                        <tr>
                            <th>Kode Kriteria</th>
                            <th>Nama Kriteria</th>
                            <th>Tipe Kriteria</th>
                            <th>Bobot</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($kriterias as $kriteria)
                            <tr>
                                <td>{{ $kriteria->kode_kriteria }}</td>
                                <td>{{ $kriteria->nama_kriteria }}</td>
                                <td>{{ $kriteria->tipe_kriteria }}</td>
                                <td>{{ $kriteria->bobot }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $kriteria->id }}">Edit</button>
                                    <form action="{{ route('kriteria.destroy', $kriteria->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $kriteria->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $kriteria->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center" id="editModalLabel{{ $kriteria->id }}">Edit Kriteria</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="kode_kriteria{{ $kriteria->id }}" class="form-label">Kode Kriteria</label>
                                                    <input type="text" name="kode_kriteria" class="form-control" id="kode_kriteria{{ $kriteria->id }}" value="{{ $kriteria->kode_kriteria }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama_kriteria{{ $kriteria->id }}" class="form-label">Nama Kriteria</label>
                                                    <input type="text" name="nama_kriteria" class="form-control" id="nama_kriteria{{ $kriteria->id }}" value="{{ $kriteria->nama_kriteria }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tipe_kriteria{{ $kriteria->id }}" class="form-label">Tipe Kriteria</label>
                                                    <select name="tipe_kriteria" class="form-control" id="tipe_kriteria{{ $kriteria->id }}" required>
                                                        <option value="benefit" {{ $kriteria->tipe_kriteria == 'benefit' ? 'selected' : '' }}>Benefit</option>
                                                        <option value="cost" {{ $kriteria->tipe_kriteria == 'cost' ? 'selected' : '' }}>Cost</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="bobot{{ $kriteria->id }}" class="form-label">Bobot</label>
                                                    <input type="number" step="0.01" name="bobot" class="form-control" id="bobot{{ $kriteria->id }}" value="{{ $kriteria->bobot }}" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="createModalLabel">Tambah Kriteria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kriteria.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="kode_kriteria" class="form-label">Kode Kriteria</label>
                            <input type="text" name="kode_kriteria" class="form-control" id="kode_kriteria" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
                            <input type="text" name="nama_kriteria" class="form-control" id="nama_kriteria" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipe_kriteria" class="form-label">Tipe Kriteria</label>
                            <select name="tipe_kriteria" class="form-control" id="tipe_kriteria" required>
                                <option value="benefit">Benefit</option>
                                <option value="cost">Cost</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="bobot" class="form-label">Bobot</label>
                            <input type="number" step="0.01" name="bobot" class="form-control" id="bobot" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
