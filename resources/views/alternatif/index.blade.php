@extends('layouts.app')

@section('content')
    <style>
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6 !important;
        }
        .table thead th {
            vertical-align: middle;
        }
    </style>

    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2 class="text-center">{{ __('Alternatifs') }}</h2>
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
                    <h6 class="font-weight-bold text-primary text-center">Alternatif List</h6>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAlternatifModal">Add Alternatif</button>
                </div>

                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alternatifs as $alternatif)
                            <tr>
                                <td>{{ $alternatif->kode }}</td>
                                <td>{{ $alternatif->nama }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editAlternatifModal{{ $alternatif->id }}">Edit</button>
                                    <form action="{{ route('alternatifs.destroy', $alternatif->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Alternatif Modal -->
                            <div class="modal fade" id="editAlternatifModal{{ $alternatif->id }}" tabindex="-1" role="dialog" aria-labelledby="editAlternatifModalLabel{{ $alternatif->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editAlternatifModalLabel{{ $alternatif->id }}">Edit Alternatif</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('alternatifs.update', $alternatif->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="kode{{ $alternatif->id }}" class="form-label">Kode</label>
                                                    <input type="text" name="kode" class="form-control" id="kode{{ $alternatif->id }}" value="{{ $alternatif->kode }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama{{ $alternatif->id }}" class="form-label">Nama</label>
                                                    <input type="text" name="nama" class="form-control" id="nama{{ $alternatif->id }}" value="{{ $alternatif->nama }}" required>
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

    <!-- Add Alternatif Modal -->
    <div class="modal fade" id="addAlternatifModal" tabindex="-1" role="dialog" aria-labelledby="addAlternatifModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAlternatifModalLabel">Add Alternatif</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('alternatifs.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode</label>
                            <input type="text" name="kode" class="form-control" id="kode" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" id="nama" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
