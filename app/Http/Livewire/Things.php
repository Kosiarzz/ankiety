<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Things extends Component
{
    public $things = [
        ['id' => 1, 'title' => 'Pytanie'],
        ['id' => 2, 'title' => 'Pytanie'],
    ];

    protected $listeners = [
        'questionAdded' => 'questionAdded',
        'questionRemove' => 'questionRemove',
    ];

    public function reorder($orderedIds)
    {
        $this->things = collect($orderedIds)->map(function($id) {
            return collect($this->things)->where('id', (int) $id['value'])->first();
        })->toArray();
    }

    public function questionAdded()
    {
        array_push($this->things, ['id' => count($this->things) + 1, 'title' => 'Pytanie']);
    }

    public function questionRemove(int $id)
    {
        #dd($this->things[$id-1]);
        unset($this->things[$id-1]);
    }

    public function render()
    {
        return view('livewire.things');
    }
}
