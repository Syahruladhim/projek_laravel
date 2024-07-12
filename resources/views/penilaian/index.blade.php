@extends('layouts.app')

@section('content')
    <style>
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6 !important;
        }
        .table thead th,
        .table tbody td {
            vertical-align: middle;
        }
    </style>

    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('Penilaian Alternatif') }}</h2>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    @if (session('toast_success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('toast_success') }}
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
                    <h6 class="font-weight-bold text-primary">Penilaian</h6>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPenilaianModal">Tambah Penilaian</button>
                </div>

                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Alternatif</th>
                            @foreach($kriterias as $kriteria)
                                <th>{{ $kriteria->nama_kriteria }}</th>
                            @endforeach
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alternatifs as $alternatif)
                            <tr>
                                <td>{{ $alternatif->nama }}</td>
                                @foreach($kriterias as $kriteria)
                                    <td>{{ optional($penilaians->where('alternatif_id', $alternatif->id)->where('kriteria_id', $kriteria->id)->first())->nilai }}</td>
                                @endforeach
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPenilaianModal{{ $alternatif->id }}">Edit</button>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editPenilaianModal{{ $alternatif->id }}" tabindex="-1" role="dialog" aria-labelledby="editPenilaianModalLabel{{ $alternatif->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editPenilaianModalLabel{{ $alternatif->id }}">Edit Penilaian {{ $alternatif->nama }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('penilaian.update', $alternatif->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                @foreach($kriterias as $kriteria)
                                                    <div class="mb-3">
                                                        <label for="kriteria_{{ $kriteria->id }}" class="form-label">{{ $kriteria->nama_kriteria }}</label>
                                                        <input type="number" name="{{ $kriteria->id }}" class="form-control" id="kriteria_{{ $kriteria->id }}" value="{{ optional($penilaians->where('alternatif_id', $alternatif->id)->where('kriteria_id', $kriteria->id)->first())->nilai }}" required>
                                                    </div>
                                                @endforeach
                                                <button type="submit" class="btn btn-primary">Simpan</button>
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
    <div class="modal fade" id="createPenilaianModal" tabindex="-1" role="dialog" aria-labelledby="createPenilaianModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPenilaianModalLabel">Tambah Penilaian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('penilaian.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="alternative_id" class="form-label">Alternatif</label>
                            <select class="form-control" id="alternative_id" name="alternative_id" required>
                                @foreach($alternatifs as $alternatif)
                                    <option value="{{ $alternatif->id }}">{{ $alternatif->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        @foreach($kriterias as $kriteria)
                            <div class="mb-3">
                                <label for="kriteria_{{ $kriteria->id }}" class="form-label">{{ $kriteria->nama_kriteria }}</label>
                                <input type="number" name="{{ $kriteria->id }}" class="form-control" id="kriteria_{{ $kriteria->id }}" required>
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
