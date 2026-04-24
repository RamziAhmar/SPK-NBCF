<div class="col-md-12 col-xl-12">
    <div class="d-flex justify-content-end align-items-center mb-3">
        <a href="{{ route('penilaian.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i class="ti ti-plus"></i>
            <span>Tambah Alternatif</span>
        </a>
    </div>
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
                            <th class="text-center">Nama Alternatif</th>
                            <th class="text-center">Naive Bayes</th>
                            <th class="text-center">Certainty Factor</th>
                            <th class="text-center">Hasil</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_alternatif }}</td>
                                <td>{{ number_format($item->hasil->nilai_cb ?? 0, 4) }}</td>
                                <td>{{ number_format($item->hasil->nilai_cf ?? 0, 4) }}</td>
                                <td class="text-center">
                                    <span
                                        class="badge bg-{{ $item->hasil->hasil_akhir == 'Layak' ? 'success' : 'danger' }}">
                                        {{ $item->hasil->hasil_akhir }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('penilaian.show', $item->id_alternatif) }}"
                                        class="btn btn-sm btn-warning"><i class="ti ti-eye"></i> Lihat</a>
                                    <form action="{{ route('penilaian.destroy', $item->id_alternatif) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalDelete{{ $item->id_alternatif }}"><i
                                                class="ti ti-trash"></i> Hapus</button>
                                    </form>
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
    <form action="{{ route('penilaian.destroy', $item->id_alternatif) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <div id="modalDelete{{ $item->id_alternatif }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus data
                            <b>{{ $item->nama_alternatif }}</b>?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endforeach
<!-- [ vertically-modal ] end -->
