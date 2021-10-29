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

   <title>College Admission System</title>
</head>

<body>
   <!-- app header -->
   <div class="flexrow row-mid-left border-bottom py-3 sticky-top">
      <div class="txt-l txt-b hw-30 ml-4 text-primary">

         <img src="{{url(asset('images/logo.jpg'))}}" alt="" width=200 height=40>
      </div>
      <div class="text-right hw-70 mr-3">Welcome {{session('user')->userid}} <a href="{{route('signout')}}"><i data-feather='power' class="feather-small ml-2"></i></a></div>
   </div>

   <!-- content page -->
   <div class="flexrow w-100 auto-col">
      <div class="flexcol hw-20 ">
         @yield('menu')
      </div>
      <div class="flexcol hw-80 border-left">
         @yield('page')
         @yield('modal')
      </div>
   </div>
   @yield('script')

   <script>
   feather.replace()
   </script>
</body>

</html>