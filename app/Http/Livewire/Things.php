<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Poll;
use Illuminate\Support\Facades\Auth;

class Things extends Component
{
    public $things = [];
    public $items = 0;

    protected $listeners = [
        'questionAdded' => 'questionAdded',
        'questionRemove' => 'questionRemove',
        'info' => 'info',
    ];

    public function boot()
    {
        if(old())
        {   
            foreach(old('question') as $key => $question)
            {
                $this->things[] = ['id' => $key, 'question' => old('question')[$key], 'type'=>old('type')[$key]];
            }
        }
        else if(session('currentPoll') && request()->routeIs('poll.edit') )
        {
            $poll = Poll::where('user_id', Auth::id())->where('id', session('currentPoll'))->with('questions')->get();
            
            $this->things = [];
            $this->title = $poll[0]->title;
            $this->slug = $this->original_slug = $poll[0]->slug;
            $this->status = $poll[0]->status;

            foreach($poll[0]->questions as $key => $question)
            {
                $this->things[] = ['id' => $key, 'question' => $question->question, 'type'=>$question->type];
            }
            
        }

        $this->items = count($this->things);
    }

    public function reorder($orderedIds)
    {
        $this->things = collect($orderedIds)->map(function($id) {
            return collect($this->things)->where('id', (int) $id['value'])->first();
        })->toArray();
    }

    public function questionAdded()
    {
        array_push($this->things, ['id' => $this->items++, 'question' => '', 'type' => 'radio']);
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
