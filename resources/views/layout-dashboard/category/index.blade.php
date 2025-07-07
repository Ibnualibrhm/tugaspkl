@extends('layout-dashboard/partials/app')

@section('content')
  <h1>{{ $title }}</h1>

  <div class="table-responsive">
    <table class="table table-bordered" id="myTable">
      <thead>
        <tr>
          <th style="text-align: left!important">Nomor</th>
          <th style="text-align: left!important">Nama</th>
          <th style="text-align: left!important">Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $value)
        <tr>
          <td style="text-align: left!important">{{ $loop->iteration }}</td>
          <td style="text-align: left!important">{{ $value->name }}</td>
          <td style="text-align: left!important">{{ $value->is_publish ? 'Published' : 'Draft' }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection


@section('scripts')
<script>
  $(document).ready(function () {
    $('#myTable').DataTable();
  });
</script>
@endsection