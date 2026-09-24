<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Permintaan Darah Baru</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        .header { background-color: #d9534f; color: white; padding: 10px; text-align: center; border-radius: 5px 5px 0 0; }
        .content { padding: 20px; }
        .info-row { margin-bottom: 10px; }
        .label { font-weight: bold; width: 150px; display: inline-block; }
        .footer { margin-top: 20px; font-size: 12px; color: #777; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Pemberitahuan Permintaan Darah</h2>
        </div>
        
        <div class="content">
            <p>Halo Admin,</p>
            <p>Ada permintaan darah baru yang masuk melalui sistem. Berikut adalah rinciannya:</p>
            
            <div class="info-row"><span class="label">Nama Pasien:</span> {{ $data['nama_pasien'] }}</div>
            <div class="info-row"><span class="label">Golongan Darah:</span> {{ $data['golongan_darah'] }}{{ $data['rhesus'] }}</div>
            <div class="info-row"><span class="label">Jumlah Kantong:</span> {{ $data['jumlah_kantong'] }}</div>
            <div class="info-row"><span class="label">Rumah Sakit:</span> {{ $data['rumah_sakit'] }}</div>
            <div class="info-row"><span class="label">Kontak Keluarga:</span> {{ $data['kontak_keluarga'] }}</div>
            <div class="info-row"><span class="label">Kontak Pribadi:</span> {{ $data['kontak_pribadi'] }}</div>
        </div>

        <div class="footer">
            <p>Email ini dikirim secara otomatis dari Sistem Permintaan Darah Radio.</p>
        </div>
    </div>
</body>
</html>