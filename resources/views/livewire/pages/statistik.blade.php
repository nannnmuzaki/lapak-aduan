<div>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Statistik</h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">Data dan analisis pengaduan masyarakat</p>
    </div>

    {{-- Filters --}}
    <div class="p-6 mb-6 bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Filter Data</h3>
        <div class="grid gap-4 md:grid-cols-3 lg:grid-cols-6">
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Jenis</label>
                <select wire:model.live="filterJenis"
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                    <option value="">Semua Jenis</option>
                    @foreach($jenisOptions as $jenis)
                        <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                <select wire:model.live="filterKategori"
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoriOptions as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">OPD</label>
                <select wire:model.live="filterOpd"
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                    <option value="">Semua OPD</option>
                    @foreach($opdOptions as $opd)
                        <option value="{{ $opd->id }}">{{ $opd->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Status Respon</label>
                <select wire:model.live="filterStatus"
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                    <option value="">Semua Status</option>
                    <option value="telah_direspon">Telah Direspon</option>
                    <option value="dalam_proses">Dalam Proses</option>
                </select>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Dari Tanggal</label>
                <input wire:model.live="dateFrom" type="date"
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Sampai Tanggal</label>
                <input wire:model.live="dateTo" type="date"
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            </div>
        </div>
    </div>

    {{-- Overview Stats --}}
    <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
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
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total</p>
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
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Direspon</p>
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
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Proses</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($pengaduanDiproses) }}
                    </p>
                </div>
            </div>
        </div>

        <div class="p-6 bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 rounded-lg bg-blue-100 dark:bg-blue-900/30">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Verified</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($pengaduanVerified) }}
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
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Response Rate</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $responseRate }}%</p>
                </div>
            </div>
        </div>

        <div class="p-6 bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 rounded-lg bg-indigo-100 dark:bg-indigo-900/30">
                    <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Verification Rate</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $verificationRate }}%</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Comparison Charts --}}
    <div class="grid gap-6 mb-8 lg:grid-cols-2">
        {{-- Response Comparison --}}
        <div class="p-6 bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
            <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Perbandingan Status Respon</h3>
            <div class="space-y-4">
                @foreach($responseComparison as $item)
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $item['status'] }}</span>
                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $item['total'] }}
                                ({{ $totalPengaduan > 0 ? round(($item['total'] / $totalPengaduan) * 100, 1) : 0 }}%)</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700">
                            <div class="h-4 rounded-full {{ $item['status'] == 'Direspon' ? 'bg-green-600 dark:bg-green-500' : 'bg-orange-600 dark:bg-orange-500' }}"
                                style="width: {{ $totalPengaduan > 0 ? ($item['total'] / $totalPengaduan * 100) : 0 }}%">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Verification Comparison --}}
        <div class="p-6 bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
            <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Perbandingan Status Verifikasi</h3>
            <div class="space-y-4">
                @foreach($verificationComparison as $item)
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $item['status'] }}</span>
                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $item['total'] }}
                                ({{ $totalPengaduan > 0 ? round(($item['total'] / $totalPengaduan) * 100, 1) : 0 }}%)</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700">
                            <div class="h-4 rounded-full {{ $item['status'] == 'Terverifikasi' ? 'bg-blue-600 dark:bg-blue-500' : 'bg-red-600 dark:bg-red-500' }}"
                                style="width: {{ $totalPengaduan > 0 ? ($item['total'] / $totalPengaduan * 100) : 0 }}%">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Charts Grid --}}
    <div class="grid gap-6 mb-8 lg:grid-cols-2">
        {{-- By Jenis --}}
        <div class="p-6 bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
            <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Berdasarkan Jenis</h3>
            <div class="space-y-3">
                @forelse($byJenis as $item)
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $item['nama'] }}</span>
                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $item['total'] }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 dark:bg-gray-700">
                            <div class="h-2 rounded-full bg-sky-600 dark:bg-sky-500"
                                style="width: {{ $totalPengaduan > 0 ? ($item['total'] / $totalPengaduan * 100) : 0 }}%">
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada data</p>
                @endforelse
            </div>
        </div>

        {{-- By Kategori --}}
        <div class="p-6 bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
            <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Berdasarkan Kategori</h3>
            <div class="space-y-3">
                @forelse($byKategori->take(8) as $item)
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $item['nama'] }}</span>
                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $item['total'] }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 dark:bg-gray-700">
                            <div class="h-2 rounded-full bg-green-600 dark:bg-green-500"
                                style="width: {{ $totalPengaduan > 0 ? ($item['total'] / $totalPengaduan * 100) : 0 }}%">
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada data</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Top OPD --}}
    <div class="p-6 mb-8 bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Top 10 OPD dengan Pengaduan Terbanyak</h3>
        <div class="space-y-3">
            @forelse($byOpd as $item)
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $item['nama'] }}</span>
                        <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $item['total'] }} pengaduan</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3 dark:bg-gray-700">
                        <div class="h-3 rounded-full bg-purple-600 dark:bg-purple-500"
                            style="width: {{ $totalPengaduan > 0 ? ($item['total'] / $totalPengaduan * 100) : 0 }}%"></div>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada data</p>
            @endforelse
        </div>
    </div>

    {{-- Monthly Trend --}}
    <div class="p-6 bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Tren Bulanan</h3>
        <div class="space-y-3">
            @forelse($monthlyTrend as $item)
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <span
                            class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ \Carbon\Carbon::parse($item->month . '-01')->format('F Y') }}</span>
                        <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $item->total }} pengaduan</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 dark:bg-gray-700">
                        <div class="h-2 rounded-full bg-orange-600 dark:bg-orange-500"
                            style="width: {{ $monthlyTrend->max('total') > 0 ? ($item->total / $monthlyTrend->max('total') * 100) : 0 }}%">
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada data</p>
            @endforelse
        </div>
    </div>
</div>