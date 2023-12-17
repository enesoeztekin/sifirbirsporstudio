@extends('layouts.panel')

@section('title', 'Ölçümler')

@section('content')

    <p class="text-white text-2xl">Ölçümler
        <a href="/measurement/add">
            <span class="px-3 py-1.5 bg-amber-500 rounded-xl text-sm ml-2">Yeni Ölçüm Gir</span>
        </a>
    </p>
    <div class="flex flex-col mt-10 mb-6 sm:flex-row">
        <div class="relative block mt-2 sm:mt-0"><span class="absolute inset-y-0 left-0 flex items-center pl-2"><svg
                    viewBox="0 0 24 24" class="w-4 h-4 text-gray-500 fill-current">
                    <path
                        d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                    </path>
                </svg></span><input id="searchMeasurementsTable" placeholder="Ölçüm Ara"
                class="block w-full h-10 py-2 pl-8 pr-6 text-sm text-gray-700 placeholder-gray-400 bg-white border border-gray-400 rounded-md appearance-none focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none">
        </div>
    </div>
    <div class="flex flex-col mt-10">
        @if($members->count() > 0)
        <div class="py-2 -my-2 overflow-x-auto">
                <table id="measurementsTable" class="min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Üye Adı </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Ölçüm Tarihi </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Kilo (kg)</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Kol (cm)</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Göğüs (cm)</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Omuz (cm)</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Bel (cm)</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Bacak (cm)</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Kalça (cm)</th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                İşlemler</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                                @foreach ($members as $member)
                                    @foreach ($member->measurements as $measurement)
                                        <tr>
                                            <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 w-10 h-10"><img class="w-10 h-10 rounded-full"
                                                            src="{{ asset('assets/sfrbir.png') }}"
                                                            alt=""></div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium leading-5 text-gray-900">{{$member->fullname}}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                                                <div class="inline-flex px-2 text-sm font-semibold leading-5 text-black bg-zinc-200 rounded-full">{{$measurement->created_at->format('d.m.Y - H:i:s')}}</div>
                                            </td>
                                            <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                                                <div class="text-sm font-medium leading-5 text-gray-900">{{$measurement->weight}}</div>
                                            </td>
                                            <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                                                <div class="text-sm font-medium leading-5 text-gray-900">{{$measurement->arm}}</div>
                                            </td>
                                            <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                                                <div class="text-sm font-medium leading-5 text-gray-900">{{$measurement->chest}}</div>
                                            </td>
                                            <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                                                <div class="text-sm font-medium leading-5 text-gray-900">{{$measurement->shoulders}}</div>
                                            </td>
                                            <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                                                <div class="text-sm font-medium leading-5 text-gray-900">{{$measurement->waist}}</div>
                                            </td>
                                            <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                                                <div class="text-sm font-medium leading-5 text-gray-900">{{$measurement->legs}}</div>
                                            </td>
                                            <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                                                <div class="text-sm font-medium leading-5 text-gray-900">{{$measurement->hips}}</div>
                                            </td>
                                            <td class="px-6 py-4 text-sm font-medium leading-5 text-right border-b border-gray-200 whitespace-nowrap">
                                                <a href="/measurement/{{$measurement->id}}" class="text-indigo-600 hover:text-indigo-900">
                                                    <div class="text-start flex items-center gap-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                        </svg>
                                                        Düzenle</div>
                                                </a>
                                                        <a href="/measurement/del/{{$measurement->id}}" class="text-indigo-600 hover:text-indigo-900">
                                                            <div class="text-start flex items-center gap-2 mt-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                                </svg>


                                                                Sil</div></a>
                                            </td>
                                        </tr>
                                    @endforeach
                            @endforeach
                        </tbody>
                    </table>
        </div>
        @else
            <p class="py-3 text-white font-normal"> Henüz hiç ölçüm girmediniz. </p>
        @endif
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <script>
      $(document).ready(function() {
        measurementsTable = $('#measurementsTable').DataTable({
              dom: 'Btip',
              language: {
                  "zeroRecords": "Bir kayıt bulunamadı.",
                  "info": "<span class='text-white text-sm'>_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor.</span>",
                  "infoEmpty": "",
                  "paginate": {
                      "next":       "<span class=''>Sonraki</span>",
                      "previous":   "<span class=''>Önceki</span>"
                  },
                  "infoFiltered": "",
              },
              paginate: true,
              pageLength: 10,
          });

          $('#searchMeasurementsTable').keyup(function() {
            measurementsTable.search($(this).val()).draw();

          })
      });
      </script>
@endsection
