@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-6">Formulir Pengajuan Kredit Kendaraan</h2>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pengajuan.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Data Pribadi</h3>

                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                        <input type="text" name="nama_lengkap"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                            value="{{ old('nama_lengkap') }}" required>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">NIK</label>
                                        <input type="text" name="nik"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                            value="{{ old('nik') }}" required>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                            value="{{ old('tanggal_lahir') }}" required>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                        <select name="jenis_kelamin"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Kendaraan</h3>

                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Merk Kendaraan</label>
                                        <input type="text" name="merk_kendaraan"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                            value="{{ old('merk_kendaraan') }}" required>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Model Kendaraan</label>
                                        <input type="text" name="model_kendaraan"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                            value="{{ old('model_kendaraan') }}" required>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Harga Kendaraan</label>
                                        <input type="number" name="harga_kendaraan"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                            value="{{ old('harga_kendaraan') }}" required>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Tenor (Bulan)</label>
                                        <select name="tenor"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                            <option value="">Pilih Tenor</option>
                                            <option value="12" {{ old('tenor') == 12 ? 'selected' : '' }}>12 Bulan
                                            </option>
                                            <option value="24" {{ old('tenor') == 24 ? 'selected' : '' }}>24 Bulan
                                            </option>
                                            <option value="36" {{ old('tenor') == 36 ? 'selected' : '' }}>36 Bulan
                                            </option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Down Payment (%)</label>
                                        <input type="number" name="dp_persen"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                            value="{{ old('dp_persen') }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Ajukan Kredit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
