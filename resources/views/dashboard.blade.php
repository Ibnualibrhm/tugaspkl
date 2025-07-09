@extends('layout-dashboard/partials/app')

@section('content')
<div class="mt-4">
  <div class="row">
    <div class="col-md-6">
      <div class="card p-3">
        <h2>Total User: {{ $totalUsers }}</h2>
      </div>
    </div>

    <div class="col-md-6">
    <div class="card p-3">
      <h2>Total Category: {{ $totalCategories }}</h2>
      </div>
    </div>
  </div>
</div>  
@endsection