<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MembersTable extends Component
{
    public $members;

    public function __construct($members)
    {
        $this->members = $members;
    }

    public function render()
    {
        return view('components.members-table'); // components klasöründe members-table.blade.php
    }
}
