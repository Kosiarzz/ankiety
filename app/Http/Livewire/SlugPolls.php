<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Poll;
use Illuminate\Support\Str;

class SlugPolls extends Component
{
    public $title = 'Przykładowy tytuł';
    public $slug = '';
    public $error = '';

    public function render()
    {
        $issetSlug = Poll::where('slug', Str::slug($this->slug, '-'))->count();
        
        if($issetSlug > 0)
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
