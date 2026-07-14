@extends('frontend.layouts.app')

@section('title', 'Laporan Transparansi Keuangan - Lazismu NTB')

@section('content')
{{-- Hero Section --}}
<section class="laporan-hero" style="background: linear-gradient(135deg, #1f2937 0%, #111827 100%); padding: 80px 0; color: #fff; text-align: center; position: relative; overflow: hidden;">
    <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; border-radius: 50%; background: rgba(247, 148, 29, 0.1); filter: blur(50px);"></div>
    <div style="position: absolute; bottom: -50px; left: -50px; width: 250px; height: 250px; border-radius: 50%; background: rgba(247, 148, 29, 0.08); filter: blur(60px);"></div>
    
    <div class="container">
        <span style="color: #F7941D; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 0.85rem; display: block; margin-bottom: 8px;">Transparansi & Akuntabilitas</span>
        <h1 class="fw-bold mb-3" style="font-size: 2.8rem; letter-spacing: -0.5px;">Laporan Keuangan</h1>
        <p class="text-muted mx-auto mb-0" style="max-width: 600px; font-size: 1.05rem; color: #9CA3AF !important;">
            Bentuk pertanggungjawaban Lazismu NTB dalam mengelola dan menyalurkan dana Zakat, Infaq, Shadaqah, dan dana kemanusiaan lainnya secara amanah dan profesional.
        </p>
    </div>
</section>

{{-- Content Section --}}
<section class="laporan-list-section py-5" style="background-color: #f9fafb; min-height: 400px;">
    <div class="container" style="max-width: 1000px;">
        @if(isset($groupedReports) && $groupedReports->count() > 0)
            @foreach($groupedReports as $year => $reportsOfYear)
                <div class="year-block mb-5">
                    {{-- Year Divider --}}
                    <div class="d-flex align-items-center mb-4 gap-3">
                        <h3 class="fw-bold text-dark mb-0" style="font-size: 1.8rem; min-width: 120px;">Tahun {{ $year }}</h3>
                        <div style="flex-grow: 1; height: 2px; background-color: #E5E7EB; border-radius: 2px;"></div>
                    </div>

                    {{-- Reports Grid for this Year --}}
                    <div class="row g-4">
                        @foreach($reportsOfYear as $report)
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0,0,0,0.04) !important;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.08) !important';" onmouseout="this.style.transform='none'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.04) !important';">
                                    <div class="card-body p-4 d-flex flex-column">
                                        <div class="d-flex align-items-start gap-3 mb-3">
                                            <div style="width: 48px; height: 48px; border-radius: 12px; background-color: #FFF3E0; display: flex; align-items: center; justify-content: center; color: #F7941D; flex-shrink: 0; font-size: 1.3rem;">
                                                <i class="fas fa-file-pdf"></i>
                                            </div>
                                            <div>
                                                <h5 class="fw-bold text-dark mb-1" style="font-size: 1.1rem; line-height: 1.4;">{{ $report->title }}</h5>
                                                <span class="badge bg-light text-muted" style="font-size: 0.75rem; font-weight: 600; border: 1px solid #E5E7EB;">PDF Dokumen</span>
                                            </div>
                                        </div>
                                        
                                        <p class="text-muted flex-grow-1" style="font-size: 0.88rem; line-height: 1.6; text-align: justify; margin-bottom: 24px;">
                                            {{ $report->description ?? 'Unduh laporan lengkap pengelolaan dana tahunan Lazismu NTB.' }}
                                        </p>
                                        
                                        <a href="{{ $report->file_path }}" target="_blank" class="btn btn-unduh-laporan w-100 py-2 fw-semibold d-flex align-items-center justify-content-center gap-2" style="background-color: #F7941D; color: #fff; border-radius: 10px; border: none; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#E5820A';" onmouseout="this.style.backgroundColor='#F7941D';">
                                            <i class="fas fa-download"></i> Unduh Laporan (PDF)
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center py-5">
                <div style="color: #9CA3AF; font-size: 1.2rem;">
                    <i class="fas fa-file-pdf mb-3" style="font-size: 4rem; color: #D1D5DB;"></i>
                    <p class="fw-bold">Belum Ada Laporan</p>
                    <p class="text-muted small">Saat ini belum ada arsip laporan transparansi keuangan yang diunggah.</p>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
