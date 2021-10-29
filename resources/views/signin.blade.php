<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="/css/app.css" rel="stylesheet">

   <script src="/js/app.js"></script>
   <script src="/js/feather.min.js"></script>
   <title>Singin</title>

   <style>
   body {
      /* background-color: teal; */
      background-image: url("{{asset('images/bg.jpg')}}");
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: 100% 100%;
      opacity: 0.75;

   }
   </style>

</head>

<body style="height:100vh;">
   <div class="flexrow row-mid-right vh-10 mx-5">Session 2021-23</div>
   <div class="flexrow row-mid-right vh-40 mx-5">
      <div class="flexcol hw-25">

         <!-- if signin credentials incorrect    -->
         @if(session('error'))
         <div class="alert alert-danger">{{session('error')}}</div>
         @endif

         <form action="{{url('signin')}}" method="post">
            @csrf
            <div class="fancyinput mb-4">
               <input type="text" name='userid' placeholder="Enter user id">
               <label><i data-feather='user' class="feather-small"></i></label>
            </div>
            <div class="fancyinput mb-3">
               <input type="password" name='password' placeholder="Enter password">
               <label><i data-feather='key' class="feather-small"></i></label>
            </div>
            <div class="text-right">
               <button type="submit" class="btn btn-success">Signin</button>
            </div>
         </form>
      </div>
   </div>
   <div class="flexrow h-50 mx-10">
      <div class="flexcol col-mid-left">
         <div class="txt-xl mb-2 text-warning">
            <h1>College Admission System</h1>
         </div>
         <div class="txt-m text-justify text-success">Student Information System provides an easy way to complete admission
            process at college level. It provides up to date status of all applications for admission. It maintains
            group wise summary and detail as well.</div>
      </div>
   </div>
</body>
<script>
feather.replace()
</script>

</html>