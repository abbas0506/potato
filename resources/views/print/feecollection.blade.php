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
   <div class="w-100 txt-center txt-m bg-light-grey mx-5 py-2">Fee Collection, Part 1, Session 2021-23</div>
   <div class='w-100 txt-center txt-s mt-2'> {{$datestr}}</div>

   <!-- summary by group -->

   <div class="w-100 mx-5 py-2 mt-5">Summary - by Group</div>
   <table class="w-100 mt-2 mx-5">
      <thead class="border-bottom border-top border-thin">
         <tr>
            <td class='w-10 txt-b txt-s'>Sr</td>
            <td class="w-50 txt-b txt-s">Group</td>
            <td class="w-10 txt-b txt-s txt-right">Paid</td>
            <td class="w-15 txt-b txt-s txt-right">Unpaid</td>
            <td class="w-15 txt-b txt-s txt-right">Total</td>
         </tr>

      </thead>
      <tbody>
         @php $sr=0; $total=0; $paidcount=0; @endphp
         @foreach($summary_bygroup as $row)
         <tr>
            <td class="txt-s">{{++$sr}}</td>
            <td class="txt-s">{{$row->group->name}}</td>
            <td class="txt-s txt-right">{{$row->paidcount}}</td>
            <td class="txt-s txt-right">{{$row->n-$row->paidcount}}</td>
            <td class="txt-s txt-right">{{$row->n}}</td>
         </tr>
         @php
         $paidcount+=$row->paidcount;
         $total+=$row->n;
         @endphp
         @endforeach
         <tr>
            <td class="txt-s"></td>
            <td class="txt-s"></td>
            <td class="txt-s txt-b txt-right border-thin border-top">{{$paidcount}}</td>
            <td class="txt-s txt-b txt-right border-thin border-top">{{$total-$paidcount}}</td>
            <td class="txt-s txt-b txt-right border-thin border-top">{{$total}}</td>
         </tr>
      </tbody>
   </table>

   <!-- summary by date -->
   <div class="w-100 mx-5 py-2 mt-5">Summary - by Date</div>
   <table class="w-100 mt-2 mx-5">
      <thead class="border-bottom border-top border-thin">
         <tr>
            <td class='w-10 txt-b txt-s'>Sr</td>
            <td class="w-70 txt-b txt-s">Date</td>
            <td class="w-20 txt-b txt-s txt-right">Count</td>
            <td class="w-20 txt-b txt-s txt-right">Fee</td>
         </tr>

      </thead>
      <tbody>
         @php $sr=0; $count=0; $totalfee=0@endphp
         @foreach($summary as $row)
         <tr>
            <td class="txt-s">{{++$sr}}</td>
            <td class="txt-s">{{$row->paidat->format('d-m-Y')}}</td>
            <td class="txt-s txt-right">{{$row->n}}</td>
            <td class="txt-s txt-right">{{$row->fee}}</td>
         </tr>
         @php
         $count+=$row->n;
         $totalfee+=$row->fee;
         @endphp
         @endforeach
         <tr>
            <td class="txt-s"></td>
            <td class="txt-s"></td>
            <td class="txt-s txt-b txt-right border-thin border-top">Toal: {{$count}}</td>
            <td class="txt-s txt-b txt-right border-thin border-top">{{$totalfee}}</td>
         </tr>
      </tbody>
   </table>

   <div class="page-break"></div>
   <div class="w-100 mx-5 py-2 mt-4">Detail</div>
   <table class="w-100 mt-2 mx-5">
      <thead class="border-bottom border-top border-thin">
         <tr>
            <td class='w-10 txt-b txt-s'>Form</td>
            <td class="w-25 txt-b txt-s">Name</td>
            <td class="w-10 txt-b txt-s">Marks</td>
            <td class="w-15 txt-b txt-s">Group</td>
            <td class="w-15 txt-b txt-s">Phone</td>
            <td class="w-10 txt-b txt-s">Fee</td>
            <td class="w-15 txt-b txt-s txt-right">Paid at</td>
         </tr>

      </thead>
      <tbody>
         @foreach($registrations as $registration)
         <tr>
            <td class="txt-s">{{$registration->id}}</td>
            <td class="txt-s">{{$registration->name}}</td>
            <td class="txt-s">{{$registration->marks}}</td>
            <td class="txt-s">{{$registration->group->name}}</td>
            <td class="txt-s">{{$registration->phone}}</td>
            <td class="txt-s">{{$registration->group->fee}}</td>
            <td class="txt-s txt-right">{{$registration->paidat->format('d-m-Y')}}</td>
         </tr>
         @endforeach
      </tbody>
   </table>


</body>

</html>