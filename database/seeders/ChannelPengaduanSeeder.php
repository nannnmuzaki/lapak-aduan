<?php

namespace Database\Seeders;

use App\Models\ChannelPengaduan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChannelPengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $channelData = [
            [
                'nama' => 'Website Lapak Aduan',
                'deskripsi' => 'Pengaduan yang masuk melalui website resmi Lapak Aduan',
            ],
            [
                'nama' => 'Facebook',
                'deskripsi' => 'Pengaduan yang masuk melalui halaman Facebook resmi',
            ],
            [
                'nama' => 'Instagram',
                'deskripsi' => 'Pengaduan yang masuk melalui Instagram resmi',
            ],
            [
                'nama' => 'Twitter/X',
                'deskripsi' => 'Pengaduan yang masuk melalui Twitter/X resmi',
            ],
            [
                'nama' => 'WhatsApp',
                'deskripsi' => 'Pengaduan yang masuk melalui WhatsApp resmi',
            ],
            [
                'nama' => 'Email',
                'deskripsi' => 'Pengaduan yang masuk melalui email resmi',
            ],
            [
                'nama' => 'Telepon',
                'deskripsi' => 'Pengaduan yang masuk melalui telepon/call center',
            ],
            [
                'nama' => 'Langsung (Walk-in)',
                'deskripsi' => 'Pengaduan yang disampaikan langsung ke kantor',
            ],
            [
                'nama' => 'Surat',
                'deskripsi' => 'Pengaduan yang masuk melalui surat tertulis',
            ],
        ];

        foreach ($channelData as $channel) {
            ChannelPengaduan::create($channel);
        }
    }
}
