<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 12px; color: #333; }
        .header { 
            margin-bottom: 20px; 
            padding-bottom: 10px;
            text-align: left;
            border-bottom: 2px solid #333; 
            overflow: auto; 
        }
        .header img { 
            float: left; 
            margin-right: 15px;
            height: 50px; 
            width: auto;
        }
        .header .header-text {
            overflow: hidden; 
        }
        .header .title { font-size: 18px; font-weight: bold; }
        .header .subtitle { font-size: 14px; }
        .header .address { font-size: 10px; }
        .content { margin-top: 25px; }
        .content-title { text-align: center; font-size: 16px; font-weight: bold; text-decoration: underline; margin-bottom: 5px; }
        .period { text-align: center; font-size: 14px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; text-transform: uppercase; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: right; font-size: 10px; }
        .footer .page-number:before { content: "Halaman " counter(page); }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('img/logo-pln.png') }}" alt="Logo PLN">
        <div class="header-text">
            <div class="title">PT PLN (PERSERO)</div>
            <div class="subtitle">UNIT INDUK PEMBANGUNAN SULAWESI</div>
            <div class="subtitle">UNIT PELAKSANA PROYEK SULAWESI UTARA</div>
            <div class="address">Jl. Bethesda No. 32, Ranotana, Kec. Sario, Kota Manado, Sulawesi Utara</div>
        </div>
    </div>

    <div class="content">
        <div class="content-title">{{ $title }}</div>
        <div class="period">{{ $period }}</div>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Nama Lengkap</th>
                    <th>Alamat</th>
                    <th>Jam Datang</th>
                    <th>Jam Kembali</th>
                    <th>Keperluan</th>
                    <th>No. Kendaraan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kunjungans as $index => $kunjungan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($kunjungan->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $kunjungan->nama_lengkap }}</td>
                    <td>{{ $kunjungan->alamat }}</td>
                    <td>{{ \Carbon\Carbon::parse($kunjungan->jam_datang)->format('H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($kunjungan->jam_kembali)->format('H:i') }}</td>
                    <td>{{ $kunjungan->keperluan }}</td>
                    <td>{{ $kunjungan->nomor_kendaraan }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align: center;">Tidak ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="footer">
        Dicetak pada: {{ now()->timezone('Asia/Makassar')->translatedFormat('d F Y, H:i') }}
        <div class="page-number"></div>
    </div>

</body>
</html>