<?php

namespace App\Repositories;

use App\Models\Evaluasi;
use App\Models\DetailRps;
use App\Interfaces\EvalRepositoryInterface;
use Illuminate\Support\Facades\DB;

class EvalRepository implements EvalRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function index(){
        return Evaluasi::all();
    }

    public function getById($id_detailrps){
        $detailrps = DetailRps::findOrFail($id_detailrps);

        $evaluasi = Evaluasi::where('id_detailrps', $detailrps->id_detailrps)->first();

        return $evaluasi;
    }

    public function getEvaluasiByMinggu($id_matkul, $id_detailrps, $id_evaluasi)
    {
        $evaluasi = DB::table('detail_rps')
        ->select(
            'detail_rps.id_detailrps', 
            'detail_rps.minggu', 
            'detail_rps.id_subcpmk', 
            'detail_rps.bobot', 
            'detail_rps.id_matkul', 
            'subcpmk.id_subcpmk', 
            'subcpmk.subcpmk', 
            'subcpmk.id_matkul', 
            'evaluasi.id_evaluasi',
            'evaluasi.*'
        )
        ->leftJoin('subcpmk', 'detail_rps.id_subcpmk', '=', 'subcpmk.id_subcpmk')
        ->leftJoin('evaluasi', 'detail_rps.id_detailrps', '=', 'evaluasi.id_detailrps')
        ->where('detail_rps.id_matkul', $id_matkul)
        ->where('detail_rps.id_detailrps', $id_detailrps) // Filter berdasarkan id_detailrps
        ->where('evaluasi.id_evaluasi', $id_evaluasi) // Filter berdasarkan id_evaluasi
        ->first();
        
    return $evaluasi;
    }

    public function store(array $data)
    {
        return Evaluasi::create($data);
    }

    public function update(array $data, $id_evaluasi)
    {
        return Evaluasi::where('id_evaluasi', $id_evaluasi)->update($data);
    }

    public function delete($id_evaluasi)
    {
        $evaluasi = Evaluasi::find($id_evaluasi);

        if (!$evaluasi) {
            return false; // Gagal menghapus karena evaluasi tidak ditemukan
        }

        $evaluasi->delete();
        return true;
    }
}

        // // Ambil id_matkul dan minggu dari data yang diberikan
        // $id_matkul = $data['id_matkul'];

        // // Ambil minggu dari tabel detail_rps
        // $minggu = DB::table('detail_rps')
        //     ->where('id_matkul', $id_matkul)
        //     ->pluck('minggu')
        //     ->first();

        // $bentuk_asesmen = DB::table('evaluasi')
        //     ->where(function ($query) {
        //         $query->where('asesmen', 'Tes')
        //             ->orWhere('asesmen', 'Non Tes');
        //     })
        //     ->pluck('asesmen')
        //     ->first();

        // // Pastikan minggu ditemukan sebelum membuat data evaluasi
        // if ($minggu) {
        //     // Tambahkan minggu ke dalam data yang akan disimpan
        //     $data['minggu'] = $minggu;

        //     return Evaluasi::create($data);
        // } else {
        //     // Kembalikan pesan kesalahan jika minggu tidak ditemukan
        //     return response()->json(['message' => 'Minggu not found for this id_matkul'], 404);
        // }