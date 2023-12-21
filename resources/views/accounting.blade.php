@extends('layouts.panel')

@section('title', 'Muhasebe')

@section('content')

    <p class="text-white text-2xl">Muhasabe
        <a href="/transaction/add">
            <span class="px-3 py-1.5 bg-amber-500 rounded-xl text-sm ml-2">Yeni İşlem Oluştur</span>
        </a>
    </p>
    <div class="mt-10">
        <div class="flex flex-wrap -mx-6">
            <div class="w-full px-6 sm:w-1/2 xl:w-1/4">
                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                    <div class="p-3 bg-indigo-600 bg-opacity-75 rounded-full text-white text-[26px]">&nbsp;₺&nbsp;</div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-bold text-gray-700"> {{$transactions->sum('amount')}}₺ </h4>
                        <div class="text-gray-500"> Toplam Kazanç </div>
                    </div>
                </div>
            </div>
            <div class="w-full px-6 mt-6 md:mt-0 sm:w-1/2 xl:w-1/4 xl:mt-0">
                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                    <div class="p-3 bg-blue-400 bg-opacity-75 rounded-full text-white text-[26px]">&nbsp;₺&nbsp;</div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-bold text-gray-700"> {{$totalProfitThisMonth}}₺ </h4>
                        <div class="text-gray-500"> Kazanç (Bu Ay)</div>
                    </div>
                </div>
            </div>
            <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/4 xl:mt-0">
                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                    <div class="p-3 bg-green-600 bg-opacity-75 rounded-full text-white text-[26px]">&nbsp;₺&nbsp;</div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-bold text-gray-700"> {{$totalProfitLastSixMonths}}₺ </h4>
                        <div class="text-gray-500"> Kazanç (Son 6 Ay)</div>
                    </div>
                </div>
            </div>
            <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/4 xl:mt-0">
                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                    <div class="p-3 bg-pink-600 bg-opacity-75 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                      </svg>

                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-bold text-gray-700"> {{$transactions->count()}} </h4>
                        <div class="text-gray-500"> Toplam İşlem </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col mt-10 mb-6 sm:flex-row">
        <div class="relative block mt-2 sm:mt-0"><span class="absolute inset-y-0 left-0 flex items-center pl-2"><svg
                    viewBox="0 0 24 24" class="w-4 h-4 text-gray-500 fill-current">
                    <path
                        d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                    </path>
                </svg></span><input id="searchTransactionsTable" placeholder="İşlem Ara"
                class="block w-full h-10 py-2 pl-8 pr-6 text-sm text-gray-700 placeholder-gray-400 bg-white border border-gray-400 rounded-md appearance-none focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none">
        </div>
    </div>
    <div class="flex flex-col mt-10">
        @if($transactions->count() > 0)
        <div class="py-2 -my-2 overflow-x-auto">
                <table id="transactionsTable" class="min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                İşlem Adı </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                İşlem Tarihi </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                İşlem Tutarı</th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                İşlemler</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                                @foreach ($transactions as $transaction)

                                        <tr>
                                            <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 w-10 h-10"><img class="w-10 h-10 rounded-full"
                                                            src="{{ asset('assets/sfrbir.png') }}"
                                                            alt=""></div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-bold leading-5 text-gray-900">{{$transaction->name}}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                                                <div class="text-sm font-medium leading-5 text-gray-500">{{$transaction->created_at}}</div>
                                            </td>
                                            <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                                                @if ($transaction->amount > 0)
                                                    <div class="text-sm font-bold leading-5 text-green-600">{{$transaction->amount}} ₺</div>
                                                @elseif ($transaction->amount < 0)
                                                    <div class="text-sm font-bold leading-5 text-red-600">{{$transaction->amount}} ₺</div>
                                                @else
                                                    <div class="text-sm font-bold leading-5 text-gray-600">{{$transaction->amount}} ₺</div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-sm font-medium leading-5 text-right border-b border-gray-200 whitespace-nowrap">
                                                        <a href="/transaction/del/{{$transaction->id}}" class="text-indigo-600 hover:text-indigo-900">
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
        @else
            <p class="py-3 text-white font-normal"> Henüz hiç işlem oluşturulmadı. </p>
        @endif
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <script>
      $(document).ready(function() {
        transactionsTable = $('#transactionsTable').DataTable({
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

          $('#searchTransactionsTable').keyup(function() {
            transactionsTable.search($(this).val()).draw();

          })
      });
      </script>
@endsection
