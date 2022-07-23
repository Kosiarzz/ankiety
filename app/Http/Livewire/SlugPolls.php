<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Poll;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SlugPolls extends Component
{
    public $slug;
    public $original_slug = '';
    public $title;
    public $error = '';

    public function boot()
    {
        $poll = Poll::where('user_id', Auth::id())->where('id', session('currentPoll'))->get();

        if(old())
        {
            $this->slug = old('slug');
            $this->title = old('title');
        }
        else if(session('currentPoll') && request()->routeIs('poll.edit') )
        {
            $this->title = $poll[0]->title;
            $this->slug = $this->original_slug = $poll[0]->slug;
            $this->status = $poll[0]->status;
        }
    }

    public function render()
    {
        $issetSlug = Poll::where('slug', Str::slug($this->slug, '-'))->count();

        if($issetSlug > 0 && $this->original_slug != $this->slug)
        {
            $this->error = "Taki adres już istnieje!";
        }
        else
        {
            $this->error = '';
        }

        return view('livewire.slug-polls');
    }
}
