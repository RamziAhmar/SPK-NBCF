<div class="col-md-12 col-xl-12">
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('data_training.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i class="ti ti-plus"></i>
            <span>Tambah Data Training</span>
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
                            <th class="text-center">ID</th>
                            <th class="text-center">Warna Kaca</th>
                            <th class="text-center">Kebersihan</th>
                            <th class="text-center">Ukuran</th>
                            <th class="text-center">Kontaminasi</th>
                            <th class="text-center">Kelembaban</th>
                            <th class="text-center">Hasil</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataTraining as $item)
                            <tr>
                                <td class="text-center">{{ $item->id_training }}</td>
                                <td>{{ $item->warnaKaca->nama_sub ?? '-' }}</td>
                                <td>{{ $item->kebersihan->nama_sub ?? '-' }}</td>
                                <td>{{ $item->ukuran->nama_sub ?? '-' }}</td>
                                <td>{{ $item->kontaminasi->nama_sub ?? '-' }}</td>
                                <td>{{ $item->kelembaban->nama_sub ?? '-' }}</td>
                                <td>{{ $item->hasil }}</td>
                                <td class="text-center">
                                    <a href="{{ route('data_training.edit', $item->id_training) }}"
                                        class="btn btn-sm btn-primary"><i class="ti ti-edit"></i> Edit</a>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete{{ $item->id_training }}"><i
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

<!-- [ vertically-modal ] start -->
@foreach ($dataTraining as $item)
    <form action="{{ route('data_training.destroy', $item->id_training) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <div id="modalDelete{{ $item->id_training }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus data
                            <b>{{ $item->id_training }}</b>?
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
