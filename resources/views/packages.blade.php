@extends('layouts.panel')

@section('title', 'Paketler')

@section('content')

    <p class="text-white text-2xl">Paketler
        <a href="/package/add">
            <span class="px-3 py-1.5 bg-amber-500 rounded-xl text-sm ml-2">Yeni Paket Oluştur</span>
        </a>
    </p>
    <div class="flex flex-col mt-10">
        @if($packages->count() > 0)
        <div class="py-2 -my-2 overflow-x-auto">
            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">

                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Paket Adı </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Paket Süresİ</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Paket Fiyatı</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Dondurma Hakkı</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Öğrenci Mi?</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Paket Türü</th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                İşlemler</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                                @foreach ($packages as $package)
                                <tr>
                                    <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-10 h-10"><img class="w-10 h-10 rounded-full"
                                                    src="{{ asset('assets/sfrbir.png') }}"
                                                    alt=""></div>
                                            <a class="ml-4" href="package/{{$package->id}}/members">
                                                <div class="text-sm font-medium leading-5 text-gray-900">{{$package->package_name}}</div>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                                        <span class="inline-flex px-2 text-sm font-semibold leading-5 text-black bg-zinc-200 rounded-full">{{$package->package_period}} AY</span>
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                                        <div class="text-sm font-medium leading-5 text-gray-900">{{$package->package_cost}} ₺</div>
                                    </td>
                                    <td
                                        class="px-6 py-4 text-sm leading-5 text-gray-500 border-b border-gray-200 whitespace-nowrap">
                                        @if ($package->freeze_right_count == 0)
                                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">Yok</span>
                                        @else
                                        <span class="inline-flex px-2 text-xs font-semibold leading-5 text-indigo-800 bg-indigo-100 rounded-full">{{$package->freeze_right_count}} Hak</span>
                                        @endif
                                    </td>
                                    <td
                                        class="px-6 py-4 text-sm leading-5 text-gray-500 border-b border-gray-200 whitespace-nowrap">
                                        @if ($package->is_student == 1)
                                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Evet</span>
                                        @else
                                        <span class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">Hayır</span>
                                        @endif
                                    </td>
                                    <td
                                        class="px-6 py-4 text-sm leading-5 text-gray-500 border-b border-gray-200 whitespace-nowrap">
                                        @if ($package->is_vip == 1)
                                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-black bg-yellow-400 rounded-full">VIP</span>
                                        @else
                                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-black bg-blue-200 rounded-full">Normal</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium leading-5 text-right border-b border-gray-200 whitespace-nowrap">
                                        <a href="/package/{{$package->id}}" class="text-indigo-600 hover:text-indigo-900">
                                            <div class="text-start flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                                Düzenle</div>
                                        </a>
                                                <a href="/package/del/{{$package->id}}" class="text-indigo-600 hover:text-indigo-900">
                                                    <div class="text-start flex items-center gap-2 mt-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                        </svg>


                                                        Sil</div></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
        @else
            <p class="py-3 text-white font-normal"> Henüz hiç paket oluşturmadınız. </p>
        @endif
    </div>
@endsection
