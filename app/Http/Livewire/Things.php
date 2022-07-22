<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Poll;
use Illuminate\Support\Facades\Auth;

class Things extends Component
{
    public $things = [];
    public $dasdas = 0;

    protected $listeners = [
        'questionAdded' => 'questionAdded',
        'questionRemove' => 'questionRemove',
        'info' => 'info',
    ];

    public function boot()
    {
        if(old('question'))
        {   
            foreach(old('question') as $key => $question)
            {
                $this->things[] = ['id' => $key, 'question' => old('question')[$key], 'type'=>old('type')[$key]];
            }
        }

        if(session('currentPoll') && request()->routeIs('poll.edit') )
        {
            $polls = Poll::where('user_id', Auth::id())->where('id', session('currentPoll'))->with('questions')->get();
            
            $this->things = [];

            foreach($polls as $poll)
            {
                foreach($poll->questions as $key => $question)
                {
                    $this->things[] = ['id' => $key, 'question' => $question->question, 'type'=>$question->type];
                }
            }
        }

        $this->dasdas = count($this->things);
    }

    public function reorder($orderedIds)
    {
        $this->things = collect($orderedIds)->map(function($id) {
            return collect($this->things)->where('id', (int) $id['value'])->first();
        })->toArray();
    }

    public function questionAdded()
    {
        array_push($this->things, ['id' => $this->dasdas++, 'question' => '', 'type' => 'radio']);
    }

    public function questionRemove(int $id)
    {
        foreach($this->things as $key => $thing)
        {
            if($thing['id'] == $id)
            {
                unset($this->things[$key]);
                break;
            }
        }
    }

    public function render()
    {
        return view('livewire.things');
    }
}
