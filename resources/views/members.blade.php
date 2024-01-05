@extends('layouts.panel')

@section('title', 'Üyeler')

@section('content')


<p class="text-white text-2xl">Üyeler
    <a href="/member/add">
        <span class="px-3 py-1.5 bg-amber-500 rounded-xl text-sm ml-2">Yeni Üye Ekle</span>
    </a>
</p>
<div class="flex flex-col mt-10 mb-6 sm:flex-row">
    <div class="relative block mt-2 sm:mt-0"><span class="absolute inset-y-0 left-0 flex items-center pl-2"><svg
                viewBox="0 0 24 24" class="w-4 h-4 text-gray-500 fill-current">
                <path
                    d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                </path>
            </svg></span><input id="searchMemberTable" placeholder="Üye Ara"
            class="block w-full h-10 py-2 pl-8 pr-6 text-sm text-gray-700 placeholder-gray-400 bg-white border border-gray-400 rounded-md appearance-none focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none">
    </div>
</div>
<div class="flex flex-col">
    <div class="py-2 -my-2 overflow-x-auto">
        <x-members-table :members="$members" :isSorted="true" :now="$now"/>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <script>
      $(document).ready(function() {
          memberTable = $('#membersTable').DataTable({
              dom: 'Btip',
              order: [[0, 'desc']],
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
              pageLength: 5,
          });

          $('#searchMemberTable').keyup(function() {
              memberTable.search($(this).val()).draw();

          })
      });
      </script>
@endsection
