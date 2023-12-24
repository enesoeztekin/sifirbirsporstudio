<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MembersTable extends Component
{
    public $members;
    public $isSorted;

    public function __construct($members, $isSorted = false)
    {
        $this->members = $members;
        $this->isSorted = $isSorted;
    }

    public function render()
    {
        return view('components.members-table'); // components klasöründe members-table.blade.php
    }
}
