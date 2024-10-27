@extends('admin.layouts.master')

@section('content')
    <section class="section">
      <div class="section-header">
        <h1>Ajuan Penarikan</h1>
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
                <h4>Setujui Penarikan</h4>
              </div>
              <div class="card-body">
                <form action="{{ route('admin.payout.approve.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="withdraw_id" value="{{$log->id}}">

                    <div class="form-group">
                        <label>One Time Password</label>
                        <input type="text" name="otp" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Approve</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
