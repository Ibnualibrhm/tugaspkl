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
          <th style="text-align: left!important">Nama</th>
          <th style="text-align: left!important">Status</th>
          <th style="text-align: left!important">Aksi</th>

        </tr>
      </thead>

      <tbody>
        @foreach($data as $value)
        <tr>
          <td style="text-align: left!important">{{ $loop->iteration }}</td>
          <td style="text-align: left!important">{{ $value->name }}</td>
          <td style="text-align: left!important">
            @if($value->is_publish == 1)
              <span class="badge bg-success">Publish</span>
            @else
              <span class="badge bg-danger">Tidak Publish</span>
            @endif
          </td>
          <td>
            <button type="button" class="btn btn-sm btn-warning btn-edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $value->id }}" data-name="{{ $value->name }}" data-status="{{ $value->is_publish }}">Edit</button>
            <form action="{{route('admin.hapusDataCategory')}}" method="POST" class="d-inline delete-form">
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
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.TambahDataCategory') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="exampleInputNama" class="form-label">Nama</label>
            <input type="teks" class="form-control" name = "name" value="{{ old('name')}}" required id="exampleInputNama"/>
          </div>

          <div class="mb-3">
            <label class="" class="form-label">Status</label>
            <select name="is_publish"  class="form-select @error('is_publish') is-invalid @enderror" required>
              <option value="">--Pilih Status--</option>
              <option value="0" {{ old('is_publish') === "0 ? 'selected' : '' "}}>Tidak Publish</option>
              <option value="1" {{ old('is_publish') === "0 ? 'selected' : '' "}} >Publish</oTiption>
            </select>
            @error('ispublish')
            <div class="invalid-feedback">
              {{ $message }}
              </div>
            @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="sumbit" class="btn btn-primary">Tambah</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Edit -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('admin.editDataCategory') }}" method="POST">
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
              <label class="form-label">Status</label>
              <select name="is_publish" id="edit-status" class="form-select" required>
                <option value="">-- Pilih Status --</option>
                <option value="0">Tidak Publish</option>
                <option value="1">Publish</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Ubah</button>
          </div>
        </form>
      </div>
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
      const id = $(this).data('id');
      const name = $(this).data('name');
      const status = $(this).data('status');

      $('#edit-id').val(id);
      $('#edit-name').val(name);
      $('#edit-status').val(status);
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