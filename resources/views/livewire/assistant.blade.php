{{-- <div>
    <div>
        <h3>PEST Documentation Assistant</h3>
        <div>
            <p>Enter you question, and I will try to find an answer in the current Pest documentation.</p>
        </div>
        <form wire:submit.prevent="ask">
            <div>
                <label for="question">Question</label>
                <input type="text"
                       name="question"
                       wire:model="question"
                       placeholder="How to run a single test?"
                >
            </div>
            <button type="submit">
                <span wire:loading.class="invisible">Ask</span>
                <x-spinner class="absolute invisible" wire:loading.class.remove="invisible" />
            </button>
        </form>
        @if($answer)
            <h3 class="mt-8 mb-1 text-base font-semibold leading-6 text-gray-900">My answer</h3>
            <div class="mb-2 prose">
                {!! $answer !!}
            </div>
        @endif
    </div>
</div> --}}

<div class="d-lg-flex justify-content-lg-center align-items-lg-center mt-2">
    <div class="card" style="width: 50%;">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h4 class="mb-2">Asisten AI CocoHub</h4>
                    <h6 class="text-muted mb-2">Tanyakan pertanyaan seputar CocoHub:</h6>
                </div>
            </div>
            <div class="row mb-2">
                <form wire:submit.prevent="ask">
                    <div class="col-lg-9">
                        <div class="input-group">
                            <input class="form-control" type="text" name="question" wire:model="question" placeholder="Masukkan pertanyaan anda disini" maxlength="250" />
                            <button class="btn btn-primary" type="submit">Tanyakan</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col">
                    <h3>Jawaban:</h3>
                    <p>
                        @if ($answer)
                            {!! $answer!!}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
