<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Measurement;
use App\Models\Member;

class MeasurementController extends Controller
{

    public function index(){
        if(!Auth::check()){
            return redirect('login');
        }
        $members = Member::all();
        return view('addmeasurement')->with('members', $members);
    }

    public function all(){
        if (!Auth::check()) {
            return redirect('login');
        }

        $members = Member::with([
            'measurements' => function ($query) {
                $query->orderBy('created_at', 'desc')->get();
            }
        ]
        )->whereHas('measurements')->select('id', 'fullname')->get();

        return view('measurements')->with('members', $members);
    }

    public function add(Request $request){
        if(!Auth::check()){
            return redirect('login');
        }

        $measurement = new Measurement();
        $measurement->member_id = $request->member;
        $measurement->weight = $request->weight ? $request->weight : 0;
        $measurement->arm = $request->arm ? $request->arm : 0;
        $measurement->chest = $request->chest ? $request->chest : 0;
        $measurement->shoulders = $request->shoulders ? $request->shoulders : 0;
        $measurement->waist = $request->waist ? $request->waist : 0;
        $measurement->legs = $request->legs ? $request->legs : 0;
        $measurement->hips = $request->hips ? $request->hips : 0;

        $result = $measurement->save();

        if(!$result){
            return redirect('measurements')->with('error', 'Ölçüm eklenemedi! Lütfen tekrar deneyiniz.');
        }

        return redirect('measurements')->with('success', 'Ölçüm başarıyla eklendi.');
    }

    public function delete($id){
        if (!Auth::check()) {
            return redirect('login');
        }

        $measurement = Measurement::find($id);

        if(!$measurement){
            return redirect('measurements')->with('error', 'Ölçüm bulunamadı!');
        }

        $result = $measurement->delete();

        if(!$result){
            return back()->with('error', 'Ölçüm silinemedi! Lütfen tekrar deneyiniz.');
        }

        return back()->with('success', 'Ölçüm başarıyla silindi.');
    }

    public function getMeasurement($measurementId){
        if(!Auth::check()){
            return redirect('login');
        }

        $measurement = Measurement::find($measurementId);
        if(!$measurement){
            return redirect('measurements')->with('error', 'Ölçüm bulunamadı!');
        }

        $member = Member::find($measurement->member_id)->select('id', 'fullname', 'gender')->first();

        return view('editmeasurement')->with('measurement', $measurement)->with('member', $member);
    }

    public function getMeasurementsByMemberId($memberId){
        if(!Auth::check()){
            return redirect('login');
        }

        $member = Member::where('id', $memberId)->select('id', 'fullname', 'gender')->first();
        $measurements = Measurement::where('member_id', $memberId)->orderBy('created_at', 'desc')->get();

        return view('membermeasurements')->with('member', $member)->with('measurements', $measurements);
    }

    public function getMemberForAddMemberMeasurement($memberId){
        if(!Auth::check()){
            return redirect('login');
        }

        $member = Member::where('id', $memberId)->select('id', 'fullname', 'gender')->first();
        if(!$member){
            return redirect('measurements')->with('error', 'Üye bulunamadı!');
        }
        return view('addmembermeasurement')->with('member', $member);
    }

    public function addMeasurementByMemberId(Request $request, $memberId){
        if(!Auth::check()){
            return redirect('login');
        }

        $measurement = new Measurement();
        $measurement->member_id = $memberId;
        $measurement->weight = $request->weight ? $request->weight : 0;
        $measurement->arm = $request->arm ? $request->arm : 0;
        $measurement->chest = $request->chest ? $request->chest : 0;
        $measurement->shoulders = $request->shoulders ? $request->shoulders : 0;
        $measurement->waist = $request->waist ? $request->waist : 0;
        $measurement->legs = $request->legs ? $request->legs : 0;
        $measurement->hips = $request->hips ? $request->hips : 0;

        $result = $measurement->save();

        if(!$result){
            return redirect('measurements/'.$memberId)->with('error', 'Ölçüm eklenemedi! Lütfen tekrar deneyiniz.');
        }

        return redirect('measurements/'.$memberId)->with('success', 'Ölçüm başarıyla eklendi.');
    }

    public function update(Request $request, $measurementId){
        if(!Auth::check()){
            return redirect('login');
        }

        $measurement = Measurement::find($measurementId);
        if(!$measurement){
            return redirect('measurements')->with('error', 'Ölçüm bulunamadı!');
        }

        $measurement->member_id = $request->member;
        $measurement->weight = $request->weight;
        $measurement->arm = $request->arm;
        $measurement->chest = $request->chest;
        $measurement->shoulders = $request->shoulders;
        $measurement->waist = $request->waist;
        $measurement->legs = $request->legs;
        $measurement->hips = $request->hips;

        $result = $measurement->save();

        if(!$result){
            return redirect('measurements')->with('error', 'Ölçüm güncellenemedi! Lütfen tekrar deneyiniz.');
        }

        return redirect('measurements')->with('success', 'Ölçüm başarıyla güncellendi.');
    }
}
