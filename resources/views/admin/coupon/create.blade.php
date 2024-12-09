@extends('admin.layouts.master')

@section('content')
    <section class="section">
      <div class="section-header">
        <h1>Kupon</h1>
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
                <h4>Buat kupon</h4>
              </div>
              <div class="card-body">
                <form action="{{ route('admin.coupons.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Kode</label>
                        <input type="text" name="code" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>qty</label>
                        <input type="text" name="qty" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Maksimum per pengguna</label>
                        <input type="text" name="max_use" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal mulai</label>
                                <input type="text" name="start" class="form-control datepicker">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal kadaluarsa</label>
                                <input type="text" name="end" class="form-control datepicker">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputState">Tipe diskon</label>
                                <select name="type" id="inputState" class="form-control">
                                     <option value="1">Persen (%)</option>
                                     <option value="2">Nominal (Rp.)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                             <div class="form-group">
                                <label for="val">Nilai diskon</label>
                                <input type="text" name="value" id="val" class="form-control">
                             </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
