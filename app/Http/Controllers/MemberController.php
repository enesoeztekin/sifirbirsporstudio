<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Package;
use App\Models\Member;
use App\Models\Membership;
use App\Models\Transaction;
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
        ])->select('id','fullname', 'email', 'phone')->get();
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
            'gender' =>'required',
            'phone' =>'required',
            'package' => 'required',
        ]);

        //Creating a new member
        $member = new Member();
        $member->fullname = $request->input('fullname');
        $member->age = $request->input('age');
        $member->job = $request->input('job') ? $request->input('job') : "-";

        if($request->input('gender') == "male"){
            $member->gender = "Erkek";
        }else if ($request->input('gender') == "female"){
            $member->gender = "Kadın";
        }else{
            $member->gender = "Diğer";
        }

        $member->phone = $request->input('phone');
        $member->email = $request->input('email') ? $request->input('email') : "-";
        $member->injury = $request->input('injury') ? $request->input('injury') : "-";

        $result = $member->save();

        // Checking if an error occured during saving
        if(!$result){
            return back()->with('error', 'Bir şeyler yanlış gitti! Lütfen tekrar deneyiniz.');
        }


        //Creating a new membership.
        $membership = new Membership();

        $membership->member_id = $member->id;
        // Retrieve a package by package_id from database
        $package_id = $request->input('package');
        $package = Package::find($package_id);
        $membership->package_id = $package_id;
        $membership->starting_date = $request->input('startingdate') ? Carbon::parse($request->input('startingdate'))->setTimezone('Turkey') : Carbon::now('Turkey');
        $months_to_add = $package->package_period;
        $starting_date = $request->input('startingdate') ? Carbon::parse($request->input('startingdate'))->setTimezone('Turkey') : Carbon::now('Turkey');
        $membership->expiration_date = Carbon::parse($starting_date)->addMonth($months_to_add);
        $membership->package_period = $package->package_period;
        $membership->is_student = $package->is_student;
        $membership->is_vip = $package->is_vip;
        $membership->package_cost = $package->package_cost;
        $membership->freeze_right_count = $package->freeze_right_count;

        $result = $membership->save();

        if(!$result){
            return back()->with('error', 'Üyelik oluştururken hata ile karşılaşıldı. Lütfen tekrar deneyin.');
        }

        //Creating a new transaction.
        $transaction = new Transaction();
        $transaction->member_id = $member->id;
        $transaction->name = $package->package_name . " Paket Satışı". " -> ". $member->fullname;
        $transaction->created_at = Carbon::now('Turkey');
        $transaction->amount = $package->package_cost;

        $result = $transaction->save();

        if(!$result){
            return back()->with('error', 'üyelik oluşturuldu fakat işlem oluşturulamadı. Muhasabe sayfasından işlem ekleyin.');
        }


        return redirect('members')->with('success', 'Üye eklendi.');
    }

    public function getMember($id){
        if(!Auth::check()){
            return redirect('login');
        }

        $member = Member::with(
            [
                'membership' => function ($q) {
                    $q->get();
                },
                'membership.package' => function ($q) {
                    $q->get();
                }
            ]
        )->where('id', $id)->first();


        if(!$member){
            return back()->with('error', 'Üye bulunamadı.');
        }

        $packages = Package::all();

        return view('editmember')->with('member', $member)->with('packages', $packages);
    }


    public function update(Request $request, $id)
    {
        if(!Auth::check()){
            return redirect('login');
        }

        $member = Member::find($id);
        $member->fullname = $request->input('fullname');
        $member->age = $request->input('age');
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

        if(!$result){
            return back()->with('error', 'Üye güncellenemedi. Lütfen tekrar deneyin.');
        }

        // Update membership of the member
        $membership = Membership::where('member_id', $id)->first();
        $package_id = $request->input('package');
        $package = Package::where('id', $package_id)->first();

        // Package changed:
        if($membership->package_id != $package_id){
            $old_package_id = $membership->package_id;
            $old_package_name = Package::where('id', $old_package_id)->first()->package_name;
            $old_package_cost = Package::where('id', $old_package_id)->first()->package_cost;
            $new_package_cost = $package->package_cost;

            $membership->package_id = $package_id;
            $membership->package_period = $package->package_period;
            $membership->is_student = $package->is_student;
            $membership->is_vip = $package->is_vip;
            $membership->package_cost = $package->package_cost;

            // Add the new package period to the old starting date of membership.
            $months_to_add = $package->package_period;
            $starting_date = $membership->starting_date;
            $membership->expiration_date = Carbon::parse($starting_date)->addMonth($months_to_add);
            $membership->freeze_right_count = $package->freeze_right_count;

            // Add a new transaction.
            $transaction = new Transaction();
            $transaction->member_id = $membership->member_id;
            $transaction->name = $old_package_name." -> ".$package->package_name." Paket Değişikliği". "  (".$member->fullname.")";
            $transaction->created_at = Carbon::now('Turkey');
            $transaction->amount = $new_package_cost - $old_package_cost;
            $result = $transaction->save();
            if(!$result){
                return back()->with('error', 'Üyenin paketi güncellendi fakat muhasebe kaydı eklenmedi.');
            }
        }

        // Starting date changed:
        if($request->input('startingdate') && $request->input('startingdate') != $membership->starting_date){
            $membership->starting_date = Carbon::parse($request->input('startingdate'))->setTimezone('Turkey');

            // Both package and starting date changed:
            if($membership->package_id != $package_id){
                $membership->package_id = $package_id;
                $months_to_add = $package->package_period;
                $starting_date = $request->input('startingdate');
                $membership->expiration_date = Carbon::parse($starting_date)->addMonth($months_to_add);
                $membership->freeze_right_count = $package->freeze_right_count;
            }else { // Only starting date changed, package stays the same:
                $months_to_add = $membership->package_period;
                $starting_date = $request->input('startingdate');
                $membership->expiration_date = Carbon::parse($starting_date)->addMonth($months_to_add);
            }
        }
        $result = $membership->save();

        if(!$result){
            return back()->with('error', 'Üye güncellenemedi. Lütfen tekrar deneyin.');
        }

        return redirect('members')->with('success', 'Üye güncellendi.');

    }

    public function delete($id){
        if(!Auth::check()){
            return redirect('login');
        }

        $member = Member::find($id);

        if(!$member){
            return back()->with('error', 'Üye bulunamadı.');
        }

        $membership = Membership::where('member_id', $id)->first();


        $member->delete();
        $membership->delete();

        return back()->with('success', 'Üye silindi.');
    }

    public function cancel($id){
        if(!Auth::check()){
            return redirect('login');
        }

        $member = Member::find($id);

        if(!$member){
            return back()->with('error', 'Üye bulunamadı.');
        }


        $membership = Membership::where('member_id', $id)->first();
        $transaction = Transaction::where('member_id', $id)->first();

        $member->delete();
        $membership->delete();
        $transaction->delete();

        return back()->with('success', 'Üyelik iptal edildi.s');
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

    public function extendMembership($memberId){
        if(!Auth::check()){
            return redirect('login');
        }

        $packages = Package::all();
        $member = Member::where('id', $memberId)->select('id', 'fullname')->first();

        if(!$member){
            return back()->with('error', 'Üye bulunamadı.');
        }

        return view('extendmembership')->with('packages', $packages)->with('member', $member);
    }

    public function extend($memberId, Request $request){
        if(!Auth::check()){
            return redirect('login');
        }

        $package = Package::find($request->package);
        if(!$package){
            return back()->with('error', 'Paket bulunamadı.');
        }

        $member = Member::find($memberId)->first();

        if(!$member){
            return back()->with('error', 'Üye bulunamadı.');
        }

        $membership = Membership::where('member_id', $memberId)->first();

        if(!$membership){
            return back()->with('error', 'Üye bulunamadı.');
        }

        $membership->package_id = $package->id;
        if($request->startingdate != NULL){
            $membership->starting_date = Carbon::parse($request->startingdate)->setTimezone('Turkey');
            $membership->package_period = $package->package_period;
            $membership->expiration_date = Carbon::parse($request->startingdate)->addMonth($package->package_period);

        }else {
            $membership->package_period += $package->package_period;
            $membership->expiration_date = Carbon::parse($membership->expiration_date)->addMonth($package->package_period);
        }
        $result = $membership->save();
        if(!$result){
            return back()->with('error', 'Üyelik uzatma işlemi başarısız. Lütfen tekrar deneyin.');
        }

        $transaction = new Transaction();
        $transaction->member_id = $membership->member_id;
        $transaction->name = $package->package_name." Paketi Uzatma". "  (".$member->fullname.")";
        $transaction->created_at = Carbon::now('Turkey');
        $transaction->amount = $package->package_cost;
        $result = $transaction->save();

        if(!$result){
            return back()->with('error', 'Üyelik uzatma işlemi başarısız. Lütfen tekrar deneyin.');
        }

        return redirect('members')->with('success', 'Üyelik uzatma işlemi başarılı.');
    }


}
