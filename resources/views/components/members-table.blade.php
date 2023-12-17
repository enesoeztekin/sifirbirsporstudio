
    <table id="membersTable" class="min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
        <thead>
            <tr>
                <th
                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                    Üye </th>
                <th
                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                    Paket </th>
                <th
                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                    Durum </th>
                <th
                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                    Tür </th>
                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">İşlemler</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @foreach ($members as $member)
            <tr>
                <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-10 h-10"><img class="w-10 h-10 rounded-full"
                                src="{{ asset('assets/sfrbir.png') }}" alt=""></div>
                        <div class="ml-4">
                            <div class="text-sm font-bold leading-8 text-gray-900">{{$member->fullname}}</div>
                            <div class="text-sm leading-6 font-medium text-gray-500">{{$member->email}}</div>
                            <div class="text-sm leading-6 font-medium text-gray-500">{{$member->phone}}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                    <div class="text-sm leading-5 text-gray-900">{{$member->membership->package_period}} AYLIK
                        @if ($member->membership->is_student)
                            <span
                                class="inline-flex px-2 text-xs font-semibold leading-5 text-black bg-zinc-200 rounded-full">Öğrenci</span>
                        @else
                            <span
                            class="inline-flex px-2 text-xs font-semibold leading-5 text-black bg-zinc-200 rounded-full">Sivil</span>
                        @endif
                    </div>
                    <div class="text-sm leading-6 text-gray-500 font-normal">Başlangıç: {{$member->membership->starting_date->format('d/m/Y')}}</div>
                    <div class="text-sm leading-6 text-gray-500 font-normal">Bitiş: {{$member->membership->expiration_date->format('d/m/Y')}}</div>
                    @if ($member->membership->is_freezed)
                        <div class="flex items-center gap-1 text-sm leading-6 text-gray-500 font-normal">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 9.563C9 9.252 9.252 9 9.563 9h4.874c.311 0 .563.252.563.563v4.874c0 .311-.252.563-.563.563H9.564A.562.562 0 019 14.437V9.564z" />
                            </svg>
                            Dondurma
                        </div>
                        @if($member->membership->freeze_starting_date)
                        <div class="text-sm leading-6 text-gray-500 font-normal">
                            Başlangıç: {{$member->membership->freeze_starting_date}}</div>
                        @endif
                        @if($member->membership->freeze_expiration_date)
                        <div class="text-sm leading-6 text-gray-500 font-normal">
                            Bitiş: {{$member->membership->freeze_expiration_date}}</div>
                        @endif
                    @endif
                </td>
                <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                    @if ($member->membership->starting_date <= $member->membership->expiration_date)
                        @if ($member->membership->is_freezed)
                        <span
                            class="inline-flex px-2 text-xs font-semibold leading-5 text-white bg-sky-400 rounded-full">Donduruldu</span>
                        @else
                        <span
                            class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Aktif</span>
                        @endif
                    @else
                        <span
                        class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">Pasif</span>
                    @endif
                </td>
                <td
                    class="px-6 py-4 text-sm leading-5 text-gray-500 border-b border-gray-200 whitespace-nowrap">
                    @if ($member->membership->is_vip)
                        <span
                        class="inline-flex px-2 text-xs font-semibold leading-5 text-black bg-yellow-400 rounded-full">VIP</span>
                    @else
                        <span
                        class="inline-flex px-2 text-xs font-semibold leading-5 text-black bg-blue-200 rounded-full">Normal</span>
                    @endif

                </td>
                <td
                    class="px-6 py-4 text-sm font-medium leading-5 text-right border-b border-gray-200 whitespace-nowrap">
                    <a href="/member/edit/{{$member->id}}" class="text-indigo-600 hover:text-indigo-900">
                        <div class="text-start flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                            Düzenle
                        </div>
                    </a>
                    <a href="/measurements/{{$member->id}}" class="text-indigo-600 hover:text-indigo-900">
                        <div class="text-start flex items-center gap-2 mt-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0112 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5" />
                            </svg>

                            Ölçüm Tablosu
                        </div>
                    </a>
                    <a href="/member/delete/{{$member->id}}" class="text-indigo-600 hover:text-indigo-900">
                        <div class="text-start flex items-center gap-2 mt-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>

                            Sil
                        </div>
                    </a>
                    @if (($member->membership->starting_date <= $member->membership->expiration_date) && ($member->membership->freeze_right_count > 0) && ($member->membership->is_freezed == 0))
                        <a href="/member/freeze/{{$member->id}}" class="text-indigo-600 hover:text-indigo-900">
                            <div class="text-start flex items-center gap-2 mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 9.563C9 9.252 9.252 9 9.563 9h4.874c.311 0 .563.252.563.563v4.874c0 .311-.252.563-.563.563H9.564A.562.562 0 019 14.437V9.564z" />
                                </svg>


                                Dondur
                            </div>
                        </a>
                    @else
                        @if ($member->membership->is_freezed)
                            <a href="/member/unfreeze/{{$member->id}}" class="text-indigo-600 hover:text-indigo-900">
                                <div class="text-start flex items-center gap-2 mt-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.91 11.672a.375.375 0 010 .656l-5.603 3.113a.375.375 0 01-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z" />
                                    </svg>



                                    Devam Ettir
                                </div>
                            </a>
                        @endif
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
