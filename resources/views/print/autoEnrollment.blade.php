<html>

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="{{public_path('css/pdf.css') }}" rel="stylesheet">
   <style>
   @page {
      margin: 50px 25px;
   }
   </style>

</head>

<body>
   <div class="w-100 txt-center txt-m bg-light-grey mx-5 py-2">Auto Enrollment List</div>
   <div class='w-100 txt-center txt-s mt-2'>Part 1, Session 2021-23</div>

   <div class="w-100 mx-5 py-2 mt-4 text-right txt-s">Printed On: {{date('d-m-Y')}}</div>
   <table class="w-100 mt-2 mx-5" CELLpadding=10 style='border-collapse:collapse'>
      <thead class="border-bottom border-top thin">
         <tr>
            <td class='w-10 txt-b txt-s'>Adm No.</td>
            <td class="w-20 txt-b txt-s">Name/Father</td>
            <td class="w-20 txt-b txt-s">DOB/BForm</td>
            <td class="w-20 txt-b txt-s">Phone/G.CNIC</td>
            <td class="w-30 txt-b txt-s">Address</td>
         </tr>

      </thead>
      <tbody>
         @foreach($registrations as $registration)
         <tr class="mt-2">
            <td class="txt-s border-bottom thin">{{$registration->admno}}</td>
            <td class="txt-s border-bottom thin">{{$registration->name}}<br>{{$registration->fname}}</td>
            <td class="txt-s border-bottom thin">{{$registration->dob->format('d-m-Y')}}<br>{{$registration->bform}}</td>
            <td class="txt-s border-bottom thin">{{$registration->phone}}<br>{{$registration->gcnic}}</td>
            <td class="txt-s border-bottom thin">{{$registration->address}}</td>
         </tr>
         @endforeach
      </tbody>
   </table>


</body>

</html>