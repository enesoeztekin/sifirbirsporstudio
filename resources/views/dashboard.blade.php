@extends('layouts.panel')

@section('title', 'Dashboard')

@section('content')

<p class="text-white text-2xl">Genel Bakış</p>
<div class="mt-10">
    <div class="flex flex-wrap -mx-6">
        <div class="w-full px-6 sm:w-1/2 xl:w-1/4">
            <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                <div class="p-3 bg-indigo-600 bg-opacity-75 rounded-full"><svg class="w-8 h-8 text-white"
                        viewBox="0 0 28 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M18.2 9.08889C18.2 11.5373 16.3196 13.5222 14 13.5222C11.6804 13.5222 9.79999 11.5373 9.79999 9.08889C9.79999 6.64043 11.6804 4.65556 14 4.65556C16.3196 4.65556 18.2 6.64043 18.2 9.08889Z"
                            fill="currentColor"></path>
                        <path
                            d="M25.2 12.0444C25.2 13.6768 23.9464 15 22.4 15C20.8536 15 19.6 13.6768 19.6 12.0444C19.6 10.4121 20.8536 9.08889 22.4 9.08889C23.9464 9.08889 25.2 10.4121 25.2 12.0444Z"
                            fill="currentColor"></path>
                        <path
                            d="M19.6 22.3889C19.6 19.1243 17.0927 16.4778 14 16.4778C10.9072 16.4778 8.39999 19.1243 8.39999 22.3889V26.8222H19.6V22.3889Z"
                            fill="currentColor"></path>
                        <path
                            d="M8.39999 12.0444C8.39999 13.6768 7.14639 15 5.59999 15C4.05359 15 2.79999 13.6768 2.79999 12.0444C2.79999 10.4121 4.05359 9.08889 5.59999 9.08889C7.14639 9.08889 8.39999 10.4121 8.39999 12.0444Z"
                            fill="currentColor"></path>
                        <path
                            d="M22.4 26.8222V22.3889C22.4 20.8312 22.0195 19.3671 21.351 18.0949C21.6863 18.0039 22.0378 17.9556 22.4 17.9556C24.7197 17.9556 26.6 19.9404 26.6 22.3889V26.8222H22.4Z"
                            fill="currentColor"></path>
                        <path
                            d="M6.64896 18.0949C5.98058 19.3671 5.59999 20.8312 5.59999 22.3889V26.8222H1.39999V22.3889C1.39999 19.9404 3.2804 17.9556 5.59999 17.9556C5.96219 17.9556 6.31367 18.0039 6.64896 18.0949Z"
                            fill="currentColor"></path>
                    </svg></div>
                <div class="mx-5">
                    <h4 class="text-2xl font-bold text-gray-700"> {{$totalMemberCount}} </h4>
                    <div class="text-gray-500"> Toplam Üye </div>
                </div>
            </div>
        </div>
        <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/4 xl:mt-0">
            <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                <div class="p-3 bg-green-600 bg-opacity-75 rounded-full"><svg xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-6 h-6 fill-current text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </div>
                <div class="mx-5">
                    <h4 class="text-2xl font-bold text-gray-700"> {{$activeMemberCount}} </h4>
                    <div class="text-gray-500"> Aktif Üye </div>
                </div>
            </div>
        </div>
        <div class="w-full px-6 mt-6 md:mt-0 sm:w-1/2 xl:w-1/4 xl:mt-0">
            <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                <div class="p-3 bg-blue-400 bg-opacity-75 rounded-full text-white text-[26px]"><svg xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="w-6 h-6 fill-current text-white">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg></div>
                <div class="mx-5">
                    <h4 class="text-2xl font-bold text-gray-700"> {{$maleMemberCount}} </h4>
                    <div class="text-gray-500"> Erkek Üye </div>
                </div>
            </div>
        </div>
        <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/4 xl:mt-0">
            <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                <div class="p-3 bg-pink-600 bg-opacity-75 rounded-full text-white text-[26px]"><svg xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="w-6 h-6 fill-current text-white">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg></div>
                <div class="mx-5">
                    <h4 class="text-2xl font-bold text-gray-700"> {{$femaleMemberCount}} </h4>
                    <div class="text-gray-500"> Kadın Üye </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="flex flex-row justify-between items-center mt-12 mb-6">
    <p class="text-white text-lg">En Son Eklenenler</p>
    <a href="/members" class="">
        <p class="text-amber-500 text-sm text">TAMAMINI GÖR</p>
    </a>
</div>
<div class="flex flex-col">
    <div class="py-2 -my-2 overflow-x-auto">
        <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
            <x-members-table :members="$members" :isSorted="false" :now="$now" />
        </div>
    </div>
</div>

@endsection
