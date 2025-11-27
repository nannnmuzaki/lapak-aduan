<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class AlurPengaduan extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Alur Pengaduan - Lapak Aduan')]
    
    public function render()
    {
        return view('livewire.pages.alur-pengaduan');
    }
}
