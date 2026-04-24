<div class="col-md-12 col-xl-12">
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('kriteria.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i class="ti ti-plus"></i>
            <span>Tambah Kriteria</span>
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
                            <th class="text-center">Kode Kriteria</th>
                            <th class="text-center">Nama Kriteria</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriteria as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->kode_kriteria }}</td>
                                <td>{{ $item->nama_kriteria }}</td>
                                <td class="text-center">
                                    <a href="{{ route('kriteria.edit', $item->id_kriteria) }}"
                                        class="btn btn-sm btn-primary"><i class="ti ti-edit"></i> Edit</a>
                                    <form action="{{ route('kriteria.destroy', $item->id_kriteria) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalDelete{{ $item->id_kriteria }}"><i
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
@foreach ($kriteria as $item)
    <form action="{{ route('kriteria.destroy', $item->id_kriteria) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <div id="modalDelete{{ $item->id_kriteria }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus data
                            <b>{{ $item->kode_kriteria . ' - ' . $item->nama_kriteria }}</b>?
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
