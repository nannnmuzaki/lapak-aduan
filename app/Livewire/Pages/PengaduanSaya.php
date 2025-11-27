<?php

namespace App\Livewire\Pages;

use App\Models\Pengaduan;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class PengaduanSaya extends Component
{
    use WithPagination;

    public $selectedPengaduan = null;
    public $showDetailModal = false;
    public $showDeleteModal = false;
    public $pengaduanToDelete = null;

    #[Layout('components.layouts.app')]
    #[Title('Pengaduan Saya - Lapak Aduan')]

    public function showDetail($pengaduanId)
    {
        $this->selectedPengaduan = Pengaduan::with(['jenisPengaduan', 'kategoriPengaduan', 'opd', 'channelPengaduan'])
            ->where('user_id', auth()->id())
            ->find($pengaduanId);
        $this->showDetailModal = true;
    }

    public function closeDetailModal()
    {
        $this->showDetailModal = false;
        $this->selectedPengaduan = null;
    }

    public function confirmDelete($pengaduanId)
    {
        $this->pengaduanToDelete = $pengaduanId;
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->pengaduanToDelete = null;
    }

    public function deletePengaduan()
    {
        $pengaduan = Pengaduan::where('user_id', auth()->id())
            ->find($this->pengaduanToDelete);
        
        if ($pengaduan) {
            $pengaduan->delete();
            session()->flash('success', 'Pengaduan berhasil dihapus');
        }

        $this->closeDeleteModal();
    }

    public function render()
    {
        $pengaduans = Pengaduan::where('user_id', auth()->id())
            ->with(['jenisPengaduan', 'kategoriPengaduan', 'opd'])
            ->latest()
            ->paginate(10);

        return view('livewire.pages.pengaduan-saya', [
            'pengaduans' => $pengaduans,
        ]);
    }
}
