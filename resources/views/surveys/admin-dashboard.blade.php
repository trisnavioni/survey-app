@extends('layouts.app')

@section('title','Dashboard')

@section('content')
<div class="breadcrumb">📊 Dashboard</div>

{{-- 🌟 INFORMASI SETTING --}}
@if(!$hasSetting)
  <div class="card border-0 p-4 mb-3 rounded-3 shadow-sm" style="background:#fff6d9;">
    <h5 class="fw-bold text-danger mb-2">⚠️ Setting Belum Dibuat</h5>
    <p class="text-muted m-0">Anda belum membuat pengaturan survei. Silakan buat terlebih dahulu di menu <b>Setting</b>.</p>
  </div>
@elseif(!$settingActive)
  <div class="card border-0 p-4 mb-3 rounded-3 shadow-sm" style="background:#fff6d9">
    <h5 class="fw-bold text-warning mb-2">⚠️ Setting Belum Aktif</h5>
    <p class="text-muted m-0">Setting sudah dibuat, tetapi belum diaktifkan. Aktifkan agar survei dapat berjalan.</p>
  </div>
@endif


{{-- 🌟 INFORMASI KUESIONER --}}
@if(!$hasCategories)
  <div class="card border-0 p-4 mb-3 rounded-3 shadow-sm" style="background:#e3f2fd;">
    <h5 class="fw-bold mb-2" style="color:#0d47a1;">⚠️ Belum Ada Kategori</h5>
    <p class="text-muted m-0">Anda belum membuat kategori dan pertanyaan. Tambahkan melalui menu <b>Kuesioner</b>.</p>
  </div>

@elseif(!$hasActiveCategories)
  <div class="card border-0 p-4 mb-3 rounded-3 shadow-sm" style="background:#e3f2fd;">
    <h5 class="fw-bold mb-2" style="color:#0d47a1;">⚠️ Kategori Belum Aktif</h5>
    <p class="text-muted m-0">Kategori sudah dibuat, tetapi belum ada yang diaktifkan. Aktifkan salah satu kategori yang sudah berisi pertanyaan.</p>
  </div>
@endif



{{-- 🌟 INFORMASI SURVEI --}}
@if(!$hasActiveSurvey)
  <div class="card border-0 p-4 mb-3 rounded-3 shadow-sm" style="background:#efe0ff;">
    <h5 class="fw-bold mb-3" style="color:#7b1fa2;">⚙️ Selesaikan Langkah Berikut untuk Mengaktifkan Link Survey dan Mendapatkan QR Code</h5>

    <p class="mb-1">{!! $hasSetting ? '<span style="color:#22a769;">✔</span>' : '<span style="color:#d32f2f;">✘</span>' !!} Membuat Survey di Menu Setting</p>
    <p class="mb-1">{!! $settingActive ? '<span style="color:#22a769;">✔</span>' : '<span style="color:#d32f2f;">✘</span>' !!} Mengaktifkan Survei di Menu Setting</p>
    <p class="mb-1">{!! $hasCategories ? '<span style="color:#22a769;">✔</span>' : '<span style="color:#d32f2f;">✘</span>' !!} Membuat Kategori di Menu Kuesioner</p>
    <p class="mb-1">{!! $hasQuestions ? '<span style="color:#22a769;">✔</span>' : '<span style="color:#d32f2f;">✘</span>' !!} Membuat Pertanyaan di Menu Kuesioner</p>
    <p class="mb-0">{!! $hasActiveCategories ? '<span style="color:#22a769;">✔</span>' : '<span style="color:#d32f2f;">✘</span>' !!} Mengaktifkan Kategori di Menu Kuesioner</p>

  </div>
@endif


{{-- 🌟 QR CODE --}}
@if($hasActiveSurvey)
  <div class="card soft-shadow border-0 rounded-2 p-4 mt-3 text-center bg-white mb-4">
      <div class="mb-3">
          <h5 class="fw-bold text-primary">🔗 Link Survei Anda</h5>
          <p class="text-muted mb-1">Bagikan link berikut kepada responden.</p>
      </div>

      <div class="input-group mb-3 soft-shadow-sm">
          <input type="text" class="form-control text-center border-0 fw-semibold bg-light"
                 id="surveyLink" value="{{ $surveyLink }}" readonly>
          <button class="btn btn-outline-primary" onclick="copySurveyLink('{{ $surveyLink }}')">
              📋 Salin
          </button>
      </div>

      <a href="{{ $surveyLink }}" target="_blank" class="btn btn-success w-100 fw-bold mb-3">
          🚀 Buka Survei
      </a>

      <div class="mt-4" id="qrContainer">
          {!! $qrCode !!}
          <p class="text-muted mt-2">📱 Scan QR untuk membuka survei</p>
      </div>

      <button class="btn btn-outline-secondary mt-3" onclick="printQRCode()">
          🖨️ Cetak QR Code
      </button>
  </div>
@endif


{{-- 🌟 STATISTIK --}}
<div class="row g-4 mb-4">
  <div class="col-md-4 col-12">
    <div class="card border-0 rounded-2 soft-shadow">
      <div class="card-header text-white p-3 text-center" style="background:#22a769;">KATEGORI</div>
      <div class="card-body text-center">
        <div>JUMLAH</div>
        <div class="inner-number fs-4 fw-bold">{{ $totalCategories }}</div>
      </div>
    </div>
  </div>

  <div class="col-md-4 col-12">
    <div class="card border-0 rounded-2 soft-shadow">
      <div class="card-header text-white p-3 text-center" style="background:#f28b82;">PERTANYAAN</div>
      <div class="card-body text-center">
        <div>JUMLAH</div>
        <div class="inner-number fs-4 fw-bold">{{ $totalQuestions }}</div>
      </div>
    </div>
  </div>

  <div class="col-md-4 col-12">
    <div class="card border-0 rounded-2 soft-shadow">
      <div class="card-header text-white p-3 text-center" style="background:#8ab4f8;">JAWABAN</div>
      <div class="card-body text-center">
        <div>JUMLAH</div>
        <div class="inner-number fs-4 fw-bold">{{ $totalResponses }}</div>
      </div>
    </div>
  </div>
</div>


{{-- 🌟 GRAFIK FULL WIDTH --}}
@if(!$categories->isEmpty())
  @foreach($categories as $category)
    <div class="card mb-4 rounded-2 border-0 soft-shadow" style="width:100%;">
      <div class="card-body text-dark">
        <h5 class="fw-bold mb-3">{{ $category->name }}</h5>

        @forelse($category->questions as $qIndex => $q)
          <h6 class="mb-2">{{ $q->pertanyaan }}</h6>

          <div class="chart-container" style="max-height:100px;">
            <canvas id="chart_{{ $category->id }}_{{ $qIndex }}"></canvas>
          </div>

        @empty
          <p class="text-muted fst-italic">Belum ada pertanyaan di kategori ini.</p>
        @endforelse
      </div>
    </div>
  @endforeach
@endif
@endsection


{{-- ====================== STYLE ======================= --}}
@push('styles')
<style>
.soft-shadow { box-shadow:0 2px 8px rgba(0,0,0,0.08); }
.soft-shadow:hover { box-shadow:0 4px 14px rgba(0,0,0,0.12); }
.soft-shadow-sm { box-shadow:0 1px 4px rgba(0,0,0,0.06); }

.chart-container { width:100% !important; min-height:150px; }
.chart-container canvas { width:100% !important; }
</style>
@endpush


{{-- ====================== SCRIPT ======================= --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function copySurveyLink(link) {
    navigator.clipboard.writeText(link).then(() => {
        Swal.fire({ icon: 'success', title: 'Link Disalin!', timer: 1500, showConfirmButton:false });
    });
}

function printQRCode() {
    const qrContent = document.getElementById("qrContainer").innerHTML;
    const win = window.open("", "_blank");
    win.document.write(`<html><body>${qrContent}<script>window.print();<\/script></body></html>`);
    win.document.close();
}

document.addEventListener("DOMContentLoaded", function () {
    let chartData = @json($chartData);
    if (!chartData) return;

    chartData.forEach(item => {
        const ctx = document.getElementById(item.id)?.getContext("2d");
        if (!ctx) return;

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["Tidak Baik","Kurang Baik","Baik","Sangat Baik"],
                datasets: [{
                    data: item.counts,
                    backgroundColor:["#dc3545","#ffc107","#0d6efd","#198754"],
                    borderRadius:6
                }]
            },
            options:{
    responsive:true,
    maintainAspectRatio:false,
    scales:{
        y:{
            beginAtZero:true,
            max:100,
            ticks:{
                stepSize:20
            }
        }
    },
    plugins:{
        legend:{ display:false }
    }
}

        });
    });
});

</script>
@endpush
