@extends('layouts.panel')

@section('title', 'Paketi Düzenle')

@section('content')

    <p class="text-white text-2xl">Paketi Düzenle</p>
    <form action="{{ route('update-package', ['id' => $package->id]) }}" method="POST" class="max-w-md mt-10 flex flex-col gap-10">
        @csrf
    <div>
            <label for="package_name" class="text-white text-sm">Paket Adı:</label>
            <input type="text" id="package_name" value="{{$package->package_name}}" name="package_name" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12 placeholder:text-gray-800" placeholder="Örneğin; 3 Aylık | Öğrenci (VIP)...">
    </div>
    <div>
        <label for="package_period" class="text-white text-sm">Paket Süresi (Ay):</label>
        <input type="text" id="package_period" value="{{$package->package_period}}" name="package_period" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12 placeholder:text-gray-800" placeholder="Sayı olarak giriniz. Örn; 1, 3, 6, 12...">
    </div>
    <div>
        <label for="is_student" class="text-white text-sm block">Öğrenci indirimi var mı?</label>
        <label class="text-white text-sm flex flex-row items-center gap-2 mt-3">
            <input id="is_student" type="checkbox" name="is_student" value="1" class="text-white w-5 h-5" {{ $package->is_student == 1 ? 'checked' : '' }}>
            <span>Evet, var.</span>
        </label>
    </div>
    <div>
        <label for="is_vip" class="text-white text-sm block">VIP paket mi?</label>
        <label class="text-white text-sm flex flex-row items-center gap-2 mt-3">
            <input id="is_vip" type="checkbox" name="is_vip" value="1" class="text-white w-5 h-5" {{ $package->is_vip == 1 ? 'checked' : '' }}>
            <span>Evet, var.</span>
        </label>
    </div>
    <div>
        <label for="package_cost" class="text-white text-sm">Paket Fiyatı (₺):</label>
        <input type="text" id="package_cost" value="{{$package->package_cost}}" name="package_cost" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12 placeholder:text-gray-800" placeholder="Sayı olarak giriniz. Örneğin: 750, 1500, 2000... ">
    </div>
    <div>
        <input type="submit" value="Oluştur" class="bg-amber-500 h-12 px-3 rounded-lg text-sm w-full">
    </div>
    </form>
@endsection
