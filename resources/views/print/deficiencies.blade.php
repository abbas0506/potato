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

   table {
      border-spacing: -1 !important;
   }
   </style>

</head>

<body>
   <div class="w-100 txt-center txt-m bg-light-grey mx-5 py-2">Registration Deficiences, Part 1, Session 2021-23</div>

   <table class="w-100 mx-5">
      <tbody>
         <tr class="">
            <td class="txt-b w-75">Summary of Deficiencies</td>
            <td class="w-25 txt-s">
               <ul>
                  <li>P= Pics</li>
                  <li>C= CNIC</li>
                  <li>B= BForm</li>
                  <li>M= matric</li>
                  <li>N=NOC</li>
               </ul>
            </td>
         </tr>
      </tbody>
   </table>

   <table class="w-100 mt-1 mx-5">
      <thead class="border-bottom border-top border-thin">
         <tr>
            <td class='w-10 txt-b txt-s'>Sr</td>
            <td class="w-40 txt-b txt-s">Group</td>

            <td class="w-10 txt-b txt-s txt-right">Pics</td>
            <td class="w-10 txt-b txt-s txt-right">Cnic</td>
            <td class="w-10 txt-b txt-s txt-right">Bform</td>
            <td class="w-10 txt-b txt-s txt-right">Matric</td>
            <td class="w-10 txt-b txt-s txt-right">NOC</td>
         </tr>

      </thead>
      <tbody>
         @php $sr=0;$p=0; $c=0;$b=0; $m=0; $n=0;@endphp
         @foreach($summary as $row)
         <tr>
            <td class="txt-s">{{++$sr}}</td>
            <td class="txt-s">{{$row->group->name}}</td>

            <td class="txt-s txt-right">{{$row->p}}</td>
            <td class="txt-s txt-right">{{$row->c}}</td>
            <td class="txt-s txt-right">{{$row->b}}</td>
            <td class="txt-s txt-right">{{$row->m}}</td>
            <td class="txt-s txt-right">{{$row->n}}</td>
         </tr>
         @php
         $p+=$row->p;
         $c+=$row->c;
         $b+=$row->b;
         $m+=$row->m;
         $n+=$row->n;
         @endphp
         @endforeach
         <tr>
            <td class="txt-s"></td>
            <td class="txt-s"></td>
            <td class="txt-s txt-right border-top border-thin">{{$p}}</td>
            <td class="txt-s txt-right border-top border-thin">{{$c}}</td>
            <td class="txt-s txt-right border-top border-thin">{{$b}}</td>
            <td class="txt-s txt-right border-top border-thin">{{$m}}</td>
            <td class="txt-s txt-right border-top border-thin">{{$n}}</td>
         </tr>
      </tbody>
   </table>
   <!-- <div class="page-break"></div> -->
   <div class="w-100 mx-5 py-2">On Roll - Having any Deficiency</div>
   <table class="w-100 mt-2 mx-5">
      <thead class="border-bottom border-top border-thin">
         <tr>
            <td class='w-10 txt-b txt-s'>Form</td>
            <td class="w-25 txt-b txt-s">Name</td>
            <td class="w-10 txt-b txt-s">Marks</td>
            <td class="w-15 txt-b txt-s">Group</td>
            <td class="w-15 txt-b txt-s">Phone</td>
            <td class="w-15 txt-b txt-s">Deficiency</td>
         </tr>

      </thead>
      <tbody>
         @foreach($reg_havingDeficiency as $registration)
         <tr class="border-top">
            <td class="txt-s">{{$registration->id}}</td>
            <td class="txt-s">{{$registration->name}}</td>
            <td class="txt-s">{{$registration->marks}}</td>
            <td class="txt-s">{{$registration->group->name}}</td>
            <td class="txt-s">{{$registration->phone}}</td>
            <td class="txt-s">@if($registration->deficiencyCode()) {{$registration->deficiencyCode()}}@endif </td>
         </tr>
         @endforeach
      </tbody>
   </table>
   <!-- <div class="page-break"></div> -->
   <div class="w-100 mx-5 py-2 mt-4">On Roll - Having Full Clearance</div>
   <table class="w-100 mt-2 mx-5">
      <thead class="border-bottom border-top border-thin">
         <tr>
            <td class='w-10 txt-b txt-s'>Form</td>
            <td class="w-25 txt-b txt-s">Name</td>
            <td class="w-10 txt-b txt-s">Marks</td>
            <td class="w-15 txt-b txt-s">Group</td>
            <td class="w-15 txt-b txt-s">Phone</td>
            <td class="w-15 txt-b txt-s txt-right">Fee</td>

         </tr>

      </thead>
      <tbody>
         @foreach($reg_havingClearance as $registration)
         <tr class="border-top">
            <td class="txt-s">{{$registration->id}}</td>
            <td class="txt-s">{{$registration->name}}</td>
            <td class="txt-s">{{$registration->marks}}</td>
            <td class="txt-s">{{$registration->group->name}}</td>
            <td class="txt-s">{{$registration->phone}}</td>
            <td class="txt-s txt-right">@if($registration->paidat) {{$registration->paidat->format('d-m-Y')}}@else - @endif</td>
         </tr>
         @endforeach
      </tbody>
   </table>


</body>

</html>