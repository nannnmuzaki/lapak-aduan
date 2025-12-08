<?php

namespace App\Livewire\Pages;

use App\Models\Pengaduan;
use App\Models\ChannelPengaduan;
use App\Models\JenisPengaduan;
use App\Models\KategoriPengaduan;
use App\Models\Opd;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class BuatPengaduan extends Component
{
    use WithFileUploads;

    #[Validate('required|string|max:255')]
    public $judul = '';

    #[Validate('required|string|max:255')]
    public $nama_pengadu = '';

    #[Validate('nullable|email|max:255')]
    public $email_pengadu = '';

    #[Validate('nullable|string|max:20')]
    public $telepon_pengadu = '';

    #[Validate('required')]
    public $jenis_pengaduan_id = '';

    #[Validate('required')]
    public $kategori_pengaduan_id = '';

    #[Validate('required')]
    public $opd_id = '';

    #[Validate('required|string')]
    public $isi = '';

    #[Validate('nullable|array|max:5')]
    public $images = [];

    public $is_profile_anonymous = false;
    public $is_pengaduan_public = true;
    public $perlu_tindak_lanjut = false;

    #[Layout('components.layouts.app')]
    #[Title('Buat Pengaduan - Lapak Aduan')]

    public function mount()
    {
        if (auth()->check()) {
            $this->nama_pengadu = auth()->user()->name;
            $this->email_pengadu = auth()->user()->email;
        }
    }

    public function submit()
    {
        $this->validate();

        $channelWebsite = ChannelPengaduan::where('nama', 'Website Lapak Aduan')->first();
        
        $imagePaths = [];
        if ($this->images) {
            foreach ($this->images as $image) {
                $imagePaths[] = $image->store('pengaduan-images', 'public');
            }
        }

        $pengaduan = Pengaduan::create([
            'user_id' => auth()->id(),
            'jenis_pengaduan_id' => $this->jenis_pengaduan_id,
            'kategori_pengaduan_id' => $this->kategori_pengaduan_id,
            'channel_pengaduan_id' => $channelWebsite->id,
            'opd_id' => $this->opd_id,
            'judul' => $this->judul,
            'nama_pengadu' => $this->nama_pengadu,
            'email_pengadu' => $this->email_pengadu,
            'telepon_pengadu' => $this->telepon_pengadu,
            'nomor_pengaduan' => Pengaduan::generateNomorPengaduan($channelWebsite->id),
            'isi' => $this->isi,
            'images_path' => $imagePaths,
            'is_profile_anonymous' => $this->is_profile_anonymous,
            'is_pengaduan_public' => $this->is_pengaduan_public,
            'perlu_tindak_lanjut' => $this->perlu_tindak_lanjut,
            'status_respon' => 'dalam_proses',
            'is_verified' => false,
        ]);

        session()->flash('success', 'Pengaduan berhasil dibuat dengan nomor: ' . $pengaduan->nomor_pengaduan);
        
        return $this->redirect(route('page.daftar-pengaduan'), navigate: true);
    }

    public function render()
    {
        $jenisOptions = JenisPengaduan::all();
        $kategoriOptions = KategoriPengaduan::all();
        $opdOptions = Opd::all();

        return view('livewire.pages.buat-pengaduan', [
            'jenisOptions' => $jenisOptions,
            'kategoriOptions' => $kategoriOptions,
            'opdOptions' => $opdOptions,
        ]);
    }
}
                