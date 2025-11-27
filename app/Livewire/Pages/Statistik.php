<?php

namespace App\Livewire\Pages;

use App\Models\Pengaduan;
use App\Models\JenisPengaduan;
use App\Models\KategoriPengaduan;
use App\Models\Opd;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Statistik extends Component
{
    public $filterJenis = '';
    public $filterKategori = '';
    public $filterOpd = '';
    public $filterStatus = '';
    public $filterVerified = '';
    public $dateFrom = '';
    public $dateTo = '';

    #[Layout('components.layouts.app')]
    #[Title('Statistik - Lapak Aduan')]

    public function mount()
    {
        $this->dateFrom = now()->subMonths(6)->format('Y-m-d');
        $this->dateTo = now()->format('Y-m-d');
    }

    public function render()
    {
        $query = Pengaduan::query();

        // Apply filters
        if ($this->filterJenis) {
            $query->where('jenis_pengaduan_id', $this->filterJenis);
        }
        if ($this->filterKategori) {
            $query->where('kategori_pengaduan_id', $this->filterKategori);
        }
        if ($this->filterOpd) {
            $query->where('opd_id', $this->filterOpd);
        }
        if ($this->filterStatus) {
            $query->where('status_respon', $this->filterStatus);
        }
        if ($this->filterVerified !== '') {
            $query->where('is_verified', $this->filterVerified);
        }
        if ($this->dateFrom) {
            $query->whereDate('created_at', '>=', $this->dateFrom);
        }
        if ($this->dateTo) {
            $query->whereDate('created_at', '<=', $this->dateTo);
        }

        // Overall stats
        $totalPengaduan = (clone $query)->count();
        $pengaduanDirespon = (clone $query)->where('status_respon', 'telah_direspon')->count();
        $pengaduanDiproses = (clone $query)->where('status_respon', 'dalam_proses')->count();
        $pengaduanVerified = (clone $query)->where('is_verified', true)->count();
        $pengaduanUnverified = (clone $query)->where('is_verified', false)->count();
        $responseRate = $totalPengaduan > 0 ? round(($pengaduanDirespon / $totalPengaduan) * 100, 1) : 0;
        $verificationRate = $totalPengaduan > 0 ? round(($pengaduanVerified / $totalPengaduan) * 100, 1) : 0;

        // By Jenis
        $byJenis = (clone $query)->select('jenis_pengaduan_id', DB::raw('count(*) as total'))
            ->groupBy('jenis_pengaduan_id')
            ->with('jenisPengaduan')
            ->get()
            ->map(function($item) {
                return [
                    'nama' => $item->jenisPengaduan->nama,
                    'total' => $item->total
                ];
            });

        // By Kategori
        $byKategori = (clone $query)->select('kategori_pengaduan_id', DB::raw('count(*) as total'))
            ->groupBy('kategori_pengaduan_id')
            ->with('kategoriPengaduan')
            ->get()
            ->map(function($item) {
                return [
                    'nama' => $item->kategoriPengaduan->nama,
                    'total' => $item->total
                ];
            });

        // By OPD
        $byOpd = (clone $query)->select('opd_id', DB::raw('count(*) as total'))
            ->groupBy('opd_id')
            ->with('opd')
            ->orderByDesc('total')
            ->take(10)
            ->get()
            ->map(function($item) {
                return [
                    'nama' => $item->opd->nama,
                    'total' => $item->total
                ];
            });

        // Monthly trend
        $monthlyTrend = (clone $query)->select(
                DB::raw('strftime("%Y-%m", created_at) as month'),
                DB::raw('count(*) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Response comparison for chart
        $responseComparison = [
            ['status' => 'Direspon', 'total' => $pengaduanDirespon],
            ['status' => 'Dalam Proses', 'total' => $pengaduanDiproses]
        ];

        // Verification comparison
        $verificationComparison = [
            ['status' => 'Terverifikasi', 'total' => $pengaduanVerified],
            ['status' => 'Belum Terverifikasi', 'total' => $pengaduanUnverified]
        ];

        // Get filter options
        $jenisOptions = JenisPengaduan::all();
        $kategoriOptions = KategoriPengaduan::all();
        $opdOptions = Opd::all();

        return view('livewire.pages.statistik', [
            'totalPengaduan' => $totalPengaduan,
            'pengaduanDirespon' => $pengaduanDirespon,
            'pengaduanDiproses' => $pengaduanDiproses,
            'pengaduanVerified' => $pengaduanVerified,
            'pengaduanUnverified' => $pengaduanUnverified,
            'responseRate' => $responseRate,
            'verificationRate' => $verificationRate,
            'byJenis' => $byJenis,
            'byKategori' => $byKategori,
            'byOpd' => $byOpd,
            'monthlyTrend' => $monthlyTrend,
            'responseComparison' => $responseComparison,
            'verificationComparison' => $verificationComparison,
            'jenisOptions' => $jenisOptions,
            'kategoriOptions' => $kategoriOptions,
            'opdOptions' => $opdOptions,
        ]);
    }
}
