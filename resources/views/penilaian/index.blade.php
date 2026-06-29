<div class="col-md-12 col-xl-12">
    @session('success')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession
    <div class="card tbl-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Data Penilaian</h3>
                <div class="card-actions">
                    <a href="{{ route('penilaian.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                        <i class="ti ti-plus"></i>
                        <span>Tambah Alternatif</span>
                    </a>
                </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Alternatif</th>
                            <th class="text-center">Certainty Factor</th>
                            <th class="text-center">Hasil</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_alternatif }}</td>
                                <td>{{ number_format($item->hasil->nilai_cf ?? 0, 4) }}</td>
                                <td class="text-center">
                                    <span
                                        class="badge bg-{{ $item->hasil->hasil_akhir == 'Layak' ? 'success' : 'danger' }}">
                                        {{ $item->hasil->hasil_akhir }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if ($item->hasil->status == 'Disetujui')
                                        <span class="badge bg-success"> {{ $item->hasil->status }} </span>
                                    @elseif ($item->hasil->status == 'Ditolak')
                                        <span class="badge bg-danger"> {{ $item->hasil->status }} </span>
                                    @else
                                        <span class="badge bg-warning"> {{ $item->hasil->status }} </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('penilaian.show', $item->id_alternatif) }}"
                                        class="btn btn-sm btn-primary"><i class="ti ti-eye"></i> Detail</a>
                                    @if (auth()->user()->role == 'admin')
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalDelete{{ $item->id_alternatif }}"><i
                                                class="ti ti-trash"></i> Hapus</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card tbl-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Menunggu Persetujuan</h3>
                <div class="card-actions">
                    <!-- Tempat menaruh tombol tambah atau export jika diperlukan -->
                </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Alternatif</th>
                            <th class="text-center">Certainty Factor</th>
                            <th class="text-center">Hasil</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataMenunggu as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_alternatif }}</td>
                                <td>{{ number_format($item->hasil->nilai_cf ?? 0, 4) }}</td>
                                <td class="text-center">
                                    <span
                                        class="badge bg-{{ $item->hasil->hasil_akhir == 'Layak' ? 'success' : 'danger' }}">
                                        {{ $item->hasil->hasil_akhir }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if ($item->hasil->status == 'Disetujui')
                                        <a href="{{ route('penilaian.show', $item->id_alternatif) }}"><span
                                                class="badge bg-success"><i class="ti ti-eye me-1"></i>
                                                {{ $item->hasil->status }}
                                            </span>
                                        </a>
                                    @elseif ($item->hasil->status == 'Ditolak')
                                        <span class="badge bg-danger"> {{ $item->hasil->status }} </span>
                                    @else
                                        <span class="badge bg-warning"> {{ $item->hasil->status }} </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('penilaian.show', $item->id_alternatif) }}"
                                        class="btn btn-sm btn-primary"><i class="ti ti-eye"></i> Detail</a>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete{{ $item->id_alternatif }}"><i
                                            class="ti ti-trash"></i> Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@if (auth()->user()->role == 'admin')
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
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
@endif
