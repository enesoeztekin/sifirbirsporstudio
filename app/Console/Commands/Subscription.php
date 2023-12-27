<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Membership;
use App\Models\Member;
use Carbon\Carbon;
use NetGsm\Sms\SmsSend;

class Subscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now("Europe/Istanbul");
        $fiveDaysLater = $now->copy()->addDays(7);

        $membershipsEndsIn5Days = Membership::where('expiration_date', '<=', $fiveDaysLater)
                                            ->where('expiration_date', '>', $now)
                                            ->get();

        foreach ($membershipsEndsIn5Days as $membership) {
            $member = Member::find($membership->member_id);
            if ($member) {
                $remainingDays = $now->diffInDays($membership->expiration_date);
                if($remainingDays == 5){
                    $this->info("Sayın, " . $member->fullname . " üyeliğiniz " . $remainingDays . " gün içerisinde sonlanacaktır. SıfırBirSporStudio");
                    // $sms=new SmsSend;
                    // $data=array(
                    //     'msgheader'=>"",
                    //     'gsm'=>'553XXXXXXX',
                    //     'message'=>'Merhaba',
                    //     'filter'=>'0',
                    //     'startdate'=>'270120230950',
                    //     'stopdate'=>'270120231030',
                    // );

                    // $sonuc=$sms->smsgonder1_1($data);
                    // dd($sonuc);
                    // die;
                }
            }
        }

        return Command::SUCCESS;
    }
}
