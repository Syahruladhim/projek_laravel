<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PenilaianController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();
        $penilaians = Penilaian::all();

        return view('penilaian.index', compact('alternatifs', 'kriterias', 'penilaians'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $alternativeId = $request->input('alternative_id');

        DB::beginTransaction();
        foreach ($data as $key => $value) {
            if ($key != 'alternative_id') {
                Penilaian::updateOrCreate(
                    ['alternatif_id' => $alternativeId, 'kriteria_id' => $key],
                    ['nilai' => $value]
                );
            }
        }
        DB::commit();

        return redirect()->route('penilaian.index')->with('toast_success', 'Penilaian alternatif diperbarui!');
    }

    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', '_method', 'alternative_id']);
        $alternativeId = $request->input('alternative_id');

        DB::beginTransaction();
        foreach ($data as $key => $value) {
            if ($key != 'alternative_id') {
                Penilaian::where('alternatif_id', $alternativeId)
                    ->where('kriteria_id', $key)
                    ->update(['nilai' => $value]);
            }
        }
        DB::commit();

        return redirect()->route('penilaian.index')->with('toast_success', 'Penilaian alternatif diperbarui!');
    }
    public function saw()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();
        $penilaians = Penilaian::all();

        // Normalisasi Matriks
        $matrixNormalisasi = $this->normalisasiMatriksSAW($penilaians, $kriterias);

        // Nilai Preferensi
        $nilaiPreferensi = $this->hitungNilaiPreferensiSAW($matrixNormalisasi, $kriterias);

        return view('perhitungan.saw', compact('alternatifs', 'kriterias', 'matrixNormalisasi', 'nilaiPreferensi'));
    }

    private function normalisasiMatriksSAW($penilaians, $kriterias)
    {
        $matrixNormalisasi = [];
        foreach ($kriterias as $kriteria) {
            $nilaiKriteria = [];
            foreach ($penilaians as $penilaian) {
                if ($penilaian->kriteria_id == $kriteria->id) {
                    $nilaiKriteria[$penilaian->alternatif_id] = $penilaian->nilai;
                }
            }

            $max = max($nilaiKriteria);
            $min = min($nilaiKriteria);

            foreach ($nilaiKriteria as $alternatifId => $nilai) {
                if ($kriteria->tipe_kriteria == 'benefit') {
                    $matrixNormalisasi[$alternatifId][$kriteria->id] = $nilai / $max;
                } else { // cost
                    $matrixNormalisasi[$alternatifId][$kriteria->id] = $min / $nilai;
                }
            }
        }
        return $matrixNormalisasi;
    }

    private function hitungNilaiPreferensiSAW($matrixNormalisasi, $kriterias)
    {
        $nilaiPreferensi = [];
        foreach ($matrixNormalisasi as $alternatifId => $nilaiKriteria) {
            $nilaiPreferensi[$alternatifId] = 0;
            foreach ($nilaiKriteria as $kriteriaId => $nilai) {
                $bobot = $kriterias->find($kriteriaId)->bobot;
                $nilaiPreferensi[$alternatifId] += $nilai * $bobot;
            }
        }
        arsort($nilaiPreferensi);
        return $nilaiPreferensi;
    }
}
