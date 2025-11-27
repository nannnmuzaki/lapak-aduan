<div>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Pengaduan Saya</h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">Daftar pengaduan yang telah Anda ajukan</p>
    </div>

    @if(session()->has('success'))
    <div class="p-4 mb-6 text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900/30 dark:text-green-400 dark:border-green-800">
        {{ session('success') }}
    </div>
    @endif

    {{-- Pengaduan List --}}
    <div class="space-y-4">
        @forelse($pengaduans as $pengaduan)
        <div class="p-6 bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $pengaduan->judul }}</h3>
                        <div class="flex gap-2 ml-4">
                            @if($pengaduan->status_respon === 'telah_direspon')
                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-md dark:bg-green-900/30 dark:text-green-400">Direspon</span>
                            @else
                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-orange-700 bg-orange-100 rounded-md dark:bg-orange-900/30 dark:text-orange-400">Proses</span>
                            @endif
                            @if($pengaduan->is_verified)
                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-md dark:bg-blue-900/30 dark:text-blue-400">Terverifikasi</span>
                            @endif
                        </div>
                    </div>
                    
                    <p class="mb-3 text-sm text-gray-600 dark:text-gray-400 line-clamp-2">{{ Str::of($pengaduan->isi)->toHtmlString() }}</p>
                    
                    <div class="flex flex-wrap items-center gap-3 mb-3">
                        <span class="text-xs text-gray-500 dark:text-gray-500">No: {{ $pengaduan->nomor_pengaduan }}</span>
                        <span class="text-xs text-gray-500 dark:text-gray-500">•</span>
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-md bg-sky-100 text-sky-700 dark:bg-sky-900/30 dark:text-sky-400">
                            {{ $pengaduan->jenisPengaduan->nama }}
                        </span>
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-md dark:bg-gray-800 dark:text-gray-300">
                            {{ $pengaduan->kategoriPengaduan->nama }}
                        </span>
                        <span class="text-xs text-gray-600 dark:text-gray-400">→ {{ $pengaduan->opd->kode }}</span>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <button wire:click="showDetail({{ $pengaduan->id }})" 
                            class="text-sm font-medium text-sky-600 hover:text-sky-700 dark:text-sky-400">
                            Lihat Detail
                        </button>
                        <span class="text-gray-300 dark:text-gray-700">|</span>
                        <button wire:click="confirmDelete({{ $pengaduan->id }})" 
                            class="text-sm font-medium text-red-600 hover:text-red-700 dark:text-red-400">
                            Hapus
                        </button>
                        <span class="ml-auto text-xs text-gray-500 dark:text-gray-500">{{ $pengaduan->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="p-12 text-center bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
            <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <p class="mt-4 text-gray-600 dark:text-gray-400">Anda belum memiliki pengaduan</p>
            <a wire:navigate href="{{ route('page.buat-pengaduan') }}" 
                class="inline-flex items-center px-4 py-2 mt-4 text-sm font-medium text-white transition-colors rounded-lg bg-sky-600 hover:bg-sky-700">
                Buat Pengaduan Baru
            </a>
        </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $pengaduans->links() }}
    </div>

    {{-- Modal Detail --}}
    @if($showDetailModal && $selectedPengaduan)
    <div class="fixed inset-0 z-50 overflow-y-auto" x-data="{ show: @entangle('showDetailModal') }">
        <div class="flex items-center justify-center min-h-screen px-4 py-8">
            <div class="fixed inset-0 transition-opacity bg-gray-500 dark:bg-gray-900 bg-opacity-75 dark:bg-opacity-75" @click="$wire.closeDetailModal()"></div>
            
            <div class="relative w-full max-w-3xl mx-auto bg-white rounded-xl dark:bg-gray-900 shadow-xl max-h-[90vh] overflow-y-auto">
                <div class="sticky top-0 z-10 flex items-center justify-between p-6 border-b border-gray-200 bg-white dark:bg-gray-900 dark:border-gray-800">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Detail Pengaduan</h3>
                    <button @click="$wire.closeDetailModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">No. Pengaduan</label>
                        <p class="mt-1 text-gray-900 dark:text-white">{{ $selectedPengaduan->nomor_pengaduan }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Judul</label>
                        <p class="mt-1 text-gray-900 dark:text-white">{{ $selectedPengaduan->judul }}</p>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis</label>
                            <p class="mt-1"><span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-md bg-sky-100 text-sky-700 dark:bg-sky-900/30 dark:text-sky-400">{{ $selectedPengaduan->jenisPengaduan->nama }}</span></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                            <p class="mt-1"><span class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-md dark:bg-gray-800 dark:text-gray-300">{{ $selectedPengaduan->kategoriPengaduan->nama }}</span></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">OPD</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $selectedPengaduan->opd->nama }}</p>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Isi Pengaduan</label>
                        <p class="mt-1 text-gray-900 dark:text-white whitespace-pre-wrap">{{ Str::of($selectedPengaduan->isi)->toHtmlString() }}</p>
                    </div>
                    
                    @if($selectedPengaduan->images_path && count($selectedPengaduan->images_path) > 0)
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Lampiran Foto</label>
                        <div class="grid grid-cols-3 gap-2">
                            @foreach($selectedPengaduan->images_path as $image)
                            <a href="{{ Storage::url($image) }}" target="_blank" class="block overflow-hidden border border-gray-200 rounded-lg dark:border-gray-700 hover:border-sky-500">
                                <img src="{{ Storage::url($image) }}" alt="Lampiran" class="object-cover w-full h-32">
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <p class="mt-1">
                                @if($selectedPengaduan->status_respon === 'telah_direspon')
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-md dark:bg-green-900/30 dark:text-green-400">Telah Direspon</span>
                                @else
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-orange-700 bg-orange-100 rounded-md dark:bg-orange-900/30 dark:text-orange-400">Dalam Proses</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Verifikasi</label>
                            <p class="mt-1">
                                @if($selectedPengaduan->is_verified)
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-md dark:bg-blue-900/30 dark:text-blue-400">Terverifikasi</span>
                                @else
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-md dark:bg-gray-800 dark:text-gray-300">Belum Diverifikasi</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    @if($selectedPengaduan->balasan)
                    <div class="p-4 border-l-4 border-sky-500 bg-sky-50 dark:bg-sky-900/20 dark:border-sky-400">
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Balasan</label>
                        <p class="text-gray-900 dark:text-white whitespace-pre-wrap">{{ Str::of($selectedPengaduan->balasan)->toHtmlString() }}</p>
                    </div>
                    @endif
                    
                    @if($selectedPengaduan->bukti_terusan_path)
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Bukti Terusan</label>
                        <a href="{{ Storage::url($selectedPengaduan->bukti_terusan_path) }}" target="_blank" 
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg bg-sky-600 hover:bg-sky-700">
                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Unduh Bukti Terusan
                        </a>
                    </div>
                    @endif
                    
                    @if($selectedPengaduan->bukti_balasan_path)
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Bukti Balasan</label>
                        <a href="{{ Storage::url($selectedPengaduan->bukti_balasan_path) }}" target="_blank" 
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg bg-sky-600 hover:bg-sky-700">
                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Unduh Bukti Balasan
                        </a>
                    </div>
                    @endif
                </div>

                <div class="flex justify-end p-6 border-t border-gray-200 dark:border-gray-800">
                    <button @click="$wire.closeDetailModal()" 
                        class="px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg bg-sky-600 hover:bg-sky-700">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Modal Delete Confirmation --}}
    @if($showDeleteModal)
    <div class="fixed inset-0 z-50 overflow-y-auto" x-data="{ show: @entangle('showDeleteModal') }">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity bg-gray-500 dark:bg-gray-900 bg-opacity-75 dark:bg-opacity-75" @click="$wire.closeDeleteModal()"></div>
            
            <div class="relative w-full max-w-md p-6 mx-auto bg-white rounded-xl dark:bg-gray-900 shadow-xl">
                <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-red-100 rounded-full dark:bg-red-900/30">
                    <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                
                <h3 class="mb-2 text-lg font-semibold text-center text-gray-900 dark:text-white">Hapus Pengaduan?</h3>
                <p class="mb-6 text-sm text-center text-gray-600 dark:text-gray-400">Tindakan ini tidak dapat dibatalkan. Pengaduan akan dihapus secara permanen.</p>
                
                <div class="flex gap-3">
                    <button @click="$wire.closeDeleteModal()" 
                        class="flex-1 px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700 dark:hover:bg-gray-700">
                        Batal
                    </button>
                    <button wire:click="deletePengaduan" 
                        class="flex-1 px-4 py-2 text-sm font-medium text-white transition-colors bg-red-600 rounded-lg hover:bg-red-700">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
