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
   <div class="w-90 txt-center txt-m bg-light-grey mx-5 py-2">BUYER REPORT</div>
   <div class='w-90 txt-center txt-s txt-b mt-2 mx-5'>Abdul Hameed & Co</div>
   <div class='w-90 txt-center txt-s mt-2 mx-5'>Printed on {{date('d/m/y')}}</div>

   <table class="w-90 mt-4 mx-5" cellpadding=2>
      <tbody>
         <tr class="mt-2">
            <td class="txt-s w-20 txt-b">Buyer Name: </td>
            <td class="txt-s w-50">{{$buyer->name}} </td>
         </tr>
         <tr class="mt-2">
            <td class="txt-s w-20 txt-b">Phone:</td>
            <td class="txt-s w-50">{{$buyer->phone}} </td>
         </tr>
         <tr class="mt-2">
            <td class="txt-s w-20 txt-b">Address: </td>
            <td class="txt-s w-50">{{$buyer->address}}</td>
         </tr>
      </tbody>
   </table>
   <div class="w-90 mx-5 mt-4 txt-s">Buy Detail</div>
   <table class="w-90 mt-2 mx-5" cellpadding=5 style='border-collapse:collapse'>
      <thead class="border-bottom border-top thin">
         <tr>
            <td class='w-10 txt-b txt-s'>ID</td>
            <td class="w-20 txt-b txt-s">Date</td>
            <td class="w-10 txt-b txt-s">Vehicle</td>
            <td class="w-10 txt-b txt-s">Bori</td>
            <td class="w-10 txt-b txt-s">Tora</td>
            <td class="w-10 txt-b txt-s">Gross</td>
            <td class="w-10 txt-b txt-s">Actual</td>
            <td class="w-10 txt-b txt-s txt-right">Total</td>
         </tr>

      </thead>
      <tbody>
         @foreach($buyer->sales as $sale)
         <tr class="mt-2">
            <td class="txt-s">{{$sale->id}}</td>
            <td class="txt-s">{{$sale->dateon->format('d/m/y')}}</td>
            <td class="txt-s">{{$sale->vehicleno}}</td>
            <td class="txt-s">{{$sale->numofbori}}</td>
            <td class="txt-s">{{$sale->numoftora}}</td>
            <td class="txt-s">{{$sale->grossweight}}</td>
            <td class="txt-s">{{$sale->actual()}}</td>
            <td class="txt-s">{{$sale->saleprice}}</td>
         </tr>
         @endforeach
      </tbody>
   </table>
   <div class="w-90 mt-2 mx-5 txt-right txt-s border-top thin">Bill Amount: {{$buyer->bill()}}</div>

   <div class="w-90 mx-5 mt-2 txt-s">Payments Detail</div>

   <table class="w-90 mt-2 mx-5" cellpadding=5 style='border-collapse:collapse'>
      <thead class="border-bottom border-top thin">
         <tr>
            <td class='w-10 txt-b txt-s'>ID</td>
            <td class="w-20 txt-b txt-s">Date</td>
            <td class="w-10 txt-b txt-s">Amount</td>
            <td class="w-20 txt-b txt-s">Mode</td>
            <td class="w-40 txt-b txt-s">Note</td>
         </tr>
      </thead>
      <tbody>
         @foreach($buyer->payments as $payment)
         <tr class="mt-2">
            <td class="txt-s">{{$payment->id}}</td>
            <td class="txt-s">{{$payment->created_at->format('d/m/y')}}</td>
            <td class="txt-s">{{$payment->paid}}</td>
            <td class="txt-s">{{$payment->mode}}</td>
            <td class="txt-s">{{$payment->note}}</td>
         </tr>
         @endforeach
      </tbody>
   </table>
   <div class="w-90 mt-2 mx-5 txt-right txt-s border-top thin">Total Payment: {{$buyer->paid()}}</div>

</body>

</html>