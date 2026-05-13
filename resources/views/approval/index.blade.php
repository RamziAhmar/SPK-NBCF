<div class="col-md-12 col-xl-12">
    @session('success')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession
    <div class="card tbl-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Nama Alternatif</th>
                            <th class="text-center">Hasil Kelayakan</th>
                            <th class="text-center">Persetujuan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                <td>{{ $item->alternatif->nama_alternatif }}</td>
                                <td class="text-center">
                                    <span class="badge bg-{{ $item->hasil_akhir == 'Layak' ? 'success' : 'danger' }}">
                                        {{ $item->hasil_akhir }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if ($item->status == 'Menunggu')
                                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                            data-bs-target="#modalApproved{{ $item->id_hasil_perhitungan }}"><i
                                                class="ti ti-check"></i> Setujui</button>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalRejected{{ $item->id_hasil_perhitungan }}"><i
                                                class="ti ti-letter-x"></i> Tolak</button>
                                    @else
                                        <span
                                            class="badge bg-{{ $item->status == 'Disetujui' ? 'success' : 'danger' }}">
                                            <i class="ti ti-{{ $item->status == 'Disetujui' ? 'check' : 'letter-x' }}"></i>
                                            {{ $item->status }}
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('penilaian.show', $item->id_hasil_perhitungan) }}"
                                        class="btn btn-sm btn-primary"><i class="ti ti-eye"></i> Detail</a>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- [ vertically-modal ] start -->
@foreach ($data as $item)
    <div id="modalApproved{{ $item->id_hasil_perhitungan }}" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="modalApprovedTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalApprovedTitle">Approval</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menyetujui Alternatif
                        <b>{{ $item->alternatif->nama_alternatif }}</b>?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="{{ route('approval.approved', $item->id_hasil_perhitungan) }}"
                        class="btn btn-success">Setujui</a>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- [ vertically-modal ] end -->

<!-- [ vertically-modal ] start -->
@foreach ($data as $item)
    <div id="modalRejected{{ $item->id_hasil_perhitungan }}" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="modalRejectedTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRejectedTitle">Approval</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin enolak Alternatif
                        <b>{{ $item->alternatif->nama_alternatif }}</b>?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="{{ route('approval.rejected', $item->id_hasil_perhitungan) }}"
                        class="btn btn-danger">Tolak</a>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- [ vertically-modal ] end -->
