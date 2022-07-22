<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Poll;
use Illuminate\Support\Str;

class SlugPolls extends Component
{
    public $slug;
    public $title;
    public $error = '';

    public function boot()
    {
        $this->slug = old('slug');
        $this->title = old('title');
    }

    public function render()
    {
        $issetSlug = Poll::where('slug', Str::slug($this->slug, '-'))->count();

        if($issetSlug > 0 )
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
