<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Grafik</title>
    <style>
        /* Font & dasar */
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 16px;
        }

        /* Kategori */
        .category {
            font-weight: bold;
            margin-top: 25px;
            margin-bottom: 10px;
            color: #0d6efd;
            text-transform: capitalize;
            font-size: 14px;
        }

        /* Grafik */
        .chart {
            text-align: center;
            margin: 10px 0 20px 0;
        }

        .chart img {
            width: 100%;
            max-width: 700px;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        /* Tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* penting agar teks wrap otomatis */
            margin-bottom: 20px;
            word-wrap: break-word;
            page-break-inside: avoid; /* biar tabel tidak terpotong di halaman PDF */
        }

        th, td {
            border: 1px solid #ccc;
            padding: 6px;
            vertical-align: top;
            word-break: break-word; /* pecah kata panjang */
            white-space: normal; /* agar teks panjang turun */
        }

        th {
            background: #f8f9fa;
            font-weight: bold;
        }

        th:nth-child(1), td:nth-child(1) {
            width: 8%;
            text-align: center;
        }

        th:nth-child(2), td:nth-child(2) {
            width: 72%;
        }

        th:nth-child(3), td:nth-child(3) {
            width: 20%;
            text-align: center;
        }

        /* Responsif untuk HP */
        @media screen and (max-width: 600px) {
            body {
                font-size: 11px;
                margin: 10px;
            }

            h2 {
                font-size: 14px;
            }

            table, th, td {
                font-size: 10px;
                padding: 4px;
            }

            .chart img {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <h2>Laporan Hasil Survey</h2>

    @foreach($grouped as $kategori => $items)
        <div class="category">{{ $kategori }}</div>

        {{-- ✅ Grafik di atas tabel --}}
        @if(isset($charts[\Illuminate\Support\Str::slug($kategori)]))
            <div class="chart">
                <img src="{{ $charts[\Illuminate\Support\Str::slug($kategori)] }}" alt="Grafik {{ $kategori }}">
            </div>
        @endif

        {{-- ✅ Tabel data --}}
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pertanyaan</th>
                    <th>Jumlah Respon</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $i => $item)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $item->pertanyaan }}</td>
                        <td>{{ $item->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>
</html>
