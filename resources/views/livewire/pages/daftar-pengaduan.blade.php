<div>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Daftar Pengaduan</h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">Pengaduan masyarakat yang telah terverifikasi</p>
    </div>

    {{-- Filters --}}
    <div class="p-6 mb-6 bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
        <div class="grid gap-4 md:grid-cols-5">
            <div>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari pengaduan..."
                    class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white focus:ring-2 focus:ring-sky-500">
            </div>
            <div>
                <select wire:model.live="filterJenis"
                    class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white focus:ring-2 focus:ring-sky-500">
                    <option value="">Semua Jenis</option>
                    @foreach($jenisOptions as $jenis)
                        <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select wire:model.live="filterKategori"
                    class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white focus:ring-2 focus:ring-sky-500">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoriOptions as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select wire:model.live="filterOpd"
                    class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white focus:ring-2 focus:ring-sky-500">
                    <option value="">Semua OPD</option>
                    @foreach($opdOptions as $opd)
                        <option value="{{ $opd->id }}">{{ $opd->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select wire:model.live="filterStatus"
                    class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white focus:ring-2 focus:ring-sky-500">
                    <option value="">Semua Status</option>
                    <option value="dalam_proses">Dalam Proses</option>
                    <option value="telah_direspon">Telah Direspon</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Pengaduan Grid --}}
    <div class="grid gap-6 mb-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse($pengaduans as $pengaduan)
            <div wire:click="showDetail({{ $pengaduan->id }})"
                class="p-6 transition-all bg-white border border-gray-200 cursor-pointer rounded-xl hover:border-sky-500 hover:shadow-lg dark:bg-gray-900 dark:border-gray-800 dark:hover:border-sky-500">
                <div class="flex items-start justify-between mb-3">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white line-clamp-2">{{ $pengaduan->judul }}
                    </h3>
                    @if($pengaduan->status_respon === 'telah_direspon')
                        <span
                            class="flex-shrink-0 ml-2 inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-md dark:bg-green-900/30 dark:text-green-400">Direspon</span>
                    @else
                        <span
                            class="flex-shrink-0 ml-2 inline-flex items-center px-2 py-1 text-xs font-medium text-orange-700 bg-orange-100 rounded-md dark:bg-orange-900/30 dark:text-orange-400">Proses</span>
                    @endif
                </div>

                <p class="mb-4 text-sm text-gray-600 dark:text-gray-400 line-clamp-3">{{ Str::of($pengaduan->isi)->toHtmlString() }}</p>

                <div class="flex flex-wrap gap-2 mb-3">
                    <span
                        class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-md bg-sky-100 text-sky-700 dark:bg-sky-900/30 dark:text-sky-400">
                        {{ $pengaduan->jenisPengaduan->nama }}
                    </span>
                    <span
                        class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-md dark:bg-gray-800 dark:text-gray-300">
                        {{ $pengaduan->kategoriPengaduan->nama }}
                    </span>
                </div>

                <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-500">
                    <span>{{ $pengaduan->opd->kode }}</span>
                    <span>{{ $pengaduan->created_at->diffForHumans() }}</span>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div
                    class="p-12 text-center bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
                    <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-600" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="mt-4 text-gray-600 dark:text-gray-400">Tidak ada pengaduan yang ditemukan</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $pengaduans->links() }}
    </div>

    {{-- Modal Detail --}}
    @if($showModal && $selectedPengaduan)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data="{ show: @entangle('showModal') }">
            <div class="flex items-center justify-center min-h-screen px-4 py-8">
                <div class="fixed inset-0 transition-opacity bg-gray-500 dark:bg-gray-900 bg-opacity-75 dark:bg-opacity-75"
                    @click="$wire.closeModal()"></div>

                <div
                    class="relative w-full max-w-3xl mx-auto bg-white rounded-xl dark:bg-gray-900 shadow-xl max-h-[90vh] overflow-y-auto">
                    <div
                        class="sticky top-0 z-10 flex items-center justify-between p-6 border-b border-gray-200 bg-white dark:bg-gray-900 dark:border-gray-800">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Detail Pengaduan</h3>
                        <button @click="$wire.closeModal()"
                            class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
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

                        @if(!$selectedPengaduan->is_profile_anonymous)
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pengadu</label>
                                    <p class="mt-1 text-gray-900 dark:text-white">{{ $selectedPengaduan->nama_pengadu }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                    <p class="mt-1 text-gray-900 dark:text-white">{{ $selectedPengaduan->email_pengadu ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        @else
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pengadu</label>
                                <p class="mt-1 text-gray-600 italic dark:text-gray-400">Anonim</p>
                            </div>
                        @endif

                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis</label>
                                <p class="mt-1"><span
                                        class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-md bg-sky-100 text-sky-700 dark:bg-sky-900/30 dark:text-sky-400">{{ $selectedPengaduan->jenisPengaduan->nama }}</span>
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                                <p class="mt-1"><span
                                        class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-md dark:bg-gray-800 dark:text-gray-300">{{ $selectedPengaduan->kategoriPengaduan->nama }}</span>
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Channel</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                    {{ $selectedPengaduan->channelPengaduan->nama }}
                                </p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">OPD Tujuan</label>
                            <p class="mt-1 text-gray-900 dark:text-white">{{ $selectedPengaduan->opd->nama }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Isi Pengaduan</label>
                            <p class="mt-1 text-gray-900 dark:text-white whitespace-pre-wrap">
                                {{ Str::of($selectedPengaduan->isi)->toHtmlString() }}</p>
                        </div>

                        @if($selectedPengaduan->images_path && count($selectedPengaduan->images_path) > 0)
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Lampiran
                                    Foto</label>
                                <div class="grid grid-cols-3 gap-2">
                                    @foreach($selectedPengaduan->images_path as $image)
                                        <a href="{{ Storage::url($image) }}" target="_blank"
                                            class="block overflow-hidden border border-gray-200 rounded-lg dark:border-gray-700 hover:border-sky-500">
                                            <img src="{{ Storage::url($image) }}" alt="Lampiran" class="object-cover w-full h-32">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status
                                    Respon</label>
                                <p class="mt-1">
                                    @if($selectedPengaduan->status_respon === 'telah_direspon')
                                        <span
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-md dark:bg-green-900/30 dark:text-green-400">Telah
                                            Direspon</span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-orange-700 bg-orange-100 rounded-md dark:bg-orange-900/30 dark:text-orange-400">Dalam
                                            Proses</span>
                                    @endif
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal</label>
                                <p class="mt-1 text-gray-900 dark:text-white">
                                    {{ $selectedPengaduan->created_at->format('d M Y H:i') }}
                                </p>
                            </div>
                        </div>

                        @if($selectedPengaduan->balasan)
                            <div class="p-4 border-l-4 border-sky-500 bg-sky-50 dark:bg-sky-900/20 dark:border-sky-400">
                                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Balasan</label>
                                <p class="text-gray-900 dark:text-white whitespace-pre-wrap">
                                    {{ Str::of($selectedPengaduan->balasan)->toHtmlString() }}</p>
                            </div>
                        @endif

                        @if($selectedPengaduan->bukti_terusan_path)
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Bukti
                                    Terusan</label>
                                <a href="{{ Storage::url($selectedPengaduan->bukti_terusan_path) }}" target="_blank"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg bg-sky-600 hover:bg-sky-700">
                                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Unduh Bukti Terusan
                                </a>
                            </div>
                        @endif

                        @if($selectedPengaduan->bukti_balasan_path)
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Bukti
                                    Balasan</label>
                                <a href="{{ Storage::url($selectedPengaduan->bukti_balasan_path) }}" target="_blank"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg bg-sky-600 hover:bg-sky-700">
                                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Unduh Bukti Balasan
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="flex justify-end p-6 border-t border-gray-200 dark:border-gray-800">
                        <button @click="$wire.closeModal()"
                            class="px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg bg-sky-600 hover:bg-sky-700">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>