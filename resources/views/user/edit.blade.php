<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('user.update', $data->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" placeholder="Username" name="username"
                        value="{{ $data->username }}" required>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Password</label>
                    <input type="text" class="form-control" placeholder="Kosongkan jika tidak perlu" name="password"
                        value="">
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Role</label>
                    <select class="form-control" name="role" required>
                        <option>Pilih Role</option>
                        <option value="admin" {{ $data->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ $data->role == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>

                {{-- ERROR MESSAGE --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="d-flex justify-content-end gap-2 mt-4">

                    <a href="{{ route('user.index') }}" class="btn btn-danger">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                        <i class="ti ti-device-floppy"></i>
                        Simpan
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>
