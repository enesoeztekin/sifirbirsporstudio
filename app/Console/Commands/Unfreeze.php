<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Membership;
use App\Models\Member;

class Unfreeze extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unfreeze';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Unfreezes the members whose freezing end date is today';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today("Turkey");
        $memberships = Membership::where('freeze_expiration_date', '=', $today)->get();
        foreach ($memberships as $membership) {
            $member = Member::find($membership->member_id);
            if ($member) {
                $this->info("Sayın, " . $member->fullname . " dondurma süreniz dolduğundan üyeliğinizin otomatik olarak tekrardan aktif edilmiştir.");
                $daysToAdd = 30; // Max dondurma süresi = 30 gün.
                $membership->is_freezed = 0;
                $membership->expiration_date = Carbon::parse($membership->expiration_date)->addDays($daysToAdd);
                $membership->freeze_starting_date = NULL;
                $membership->freeze_expiration_date = NULL;
                $membership->save();
                return Command::SUCCESS;
            }
        }
    }
}
