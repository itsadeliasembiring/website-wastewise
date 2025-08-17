@extends('layouts.template')
@section('title', 'Detail Artikel')

@section('content')
    <!-- Navbar -->
    <x-header.admin/>

    <div class="flex min-h-full">
        <!-- Sidebar -->
        <div class="relative">
            <x-sidebar.admin />
        </div>

        <!-- Main Content -->
        <main class="justify-center w-full">
            <!-- Title & Description -->
            <div class="mt-4 sm:px-8">
                <p class="text-[#3D8D7A] text-center font-semibold xs:text-[23px] sm:text-[23px] xl:text-[25px]">
                    Detail Artikel</p>
            </div>

            <!-- Content -->
            <div class="pl-[70px] pr-[20px]">
                <div class="flex justify-between items-center mt-4 mb-4">
                    <a href="{{ route('kelola-artikel') }}" 
                       class="btn btn-sm bg-gray-500 hover:bg-gray-600 text-white border-none rounded-[10px]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>
                    
                    <a href="{{ route('edit-artikel.show', $artikel->id_artikel) }}"
                       class="btn btn-sm bg-[#3D8D7A] hover:bg-[#3D8D7A] text-white border-none rounded-[10px]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Artikel
                    </a>
                </div>

                <!-- Detail Card -->
                <div class="card w-full shadow-md bg-white text-black px-6 py-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Informasi Utama -->
                        <div class="space-y-6">
                            <div>
                                <label class="text-sm font-medium text-gray-500">ID Artikel</label>
                                <p class="text-lg font-semibold text-gray-800">{{ $artikel->id_artikel }}</p>
                            </div>
                            
                            <div>
                                <label class="text-sm font-medium text-gray-500">Judul Artikel</label>
                                <p class="text-lg font-semibold text-gray-800">{{ $artikel->judul_artikel }}</p>
                            </div>
                            
                            <div>
                                <label class="text-sm font-medium text-gray-500">Waktu Dibuat</label>
                                <p class="text-lg font-semibold text-gray-800">
                                    {{ \Carbon\Carbon::parse($artikel->created_at)->format('d M Y, H:i') }} WIB
                                </p>
                            </div>
                            
                            <div>
                                <label class="text-sm font-medium text-gray-500">Terakhir Diupdate</label>
                                <p class="text-lg font-semibold text-gray-800">
                                    {{ \Carbon\Carbon::parse($artikel->updated_at)->format('d M Y, H:i') }} WIB
                                </p>
                            </div>
                        </div>
                        
                        <!-- Foto Artikel -->
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-3 block">Foto Artikel</label>
                            <div class="w-full h-80 bg-gray-100 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-300">
                                @if($artikel->foto)
                                    <img src="{{ Storage::url('artikel/' . $artikel->foto) }}"
                                         alt="Foto Artikel" 
                                         class="max-h-full max-w-full rounded-lg object-cover shadow-lg">
                                @else
                                    <div class="text-center text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <p>Tidak ada foto</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Detail Artikel -->
                    <div class="mt-8">
                        <label class="text-sm font-medium text-gray-500 mb-3 block">Detail Artikel</label>
                        <div class="bg-gray-50 p-6 rounded-lg border">
                            <div class="prose max-w-none text-gray-800 leading-relaxed">
                                {!! nl2br(e($artikel->detail_artikel)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection