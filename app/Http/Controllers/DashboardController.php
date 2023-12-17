<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Membership;


use App\View\Components\UsersTable;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        if(!Auth::check()){
            return redirect('login');
        }

        $totalMemberCount = Member::count();
        $maleMemberCount = Member::where('gender', 'Erkek')->count();
        $femaleMemberCount = Member::where('gender', 'Kadın')->count();

        //Get the last 5 members from the database
        $lastFiveMembers = Member::orderBy('created_at', 'desc')->take(5)->get();

        $totalMemberCount = Membership::count();
        $activeMemberCount = Membership::whereDate('expiration_date', '>=', Carbon::now())->count();
        return view('dashboard')->with('members', $lastFiveMembers)->with('totalMemberCount', $totalMemberCount)->with('maleMemberCount', $maleMemberCount)->with('femaleMemberCount', $femaleMemberCount)->with('activeMemberCount', $activeMemberCount);
    }
}
