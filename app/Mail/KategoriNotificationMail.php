<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KategoriNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $kategori;
    public $action;

    public function __construct($kategori, $action)
    {
        $this->kategori = $kategori;
        $this->action = $action;
    }
    
    public function envelope()
    {
        $actionText = $this->action === 'tambah' ? 'ditambahkan' : 
                     ($this->action === 'hapus' ? 'dihapus' : 'diperbarui');
        
        return new Envelope(
            subject: "Kategori {$actionText} - {$this->getKategoriName()}",
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.kategori_notification',
            with: [
                'kategori' => $this->kategori,
                'action' => $this->action,
                'kategoriName' => $this->getKategoriName(),
                'actionText' => $this->getActionText()
            ]
        );
    }

    public function attachments()
    {
        return [];
    }

    private function getKategoriName()
    {
        if (is_object($this->kategori)) {
            return $this->kategori->name ?? 'Unknown';
        }
        
        if (is_array($this->kategori)) {
            return $this->kategori['name'] ?? 'Unknown';
        }
        
        return 'Unknown';
    }

    private function getActionText()
    {
        switch ($this->action) {
            case 'tambah':
                return 'ditambahkan';
            case 'hapus':
                return 'dihapus';
            case 'edit':
                return 'diperbarui';
            default:
                return 'diproses';
        }
    }
}