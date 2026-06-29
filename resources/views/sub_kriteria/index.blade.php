<div class="col-md-12 col-xl-12">
    <div class="d-flex justify-content-between align-items-center mb-3">

        <form method="GET" action="{{ route('sub_kriteria.index') }}">
            <div class="d-flex gap-2">
                <select name="kriteria_id" class="form-select" style="width: 200px;">
                    <option value="">Pilih Kriteria</option>
                    @foreach ($kriteria as $k)
                    <option value="{{ $k->id_kriteria }}"
                        {{ request('kriteria_id') == $k->id_kriteria ? 'selected' : '' }}>
                        {{ $k->nama_kriteria }}
                    </option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-secondary d-flex align-items-center gap-2">
                    <i class="ti ti-filter"></i>
                    Filter
                </button>
                <a href="{{ route('sub_kriteria.index') }}" class="btn btn-danger d-flex align-items-center gap-2">
                    <i class="ti ti-refresh"></i>
                    <span>Reset</span>
                </a>
            </div>
        </form>

        <a href="{{ route('sub_kriteria.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i class="ti ti-plus"></i>
            <span>Tambah Sub Kriteria</span>
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
                            <th class="text-center" width="5%">No</th>
                            <th>Kriteria</th>
                            <th>Nama Sub Kriteria</th>
                            <th>Keterangan</th>
                            <th class="text-center">MB</th>
                            <th class="text-center">MD</th>
                            <th class="text-center">CF Pakar</th>
                            <th class="text-center" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subKriteria as $item)
                        <tr>
                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $item->kriteria->nama_kriteria }}
                            </td>

                            <td>
                                {{ $item->nama_sub }}
                            </td>

                            <td>
                                {{ $item->keterangan }}
                            </td>

                            <td class="text-center">
                                {{ number_format($item->mb, 2) }}
                            </td>

                            <td class="text-center">
                                {{ number_format($item->md, 2) }}
                            </td>

                            <td class="text-center">

                                @if ($item->nilai >= 0)
                                <span class="badge bg-success">
                                    {{ number_format($item->nilai, 2) }}
                                </span>
                                @else
                                <span class="badge bg-danger">
                                    {{ number_format($item->nilai, 2) }}
                                </span>
                                @endif

                            </td>

                            <td class="text-center">

                                <a href="{{ route('sub_kriteria.edit', $item->id_sub_kriteria) }}"
                                    class="btn btn-sm btn-warning">

                                    <i class="ti ti-edit"></i>

                                </a>

                                <button
                                    type="button"
                                    class="btn btn-sm btn-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalDelete{{ $item->id_sub_kriteria }}">

                                    <i class="ti ti-trash"></i>

                                </button>

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
@foreach ($subKriteria as $item)
<form action="{{ route('sub_kriteria.destroy', $item->id_sub_kriteria) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <div id="modalDelete{{ $item->id_sub_kriteria }}" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data
                        <b>{{ $item->kriteria->nama_kriteria . ' - ' . $item->nama_sub . ' - ' . $item->keterangan }}</b>?
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