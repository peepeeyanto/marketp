@extends('seller.layouts.master')

@section('title')
COCOHub - Chat List
@endsection

@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content">
            <h3><i class="fal fa-gift-card"></i> Chat</h3>
            <div class="wsus__dashboard_add">
                <div class="row">
                    <!-- Users box-->
                    <div class="col-12 px-0">
                      <div class="bg-white">

                        <div class="bg-gray px-4 py-2 bg-light">
                          <p class="h5 mb-0 py-1">Recent</p>
                        </div>

                        <div class="messages-box">
                          <div class="list-group rounded-0">

                            @foreach ($messages as $message)
                                @if ($message['from_user_id'] == Auth::user()->id)
                                    <a href="{{ route('user.chat', $message['to_user_id']) }}" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                                        <div class="media">
                                            <div class="media-body ml-4">
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                <h6 class="mb-0">{{ $message->toUser->name }}</h6><small class="small font-weight-bold">14 Dec</small>
                                                </div>
                                                <p class="font-italic text-muted mb-0 text-small">{{ $message->message }}</p>
                                            </div>
                                        </div>
                                    </a>
                                @else
                                <a href="{{ route('user.chat', $message['from_user_id']) }}" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                                    <div class="media">
                                        <div class="media-body ml-4">
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                            <h6 class="mb-0">{{ $message->fromUser->name }}</h6><small class="small font-weight-bold">14 Dec</small>
                                            </div>
                                            <p class="font-italic text-muted mb-0 text-small">{{ $message->message }}</p>
                                        </div>
                                    </div>
                                </a>
                                @endif
                            @endforeach



                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Chat Box-->
                  </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
