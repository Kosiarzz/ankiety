<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Poll;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SlugPolls extends Component
{
    public $title = 'Przykładowy tytuł';
    public $original_slug = '';
    public $slug = '';
    public $error = '';

    public function boot()
    {
        if(session('currentPoll') && request()->routeIs('poll.edit') )
        {
            $poll = Poll::where('user_id', Auth::id())->where('id', session('currentPoll'))->get();

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
            $this->error = Str::slug($this->slug, '-');
        }

        return view('livewire.slug-polls');
    }
}
