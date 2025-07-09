<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Kategori</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .content {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
        }
        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            color: white;
        }
        .badge-success {
            background-color: #28a745;
        }
        .badge-danger {
            background-color: #dc3545;
        }
        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Notifikasi Kategori</h2>
    </div>

    <div class="content">
        <h3>Kategori {{ $actionText }}</h3>
        
        <p>Berikut adalah detail kategori yang {{ $actionText }}:</p>
        
        <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
            <tr>
                <td style="padding: 10px; border: 1px solid #dee2e6; background-color: #f8f9fa; font-weight: bold;">Nama Kategori:</td>
                <td style="padding: 10px; border: 1px solid #dee2e6;">{{ $kategoriName }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #dee2e6; background-color: #f8f9fa; font-weight: bold;">Status:</td>
                <td style="padding: 10px; border: 1px solid #dee2e6;">
                    @if($action !== 'hapus')
                        @php
                            $isPublish = is_object($kategori) ? $kategori->is_publish : ($kategori['is_publish'] ?? false);
                        @endphp
                        @if($isPublish)
                            <span class="badge badge-success">Publish</span>
                        @else
                            <span class="badge badge-danger">Tidak Publish</span>
                        @endif
                    @else
                        <span class="badge badge-warning">Dihapus</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #dee2e6; background-color: #f8f9fa; font-weight: bold;">Aksi:</td>
                <td style="padding: 10px; border: 1px solid #dee2e6;">
                    @if($action === 'tambah')
                        <span class="badge badge-success">{{ ucfirst($actionText) }}</span>
                    @elseif($action === 'hapus')
                        <span class="badge badge-danger">{{ ucfirst($actionText) }}</span>
                    @else
                        <span class="badge badge-warning">{{ ucfirst($actionText) }}</span>
                    @endif
                </td>
            </tr>
        </table>

        <p>
            @if($action === 'tambah')
                Kategori baru telah berhasil ditambahkan ke sistem.
            @elseif($action === 'hapus')
                Kategori telah berhasil dihapus dari sistem.
            @else
                Kategori telah berhasil diperbarui.
            @endif
        </p>
    </div>

    <div class="footer">
        <p>Email ini dikirim secara otomatis oleh sistem. Mohon tidak membalas email ini.</p>
        <p>Waktu: {{ now()->setTimezone('Asia/Jakarta')->format('d M Y H:i:s') }} WIB</p>
    </div>
</body>
</html>