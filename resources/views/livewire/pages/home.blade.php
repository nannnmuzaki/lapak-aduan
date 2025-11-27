<div>
    {{-- Hero Section --}}
    <div
        class="relative overflow-hidden bg-gradient-to-br from-sky-50 to-white dark:from-gray-900 dark:to-gray-950 rounded-2xl mb-8">
        <div class="px-8 py-16 sm:px-12 sm:py-20">
            <div class="max-w-3xl">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl dark:text-white">
                    Lapak Aduan
                    <span class="text-sky-600 dark:text-sky-400">Kabupaten Banyumas</span>
                </h1>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">
                    Platform pengaduan masyarakat untuk menyampaikan keluhan, usulan, dan pertanyaan seputar pelayanan
                    publik di Kabupaten Banyumas.
                </p>
                <div class="flex flex-wrap gap-4 mt-8">
                    <a wire:navigate href="{{ route('page.buat-pengaduan') }}"
                        class="inline-flex items-center px-6 py-3 text-base font-medium text-white transition-colors rounded-lg bg-sky-600 hover:bg-sky-700">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Buat Pengaduan
                    </a>
                    <a wire:navigate href="{{ route('page.daftar-pengaduan') }}"
                        class="inline-flex items-center px-6 py-3 text-base font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700 dark:hover:bg-gray-700">
                        Lihat Pengaduan
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">
        <div class="p-6 bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 rounded-lg bg-sky-100 dark:bg-sky-900/30">
                    <svg class="w-6 h-6 text-sky-600 dark:text-sky-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Pengaduan</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($totalPengaduan) }}</p>
                </div>
            </div>
        </div>

        <div class="p-6 bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 rounded-lg bg-green-100 dark:bg-green-900/30">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Telah Direspon</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($pengaduanDirespon) }}
                    </p>
                </div>
            </div>
        </div>

        <div class="p-6 bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 rounded-lg bg-orange-100 dark:bg-orange-900/30">
                    <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Dalam Proses</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($pengaduanDiproses) }}
                    </p>
                </div>
            </div>
        </div>

        <div class="p-6 bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 rounded-lg bg-purple-100 dark:bg-purple-900/30">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total OPD</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($totalOpd) }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Features --}}
    <div class="grid gap-6 mb-8 md:grid-cols-3">
        <div class="p-6 bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
            <div class="flex items-center justify-center w-12 h-12 mb-4 rounded-lg bg-sky-100 dark:bg-sky-900/30">
                <svg class="w-6 h-6 text-sky-600 dark:text-sky-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Cepat & Mudah</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">Sampaikan pengaduan Anda dengan mudah melalui formulir
                online yang simple.</p>
        </div>

        <div class="p-6 bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
            <div class="flex items-center justify-center w-12 h-12 mb-4 rounded-lg bg-sky-100 dark:bg-sky-900/30">
                <svg class="w-6 h-6 text-sky-600 dark:text-sky-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </div>
            <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Transparansi</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">Pantau status pengaduan Anda secara real-time dan lihat
                respon dari OPD terkait.</p>
        </div>

        <div class="p-6 bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
            <div class="flex items-center justify-center w-12 h-12 mb-4 rounded-lg bg-sky-100 dark:bg-sky-900/30">
                <svg class="w-6 h-6 text-sky-600 dark:text-sky-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
            <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Terpercaya</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">Sistem terintegrasi langsung dengan OPD untuk penanganan
                yang cepat dan tepat.</p>
        </div>
    </div>

    {{-- Recent Pengaduan --}}
    @if($recentPengaduan->count() > 0)
        <div class="p-6 bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Pengaduan Terbaru</h2>
                <a wire:navigate href="{{ route('page.daftar-pengaduan') }}"
                    class="text-sm font-medium text-sky-600 hover:text-sky-700 dark:text-sky-400">
                    Lihat Semua →
                </a>
            </div>
            <div class="space-y-4">
                @foreach($recentPengaduan as $pengaduan)
                    <div
                        class="flex items-start p-4 transition-colors border border-gray-200 rounded-lg hover:bg-gray-50 dark:border-gray-800 dark:hover:bg-gray-800/50">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $pengaduan->judul }}</p>
                            <div class="flex flex-wrap items-center gap-2 mt-1">
                                <span
                                    class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-md bg-sky-100 text-sky-700 dark:bg-sky-900/30 dark:text-sky-400">
                                    {{ $pengaduan->jenisPengaduan->nama }}
                                </span>
                                <span
                                    class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-md dark:bg-gray-800 dark:text-gray-300">
                                    {{ $pengaduan->kategoriPengaduan->nama }}
                                </span>
                                <span
                                    class="text-xs text-gray-500 dark:text-gray-500">{{ $pengaduan->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="ml-4">
                            @if($pengaduan->status_respon === 'telah_direspon')
                                <span
                                    class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-md dark:bg-green-900/30 dark:text-green-400">
                                    Direspon
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-2 py-1 text-xs font-medium text-orange-700 bg-orange-100 rounded-md dark:bg-orange-900/30 dark:text-orange-400">
                                    Proses
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>