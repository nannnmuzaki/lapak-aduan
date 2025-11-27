<div>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Buat Pengaduan</h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">Sampaikan keluhan, usulan, atau pertanyaan Anda</p>
    </div>

    @if(session()->has('success'))
        <div
            class="p-4 mb-6 text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900/30 dark:text-green-400 dark:border-green-800">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit="submit" class="space-y-6">
        <div class="p-6 bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
            <h2 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Informasi Pengadu</h2>

            <div class="grid gap-6 md:grid-cols-3">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap
                        *</label>
                    <input wire:model="nama_pengadu" type="text"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                    @error('nama_pengadu') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input wire:model="email_pengadu" type="email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                    @error('email_pengadu') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">No. Telepon</label>
                    <input wire:model="telepon_pengadu" type="text"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                    @error('telepon_pengadu') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="p-6 bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
            <h2 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Detail Pengaduan</h2>

            <div class="space-y-6">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Judul Pengaduan
                        *</label>
                    <input wire:model="judul" type="text"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                    @error('judul') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="grid gap-6 md:grid-cols-3">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Pengaduan
                            *</label>
                        <select wire:model="jenis_pengaduan_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                            <option value="">Pilih Jenis</option>
                            @foreach($jenisOptions as $jenis)
                                <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                            @endforeach
                        </select>
                        @error('jenis_pengaduan_id') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Kategori
                            *</label>
                        <select wire:model="kategori_pengaduan_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoriOptions as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                        @error('kategori_pengaduan_id') <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">OPD Tujuan
                            *</label>
                        <select wire:model="opd_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                            <option value="">Pilih OPD</option>
                            @foreach($opdOptions as $opd)
                                <option value="{{ $opd->id }}">{{ $opd->nama }}</option>
                            @endforeach
                        </select>
                        @error('opd_id') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Isi Pengaduan
                        *</label>
                    <textarea wire:model="isi" rows="8"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white focus:ring-2 focus:ring-sky-500 focus:border-sky-500"
                        placeholder="Tuliskan detail pengaduan Anda..."></textarea>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Jelaskan pengaduan Anda dengan detail</p>
                    @error('isi') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Lampiran Foto
                        (Opsional)</label>
                    <input wire:model="images" type="file" multiple accept="image/*"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white focus:ring-2 focus:ring-sky-500">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Maksimal 5 foto (JPG, PNG, max 2MB per
                        file)</p>
                    @error('images.*') <span class="text-sm text-red-600">{{ $message }}</span> @enderror

                    @if($images)
                        <div class="grid grid-cols-5 gap-2 mt-3">
                            @foreach($images as $image)
                                <div class="relative">
                                    <img src="{{ $image->temporaryUrl() }}" class="object-cover w-full h-20 rounded-lg">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="p-6 bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
            <h2 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Pengaturan Privasi</h2>

            <div class="space-y-4">
                <label class="flex items-start gap-3">
                    <input wire:model="is_profile_anonymous" type="checkbox"
                        class="w-4 h-4 mt-1 border-gray-300 rounded text-sky-600 focus:ring-sky-500">
                    <div>
                        <div class="font-medium text-gray-900 dark:text-white">Sembunyikan Identitas Saya</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Pengaduan akan ditampilkan sebagai anonim
                        </div>
                    </div>
                </label>

                <label class="flex items-start gap-3">
                    <input wire:model="is_pengaduan_public" type="checkbox"
                        class="w-4 h-4 mt-1 border-gray-300 rounded text-sky-600 focus:ring-sky-500">
                    <div>
                        <div class="font-medium text-gray-900 dark:text-white">Publikasikan Pengaduan</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Pengaduan dapat dilihat oleh publik
                            setelah diverifikasi</div>
                    </div>
                </label>

                <label class="flex items-start gap-3">
                    <input wire:model="perlu_tindak_lanjut" type="checkbox"
                        class="w-4 h-4 mt-1 border-gray-300 rounded text-sky-600 focus:ring-sky-500">
                    <div>
                        <div class="font-medium text-gray-900 dark:text-white">Perlu Tindak Lanjut</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Pengaduan memerlukan tindak lanjut dari
                            OPD</div>
                    </div>
                </label>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="px-6 py-3 text-sm font-medium text-white transition-colors rounded-lg bg-sky-600 hover:bg-sky-700 focus:ring-4 focus:ring-sky-500/50">
                <span wire:loading.remove wire:target="submit">Kirim Pengaduan</span>
                <span wire:loading wire:target="submit">Mengirim...</span>
            </button>
        </div>
    </form>

</div>