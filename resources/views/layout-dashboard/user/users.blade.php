@extends('layout-dashboard/partials/app')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
  <h1>{{ $title }}</h1>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Tambah Data
</button>
</div>

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
      <strong>Gagal menambahkan data:</strong>
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="table-responsive">
    <table class="table table-bordered" id="myTable">
      <thead>
        <tr>
          <th style="text-align: left!important">Nomor</th>
          <th style="text-align: left!important">nama</th>
          <th style="text-align: left!important">email</th>
          <th style="text-align: left!important">jenis kelamin</th>
          <th style="text-align: left!important">umur</th>
          <th style="text-align: left!important">nomer telepon</th>
          <th style="text-align: left!important">Aksi</th>

        </tr>
      </thead>

      <tbody>
        @foreach($data as $value)
        <tr>
          <td style="text-align: left!important">{{ $loop->iteration }}</td>
          <td style="text-align: left!important">{{ $value->name }}</td>
          <td style="text-align: left!important">{{ $value->email }}</td>
          <td>{{ $value->jenis_kelamin === 'P' ? 'Perempuan' : 'Laki-laki' }}</td>
          <td style="text-align: left!important">{{ $value->umur }}</td>

          <td style="text-align: left!important">{{ $value->nomer }}</td>
          <td>
            <button type="button" class="btn btn-sm btn-warning btn-edit"
              data-id="{{ $value->id }}"
              data-name="{{ $value->name }}"
              data-email="{{ $value->email }}"
              data-umur="{{ $value->umur }}"
              data-telepon="{{ $value->nomor_telepon }}"
              data-jenis="{{ $value->jenis_kelamin }}"
              data-bs-toggle="modal"
              data-bs-target="#editModal">
              Edit
            </button>
            <form action="{{route('admin.hapusDataUsers')}}" method="POST" class="d-inline delete-form">
              @csrf
              <input type="hidden" name="id" value="{{ $value->id }}">
              <button type="submit" class="btn btn-sm btn-danger delete-button">Hapus</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

<!-- Modal Tambah -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.TambahDataUsers') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="exampleInputNama" class="form-label">Nama</label>
            <input 
              type="text" 
              class="form-control @error('name') is-invalid @enderror" 
              name="name" 
              id="exampleInputNama" 
              value="{{ old('name') }}" 
              required
            >
              @error('name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail" class="form-label">Email</label>
            <input 
              type="email" 
              class="form-control @error('email') is-invalid @enderror" 
              name="email" 
              id="exampleInputEmail" 
              value="{{ old('email') }}" 
              required
            >
              @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="exampleInputNomer" class="form-label">Nomor Telpon</label>
            <input 
              type="number" 
              class="form-control @error('nomer') is-invalid @enderror" 
              name="nomer" 
              id="exampleInputNomer" 
              value="{{ old('nomer') }}" 
              required
            >
              @error('nomer')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="exampleInputUmur" class="form-label">Umur</label>
            <input 
              type="number" 
              class="form-control @error('umur') is-invalid @enderror" 
              name="umur" 
              id="exampleInputUmur" 
              value="{{ old('umur') }}" 
              required
            >
              @error('umur')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
              <option value="">-- Pilih Jenis Kelamin --</option>
              <option value="P" {{ old('jenis_kelamin') === "P" ? 'selected' : '' }}>Perempuan</option>
              <option value="L" {{ old('jenis_kelamin') === "L" ? 'selected' : '' }}>Laki-laki</option>
            </select>
            @error('jenis_kelamin')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="exampleInputPassword" class="form-label">Password</label>
            <input 
              type="password" 
              class="form-control @error('password') is-invalid @enderror" 
              name="password" 
              id="exampleInputPassword" 
              value="{{ old('password') }}" 
              required
            >
              @error('password')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>

        </form>
       </div>
      </div>
    </div>
  </div>

<!-- Modal Edit -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('admin.editDataUsers') }}" method="POST">
          @csrf
          <input type="hidden" name="id" id="edit-id">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="edit-name" class="form-label">Nama</label>
              <input type="text" class="form-control" id="edit-name" name="name" required>
            </div>
            <div class="mb-3">
              <label for="edit-email" class="form-label">Email</label>
              <input type="email" class="form-control" id="edit-email" name="email" required>
            </div>
            <div class="mb-3">
              <label for="edit-nomor" class="form-label">Nomor Telpon</label>
              <input type="text" class="form-control" id="edit-nomor" name="nomor_telepon" required>
            </div>
            <div class="mb-3">
              <label for="edit-umur" class="form-label">Umur</label>
              <input type="number" class="form-control" id="edit-umur" name="umur" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Jenis Kelamin</label>
              <select name="jenis_kelamin" id="edit-jenis" class="form-select" required>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
<script>
  $(document).ready(function () {
    $('#myTable').DataTable();

    $('#exampleModal').on('hidden.bs.modal', function () {
      const form = $(this).find('form')[0];
      if (form) form.reset();
      $(this).find('.is-invalid').removeClass('is-invalid');
      $(this).find('.invalid-feedback').text('');
    });

   $(document).on('click', '.btn-edit', function () {
      $('#edit-id').val($(this).data('id'));
      $('#edit-name').val($(this).data('name'));
      $('#edit-email').val($(this).data('email'));
      $('#edit-umur').val($(this).data('umur'));
      $('#edit-nomor').val($(this).data('telepon'));
      $('#edit-jenis').val($(this).data('jenis'));
    });

    // GANTI di sini
    $(document).on('submit', '.delete-form', function(e) {
      e.preventDefault();
      const form = this;
      const name = $(form).find('.btn-delete').data('name');

      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: `Data "${name}" akan dihapus secara permanen!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
  });

</script>
@endsection 