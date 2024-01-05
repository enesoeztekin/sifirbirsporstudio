<?php

namespace App\View\Components;

use Carbon\Carbon;
use Illuminate\View\Component;

class MembersTable extends Component
{
    public $members;
    public $isSorted;
    public $now;

    public function __construct($members, $isSorted = false, $now)
    {
        $this->members = $members;
        $this->isSorted = $isSorted;
        $this->now = $now;
    }

    public function render()
    {
        return view('components.members-table'); // components klasöründe members-table.blade.php
    }
}
