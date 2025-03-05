@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-6">Detail Pengajuan Kredit</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Data Konsumen</h3>
                            <div class="bg-gray-50 p-4 rounded-md">
                                <p><strong>Nama:</strong> {{ $pengajuan->konsumen->nama_lengkap }}</p>
                                <p><strong>NIK:</strong> {{ $pengajuan->konsumen->nik }}</p>
                                <p><strong>Tanggal Lahir:</strong> {{ $pengajuan->konsumen->tanggal_lahir }}</p>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Kendaraan</h3>
                            <div class="bg-gray-50 p-4 rounded-md">
                                <p><strong>Merk:</strong> {{ $pengajuan->merk_kendaraan }}</p>
                                <p><strong>Model:</strong> {{ $pengajuan->model_kendaraan }}</p>
                                <p><strong>Harga:</strong> Rp {{ number_format($pengajuan->harga_kendaraan, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Status Pengajuan</h3>
                        <div class="bg-gray-50 p-4 rounded-md">
                            <p><strong>Status:</strong>
                                <span
                                    class="
                                @if ($pengajuan->status == 'disetujui') text-green-600
                                @elseif($pengajuan->status == 'ditolak') text-red-600
                                @else text-yellow-600 @endif
                            ">
                                    {{ ucfirst($pengajuan->status) }}
                                </span>
                            </p>
                            @if ($pengajuan->catatan_approval)
                                <p><strong>Catatan:</strong> {{ $pengajuan->catatan_approval }}</p>
                            @endif
                        </div>
                    </div>

                    @if (Auth::user()->hasRole('marketing'))
                        <form action="{{ route('pengajuan.approval', $pengajuan->id) }}" method="POST" class="mt-6">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Status Approval</label>
                                    <select name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                        required>
                                        <option value="disetujui">Setujui</option>
                                        <option value="ditolak">Tolak</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Catatan (Opsional)</label>
                                    <textarea name="catatan_approval" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="3"></textarea>
                                </div>
                                <div>
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Proses Pengajuan
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
