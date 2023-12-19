<div id="delete-member-popup-{{$member->id}}" class="modal-popup hidden fixed inset-0 bg-black z-50 justify-center items-center bg-opacity-50 p-6">
    <div class="relative flex flex-col gap-3 bg-white !opacity-100 w-max p-8 py-12 text-center rounded-lg">
        <div class="absolute top-5 right-5 bg-gray-300 text-white rounded-full p-3 cursor-pointer" onclick="closeModal({{$member->id}})"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" data-slot="icon" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
          </svg>
          </div>
        <div class="heading-5 mt-3">Silmek istediğinize emin misiniz?</div>
        <p class="text-gray-500 text-sm font-medium max-w-lg my-5">Üyeliği sil butonu, sadece üyeyi ve üyeliğini sistemden siler. Üyeliği iptal et butonu ise muhasebe kısmındaki kaydı da silecektir.</p>
        <div class="flex flex-col gap-4">
            <a href="/member/delete/{{$member->id}}" class="py-3 bg-red-800 text-white rounded-lg text-sm">Üyeliği sil</a>
            <a href="/membership/cancel/{{$member->id}}" class="px-3 py-1 text-sm text-amber-600">Üyeliği İptal Et</a>
        </div>
    </div>
</div>
