<div>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Daftar OPD</h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">Organisasi Perangkat Daerah Kabupaten Banyumas</p>
    </div>

    {{-- Search --}}
    <div class="mb-6">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari OPD..."
            class="w-full px-4 py-3 text-gray-900 bg-white border border-gray-300 rounded-lg dark:bg-gray-900 dark:text-white dark:border-gray-700 focus:ring-2 focus:ring-sky-500 focus:border-transparent">
    </div>

    {{-- OPD Table --}}
    <div class="overflow-hidden bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                            Kode</th>
                        <th
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                            Nama OPD</th>
                        <th
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                            Kontak</th>
                        <th
                            class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase dark:text-gray-400">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-800">
                    @forelse($opds as $opd)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $opd->kode }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $opd->nama }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                <div>{{ $opd->telepon }}</div>
                                <div class="text-xs">{{ $opd->email }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-right whitespace-nowrap">
                                <button wire:click="showDetail({{ $opd->id }})"
                                    class="font-medium text-sky-600 hover:text-sky-700 dark:text-sky-400">
                                    Lihat Detail
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                Tidak ada data OPD
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-800">
            {{ $opds->links() }}
        </div>
    </div>

    {{-- Modal Detail --}}
    @if($showModal && $selectedOpd)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data="{ show: @entangle('showModal') }">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div class="fixed inset-0 transition-opacity bg-gray-500 dark:bg-gray-900 bg-opacity-75 dark:bg-opacity-75"
                    @click="$wire.closeModal()"></div>

                <div class="relative w-full max-w-2xl p-6 mx-auto bg-white rounded-xl dark:bg-gray-900 shadow-xl">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Detail OPD</h3>
                        <button @click="$wire.closeModal()"
                            class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kode</label>
                            <p class="mt-1 text-gray-900 dark:text-white">{{ $selectedOpd->kode }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama OPD</label>
                            <p class="mt-1 text-gray-900 dark:text-white">{{ $selectedOpd->nama }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                            <p class="mt-1 text-gray-900 dark:text-white">{{ $selectedOpd->deskripsi }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                            <p class="mt-1 text-gray-900 dark:text-white">{{ $selectedOpd->alamat }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Telepon</label>
                                <p class="mt-1 text-gray-900 dark:text-white">{{ $selectedOpd->telepon }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                <p class="mt-1 text-gray-900 dark:text-white">{{ $selectedOpd->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
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