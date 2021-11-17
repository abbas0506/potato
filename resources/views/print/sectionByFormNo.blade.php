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


   <div class="w-100 txt-center txt-m bg-light-grey mx-5 py-2">Admission File Labelling</div>
   <div class='w-100 txt-center txt-s mt-2'>Part 1, Session 2021-23</div>

   <div class="w-100 mx-5 py-2 mt-4 text-right txt-s">Printed on: {{date('d-m-Y')}}</div>
   <table class="w-100 mt-2 mx-5">
      <thead class="border-bottom border-top border-thin">
         <tr>
            <td class='w-10 txt-b txt-s'>Form #</td>
            <td class="w-15 txt-b txt-s">Section</td>
            <td class='w-15 txt-b txt-s'>Admission #</td>
            <td class='w-15 txt-b txt-s'>Roll #</td>
            <td class="w-30 txt-b txt-s">Name</td>
            <td class="w-15 txt-b txt-s">Group</td>

         </tr>

      </thead>
      <tbody>
         @foreach($registrations as $registration)
         <tr>
            <td class="txt-s">{{$registration->id}}</td>
            <td class="txt-s">{{$registration->section->name}}</td>
            <td class="txt-s">{{$registration->admno}}</td>
            <td class="txt-s">{{$registration->classrollno}}</td>
            <td class="txt-s">{{$registration->name}}</td>
            <td class="txt-s">{{$registration->group->name}}</td>
         </tr>
         @endforeach
      </tbody>
   </table>

   <div class="page-break"></div>

   @foreach($sections as $section)
   <div class="w-100 txt-center txt-m bg-light-grey mx-5 mt-5 py-2">Files for {{$section->name}}, Session 2021-23</div>
   <div class="w-100 txt-center txt-s mt-1">Printed on: {{date('d-m-Y')}}</div>
   <table class="w-100 mt-4 mx-5">

      <tbody>

         @php
         $i=1;
         $perLine=12;
         @endphp

         @foreach($section->registrations()->get() as $registration)
         @if($i%$perLine==0)<tr>@endif
            <td class="txt-s mr-2">{{$registration->id}}</td>
            @if($i%$perLine==0)
         </tr>@endif
         @php $i++; @endphp
         @endforeach
      </tbody>
   </table>
   @endforeach

</body>

</html>