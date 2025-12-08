<?php

namespace App\Filament\Resources\Pengaduans\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class PengaduansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor_pengaduan')
                    ->label('No. Pengaduan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                TextColumn::make('nama_pengadu')
                    ->label('Pengadu')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jenisPengaduan.nama')
                    ->label('Jenis')
                    ->badge()
                    ->sortable(),
                TextColumn::make('kategoriPengaduan.nama')
                    ->label('Kategori')
                    ->badge()
                    ->color('info')
                    ->sortable(),
                TextColumn::make('channelPengaduan.nama')
                    ->label('Channel')
                    ->sortable(),
                TextColumn::make('opd.nama')
                    ->label('OPD')
                    ->sortable()
                    ->limit(20),
                BadgeColumn::make('status_respon')
                    ->label('Status Respon')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'dalam_proses' => 'Dalam Proses',
                        'telah_direspon' => 'Telah Direspon',
                    })
                    ->colors([
                        'warning' => 'dalam_proses',
                        'success' => 'telah_direspon',
                    ]),
                BadgeColumn::make('status_tindak_lanjut')
                    ->label('Tindak Lanjut')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'belum_ditindak_lanjuti' => 'Belum Ditindak Lanjuti',
                        'sudah_ditindak_lanjuti' => 'Sudah Ditindak Lanjuti',
                        default => '-',
                    })
                    ->colors([
                        'warning' => 'belum_ditindak_lanjuti',
                        'success' => 'sudah_ditindak_lanjuti',
                    ]),
                IconColumn::make('is_verified')
                    ->label('Terverifikasi')
                    ->boolean(),
                IconColumn::make('perlu_tindak_lanjut')
                    ->label('Perlu Tindak Lanjut')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('jenis_pengaduan_id')
                    ->label('Jenis Pengaduan')
                    ->relationship('jenisPengaduan', 'nama'),
                SelectFilter::make('kategori_pengaduan_id')
                    ->label('Kategori Pengaduan')
                    ->relationship('kategoriPengaduan', 'nama'),
                SelectFilter::make('channel_pengaduan_id')
                    ->label('Channel Pengaduan')
                    ->relationship('channelPengaduan', 'nama'),
                SelectFilter::make('opd_id')
                    ->label('OPD')
                    ->relationship('opd', 'nama'),
                SelectFilter::make('status_respon')
                    ->label('Status Respon')
                    ->options([
                        'dalam_proses' => 'Dalam Proses',
                        'telah_direspon' => 'Telah Direspon',
                    ]),
                TernaryFilter::make('is_verified')
                    ->label('Terverifikasi'),
                TernaryFilter::make('perlu_tindak_lanjut')
                    ->label('Perlu Tindak Lanjut'),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('verify_respond')
                    ->label('Verifikasi & Balas')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => auth()->user()->can('verify', $record) || auth()->user()->can('respond', $record))
                    ->modalHeading('Verifikasi dan Balas Pengaduan')
                    ->modalDescription('Verifikasi dan berikan balasan untuk pengaduan ini')
                    ->modalSubmitActionLabel('Simpan')
                    ->modalWidth('3xl')
                    ->fillForm(fn ($record): array => [
                        'is_verified' => $record->is_verified,
                        'balasan'     => $record->balasan,
                        'status_respon' => $record->status_respon,
                        'status_tindak_lanjut' => $record->status_tindak_lanjut,
                        'bukti_terusan_path' => $record->bukti_terusan_path,
                        'bukti_balasan_path' => $record->bukti_balasan_path,
                    ])
                    ->form([
                        Grid::make([
                            'default' => 1,
                            'md' => 2,
                        ])
                            ->schema([
                                Toggle::make('is_verified')
                                    ->label('Verifikasi Pengaduan')
                                    ->helperText('Tandai pengaduan ini sebagai terverifikasi')
                                    ->visible(fn () => auth()->user()->can('verify_pengaduan')),

                                Toggle::make('perlu_tindak_lanjut')
                                    ->label('Tandai Perlu Tindak Lanjut')
                                    ->helperText('Tandai pengaduan ini sebagai perlu tindak lanjut')
                                    ->visible(fn () => auth()->user()->can('verify_pengaduan')),
                            ]),
                        
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
                            ->columnSpanFull()
                            ->visible(fn () => auth()->user()->can('respond_pengaduan')),
                        
                        Grid::make([
                            'default' => 1,
                            'md' => 2,
                        ])
                            ->schema([
                                FileUpload::make('bukti_terusan_path')
                                    ->label('Bukti Terusan')
                                    ->helperText('Upload bukti terusan pengaduan ke OPD terkait.')
                                    ->disk('public')
                                    ->directory('bukti-terusan')
                                    ->visible(fn () => auth()->user()->can('respond_pengaduan')),
                                
                                FileUpload::make('bukti_balasan_path')
                                    ->label('Bukti Balasan')
                                    ->helperText('Upload bukti balasan dari OPD terkait.')
                                    ->disk('public')
                                    ->directory('bukti-balasan')
                                    ->visible(fn () => auth()->user()->can('respond_pengaduan')),
                            ]),
                        
                        Grid::make([
                            'default' => 1,
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
                                    ->required()
                                    ->helperText('Ubah status respon pengaduan.')
                                    ->visible(fn () => auth()->user()->can('respond_pengaduan')),
                                
                                Select::make('status_tindak_lanjut')
                                    ->label('Status Tindak Lanjut')
                                    ->options([
                                        'belum_ditindak_lanjuti' => 'Belum Ditindak Lanjuti',
                                        'sudah_ditindak_lanjuti' => 'Sudah Ditindak Lanjuti',
                                    ])
                                    ->helperText('Ubah status tindak lanjut pengaduan.')
                                    ->visible(fn () => auth()->user()->can('respond_pengaduan')),
                            ]),
                    ])
                    ->action(function ($record, array $data) {
                        // Verify
                        if (isset($data['is_verified']) && auth()->user()->can('verify_pengaduan')) {
                            $record->is_verified = $data['is_verified'];
                        }
                        
                        // Respond
                        if (auth()->user()->can('respond_pengaduan')) {
                            if (isset($data['balasan'])) {
                                $record->balasan = $data['balasan'];
                            }
                            
                            if (isset($data['bukti_terusan_path'])) {
                                $record->bukti_terusan_path = $data['bukti_terusan_path'];
                            }
                            
                            if (isset($data['bukti_balasan_path'])) {
                                $record->bukti_balasan_path = $data['bukti_balasan_path'];
                            }
                            
                            if (isset($data['status_respon'])) {
                                $record->status_respon = $data['status_respon'];
                            }
                            
                            if (isset($data['status_tindak_lanjut'])) {
                                $record->status_tindak_lanjut = $data['status_tindak_lanjut'];
                            }
                        }
                        
                        $record->save();
                        
                        Notification::make()
                            ->title('Berhasil')
                            ->body('Pengaduan berhasil diperbarui')
                            ->success()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}