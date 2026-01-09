<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Laporan;

class LaporanNotification extends Notification
{
    use Queueable;

    protected Laporan $laporan;

    public function __construct(Laporan $laporan)
    {
        $this->laporan = $laporan;
    }

    /**
     * Channel notifikasi
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Payload notifikasi (DATABASE)
     */
    public function toArray($notifiable): array
    {
        // Jika penerima ADMIN
        if ($notifiable->role === 'admin') {
            return [
                'type'       => 'laporan',
                'laporan_id' => $this->laporan->id,
                'judul'      => 'Laporan Baru Masuk',
                'status'     => $this->laporan->status,
                'message'    => 'Mahasiswa mengunggah laporan magang baru',
            ];
        }

        // Jika penerima USER
        return [
            'type'       => 'laporan',
            'laporan_id' => $this->laporan->id,
            'judul'      => $this->laporan->judul,
            'status'     => $this->laporan->status,
            'message' => match ($this->laporan->status) {
                'disetujui' => 'Laporan Anda telah disetujui',
                'revisi'    => 'Laporan Anda perlu direvisi',
                default     => 'Laporan berhasil dikirim dan menunggu verifikasi',
            },
        ];
    }
}

