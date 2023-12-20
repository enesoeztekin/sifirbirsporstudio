@extends('layouts.panel')

@section('title', 'Paket Ekle')

@section('content')

    <p class="text-white text-2xl">Yeni Paket Oluştur</p>
    <form action="{{ route('add-package') }}" method="POST" class="max-w-md mt-10 flex flex-col gap-10">
        @csrf
    <div>
            <label for="package_name" class="text-white text-sm">Paket Adı:</label>
            <input type="text" id="package_name" name="package_name" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12 placeholder:text-gray-400" placeholder="Örneğin; 3 Aylık | Öğrenci (VIP)...">
    </div>
    <div>
        <label for="package_period" class="text-white text-sm">Paket Süresi (Ay):</label>
        <input type="text" id="package_period" name="package_period" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12 placeholder:text-gray-400" placeholder="Sayı olarak giriniz. Örn; 1, 3, 6, 12...">
    </div>
    <div>
        <label for="is_student" class="text-white text-sm block">Öğrenci indirimi var mı?</label>
        <label class="text-white text-sm flex flex-row items-center gap-2 mt-3">
            <input id="is_student" type="checkbox" name="is_student" value="1" class="text-white w-5 h-5">
            <span>Evet, var.</span>
        </label>
    </div>
    <div>
        <label for="is_vip" class="text-white text-sm block">VIP paket mi?</label>
        <label class="text-white text-sm flex flex-row items-center gap-2 mt-3">
            <input id="is_vip" type="checkbox" name="is_vip" value="1" class="text-white w-5 h-5">
            <span>Evet, var.</span>
        </label>
    </div>
    <div>
        <label for="package_cost" class="text-white text-sm">Paket Fiyatı (₺):</label>
        <input type="text" id="package_cost" name="package_cost" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12 placeholder:text-gray-400" placeholder="Sayı olarak giriniz. Örneğin: 750, 1500, 2000... ">
    </div>
    <div>
        <input type="submit" value="Oluştur" class="bg-amber-500 h-12 px-3 rounded-lg text-sm w-full">
    </div>
    </form>
@endsection
