@extends('layouts.user')

@section('title', 'Login')

@section('content')
<div class="text-lg" style="background-color: #f6f6f6;">
    <div class="md:px-0 px-16 h-screen w-full flex flex-col justify-center items-center">
      <h1 class="" style="font-size: 30px;">LOGIN FORM</h1>
      @if ($errors->any)
          @foreach ($errors->all() as $error)
              <h4>{{ $error }}</h4>
          @endforeach
      @endif
      {{-- style="background-image: url({{ asset('assets/bg_flower.jpg') }}); background-position: center; background-size: cover;" --}}
      <form class="form-regist p-8 rounded-xl mx-auto" action="{{ route('loginProcess') }}" method="post">
          {{-- style=" backdrop-filter: blur(16px) saturate(180%);
      -webkit-backdrop-filter: blur(16px) saturate(180%);
      background-color: rgba(252, 252, 255, 0.75);
      border-radius: 12px;
      border: 1px solid rgba(255, 255, 255, 0.125);" --}}

          @csrf
          <div style="margin-top: 7px;" class="relative z-0 w-full mb-5 group">
              <input style="font-size: 18px !important; text-transform: none !important;" type="text" name="username" value="{{ old('username') }}" id="floating_username" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-500 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
              <label style="font-size: 18px !important;" for="floating_username" class="peer-focus:font-medium absolute text-sm text-gray-600 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Username</label>
          </div>

          <div style="margin-top: 7px;" class="relative z-0 w-full mb-5 group">
            <input style="font-size: 18px !important; text-transform: none !important;" type="password" name="password" id="floating_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-500 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label style="font-size: 18px !important;" for="floating_password" class="peer-focus:font-medium absolute text-sm text-gray-600 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
        </div>

        <div class="flex items-start mb-5">
            <div class="flex items-center h-5">
              <input id="rememberMe" type="checkbox" name="remember_token" class="w-6 h-6 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
            </div>
            <label for="rememberMe" style="font-size: 14px !important;" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember Me</label>
          </div>

          <button type="submit" style="font-size: 18px !important;" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-2.5 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
          <p class="" style="font-size: 16px; margin-top: 8px;">Belum memiliki akun? <a href="{{ url('/register') }}"><span class="text-blue-500">Register</span></a></p>
        </form>
  </div>
</div>
@endsection
