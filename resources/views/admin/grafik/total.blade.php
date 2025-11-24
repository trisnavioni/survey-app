@extends('layouts.app')

@section('content')
<div class="breadcrumb">📝 Grafik Total</div>

<div class="container">

    <!-- Filter -->
    <form method="GET" action="{{ route('admin.grafik.total') }}" class="mb-4">
        <label for="category_id" class="form-label">Pilih Kategori:</label>
        <select name="category_id" id="category_id" class="form-select shadow-sm" onchange="this.form.submit()">
            <option value="">-- Semua Kategori --</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ ($selectedCategory == $cat->id) ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </form>

    <!-- Form Export PDF -->
    <form id="exportForm" method="POST" action="{{ route('admin.grafik.total.pdf') }}">
        @csrf
        <input type="hidden" name="category_id" value="{{ $selectedCategory }}">

        <div class="d-flex justify-content-end mb-3">
            <button type="button" id="exportBtn" class="btn btn-danger">📄 Export PDF</button>
        </div>

        <!-- Tampilkan per kategori -->
        @foreach($grouped as $kategori => $items)
            <div class="card shadow-lg border-0 rounded-4 p-4 mb-5">
                <h4 class="fw-bold text-primary mb-4">{{ $kategori }}</h4>

                <!-- Grafik -->
                <div style="height:220px;">
                    <canvas id="chart-{{ \Illuminate\Support\Str::slug($kategori) }}"></canvas>
                </div>

                <input type="hidden" name="charts[{{ \Illuminate\Support\Str::slug($kategori) }}]" id="img-{{ \Illuminate\Support\Str::slug($kategori) }}">

                <div id="legend-{{ \Illuminate\Support\Str::slug($kategori) }}" class="mt-3 legend-container"></div>
            </div>
        @endforeach
    </form>

</div>

<!-- CSS untuk tampilan rapi dan center -->
<style>
.legend-container {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

/* Setiap item legend */
.legend-container .d-flex {
    align-items: flex-start !important;
    flex-wrap: wrap;
    word-wrap: break-word;
    white-space: normal;
    overflow-wrap: break-word;
}

/* Lingkaran angka — pastikan angkanya benar-benar di tengah */
.legend-container .rounded-circle {
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    flex-shrink: 0;
    font-weight: 700;
    font-size: 14px;
}

/* Teks pertanyaan */
.legend-container small {
    display: block;
    font-size: 13px;
    color: #555;
    word-break: break-word;
    max-width: 100%;
}

.legend-container h6 {
    font-weight: 600;
    color: #222;
}

/* Responsif */
@media (max-width: 576px) {
    .legend-container .d-flex {
        flex-direction: row;
        align-items: flex-start;
    }
    .legend-container small {
        font-size: 12px;
    }
    .legend-container h6 {
        font-size: 14px;
    }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const softColors = [
        "#dc3545", "#ffc107", "#0d6efd", "#198754", "#FFADAD",
        "#FFD6A5", "#FDFFB6", "#CAFFBF", "#9BF6FF", "#A0C4FF",
        "#BDB2FF", "#FFC6FF", "#FFFFFC", "#FFB5A7", "#FCD5CE", "#E2ECE9"
    ];

    @foreach($grouped as $kategori => $items)
        (function(){
            const pertanyaan = @json($items->pluck('pertanyaan'));
            const dataAsli   = @json($items->pluck('total'));
            const labels     = pertanyaan.map((q,i) => "Q"+(i+1));
            const total      = dataAsli.reduce((a,b)=>a+b,0);
            const persen     = dataAsli.map(v => total>0 ? ((v/total)*100).toFixed(1) : 0);

            const canvasId = "chart-{{ \Illuminate\Support\Str::slug($kategori) }}";
            const ctx = document.getElementById(canvasId).getContext("2d");

            // Hanya tampilkan persentase (tanpa jumlah respon)
            const chart = new Chart(ctx, {
                type:'bar',
                data:{
                    labels:labels,
                    datasets:[{
                        data:persen,
                        backgroundColor:softColors,
                        borderRadius:{topLeft:6, topRight:6},
                        borderSkipped:"bottom"
                    }]
                },
                options:{
                    responsive:true,
                    maintainAspectRatio:false,
                    plugins:{
                        legend:{ display:false },
                        datalabels:{
                            color:"#111",
                            anchor:"end",
                            align:"end",
                            font:{ family:"Poppins", weight:"600", size:12 },
                            formatter:(value)=> value + "%"
                        }
                    },
                    scales:{
                        y:{
                            beginAtZero:true,
                            ticks:{ callback:v => v + "%" }
                        }
                    }
                },
                plugins:[ChartDataLabels]
            });

            // Simpan base64 chart untuk ekspor PDF
            setTimeout(()=>{ 
                document.getElementById("img-{{ \Illuminate\Support\Str::slug($kategori) }}").value = chart.toBase64Image(); 
            },1000);

            // Generate legend per pertanyaan
            const legend = document.getElementById("legend-{{ \Illuminate\Support\Str::slug($kategori) }}");
            pertanyaan.forEach((q,i)=>{
                legend.innerHTML += `
                    <div class="d-flex mb-2 p-2 rounded shadow-sm" style="background:#fff; border-left:6px solid ${softColors[i%softColors.length]}">
                        <div class="me-2 rounded-circle text-white fw-bold" 
                             style="width:38px;height:38px;background:${softColors[i%softColors.length]};">
                            ${dataAsli[i]}
                        </div>
                        <div style="flex:1; min-width:0;">
                            <h6 class="mb-0">Q${i+1}</h6>
                            <small>${q}</small>
                        </div>
                    </div>
                `;
            });
        })();
    @endforeach

    // Export PDF
    document.getElementById("exportBtn").addEventListener("click", function () {
        document.querySelectorAll("canvas").forEach((canvas)=>{
            const slug = canvas.id.replace("chart-","");
            const base64 = canvas.toDataURL("image/png");
            const hidden = document.getElementById("img-"+slug);
            if(hidden) hidden.value = base64;
        });
        document.getElementById("exportForm").submit();
    });
});
</script>
@endsection
