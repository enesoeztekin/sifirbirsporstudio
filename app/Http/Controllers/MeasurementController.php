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
        $measurement = new Measurement();
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
            return redirect('measurements')->with('error', 'Ölçüm silinemedi! Lütfen tekrar deneyiniz.');
        }

        return redirect('measurements')->with('success', 'Ölçüm başarıyla silindi.');
    }

    public function getMeasurement($measurementId){
        $measurement = Measurement::find($measurementId);
        if(!$measurement){
            return redirect('measurements')->with('error', 'Ölçüm bulunamadı!');
        }

        $member = Member::find($measurement->member_id)->select('id', 'fullname', 'gender')->first();

        return view('editmeasurement')->with('measurement', $measurement)->with('member', $member);
    }

    public function update(Request $request, $measurementId){
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
