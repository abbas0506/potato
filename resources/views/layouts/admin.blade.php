<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="/css/app.css" rel="stylesheet">
   <script src="/js/app.js"></script>
   <script src="/js/autoformat.js"></script>
   <script src="/js/feather.min.js"></script>
   <meta name="csrf-token" content="{{ csrf_token() }}" />

   <title>Potato System</title>
</head>

<body>
   <!-- app header -->
   <div class="frow mid-left border-bottom py-3 px-5">
      <div class="fcol w-80 "><img src="{{url(asset('images/logo.png'))}}" alt="" width=100 height=50></div>
      <div class="frow w-20 mid-right">
         <span class="txt-b"> Admin Panel</span>
         <span class="mx-2">|</span>
         <a href="{{route('signout')}}">Sign Out</a>
      </div>

   </div>

   @yield('page-header')
   @yield('page-content')
   @yield('modal')
   @yield('script')

   <script>
   feather.replace()
   </script>
</body>

</html>