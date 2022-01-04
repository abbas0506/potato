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
   <div class="w-90 txt-center txt-m bg-light-grey mx-5 py-2">SELLER REPORT</div>
   <div class='w-90 txt-center txt-s txt-b mt-2 mx-5'>Abdul Hameed & Co</div>
   <div class='w-90 txt-center txt-s mt-2 mx-5'>Deal # {{$deal->id}} dated {{$deal->dateon->format('d/m/y')}}, printed on {{date('d/m/y')}}</div>

   <table class="w-90 mt-4 mx-5" cellpadding=2>
      <tbody>
         <tr class="mt-2">
            <td class="txt-s w-20 txt-b">Seller Name: </td>
            <td class="txt-s w-50">{{$deal->seller->name}} </td>
         </tr>
         <tr class="mt-2">
            <td class="txt-s w-20 txt-b">Product:</td>
            <td class="txt-s w-50">{{$deal->product->name}} </td>
         </tr>
         <tr class="mt-2">
            <td class="txt-s w-20 txt-b">Agreement: </td>
            <td class="txt-s w-50">
               @if($deal->numofbori>0){{$deal->numofbori}} Bori @endif
               @if($deal->numofbori>0 && $deal->numoftora>0) , @endif
               @if($deal->numoftora>0){{$deal->numoftora}} Tora @endif
            </td>
         </tr>
         <tr class="mt-2">
            <td class="txt-s w-10 txt-b">Rate / kg: </td>
            <td class="txt-s w-20">Rs. {{$deal->priceperkg}} </td>
         </tr>
         <tr class="mt-2">
            <td class="txt-s w-10 txt-b">Collection: </td>
            <td class="txt-s w-20">
               @if($deal->numofbori_picked()>0){{$deal->numofbori_picked()}} Bori @endif
               @if($deal->numofbori_picked()>0 && $deal->numoftora_picked()>0) , @endif
               @if($deal->numoftora_picked()>0){{$deal->numoftora_picked()}} Tora @endif
            </td>
         </tr>
         <tr class="mt-2">
            <td class="txt-s w-10 txt-b">Bill Amount: </td>
            <td class="txt-s w-20">Rs. {{$deal->bill()}} </td>
         </tr>
         <tr class="mt-2">
            <td class="txt-s w-10 txt-b">Paid Amount: </td>
            <td class="txt-s w-20">Rs. {{$deal->paid()}} </td>
         </tr>
         <tr class="mt-2">
            <td class="txt-s w-10 txt-b">Balance: </td>
            <td class="txt-s w-20">Rs. {{$deal->bill()-$deal->paid()}}</td>
         </tr>


      </tbody>
   </table>
   <div class="w-90 mx-5 mt-4 txt-s">Collection Detail</div>
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
            <td class="w-10 txt-b txt-s">@kg</td>
            <td class="w-10 txt-b txt-s txt-right">Total</td>
         </tr>

      </thead>
      <tbody>
         @foreach($deal->purchases as $purchase)
         <tr class="mt-2">
            <td class="txt-s">{{$purchase->id}}</td>
            <td class="txt-s">{{$purchase->dateon->format('d/m/y')}}</td>
            <td class="txt-s">{{$purchase->vehicleno}}</td>
            <td class="txt-s">{{$purchase->numofbori}}</td>
            <td class="txt-s">{{$purchase->numoftora}}</td>
            <td class="txt-s">{{$purchase->grossweight}}</td>
            <td class="txt-s">{{$purchase->actual()}}</td>
            <td class="txt-s">{{$purchase->priceperkg}}</td>
            <td class="txt-s txt-right">{{$purchase->basicprice()}}</td>
         </tr>
         @endforeach
      </tbody>
   </table>
   <div class="w-90 mt-2 mx-5 txt-right txt-s border-top thin">Bill Amount: {{$deal->bill()}}</div>

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
         @foreach($deal->payments as $payment)
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
   <div class="w-90 mt-2 mx-5 txt-right txt-s border-top thin">Total Payment: {{$deal->paid()}}</div>


</body>

</html>