<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Membership;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{

    public function index(){
        if(!Auth::check()){
            return redirect('login');
        }

        $packages = Package::all();
        return view('packages')->with('packages', $packages);
    }

    public function getPackage($id){
        if(!Auth::check()){
            return redirect('login');
        }

        $package = Package::find($id);

        if(!$package){
            return redirect('packages')->withError('error', 'Paket bulunamadı.');
        }

        return view('editpackage')->with('package', $package);
    }

    public function getMembersByPackageId($id){
        if(!Auth::check()){
            return redirect('login');
        }

        $package = Package::with('memberships.member')->find($id);
        if(!$package){
            return redirect('packages')->withError('error', 'Paket bulunamadı.');
        }

        return view('packagemembers')->with('package', $package);
    }

    public function add(Request $request)
    {
        if(!Auth::check()){
            return redirect('login');
        }

        // Generating Package
        $package = new Package();
        $package->package_name = $request->package_name;
        $package->is_student = $request->input('is_student', 0);
        $package->is_vip = $request->input('is_vip', 0);
        $package->package_period = $request->package_period;
        $package->package_cost = $request->package_cost;
        if($package->package_period == 1){
            // For 1 month packages.
            $package->freeze_right_count = 0;
        }elseif ($package->package_period < 6 && $package->package_period >= 3){
            // For [3 - 6) = {3,4,5} months packages.
            $package->freeze_right_count = 1;
        }elseif($package->package_period >= 6 && $package->package_period < 12){
            // For [6, 12) = {6, 7, 8, 9, 10, 11} month packages.
            $package->freeze_right_count = 2;
        }elseif($package->package_period >= 12 && $package->package_period < 24){
            // For [12, 24) = {12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23} month packages.
            $package->freeze_right_count = 4;
        }

        //Saving package to database
        $result = $package->save();

        // Checking if an error occured during saving
        if(!$result){
            return redirect('packages')->withError('error', 'Bir şeyler yanlış gitti! Lütfen tekrar deneyiniz.');
        }

        return redirect('packages')->with('success', 'Paket eklendi.');
    }


    public function update(Request $request, $id)
    {
        if(!Auth::check()){
            return redirect('login');
        }

        // Veritabanından ilgili paketi bulun
        $package = Package::find($id);

        if (!$package) {
            return redirect('packages')->withError('error', 'Paket bulunamadı');
        }

        $validator = Validator::make($request->all(), [
            'package_name' =>'required',
            'package_period' =>'required',
            'package_cost' =>'required',
        ]);

        if ($validator->fails()) {
            return back()->withError('error', "Hata oluştu.");
        }

        $package->is_student = $request->input('is_student', 0);
        $package->is_vip = $request->input('is_vip', 0);

        // Gelen istek verilerini kullanarak paketi güncelleyin
        $package->update($request->except('_token'));

        // Başarıyla güncellendiğine dair bir cevap döndürün
        return redirect('packages')->with('success', 'Paket başarıyla güncellendi.');
    }

    public function delete($id){
        if(!Auth::check()){
            return redirect('login');
        }

        $package = Package::find($id);

        if (!$package) {
            return redirect('/packages')->with('error', 'Paket bulunamadı.');
        }

        $package->delete();

        return redirect('/packages')->with('success', 'Paket başarıyla silindi.');
    }


}
