<div>
    <div class="col-12 px-0">
        <div class="px-4 py-5 chat-box bg-white" wire:poll>

          @foreach ($messages as $message)
          <div class="media w-50 {{ $message->from_user_id == Auth::user()->id ? 'ml-auto' : '' }} mb-3">
            @if ($message->from_user_id != Auth::user()->id)
                <img src="{{ asset($message->fromUser->image) }}" alt="Generic placeholder image" width="50" height="50" class="mr-3 rounded-circle">
            @endif
            <div class="media-body ml-3">
              <div class="{{$message->from_user_id == Auth::user()->id ? 'bg-primary' : 'bg-light'}} rounded py-2 px-3 mb-2">
                <p class="text-small mb-0 {{ $message->from_user_id == Auth::user()->id ? 'text-white' : 'text-muted' }}">{{ $message->message }}</p>
              </div>
              <p class="small text-muted">{{ $message->created_at->diffForHumans() }}</p>
            </div>
          </div>
          @endforeach

          <!-- Sender Message-->




          <!-- Reciever Message-->
          {{-- <div class="media w-50 ml-auto mb-3">
            <div class="media-body">
              <div class="bg-primary rounded py-2 px-3 mb-2">
                <p class="text-small mb-0 text-white">Test which is a new approach to have all solutions</p>
              </div>
              <p class="small text-muted">12:00 PM | Aug 13</p>
            </div>
          </div> --}}

        </div>

        <!-- Typing area -->
        <form action="" wire:submit.prevent="sendMessage" class="bg-light">
          <div class="input-group">
            <input type="text" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light" wire:model="message">
            <div class="input-group-append">
              <button id="button-addon2" type="submit" class="btn btn-primary">submit</button>
            </div>
          </div>
        </form>

      </div>
</div>
