<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Peminjaman Buku &mdash; Pustakanesia</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #334155;
            font-size: 9pt;
            line-height: 1.5;
            margin: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #4f46e5;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
        .logo-title {
            font-size: 16pt;
            font-weight: bold;
            color: #1e1b4b;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0;
        }
        .sub-title {
            font-size: 10pt;
            color: #64748b;
            margin: 4px 0 0 0;
        }
        .meta-info {
            margin-bottom: 15px;
            font-size: 8.5pt;
            color: #475569;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table th {
            background-color: #f1f5f9;
            color: #1e293b;
            font-weight: bold;
            font-size: 8.5pt;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 8px 6px;
            border: 1px solid #cbd5e1;
            text-align: left;
        }
        table td {
            padding: 7px 6px;
            border: 1px solid #cbd5e1;
            font-size: 8.5pt;
        }
        table tr:nth-child(even) td {
            background-color: #f8fafc;
        }
        .badge-returned {
            color: #065f46;
            font-weight: bold;
        }
        .badge-borrowed {
            color: #b45309;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 8.5pt;
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="logo-title">Pustakanesia &bull; Digital Library</h1>
        <p class="sub-title">Laporan Rekapitulasi Sirkulasi &amp; Peminjaman Buku Perpustakaan</p>
    </div>

    <div class="meta-info">
        <strong>Dicetak Pada:</strong> {{ date('d F Y, H:i') }} WIB &bull; 
        <strong>Total Transaksi:</strong> {{ count($riwayat_peminjaman) }} Transaksi
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 22%;">Nama Peminjam</th>
                <th style="width: 28%;">Judul Buku</th>
                <th style="width: 12%;">Kode Buku</th>
                <th style="width: 11%;">Tgl Pinjam</th>
                <th style="width: 11%;">Jatuh Tempo</th>
                <th style="width: 11%;">Pengembalian</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($riwayat_peminjaman as $item)
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    <td><strong>{{ $item->user ? $item->user->name : '-' }}</strong></td>
                    <td>{{ $item->buku ? $item->buku->judul : '-' }}</td>
                    <td>{{ $item->buku ? $item->buku->kode_buku : '-' }}</td>
                    <td>{{ $item->tanggal_pinjam }}</td>
                    <td>{{ $item->tanggal_wajib_kembali }}</td>
                    <td>
                        @if ($item->tanggal_pengembalian != null)
                            <span class="badge-returned">{{ $item->tanggal_pengembalian }}</span>
                        @else
                            <span class="badge-borrowed">Dipinjam</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 15px;">Tidak ada data peminjaman buku.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak otomatis oleh Sistem Informasi Perpustakaan Digital Pustakanesia</p>
    </div>
</body>
</html>
