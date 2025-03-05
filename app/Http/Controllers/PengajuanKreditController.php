<?php

namespace App\Http\Controllers;

use App\Models\Konsumen;
use Illuminate\Http\Request;
use App\Models\PengajuanKredit;
use Illuminate\Support\Facades\DB;
use Illuminate\Container\Attributes\Auth;

class PengajuanKreditController extends Controller
{
    public function create()
    {
        return view('pengajuan.create');
    }

    public function store(Request $request)
    {
        $validatedKonsumen = $request->validate([
            'nama_lengkap' => 'required|max:255',
            'nik' => 'required|unique:konsumens|digits:16',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required',
            'no_telpon' => 'required',
            'email' => 'required|email|unique:konsumens',
            'status_perkawinan' => 'required',
            'pekerjaan' => 'required',
            'penghasilan_bulanan' => 'required|numeric',
        ]);

        $validatedPengajuan = $request->validate([
            'merk_kendaraan' => 'required',
            'model_kendaraan' => 'required',
            'warna_kendaraan' => 'required',
            'harga_kendaraan' => 'required|numeric',
            'tenor' => 'required|numeric',
            'dp_persen' => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();

            // Buat data konsumen
            $konsumen = Konsumen::create($validatedKonsumen);

            // Hitung DP Nominal
            $validatedPengajuan['dp_nominal'] =
                $validatedPengajuan['harga_kendaraan'] *
                ($validatedPengajuan['dp_persen'] / 100);

            // Buat pengajuan kredit
            $pengajuan = new PengajuanKredit($validatedPengajuan);
            $pengajuan->konsumen_id = $konsumen->id;
            $pengajuan->status = 'menunggu_approval';
            $pengajuan->marketing_id = Auth::id();
            $pengajuan->save();

            DB::commit();

            return redirect()
                ->route('pengajuan.detail', $pengajuan->id)
                ->with('success', 'Pengajuan kredit berhasil diajukan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    public function approval(Request $request, $id)
    {
        $pengajuan = PengajuanKredit::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:disetujui,ditolak',
            'catatan_approval' => 'nullable'
        ]);

        $pengajuan->update([
            'status' => $validated['status'],
            'catatan_approval' => $validated['catatan_approval'],
            'approver_id' => Auth::id()
        ]);

        return redirect()
            ->route('pengajuan.detail', $pengajuan->id)
            ->with('success', 'Status pengajuan diperbarui');
    }
}
