<html>

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="{{public_path('css/pdf.css') }}" rel="stylesheet">
   <style>
   @page {
      margin: 75px 25px;
   }
   </style>

</head>

<body>

   @foreach($sections as $section)
   <div class="w-100 txt-center txt-m bg-light-grey mx-5 py-2">Section {{$section->name}}</div>
   <div class='w-100 txt-center txt-s mt-2'>Part 1, Session 2021-23</div>

   <div class="w-100 mx-5 py-2 mt-4 text-right txt-s">Printed on: {{date('d-m-Y')}}</div>
   <table class="w-100 mt-2 mx-5">
      <thead class="border-bottom border-top border-thin">
         <tr>
            <td class='w-10 txt-b txt-s'>Roll #</td>
            <td class="w-20 txt-b txt-s">Name</td>
            <td class="w-20 txt-b txt-s">Father</td>
            <td class="w-15 txt-b txt-s">Group</td>
            <td class="w-15 txt-b txt-s">Phone</td>
            <td class="w-20 txt-b txt-s">Address</td>
         </tr>

      </thead>
      <tbody>
         @foreach($section->registrations()->get() as $registration)
         <tr>
            <td class="txt-s">{{$registration->classrollno}}</td>
            <td class="txt-s">{{$registration->name}}</td>
            <td class="txt-s">{{$registration->fname}}</td>
            <td class="txt-s">{{$registration->group->name}}</td>
            <td class="txt-s">{{$registration->phone}}</td>
            <td class="txt-s">{{$registration->address}}</td>
         </tr>
         @endforeach
      </tbody>
   </table>
   <div class="page-break"></div>
   @endforeach

</body>

</html>