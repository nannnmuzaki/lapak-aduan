<?php

namespace Database\Seeders;

use App\Models\Pengaduan;
use App\Models\User;
use App\Models\JenisPengaduan;
use App\Models\KategoriPengaduan;
use App\Models\ChannelPengaduan;
use App\Models\Opd;
use Illuminate\Database\Seeder;

class PengaduanSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::role('user')->get();
        $jenisKeluhan = JenisPengaduan::where('nama', 'Keluhan')->first();
        $jenisUsulan = JenisPengaduan::where('nama', 'Usulan')->first();
        $jenisPertanyaan = JenisPengaduan::where('nama', 'Pertanyaan')->first();
        
        $kategoriInfrastruktur = KategoriPengaduan::where('nama', 'Infrastruktur')->first();
        $kategoriKesehatan = KategoriPengaduan::where('nama', 'Kesehatan')->first();
        $kategoriLingkungan = KategoriPengaduan::where('nama', 'Lingkungan')->first();
        $kategoriTransportasi = KategoriPengaduan::where('nama', 'Transportasi')->first();
        $kategoriKependudukan = KategoriPengaduan::where('nama', 'Kependudukan')->first();
        
        $channelWebsite = ChannelPengaduan::where('nama', 'Website Lapak Aduan')->first();
        $channelFB = ChannelPengaduan::where('nama', 'Facebook')->first();
        $channelWA = ChannelPengaduan::where('nama', 'WhatsApp')->first();
        
        $opdDPUPR = Opd::where('kode', 'DPUPR')->first();
        $opdDinkes = Opd::where('kode', 'DINKES')->first();
        $opdDLH = Opd::where('kode', 'DLH')->first();
        $opdDishub = Opd::where('kode', 'DISHUB')->first();
        $opdDisdukcapil = Opd::where('kode', 'DISDUKCAPIL')->first();

        $pengaduanData = [
            [
                'days_ago' => 10,
                'user' => $users->random(),
                'jenis' => $jenisKeluhan,
                'kategori' => $kategoriInfrastruktur,
                'channel' => $channelWebsite,
                'opd' => $opdDPUPR,
                'judul' => 'Jalan Berlubang di Jl. Raya Kemang',
                'nama_pengadu' => 'Ahmad Wijaya',
                'email_pengadu' => 'ahmad.wijaya@gmail.com',
                'telepon_pengadu' => '081234567890',
                'isi' => '<p>Dengan hormat, saya ingin melaporkan kondisi jalan yang sangat memprihatinkan di Jl. Raya Kemang tepatnya di depan SD Negeri 5. Terdapat beberapa lubang besar dengan diameter sekitar 1 meter yang sangat membahayakan pengendara, terutama pada malam hari.</p><p>Kondisi ini sudah berlangsung selama 2 minggu dan semakin parah ketika hujan. Sudah ada beberapa kecelakaan kecil karena lubang ini. Mohon dapat segera diperbaiki untuk keselamatan warga.</p>',
                'status_respon' => 'telah_direspon',
                'status_tindak_lanjut' => 'sudah_ditindak_lanjuti',
                'is_verified' => true,
                'is_pengaduan_public' => true,
                'perlu_tindak_lanjut' => true,
                'balasan' => 'Terima kasih atas laporannya. Tim kami sudah melakukan pengecekan dan perbaikan jalan akan dilaksanakan minggu depan. Estimasi perbaikan 3-5 hari kerja.',
            ],
            [
                'days_ago' => 7,
                'user' => $users->random(),
                'jenis' => $jenisKeluhan,
                'kategori' => $kategoriKesehatan,
                'channel' => $channelFB,
                'opd' => $opdDinkes,
                'judul' => 'Antrian Panjang di Puskesmas Kelapa Dua',
                'nama_pengadu' => 'Dewi Lestari',
                'email_pengadu' => 'dewi.lestari@gmail.com',
                'telepon_pengadu' => '082345678901',
                'isi' => '<p>Saya ingin menyampaikan keluhan mengenai sistem antrian di Puskesmas Kelapa Dua yang sangat tidak efisien. Pasien harus datang sejak pagi jam 6 untuk mendapat nomor antrian, namun pelayanan baru dimulai jam 8.</p><p>Banyak pasien lansia yang harus menunggu berjam-jam dalam kondisi tidak nyaman. Mohon dapat diperbaiki sistem antriannya, mungkin bisa menggunakan sistem online atau nomor WhatsApp.</p>',
                'status_respon' => 'dalam_proses',
                'status_tindak_lanjut' => 'belum_ditindak_lanjuti',
                'is_verified' => true,
                'is_pengaduan_public' => true,
                'perlu_tindak_lanjut' => true,
            ],
            [
                'days_ago' => 5,
                'user' => $users->random(),
                'jenis' => $jenisKeluhan,
                'kategori' => $kategoriLingkungan,
                'channel' => $channelWA,
                'opd' => $opdDLH,
                'judul' => 'Sampah Menumpuk di TPS Jl. Mangga Besar',
                'nama_pengadu' => 'Rudi Hartono',
                'email_pengadu' => 'rudi.hartono@yahoo.com',
                'telepon_pengadu' => '083456789012',
                'isi' => '<p>Bapak/Ibu yang terhormat, saya melaporkan kondisi TPS (Tempat Pembuangan Sementara) di Jl. Mangga Besar yang sudah penuh dan sampahnya menumpuk hingga ke jalan.</p><p>Bau tidak sedap sangat mengganggu warga sekitar dan sudah banyak lalat. Sepertinya sudah beberapa hari tidak diangkut. Mohon segera ditindaklanjuti karena sangat mengganggu kesehatan lingkungan.</p>',
                'status_respon' => 'telah_direspon',
                'status_tindak_lanjut' => 'sudah_ditindak_lanjuti',
                'is_verified' => true,
                'is_pengaduan_public' => true,
                'perlu_tindak_lanjut' => true,
                'balasan' => 'Terima kasih informasinya. Petugas kami sudah melakukan pengangkutan sampah dan pembersihan area TPS. Kami akan meningkatkan frekuensi pengangkutan di lokasi tersebut.',
            ],
            [
                'days_ago' => 3,
                'user' => $users->random(),
                'jenis' => $jenisUsulan,
                'kategori' => $kategoriTransportasi,
                'channel' => $channelWebsite,
                'opd' => $opdDishub,
                'judul' => 'Usulan Penambahan Rambu Lalu Lintas di Perempatan Sudirman',
                'nama_pengadu' => 'Sri Rahayu',
                'email_pengadu' => 'sri.rahayu@gmail.com',
                'telepon_pengadu' => '084567890123',
                'isi' => '<p>Saya ingin mengusulkan penambahan rambu lalu lintas atau traffic light di perempatan Jl. Sudirman - Jl. Gatot Subroto.</p><p>Perempatan ini sangat ramai dan sering terjadi kemacetan, bahkan hampir kecelakaan karena tidak ada pengaturan lalu lintas yang jelas. Dengan adanya traffic light, diharapkan arus lalu lintas bisa lebih tertib dan aman.</p>',
                'status_respon' => 'dalam_proses',
                'status_tindak_lanjut' => 'belum_ditindak_lanjuti',
                'is_verified' => true,
                'is_pengaduan_public' => true,
                'perlu_tindak_lanjut' => true,
            ],
            [
                'days_ago' => 1,
                'user' => $users->random(),
                'jenis' => $jenisPertanyaan,
                'kategori' => $kategoriKependudukan,
                'channel' => $channelWebsite,
                'opd' => $opdDisdukcapil,
                'judul' => 'Pertanyaan Mengenai Perpanjangan KTP',
                'nama_pengadu' => 'Agus Setiawan',
                'email_pengadu' => 'agus.setiawan@gmail.com',
                'telepon_pengadu' => '085678901234',
                'isi' => '<p>Selamat siang, saya ingin bertanya mengenai prosedur perpanjangan KTP yang sudah habis masa berlakunya.</p><p>Dokumen apa saja yang perlu disiapkan? Apakah bisa dilakukan secara online atau harus datang langsung? Berapa lama proses pengurusannya? Terima kasih.</p>',
                'status_respon' => 'telah_direspon',
                'is_verified' => false,
                'is_pengaduan_public' => true,
                'perlu_tindak_lanjut' => false,
            ],
        ];
        
        // data balasan = null, is_verified = false, status_respon = dalam_proses, created_at = menggunakan days_ago untuk testing
        foreach ($pengaduanData as $data) {
            Pengaduan::create([
                'user_id' => $data['user']->id,
                'jenis_pengaduan_id' => $data['jenis']->id,
                'kategori_pengaduan_id' => $data['kategori']->id,
                'channel_pengaduan_id' => $data['channel']->id,
                'opd_id' => $data['opd']->id,
                'judul' => $data['judul'],
                'nama_pengadu' => $data['nama_pengadu'],
                'email_pengadu' => $data['email_pengadu'],
                'telepon_pengadu' => $data['telepon_pengadu'],
                'nomor_pengaduan' => Pengaduan::generateNomorPengaduan($data['channel']->id),
                'isi' => $data['isi'],
                'status_respon' => $data['status_respon'],
                'status_tindak_lanjut' => $data['status_tindak_lanjut'] ?? null,
                'is_verified' => $data['is_verified'],
                'is_pengaduan_public' => $data['is_pengaduan_public'],
                'perlu_tindak_lanjut' => $data['perlu_tindak_lanjut'],
                'balasan' => $data['balasan'] ?? null,
                'created_at' => now()->subDays($data['days_ago']),
            ]);
        }
    }
}
