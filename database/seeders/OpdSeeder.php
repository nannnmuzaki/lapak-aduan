<?php

namespace Database\Seeders;

use App\Models\Opd;
use Illuminate\Database\Seeder;

class OpdSeeder extends Seeder
{
    public function run(): void
    {
        $opdData = [
            [
                'nama' => 'Dinas Kesehatan',
                'kode' => 'DINKES',
                'deskripsi' => 'Dinas Kesehatan Kota bertanggung jawab atas kesehatan masyarakat',
                'alamat' => 'Jl. Pemuda No. 15',
                'telepon' => '021-1234567',
                'email' => 'dinkes@pemkot.go.id',
            ],
            [
                'nama' => 'Dinas Pekerjaan Umum dan Penataan Ruang',
                'kode' => 'DPUPR',
                'deskripsi' => 'Menangani infrastruktur jalan, jembatan, dan tata ruang kota',
                'alamat' => 'Jl. Gatot Subroto No. 88',
                'telepon' => '021-2345678',
                'email' => 'dpupr@pemkot.go.id',
            ],
            [
                'nama' => 'Dinas Pendidikan',
                'kode' => 'DISDIK',
                'deskripsi' => 'Bertanggung jawab atas pendidikan dasar dan menengah',
                'alamat' => 'Jl. Sudirman No. 45',
                'telepon' => '021-3456789',
                'email' => 'disdik@pemkot.go.id',
            ],
            [
                'nama' => 'Dinas Lingkungan Hidup',
                'kode' => 'DLH',
                'deskripsi' => 'Menangani kebersihan, persampahan, dan lingkungan hidup',
                'alamat' => 'Jl. Diponegoro No. 22',
                'telepon' => '021-4567890',
                'email' => 'dlh@pemkot.go.id',
            ],
            [
                'nama' => 'Dinas Perhubungan',
                'kode' => 'DISHUB',
                'deskripsi' => 'Mengelola transportasi dan lalu lintas kota',
                'alamat' => 'Jl. Ahmad Yani No. 100',
                'telepon' => '021-5678901',
                'email' => 'dishub@pemkot.go.id',
            ],
            [
                'nama' => 'Dinas Kependudukan dan Pencatatan Sipil',
                'kode' => 'DISDUKCAPIL',
                'deskripsi' => 'Menangani administrasi kependudukan dan dokumen sipil',
                'alamat' => 'Jl. Thamrin No. 55',
                'telepon' => '021-6789012',
                'email' => 'disdukcapil@pemkot.go.id',
            ],
            [
                'nama' => 'Dinas Sosial',
                'kode' => 'DINSOS',
                'deskripsi' => 'Menangani kesejahteraan sosial dan bantuan masyarakat',
                'alamat' => 'Jl. Kartini No. 33',
                'telepon' => '021-7890123',
                'email' => 'dinsos@pemkot.go.id',
            ],
            [
                'nama' => 'Dinas Perdagangan dan Perindustrian',
                'kode' => 'DISPERIN',
                'deskripsi' => 'Mengatur perdagangan, pasar, dan industri lokal',
                'alamat' => 'Jl. Veteran No. 77',
                'telepon' => '021-8901234',
                'email' => 'disperin@pemkot.go.id',
            ],
            [
                'nama' => 'Satuan Polisi Pamong Praja',
                'kode' => 'SATPOL-PP',
                'deskripsi' => 'Menegakkan peraturan daerah dan ketertiban umum',
                'alamat' => 'Jl. Merdeka No. 11',
                'telepon' => '021-9012345',
                'email' => 'satpolpp@pemkot.go.id',
            ],
            [
                'nama' => 'Badan Penanggulangan Bencana Daerah',
                'kode' => 'BPBD',
                'deskripsi' => 'Menangani bencana dan kedaruratan daerah',
                'alamat' => 'Jl. Pahlawan No. 66',
                'telepon' => '021-0123456',
                'email' => 'bpbd@pemkot.go.id',
            ],
        ];

        foreach ($opdData as $opd) {
            Opd::create($opd);
        }
    }
}
