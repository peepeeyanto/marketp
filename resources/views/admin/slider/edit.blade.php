@extends('admin.layouts.master')

@section('content')
    <section class="section">
      <div class="section-header">
        <h1>Slider</h1>
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
                <h4>Edit Slider</h4>
              </div>
              <div class="card-body">
                <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label>Preview</label>
                        <br>
                        <img width="200px" src="{{ asset($slider->banner) }}">
                    </div>
                    <div class="form-group">
                        <label>Banner</label>
                        <input type="file" name="banner" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <input type="text" name="type" class="form-control" value="{{ $slider->type}}">
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $slider->title }}">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control" value="{{ $slider->startPrice }}">
                    </div>
                    <div class="form-group">
                        <label>Button URL</label>
                        <input type="text" name="buttonurl" class="form-control" value="{{ $slider->buttonURL }}">
                    </div>
                    <div class="form-group">
                        <label>Serial</label>
                        <input type="text" name="serial" class="form-control" value="{{ $slider->serial }}">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option {{ $slider->status == 1 ? 'selected':'' }} value="1">Active</option>
                            <option {{ $slider->status == 0 ? 'selected':'' }} value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
