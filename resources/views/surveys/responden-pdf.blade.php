<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Responden</title>
  <style>
    body { font-family: sans-serif; font-size: 12px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #000; padding: 5px; text-align: left; }
    th { background: #f2f2f2; }
  </style>
</head>
<body>
  <h3 style="text-align:center;">Daftar Responden</h3>

  <table>
    <thead>
      <tr>
        <th style="width:5%">No</th>
        <th style="width:20%">Nama</th>
        <th style="width:35%">Pertanyaan</th>
        <th style="width:20%">Jawaban</th>
        <th style="width:20%">Kategori</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($groupedResponses as $i => $items)
        <tr>
          <td style="text-align:center">{{ $loop->iteration }}</td>
          <td>{{ $items->first()->dataDiri->nama_lengkap ?? '-' }}</td>
          <td>
            @foreach ($items as $item)
              {{ $loop->iteration }}. {{ $item->question->pertanyaan ?? '-' }} <br>
            @endforeach
          </td>
          <td>
            @foreach ($items as $item)
              {{ $item->jawaban ?? '-' }} <br>
            @endforeach
          </td>
          <td>
            @foreach ($items as $item)
              {{ $item->question->category->name ?? '-' }} <br>
            @endforeach
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="5" style="text-align:center;">Belum ada data</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</body>
</html>
