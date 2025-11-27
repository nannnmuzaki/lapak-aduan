<?php

namespace Database\Seeders;

use App\Models\KategoriPengaduan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriPengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriData = [
            [
                'nama' => 'Kesehatan',
                'deskripsi' => 'Pengaduan terkait pelayanan kesehatan, puskesmas, rumah sakit, dan fasilitas kesehatan lainnya',
            ],
            [
                'nama' => 'Infrastruktur',
                'deskripsi' => 'Pengaduan mengenai jalan, jembatan, drainase, dan infrastruktur publik lainnya',
            ],
            [
                'nama' => 'Energi',
                'deskripsi' => 'Pengaduan terkait listrik, penerangan jalan, dan sumber energi',
            ],
            [
                'nama' => 'Pendidikan',
                'deskripsi' => 'Pengaduan seputar pendidikan, sekolah, dan fasilitas pendidikan',
            ],
            [
                'nama' => 'Lingkungan',
                'deskripsi' => 'Pengaduan terkait kebersihan, sampah, polusi, dan lingkungan hidup',
            ],
            [
                'nama' => 'Transportasi',
                'deskripsi' => 'Pengaduan mengenai transportasi umum, terminal, dan mobilitas',
            ],
            [
                'nama' => 'Kependudukan',
                'deskripsi' => 'Pengaduan terkait administrasi kependudukan, KTP, KK, dan dokumen kependudukan',
            ],
            [
                'nama' => 'Sosial',
                'deskripsi' => 'Pengaduan mengenai bantuan sosial, kesejahteraan masyarakat, dan isu sosial',
            ],
            [
                'nama' => 'Ekonomi',
                'deskripsi' => 'Pengaduan terkait UMKM, pasar, perdagangan, dan ekonomi daerah',
            ],
            [
                'nama' => 'Keamanan & Ketertiban',
                'deskripsi' => 'Pengaduan mengenai keamanan, ketertiban, dan penegakan perda',
            ],
            [
                'nama' => 'Lainnya',
                'deskripsi' => 'Pengaduan lain yang tidak termasuk dalam kategori yang ada',
            ],
        ];

        foreach ($kategoriData as $kategori) {
            KategoriPengaduan::create($kategori);
        }
    }
}
