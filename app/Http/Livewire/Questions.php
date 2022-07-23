<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Poll;
use Illuminate\Support\Facades\Auth;

class Questions extends Component
{
    public $questionsArray = [];
    public $items = 0;

    protected $listeners = [
        'questionAdded' => 'questionAdded',
        'questionRemove' => 'questionRemove',
        'info' => 'info',
    ];

    //Runs on every request, before any other lifecycle methods are called
    public function boot()
    {
        if(old('question')) //if exist old variables
        {   
            foreach(old('question') as $key => $question)
            {
                $this->questionsArray[] = ['id' => $key, 'question' => old('question')[$key], 'type'=>old('type')[$key]];
            }
        }
        else if(session('currentPoll') && request()->routeIs('poll.edit') ) //if it is a poll editing page
        {
            $poll = Poll::where('user_id', Auth::id())->where('id', session('currentPoll'))->with('questions')->get();
            
            $this->questionsArray = [];
            $this->title = $poll[0]->title;
            $this->slug = $this->original_slug = $poll[0]->slug;
            $this->status = $poll[0]->status;

            foreach($poll[0]->questions as $key => $question)
            {
                $this->questionsArray[] = ['id' => $key, 'question' => $question->question, 'type'=>$question->type];
            }
            
        }

        $this->items = count($this->questionsArray);
    }

    //sorting questions
    public function reorder($orderedIds)
    {
        $this->questionsArray = collect($orderedIds)->map(function($id) {
            return collect($this->questionsArray)->where('id', (int) $id['value'])->first();
        })->toArray();
    }

    //add questions
    public function questionAdded()
    {
        array_push($this->questionsArray, ['id' => $this->items++, 'question' => '', 'type' => 'radio']);
    }

    //remove questions
    public function questionRemove(int $id)
    {
        foreach($this->questionsArray as $key => $question)
        {
            if($question['id'] == $id)
            {
                unset($this->questionsArray[$key]);
                break;
            }
        }
    }

    public function render()
    {
        return view('livewire.questions');
    }
}
