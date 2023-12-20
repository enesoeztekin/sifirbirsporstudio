@extends('layouts.panel')

@section('title', 'Ölçüm Ekle')

@section('content')



    <p class="text-white text-2xl">Ölçüm Güncelle | {{$member->fullname}} ({{$measurement->created_at->format('d/m/Y - H:i:s')}} tarihli ölçüm)</p>
    <form action="{{ route('update-measurement', ['measurementId' => $measurement->id]) }}" method="POST" class="max-w-md mt-10 flex flex-col gap-10">
        @csrf
    <div>
        <label for="member" class="text-white text-sm">Üye Seçimi:</label>
        <select id="member" name="member" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12">
               <option value="{{$member->id}}">{{$member->fullname}} | {{$member->gender}}</option>
        </select>
    </div>
    <div>
        <label for="weight" class="text-white text-sm">Kilo (kg):</label>
        <input type="text" id="weight" value="{{ $measurement->weight }}" name="weight" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12 placeholder:text-gray-400" placeholder="Kilo giriniz.">
    </div>
    <div>
        <label for="arm" class="text-white text-sm">Kol (cm):</label>
        <input type="text" id="arm" value="{{ $measurement->arm }}" name="arm" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12 placeholder:text-gray-400" placeholder="Kol ölçüsünü giriniz.">
    </div>
    <div>
        <label for="chest" class="text-white text-sm">Göğüs (cm):</label>
        <input type="text" id="chest" value="{{ $measurement->chest }}" name="chest" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12 placeholder:text-gray-400" placeholder="Göğüs ölçüsünü giriniz.">
    </div>
    <div>
        <label for="shoulders" class="text-white text-sm">Omuz (cm):</label>
        <input type="text" id="shoulders" value="{{ $measurement->shoulders }}" name="shoulders" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12 placeholder:text-gray-400" placeholder="Omuz ölçüsünü giriniz.">
    </div>
    <div>
        <label for="waist" class="text-white text-sm">Bel (cm):</label>
        <input type="text" id="waist" value="{{ $measurement->waist }}" name="waist" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12 placeholder:text-gray-400" placeholder="Bel ölçüsünü giriniz.">
    </div>
    <div>
        <label for="legs" class="text-white text-sm">Bacak (cm):</label>
        <input type="text" id="legs" value="{{ $measurement->legs }}" name="legs" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12 placeholder:text-gray-400" placeholder="Bacak ölçüsünü giriniz.">
    </div>
    <div>
        <label for="hips" class="text-white text-sm">Kalça (cm):</label>
        <input type="text" id="hips" value="{{ $measurement->hips }}" name="hips" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12 placeholder:text-gray-400" placeholder="Kalça ölçüsünü giriniz.">
    </div>
    <div>
        <input type="submit" value="Güncelle" class="bg-amber-500 h-12 px-3 rounded-lg text-sm w-full cursor-pointer">
    </div>
    </form>
@endsection
