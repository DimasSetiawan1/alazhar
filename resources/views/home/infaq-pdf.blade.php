<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Infaq</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; color: #3a7bd5; }
    </style>
</head>
<body>
    <h2>Laporan Data Infaq & Donasi</h2>
    <p><strong>Total Terkumpul:</strong> Rp. {{ number_format($totalInfaq, 0, ',', '.') }}</p>
    <p><strong>Dicetak pada:</strong> {{ now()->format('d M Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Donatur</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($infaqs as $index => $infaq)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $infaq->nama_donatur }}</td>
                <td>Rp. {{ number_format($infaq->jumlah, 0, ',', '.') }}</td>
                <td>{{ $infaq->tanggal->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
