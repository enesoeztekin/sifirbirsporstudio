@extends('layouts.panel')

@section('title', 'Üye Ekle')

@section('content')



    <p class="text-white text-2xl">Yeni Üye Oluştur</p>
    <form action="{{ route('add-member') }}" method="POST" class="max-w-md mt-10 flex flex-col gap-10">
        @csrf
    <div>
            <label for="fullname" class="text-white text-sm"><span class="text-red-600 font-bold">*</span> Adı Soyadı:</label>
            <input type="text" value="{{ old('fullname') }}" id="fullname" name="fullname" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12 placeholder:text-gray-400" placeholder="Tam adı girin.">
    </div>
    <div>
        <label for="age" class="text-white text-sm"><span class="text-red-600 font-bold">*</span> Yaş:</label>
        <input type="text" id="age" value="{{ old('age') }}" name="age" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12 placeholder:text-gray-400" placeholder="Üyenin yaşını girin.">
    </div>
    <div>
        <label for="job" class="text-white text-sm">Meslek:</label>
        <input type="text" id="job" value="{{ old('job') }}" name="job" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12 placeholder:text-gray-400" placeholder="Meslek bilgisi ekleyin.">
    </div>
    <div>
        <label for="gender" class="text-white text-sm"><span class="text-red-600 font-bold">*</span> Cinsiyet:</label><br>

       <div class="flex gap-3 mt-2">
         <div>
             <input type="radio" id="male" name="gender" value="male" class="ml-1">
             <label for="male" class="text-white text-sm">Erkek</label><br>
         </div>

         <div>
             <input type="radio" id="female" name="gender" value="female" class="ml-1">
             <label for="female" class="text-white text-sm">Kadın</label><br>
         </div>

         <div>
             <input type="radio" id="other" name="gender" value="other" class="ml-1">
             <label for="other" class="text-white text-sm">Diğer</label><br>
         </div>
       </div>
    </div>
    <div>
        <label for="phone" class="text-white text-sm"><span class="text-red-600 font-bold">*</span> Telefon Numarası:</label>
        <input type="text" id="phone" value="{{ old('phone') }}" name="phone" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12 placeholder:text-gray-400" placeholder="+90 (5__) ____">
    </div>
    <div>
        <label for="email" class="text-white text-sm">E-mail Adresi:</label>
        <input type="text" id="email" value="{{ old('email') }}" name="email" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12 placeholder:text-gray-400" placeholder="E-posta adresini girin.">
    </div>
    <div>
        <label for="injury" class="text-white text-sm">Spor yapmaya engel bir sakatlık?</label>
        <input type="text" id="injury" value="{{ old('injury') }}" name="injury" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12 placeholder:text-gray-400" placeholder="Sakatlık yoksa (-) yazın.">
    </div>
    <div>
        <label for="startingdate" class="text-white text-sm">Üyelik Başlangıç Tarihi:</label>
        <input type="date" id="startingdate" value="{{ old('startingdate') }}" name="startingdate" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12 placeholder:text-gray-400">
    </div>
    <div>
        <label for="package" class="text-white text-sm"><span class="text-red-600 font-bold">*</span> Paket Seçimi:</label>
        <select id="package" name="package" class="block mt-3 py-2 px-4 w-full rounded-lg text-sm h-12">
           @foreach ($packages as $package)
               <option value="{{$package->id}}">{{$package->package_name}} / {{$package->package_cost}} ₺</option>
           @endforeach
        </select>
    </div>
    <div>
        <input type="submit" value="Oluştur" class="bg-amber-500 h-12 px-3 rounded-lg text-sm w-full cursor-pointer">
    </div>
    </form>

    <script>
       document.addEventListener("DOMContentLoaded", function () {
    const phoneInput = document.getElementById("phone");

    phoneInput.addEventListener("input", function (event) {
        let phoneNumber = event.target.value.replace(/\D/g, ""); // Remove non-numeric characters
        const phoneNumberLength = phoneNumber.length;

        if (phoneNumberLength > 0 && phoneNumberLength < 3) {
            if(event.target.value == 0){
                phoneNumber = "+90"
            }else{
                phoneNumber = "+90" + phoneNumber;
            }
        } else if (phoneNumberLength >= 3 && phoneNumberLength < 6) {
            phoneNumber = "+" + phoneNumber.substring(0, 2) + " (" + phoneNumber.substring(2); // Keep the entered digits after +XX
        } else if (phoneNumberLength >= 6 && phoneNumberLength < 10) {
            phoneNumber = "+" + phoneNumber.substring(0, 2) + " (" + phoneNumber.substring(2, 5) + ") " + phoneNumber.substring(5); // Keep the entered digits after +XX (XXX)
        } else if (phoneNumberLength >= 10) {
            phoneNumber = "+" + phoneNumber.substring(0, 2) + " (" + phoneNumber.substring(2, 5) + ") " + phoneNumber.substring(5, 8) + " " + phoneNumber.substring(8, 12); // Keep the entered digits after +XX (XXX) XXX
        }

        event.target.value = phoneNumber;
    });
});

    </script>
@endsection
