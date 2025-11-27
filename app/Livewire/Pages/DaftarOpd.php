<?php

namespace App\Livewire\Pages;

use App\Models\Opd;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarOpd extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedOpd = null;
    public $showModal = false;

    #[Layout('components.layouts.app')]
    #[Title('Daftar OPD - Lapak Aduan')]
    
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function showDetail($opdId)
    {
        $this->selectedOpd = Opd::find($opdId);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedOpd = null;
    }

    public function render()
    {
        $opds = Opd::when($this->search, function($query) {
                return $query->where('nama', 'like', '%' . $this->search . '%')
                            ->orWhere('kode', 'like', '%' . $this->search . '%');
            })
            ->orderBy('nama')
            ->paginate(10);

        return view('livewire.pages.daftar-opd', [
            'opds' => $opds,
        ]);
    }
}
