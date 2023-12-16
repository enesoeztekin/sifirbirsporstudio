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

        $soldPackages = Membership::select('package_cost')->get();

        $totalProfit = 0;

        foreach ($soldPackages as $soldPackage) {
            $totalProfit += $soldPackage->package_cost;
        }

        $soldPackagesThisMonth = Membership::select('starting_date', 'package_cost')->whereMonth('starting_date', date('m'))->get();

        $totalProfitThisMonth = 0;

        foreach ($soldPackagesThisMonth as $soldPackageThisMonth) {
            $totalProfitThisMonth += $soldPackageThisMonth->package_cost;
        }

        //Get the last 5 members from the database
        $members = Member::orderBy('created_at', 'desc')->take(5)->get();

        $totalMemberCount = Membership::count();
        $activeMemberCount = Membership::whereDate('expiration_date', '>=', Carbon::now())->count();
        return view('dashboard')->with('members', $members)->with('totalProfit', $totalProfit)->with('totalProfitThisMonth', $totalProfitThisMonth)->with('totalMemberCount', $totalMemberCount)->with('activeMemberCount', $activeMemberCount);
    }
}
