@extends('layouts.app')

@section('content')
<div class="breadcrumb">📋 Responden</div>

<div class="responden-container">

    <!-- Filter -->
<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary-subtle fw-bold text-center">
        🔎 Filter Data Responden
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.personal.responden', $admin->slug) }}" class="row g-3 align-items-center position-relative">

            <div class="col-md-4">
                <select name="category" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Semua Kategori --</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $selectedCategory == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-5 position-relative">
                <input type="text" name="search" id="searchInput"
                    value="{{ request('search') }}"
                    class="form-control pe-5"
                    placeholder="Cari nama responden...">

                <button type="button" id="clearSearchBtn"
                    class="position-absolute d-none"
                    style="right: 12px; top: 50%; transform: translateY(-50%); border: none; background: transparent;">
                    <i class="bi bi-x-circle-fill text-danger fs-5"></i>
                </button>
            </div>

            <div class="col-md-3 d-grid">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search me-1"></i> Cari
                </button>
            </div>

        </form>
    </div>
</div>


    <!-- Export PDF -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-success-subtle fw-bold text-center">
            📄 Export Data ke PDF
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.personal.responden.exportPdf', $admin->slug) }}">
                <div class="mb-2">
                    <input type="checkbox" id="selectAll" class="form-check-input">
                    <label for="selectAll" class="form-check-label fw-bold">Pilih Semua Kategori</label>
                </div>
                <div class="row g-2">
                    @foreach($categories as $category)
                    <div class="col-md-3 col-sm-6">
                        <div class="form-check">
                            <input class="form-check-input category-checkbox" type="checkbox" name="categories[]" value="{{ $category->id }}" id="cat{{ $category->id }}" {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="cat{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-file-earmark-pdf-fill me-1"></i> Export PDF
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-info-subtle fw-bold text-center">
            📊 Data Responden
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th style="width:5%">No</th>
                            <th style="width:15%">Nama</th>
                            <th style="width:35%">Pertanyaan</th>
                            <th style="width:10%">Jawaban</th>
                            <th style="width:20%">Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($responses as $dataDiriId => $items)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $items->first()->dataDiri->nama_lengkap ?? '-' }}</td>

                            <!-- 🔹 Perbaikan disini -->
                            <td class="wrap-text">
                                @php $no = 1; @endphp
                                @foreach ($items as $item)
                                    {{ $no++ }}. {{ $item->question->pertanyaan ?? '-' }} <br>
                                @endforeach
                            </td>

                            <td class="wrap-text">
                                @foreach ($items as $item)
                                    {{ $item->jawaban ?? '-' }} <br>
                                @endforeach
                            </td>

                            <td class="wrap-text">
                                @foreach ($items as $item)
                                    {{ $item->question->category->name ?? '-' }} <br>
                                @endforeach
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@push('styles')
<style>
    .wrap-text {
        white-space: normal !important;
        word-wrap: break-word !important;
    }

    /* 🔹 Tabel lebih lebar dari layar di HP */
    @media (max-width: 767px) {
        table.table {
            min-width: 900px !important;
        }
        .wrap-text {
            max-width: 300px !important;
        }

        
    }

    /* 🔹 Tablet */
    @media (min-width: 768px) and (max-width: 1199px) {
        table.table {
            min-width: 1100px !important;
        }
        .wrap-text {
            max-width: 500px !important;
        }

        
    }

    /* 🔹 Desktop besar */
    @media (min-width: 1200px) {
        table.table {
            min-width: 1400px !important;
        }
        .wrap-text {
            max-width: 700px !important;
        }
    }

    /* Pastikan tidak tumpang tindih */
    .table {
        table-layout: auto !important;
    }

    td, th {
        vertical-align: top;
    }
</style>
@endpush



@push('scripts')
<script>
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.category-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById('searchInput');
    const clearBtn = document.getElementById('clearSearchBtn');

    function toggleClearBtn() {
        if (searchInput.value.trim() !== "") {
            clearBtn.classList.remove('d-none');
        } else {
            clearBtn.classList.add('d-none');
        }
    }

    toggleClearBtn();

    searchInput.addEventListener('input', toggleClearBtn);

    clearBtn.addEventListener('click', function() {
        searchInput.value = "";
        toggleClearBtn();
        searchInput.form.submit(); // 🔥 Auto submit supaya data kembali semula
    });
});
</script>

@endpush
@endsection
