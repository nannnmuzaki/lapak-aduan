<?php

namespace App\Livewire\Pages;

use App\Models\Pengaduan;
use App\Models\JenisPengaduan;
use App\Models\KategoriPengaduan;
use App\Models\Opd;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarPengaduan extends Component
{
    use WithPagination;

    public $search = '';
    public $filterJenis = '';
    public $filterKategori = '';
    public $filterOpd = '';
    public $filterStatus = '';
    
    public $selectedPengaduan = null;
    public $showModal = false;

    #[Layout('components.layouts.app')]
    #[Title('Daftar Pengaduan - Lapak Aduan')]

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterJenis()
    {
        $this->resetPage();
    }

    public function updatingFilterKategori()
    {
        $this->resetPage();
    }

    public function updatingFilterOpd()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function showDetail($pengaduanId)
    {
        $this->selectedPengaduan = Pengaduan::with(['jenisPengaduan', 'kategoriPengaduan', 'opd', 'channelPengaduan'])
            ->find($pengaduanId);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedPengaduan = null;
    }

    public function render()
    {
        $pengaduans = Pengaduan::where('is_pengaduan_public', true)
            ->where('is_verified', true)
            ->when($this->search, function($query) {
                return $query->where(function($q) {
                    $q->where('judul', 'like', '%' . $this->search . '%')
                      ->orWhere('nomor_pengaduan', 'like', '%' . $this->search . '%')
                      ->orWhere('isi', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterJenis, function($query) {
                return $query->where('jenis_pengaduan_id', $this->filterJenis);
            })
            ->when($this->filterKategori, function($query) {
                return $query->where('kategori_pengaduan_id', $this->filterKategori);
            })
            ->when($this->filterOpd, function($query) {
                return $query->where('opd_id', $this->filterOpd);
            })
            ->when($this->filterStatus, function($query) {
                return $query->where('status_respon', $this->filterStatus);
            })
            ->with(['jenisPengaduan', 'kategoriPengaduan', 'opd'])
            ->latest()
            ->paginate(12);

        $jenisOptions = JenisPengaduan::all();
        $kategoriOptions = KategoriPengaduan::all();
        $opdOptions = Opd::all();

        return view('livewire.pages.daftar-pengaduan', [
            'pengaduans' => $pengaduans,
            'jenisOptions' => $jenisOptions,
            'kategoriOptions' => $kategoriOptions,
            'opdOptions' => $opdOptions,
        ]);
    }
}
