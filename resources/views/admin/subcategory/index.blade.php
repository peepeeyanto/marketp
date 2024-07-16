@extends('admin.layouts.master')

@section('content')
    <section class="section">
      <div class="section-header">
        <h1>Subcategory</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Components</a></div>
          <div class="breadcrumb-item">Table</div>
        </div>
      </div>

      <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Edit kategori tambahan</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.subcategory.create') }}" class="btn btn-primary">Add</a>
                </div>
              </div>
              <div class="card-body">
                {{ $dataTable->table() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection

@push('script')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).ready(function(){
            $('body').on('click', '.change-status', function(){
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');
                $.ajax({
                    url: "{{ route('admin.subcategory.changeStatus') }}",
                    method: "PUT",
                    data: {
                        status: isChecked,
                        id: id,
                    },
                    success: function(data){
                        console.log(data);
                    },
                    error: function(lhr, status, error){
                        console.log(error);
                    },
                })
            });
        });
    </script>
@endpush
