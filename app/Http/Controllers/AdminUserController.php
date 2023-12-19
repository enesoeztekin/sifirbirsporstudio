<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function changePassword(Request $request){
        if(!Auth::check()){
            return redirect('login');
        }

        $newPassword = $request->input('newPassword');
        $reNewPassword = $request->input('reNewPassword');

        $adminUser = AdminUser::where('id', Auth::user()->id)->first();
        if(!Hash::check($request->input('curPassword'), $adminUser->password)){
            return back()->with('error', 'Mevcut şifrenizi hatalı girdiniz.');
        }

        if($newPassword != $reNewPassword){
            return back()->with('error', 'Yeni şifreler uyuşmuyor.');
        }

        $adminUser->password = Hash::make($newPassword);

        $result = $adminUser->save();

        if(!$result){
            return back()->with('error', 'Şifre değiştirilirken bir sorun oluştu.');
        }

        return back()->with('success', 'Şifre değiştirme işlemi başarılı.');
    }
}
