@extends('layouts.app')

@section('content')
    <style>
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6 !important; /* Adjust the border color and width as needed */
        }
    </style>

    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2 class="text-center">{{ __('Perhitungan SAW') }}</h2>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <!-- Matriks Normalisasi -->
    <div class="card-styles mb-4">
        <div class="card-style-3">
            <div class="card-content">
                <h5 class="mb-3 text-center">Matriks Normalisasi</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>Alternatif</th>
                                @foreach ($kriterias as $kriteria)
                                    <th>{{ $kriteria->nama_kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matrixNormalisasi as $altId => $nilai)
                                <tr>
                                    <td>{{ $alternatifs->find($altId)->nama }}</td>
                                    @foreach ($kriterias as $kriteria)
                                        <td>{{ number_format($nilai[$kriteria->id], 4) }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Nilai Preferensi dan Perankingan -->
    <div class="card-styles mb-4">
        <div class="card-style-3">
            <div class="card-content">
                <h5 class="mb-3 text-center">Nilai Preferensi dan Perankingan</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>Peringkat</th>
                                <th>Alternatif</th>
                                <th>Nilai Preferensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $rank = 1; @endphp
                            @foreach ($nilaiPreferensi as $altId => $nilai)
                                <tr>
                                    <td>{{ $rank++ }}</td>
                                    <td>{{ $alternatifs->find($altId)->nama }}</td>
                                    <td>{{ number_format($nilai, 4) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
