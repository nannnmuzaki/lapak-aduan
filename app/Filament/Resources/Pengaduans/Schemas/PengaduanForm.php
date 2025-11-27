<?php

namespace App\Filament\Resources\Pengaduans\Schemas;

use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;

class PengaduanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Grid::make([
                    'default' => 1,
                    'sm' => 1,
                    'md' => 2,
                ])
                ->columnSpanFull()
                ->extraAttributes(['class' => 'items-start'])
                ->schema([
                    Section::make('Detail Pengaduan')
                        ->columnSpan(1)
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    Select::make('jenis_pengaduan_id')
                                        ->label('Jenis Pengaduan')
                                        ->relationship('jenisPengaduan', 'nama')
                                        ->required()
                                        ->searchable()
                                        ->preload()
                                        ->helperText('Pilih jenis pengaduan: Informasi, Pertanyaan, Keluhan, atau Usulan.')
                                        ->createOptionForm([
                                            TextInput::make('nama')
                                                ->required()
                                                ->maxLength(255),
                                            Textarea::make('deskripsi'),
                                        ]),
                                    Select::make('kategori_pengaduan_id')
                                        ->label('Kategori Pengaduan')
                                        ->relationship('kategoriPengaduan', 'nama')
                                        ->required()
                                        ->searchable()
                                        ->preload()
                                        ->helperText('Pilih kategori sesuai topik pengaduan (Kesehatan, Infrastruktur, dll).')
                                        ->createOptionForm([
                                            TextInput::make('nama')
                                                ->required()
                                                ->maxLength(255),
                                            Textarea::make('deskripsi'),
                                        ]),
                                    Select::make('channel_pengaduan_id')
                                        ->label('Channel Pengaduan')
                                        ->relationship('channelPengaduan', 'nama')
                                        ->required()
                                        ->searchable()
                                        ->preload()
                                        ->helperText('Pilih dari mana pengaduan ini berasal (Facebook, Instagram, Website, dll).')
                                        ->createOptionForm([
                                            TextInput::make('nama')
                                                ->required()
                                                ->maxLength(255),
                                            Textarea::make('deskripsi'),
                                        ]),
                                    Select::make('opd_id')
                                        ->label('OPD')
                                        ->relationship('opd', 'nama')
                                        ->required()
                                        ->searchable()
                                        ->preload()
                                        ->helperText('Pilih Organisasi Perangkat Daerah yang bertanggung jawab.')
                                        ->createOptionForm([
                                            TextInput::make('nama')
                                                ->required()
                                                ->maxLength(255),
                                            TextInput::make('kode')
                                                ->required()
                                                ->maxLength(255),
                                            Textarea::make('deskripsi'),
                                            TextInput::make('alamat'),
                                            TextInput::make('telepon'),
                                            TextInput::make('email')
                                                ->email(),
                                        ]),
                                ]),
                            TextInput::make('judul')
                                ->label('Judul Pengaduan')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('Contoh: Jalan Rusak di Depan SD Negeri 1')
                                ->helperText('Buat judul yang singkat dan jelas menggambarkan pengaduan.')
                                ->columnSpanFull(),
                            RichEditor::make('isi')
                                ->label('Isi Pengaduan')
                                ->required()
                                ->toolbarButtons([
                                    ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript'],
                                    ['h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd'],
                                    ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                                    ['table'],
                                    ['undo', 'redo'],
                                ])
                                ->placeholder('Jelaskan detail pengaduan Anda...')
                                ->helperText('Jelaskan kronologi, lokasi, dan detail penting lainnya.')
                                ->columnSpanFull(),
                        ]),

                    Group::make()
                        ->columnSpan(1)
                        ->extraAttributes(['class' => 'items-start'])
                        ->schema([
                            Section::make('Informasi Pengadu')
                                ->schema([
                                    Grid::make(2)
                                        ->schema([
                                            TextInput::make('nama_pengadu')
                                                ->label('Nama Pengadu')
                                                ->required()
                                                ->maxLength(255)
                                                ->placeholder('Nama lengkap pengadu')
                                                ->columnSpan(2),
                                            TextInput::make('email_pengadu')
                                                ->label('Email Pengadu')
                                                ->email()
                                                ->maxLength(255)
                                                ->placeholder('contoh@email.com'),
                                            TextInput::make('telepon_pengadu')
                                                ->label('Telepon Pengadu')
                                                ->tel()
                                                ->maxLength(255)
                                                ->placeholder('08123456789'),
                                        ]),
                                ]),

                            Section::make('Pengaturan')
                                ->schema([
                                    Grid::make(2)
                                        ->schema([
                                            Toggle::make('is_verified')
                                                ->label('Terverifikasi')
                                                ->helperText('Menandai pengaduan ini telah diverifikasi oleh petugas.')
                                                ->default(false),
                                            Toggle::make('is_profile_anonymous')
                                                ->label('Profil Anonim')
                                                ->helperText('Sembunyikan identitas pengadu pada publik.')
                                                ->default(false),
                                            Toggle::make('is_pengaduan_public')
                                                ->label('Pengaduan Publik')
                                                ->belowContent('Pengaduan tidak akan muncul pada Daftar Pengaduan Publik.')
                                                ->default(true),
                                            Toggle::make('perlu_tindak_lanjut')
                                                ->label('Perlu Tindak Lanjut')
                                                ->live()
                                                ->helperText('Pengaduan ini butuh tindak lanjut dari pihak terkait.')
                                                ->default(true),
                                        ]),
                                ]),

                            ]),
                        ]),
                        
                Section::make('Bukti & Dokumentasi')
                    ->schema([
                        FileUpload::make('images_path')
                            ->label('Foto Pengaduan')
                            ->image()
                            ->multiple()
                            ->maxFiles(5)
                            ->helperText('Upload foto pendukung pengaduan (maksimal 5 foto).')
                            ->directory('pengaduan-images')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Respon & Tindak Lanjut')
                    ->schema([
                        RichEditor::make('balasan')
                                ->label('Balasan Pengaduan')
                                ->toolbarButtons([
                                    ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript'],
                                    ['h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd'],
                                    ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                                    ['table'],
                                    ['undo', 'redo'],
                                ])
                            ->placeholder('Tulis balasan resmi untuk pengaduan ini...')
                            ->helperText('Balasan akan dikirimkan kepada pengadu melalui email/channel yang digunakan.')
                            ->columnSpanFull(),
                        Grid::make([
                            'default' => 1,
                            'sm' => 1,
                            'md' => 2,
                        ])
                            ->schema([
                                FileUpload::make('bukti_terusan_path')
                                    ->label('Bukti Terusan')
                                    ->helperText('Upload bukti terusan pengaduan ke OPD terkait.')
                                    ->directory('bukti-terusan'),
                                FileUpload::make('bukti_balasan_path')
                                    ->label('Bukti Balasan')
                                    ->helperText('Upload bukti balasan dari OPD terkait.')
                                    ->directory('bukti-balasan'),
                            ]),
                        Grid::make([
                            'default' => 1,
                            'sm' => 1,
                            'md' => 2,
                        ])
                            ->schema([
                                Select::make('status_respon')
                                    ->label('Status Respon')
                                    ->options([
                                        'dalam_proses' => 'Dalam Proses',
                                        'telah_direspon' => 'Telah Direspon',
                                    ])
                                    ->default('dalam_proses')
                                    ->required(),
                                Select::make('status_tindak_lanjut')
                                    ->label('Status Tindak Lanjut')
                                    ->hidden(fn (Get $get): bool => ! $get('perlu_tindak_lanjut'))
                                    ->options([
                                        'belum_ditindak_lanjuti' => 'Belum Ditindak Lanjuti',
                                        'sudah_ditindak_lanjuti' => 'Sudah Ditindak Lanjuti',
                                    ]),
                            ]),
                    ]),
            ]);
    }
}