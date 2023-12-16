<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Package;
use App\Models\Member;
use App\Models\Membership;
use Illuminate\Http\Request;
use DateTime;
use Carbon\Carbon;
use DateInterval;

use App\View\Components\UsersTable;

class MemberController extends Controller
{

    public function index(){
        if(!Auth::check()){
            return redirect('login');
        }

        $packages = Package::all();
        return view('addmember')->with('packages', $packages);
    }

    public function all(Request $request){
        if(!Auth::check()){
            return redirect('login');
        }

        // $members = Member::query();

        // if($request->has('vip')){
        //     $members->with([
        //         'membership',
        //         'membership.package' => function ($q) use ($request) {
        //             $q->where('is_vip', $request->get('vip'));
        //         }
        //     ]);
        // }

        // $members->select('id', 'fullname', 'email');

        // $members = $members->get();


        $members = Member::with([
            'membership'=>function($q){
                $q->get();
            },
        ])->select('id','fullname', 'email')->get();
        //dd(gettype($members[0]->membership->freeze_expiration_date));
        return view('members')->with('members', $members);
    }

    public function add(Request $request)
    {
        if(!Auth::check()){
           return redirect('login');
        }

        $request->validate([
            'fullname' =>'required',
            'age' =>'required',
            'job' =>'required',
            'gender' =>'required',
            'phone' =>'required',
            'email' =>'required',
            'package' => 'required',
        ]);

        //Creating a new member
        $member = new Member();
        $member->fullname = $request->input('fullname');
        $member->age = $request->input('age');
        $member->job = $request->input('job');

        if($request->input('gender') == "male"){
            $member->gender = "Erkek";
        }else if ($request->input('gender') == "female"){
            $member->gender = "Kadın";
        }else{
            $member->gender = "Diğer";
        }

        $member->phone = $request->input('phone');
        $member->email = $request->input('email');

        if(!$request->input('injury')){
            $member->injury = "-";
        }else{
            $member->injury = $request->input('injury');
        }

        $result = $member->save();

        // Checking if an error occured during saving
        if(!$result){
            return redirect('add-member')->with('error', 'Bir şeyler yanlış gitti! Lütfen tekrar deneyiniz.');
        }


        //Creating a new membership.
        $membership = new Membership();

        $membership->member_id = $member->id;
        // Retrieve a package by package_id from database
        $package_id = $request->input('package');
        $package = Package::find($package_id);
        $membership->starting_date = Carbon::now('Turkey');
        $months_to_add = $package->package_period;
        $starting_date = Carbon::now('Turkey');
        $membership->expiration_date = Carbon::parse($starting_date)->addMonth($months_to_add);
        $membership->package_period = $package->package_period;
        $membership->is_student = $package->is_student;
        $membership->is_vip = $package->is_vip;
        $membership->package_cost = $package->package_cost;
        $membership->freeze_right_count = $package->freeze_right_count;

        $result = $membership->save();

        if(!$result){
            return redirect('add-member')->with('error', 'Üyelik oluştururken hata ile karşılaşıldı. Lütfen tekrar deneyin.');
        }

        return redirect('members')->with('success', 'Üye eklendi.');
    }


    public function update(Request $request)
    {


    }

    public function delete($id){
        if(!Auth::check()){
            return redirect('login');
        }

        $member = Member::find($id);

        if(!$member){
            return redirect('members')->with('error', 'Üye bulunamadı.');
        }

        $member->delete();

        return redirect('members')->with('success', 'Üye silindi.');
    }


    public function freeze($memberId){
        if(!Auth::check()){
            return redirect('login');
        }

        // Find membership by member_id from database
        $membership = Membership::where('member_id', $memberId)->where('freeze_right_count', '>', 0)->first();

        if(!$membership){
            return redirect('members')->with('error', 'Üyelik (dondurma hakkı) bulunamadı.');
        }

        $membership->is_freezed = 1;
        $membership->freeze_right_count--;
        $membership->freeze_starting_date = Carbon::today();
        $freeze_starting_date = Carbon::today();
        $max_freezing_period = 1; // as Month
        $membership->freeze_expiration_date = Carbon::parse($freeze_starting_date)->addMonth($max_freezing_period);
        $result = $membership->save();

        if(!$result){
            return redirect('members')->with('error', 'Üyelik dondurma işlemi başarısız. Lütfen tekrar deneyin.');
        }

        return redirect('members')->with('success', 'Üyelik donduruldu.');
    }

    public function unfreeze($memberId){
        if(!Auth::check()){
            return redirect('login');
        }

        // Find membership that is_freezed equals 1 by member_id from database
        $membership = Membership::where('member_id', $memberId)->where('is_freezed', 1)->first();

        if(!$membership){
            return redirect('members')->with('error', 'Dondurulmuş üyelik bulunamadı.');
        }

        $membership->is_freezed = 0;

        // Calculate the freezing days by extracting the difference between the starting date and the current date
        $freezing_days = Carbon::parse($membership->freeze_starting_date)->diffInDays(Carbon::today());

        //Add freezing days to the expiration date
        $membership->expiration_date = Carbon::parse($membership->expiration_date)->addDays($freezing_days);

        //dd("Freeze Starting Date: ", Carbon::parse($membership->freeze_starting_date)->format('d/m/Y'), "Today:", Carbon::today()->format('d/m/Y'), "Freezing Days: ", $freezing_days, "New Exp Date:", $membership->expiration_date->format('d/m/Y'));

        $membership->freeze_starting_date = NULL;
        $membership->freeze_expiration_date = NULL;
        $result = $membership->save();

        if(!$result){
            return redirect('members')->with('error', 'Üyelik dondurma işlemi başarısız. Lütfen tekrar deneyin.');
        }

        return redirect('members')->with('success', 'Üyelik aktif edildi.');
    }


}
