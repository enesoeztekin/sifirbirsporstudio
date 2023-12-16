<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Yönetim Paneli - Giriş </title>
  @vite('resources/css/app.css')
</head>
<body class="bg-zinc-900 flex justify-center items-center h-screen">
      
      <div class="bg-amber-500 rounded-lg shadow-md p-8 max-w-md w-full">
        <h1 class="text-2xl font-semibold mb-6 text-center text-white"><span class="font-bold">SıfırBir Spor Studio</span> <br> Yönetim Paneli</h1>
        <form method="POST" action="{{ route('auth') }}" class="">
            @csrf
            <div>
                <label for="username" class="block font-semibold mb-1 py-3 text-white">Kullanıcı Adı:</label>
                <input type="text" id="username" name="username" class="border border-gray-300 rounded-md w-full py-3 px-5" placeholder="Kullanıcı Adınız" required >
            </div>

            <div>
                <label for="password" class="block font-semibold mb-1 text-white py-3 mt-2">Şifre:</label>
                <input type="password" id="password" name="password" class="border border-gray-300 rounded-md w-full py-3 px-5" placeholder="Şifreniz" required>
            </div>

            <button type="submit" class="mt-6 bg-zinc-900 text-white rounded-md py-2 px-4 hover:bg-zinc-800 transition-all duration-300 w-full py-3">Giriş Yap</button>
        </form>
      </div>
      @if (Session::has('error'))
            <div class="toast-error absolute bottom-0 w-full bg-red-800 text-white text-center py-3">
              {{ Session::get('error') }}
            </div>
      @endif

      @if (Session::has('success'))
            <div class="toast-success absolute bottom-0 w-full bg-green-800 text-white text-center py-3">
              {{ Session::get('success') }}
            </div>
      @endif
      <script>
        document.addEventListener('DOMContentLoaded', () => {
           
          const toastError = document.querySelector('.toast-error');
          const toastSuccess = document.querySelector('.toast-success');

            if(toastError != null){
              setTimeout(() => {
                toastError.remove();
              }, 1500);
            }

            if(toastSuccess != null){
              setTimeout(() => {
                toastSuccess.remove();
              }, 1500);
            }
        });
      </script>
</body>
</html>