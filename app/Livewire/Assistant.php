<?php

namespace App\Livewire;

use Livewire\Component;
use OpenAI;
use OpenAI\Responses\Threads\Runs\ThreadRunResponse;

class Assistant extends Component
{
    public string $question = '';
    public ?string $answer = null;
    public ?string $error = null;

    private function createAndRunThread(): ThreadRunResponse
    {
        $apikey = getenv('OPENAI_API_KEY');
        $client = OpenAI::client($apikey);

        return $client->threads()->createAndRun([
            'assistant_id' => 'asst_3hTw9AlmOMX6kXmCwXYgd59Z',
            'thread' => [
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $this->question,
                    ],
                ],
            ],
        ]);
    }

    private function loadAnswer(ThreadRunResponse $threadRun)
    {
        $apikey = getenv('OPENAI_API_KEY');
        $client = OpenAI::client($apikey);

        while(in_array($threadRun->status, ['queued', 'in_progress'])) {
            $threadRun = $client->threads()->runs()->retrieve(
                threadId: $threadRun->threadId,
                runId: $threadRun->id,
            );
        }

        if ($threadRun->status !== 'completed') {
            $this->error = 'Request failed, please try again';
        }

        $messageList = $client->threads()->messages()->list(
            threadId: $threadRun->threadId,
        );

        $this->answer = $messageList->data[0]->content[0]->text->value;
    }

    public function ask()
    {
        $threadRun = $this->createAndRunThread();

        $this->loadAnswer($threadRun);
    }

    public function render()
    {
        return view('livewire.assistant');
    }
}
