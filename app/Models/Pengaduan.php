<?php

namespace App\Models;

use App\Enums\ChannelPengaduanEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengaduan extends Model
{
    protected $fillable = [
        'user_id',
        'jenis_pengaduan_id',
        'kategori_pengaduan_id',
        'channel_pengaduan_id',
        'opd_id',
        'judul',
        'nama_pengadu',
        'email_pengadu',
        'telepon_pengadu',
        'nomor_pengaduan',
        'isi',
        'images_path',
        'bukti_terusan_path',
        'bukti_balasan_path',
        'balasan',
        'status_respon',
        'status_tindak_lanjut',
        'is_verified',
        'is_profile_anonymous',
        'is_pengaduan_public',
        'perlu_tindak_lanjut',
    ];

    protected $casts = [
        'images_path' => 'array',
        'is_verified' => 'boolean',
        'is_profile_anonymous' => 'boolean',
        'is_pengaduan_public' => 'boolean',
        'perlu_tindak_lanjut' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jenisPengaduan(): BelongsTo
    {
        return $this->belongsTo(JenisPengaduan::class);
    }

    public function kategoriPengaduan(): BelongsTo
    {
        return $this->belongsTo(KategoriPengaduan::class);
    }

    public function channelPengaduan(): BelongsTo
    {
        return $this->belongsTo(ChannelPengaduan::class);
    }

    public function opd(): BelongsTo
    {
        return $this->belongsTo(Opd::class);
    }

    public static function generateNomorPengaduan(int $channelPengaduanId): string
    {
        $channel = ChannelPengaduan::find($channelPengaduanId);
        
        if (!$channel) {
            $prefix = 'UNK';
        } else {
            $channelEnum = ChannelPengaduanEnum::fromName($channel->nama);
            $prefix = $channelEnum ? $channelEnum->getPrefix() : 'OTH';
        }
        
        $year = date('Y');
        $month = date('m');
        $random = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));
        
        return "{$prefix}-{$year}{$month}-{$random}";
    }
}
