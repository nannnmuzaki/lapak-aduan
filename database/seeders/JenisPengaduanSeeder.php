<?php

namespace Database\Seeders;

use App\Models\JenisPengaduan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisData = [
            [
                'nama' => 'Informasi',
                'deskripsi' => 'Permintaan informasi atau penjelasan mengenai kebijakan, program, atau layanan pemerintah daerah',
            ],
            [
                'nama' => 'Pertanyaan',
                'deskripsi' => 'Pertanyaan seputar prosedur, persyaratan, atau hal-hal terkait pelayanan publik',
            ],
            [
                'nama' => 'Keluhan',
                'deskripsi' => 'Keluhan atau laporan mengenai permasalahan yang terjadi di lingkungan masyarakat',
            ],
            [
                'nama' => 'Usulan',
                'deskripsi' => 'Usulan, saran, atau ide untuk perbaikan dan pengembangan daerah',
            ],
        ];

        foreach ($jenisData as $jenis) {
            JenisPengaduan::create($jenis);
        }
    }
}
