@extends('layouts.panel')

@section('title', 'Üyelik Uzat')

@section('content')



    <p class="text-white text-2xl">{{$member->fullname}} | Üyelik Uzat</p>
    <form action="{{ route('extend-membership', ['memberId' => $member->id]) }}" method="POST" class="max-w-md mt-10 flex flex-col gap-10">
        @csrf
    <div>
        <label for="member" class="text-white text-sm">Paket Seçimi:</label>
        <select id="package" name="package" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12">
           @foreach ($packages as $package)
               <option value="{{$package->id}}">{{$package->package_name}} | {{$package->package_cost}}</option>
           @endforeach
        </select>
    </div>
    <div>
        <label for="startingdate" class="text-white text-sm">Üyelik Başlangıç Tarihi:</label>
        <input type="date" id="startingdate" value="" name="startingdate" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12 placeholder:text-gray-400">
    </div>
    <div>
        <input type="submit" value="Süre Uzat" class="bg-amber-500 h-12 px-3 rounded-lg text-sm w-full cursor-pointer">
    </div>
    </form>
@endsection
