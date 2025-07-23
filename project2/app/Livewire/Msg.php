<?php

namespace App\Livewire;

use Livewire\Component;

class Msg extends Component
{
    public $message = null;

    protected $listeners = ['flashMessage'];

    public function flashMessage($message)
    {
        $this->message = $message;
    }
    public function render()
    {
        return view('livewire.msg');
    }
}
