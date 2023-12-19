@extends('layouts.panel')

@section('title', 'Ayarlar')

@section('content')

    <p class="text-white text-2xl">Ayarlar</p>
    <form action="{{ route('change-password') }}" method="post" class="max-w-md mt-10 flex flex-col gap-10">
        @csrf
        <div>
            <label for="curPassword" class="text-white text-sm">Mevcut Şifreniz:</label>
            <input type="password" id="curPassword" name="curPassword" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12 placeholder:text-gray-800" placeholder="Mevcut şifrenizi girin...">
        </div>
        <div>
            <label for="newPassword" class="text-white text-sm">Yeni Şifreniz:</label>
            <input type="password" id="newPassword" name="newPassword" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12 placeholder:text-gray-800" placeholder="Yeni şifrenizi girin...">
        </div>
        <div>
            <label for="reNewPassword" class="text-white text-sm">Yeni Şifreniz (Tekrar):</label>
            <input type="password" id="reNewPassword" name="reNewPassword" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12 placeholder:text-gray-800" placeholder="Yeni şifrenizi tekrar girin...">
        </div>
        <div>
            <input type="submit" value="Şifreyi Güncelle" class="bg-amber-500 h-12 px-3 rounded-lg text-sm w-full">
        </div>
    </form>
@endsection
