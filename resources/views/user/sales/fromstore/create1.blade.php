@extends('layouts.user')
@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Deal # {{$deal->id}}</div>
   <div class="frow"> <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      <a href="{{url('deals')}}" class="hover-orange"> Deals </a> <span class="mx-2">/</span>
      <a href="{{route('deals.show',$deal)}}" class="hover-orange">Picks </a> <span class="mx-2">/</span>New Sale
   </div>
</div>
@endsection
@section('page-content')

<!-- display record save, del, update message if any -->
@if ($errors->any())
<div class="alert alert-danger mt-5">
   <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
   </ul>
</div>
<br />
@elseif(session('success'))
<script>
Swal.fire({
   icon: 'success',
   title: "Successful",
   showConfirmButton: false,
   timer: 1500
});
</script>
@endif
<!-- purchasing -->
<div class="frow centered">
   <div class="fcol w-70">
      <div class="w-100 bg-light my-3">
         <div class="border-1 border-left border-success py-2 text-primary txt-m" style="background-color: #eee;">
            <div class="frow px-4 stretched">
               <div>
                  {{$deal->client->name}} <span class="txt-s ml-4">Agreement => {{$deal->product->name}} : {{$deal->numofbori}} + {{$deal->numoftora}} @ Rs. {{$deal->unitprice}} dated {{$deal->dateon}}</span>
               </div>
               <div class="frow spaced txt-s mid-right">
                  <span class="txt-b">New Sale [ Store ]</span>
               </div>
            </div>
         </div>

         <form action="{{route('sales.store')}}" method='post'>
            @csrf
            <input type="hidden" name="purchase_id" value="{{$purchase->id}}">
            <div class="frow w-100 my-4 mid-left">
               <div class="fancyinput">
                  <input type="date" name='dateon' id='dateon' placeholder="Enter name" required>
                  <label for="Name">Date (mm-dd-yyyy)</label>
               </div>
               <div class="frow ml-5">
                  <div class="txt-b txt-red mr-4">Where to sell from???</div>
                  <a href="{{url('sell/fromfield',$purchase)}}">
                     <div class="rounded-pill bg-light-grey px-2 mx-2">Field: {{$purchase->numofbori_left()}} + {{$purchase->numoftora_left()}} </div>
                  </a>
                  <div class="rounded-pill bg-warning px-2">Store: {{$purchase->numofbori_stored()}} + {{$purchase->numoftora_stored()}} </div>

               </div>
            </div>
            <div class="fcol w-100 mt-3">
               <div class="fancyselect">
                  <select name="store_id" id="" required>
                     @foreach($stores as $store)
                     <option value="{{$store->id}}">{{$store->name}}</option>
                     @endforeach
                  </select>
                  <label for="Name">Cold Store Name</label>
               </div>
            </div>
            <div class="frow stretched mt-3">
               <div class="fancyinput w-48">
                  <input type="number" name='bagscost' min="0" value="0" required>
                  <label for="Name" class="bg-transparent">Bags Cost</label>
               </div>
               <div class="fancyinput w-48">
                  <input type="number" name='selectorcost' min="0" value="0">
                  <label for="Name" class="bg-transparent">Selector Cost</label>
               </div>
            </div>
            <div class="frow stretched mt-3">
               <div class="fancyinput w-48">
                  <input type="number" name='sortingcost' min="0" value="0" required>
                  <label for="Name" class="bg-transparent">Sorting Cost</label>
               </div>
               <div class="fancyinput w-48">
                  <input type="number" name='packingcost' min="0" value="0">
                  <label for="Name" class="bg-transparent">Packing Cost</label>
               </div>
            </div>
            <div class="frow stretched mt-3">
               <div class="fancyinput w-48">
                  <input type="number" name='loadingcost' min="0" value="0" required>
                  <label for="Name" class="bg-transparent">Loading Cost</label>
               </div>
               <div class="fancyinput w-48">
                  <input type="number" name='randomcost' min="0" value="0">
                  <label for="Name" class="bg-transparent">Random Cost</label>
               </div>
            </div>

            <div class="frow stretched mt-3">
               <div class="fcol w-48">
                  <div class="fancyselect">
                     <select name="transporter_id" id="" required>
                        <option value="">Select an option ...</option>
                        @foreach($transporters as $transporter)
                        <option value="{{$transporter->id}}">{{$transporter->name}}</option>
                        @endforeach
                     </select>
                     <label for="Name">Transport Company</label>
                  </div>
               </div>
               <div class="fancyinput w-48">
                  <input type="text" name='vehicleno'>
                  <label for="Name">Vehicle No</label>
               </div>
            </div>

            <div class="frow stretched mt-3">
               <div class="fcol w-48">
                  <div class="fancyselect">
                     <select name="client_id" id="" required>
                        <option value="">Select an option ...</option>
                        @foreach($clients as $client)
                        <option value="{{$client->id}}">{{$client->name}}</option>
                        @endforeach
                     </select>
                     <label for="Name">Client (Buyer)</label>
                  </div>
               </div>
               <div class="fcol w-48">
                  <div class="frow stretched">
                     <div class="fancyinput w-48">
                        <input type="number" name='numofbori' id='numofbori' min="0" value="0" required oninput="calcActualWeight()">
                        <label for="Name">Number of Bori</label>
                     </div>
                     <div class="fancyinput w-48">
                        <input type="number" name='numoftora' id='numoftora' min="0" value="0" required oninput="calcActualWeight()">
                        <label for="Name">Number of Tora</label>
                     </div>
                  </div>
               </div>
            </div>

            <div class="frow stretched mt-3">
               <div class="fancyinput w-48">
                  <input type="number" name='grossweight' id='grossweight' min="0" value="0" required oninput="calcActualWeight()">
                  <label for=" Name">Gross Weight</label>
               </div>
               <div class="fancyinput w-48">
                  <input type="number" name='actualweight' id='actualweight' min="0" value="0" disabled class="txt-b txt-red text-center">
                  <label for="Name">Actual Weight</label>
               </div>
            </div>
            <div class="frow stretched mt-3">
               <div class="fancyinput w-48">
                  <input type="number" name='carriage' id='carriage' value="0" oninput="calcActualWeight()" required>
                  <label for="Name">Carriage</label>
               </div>
               <div class="fancyinput w-48">
                  <input type="number" name='commission' id='commission' min="0" value="0" oninput="calcActualWeight()" required>
                  <label for="Name">Commission</label>
               </div>
            </div>

            <div class="frow stretched mt-3">
               <div class="fancyinput w-100">
                  <input type="number" name='saleprice' id='saleprice' min="0" value="0" oninput="calcActualWeight()" required>
                  <label for="Name">Sale Price (Return)</label>
               </div>
            </div>

            <div class="frow mid-right mt-4">
               <button type="submit" class="btn btn-primary">Submit</button>
            </div>

         </form>
      </div>
   </div>
</div>

@endsection

@section('script')
<script lang="javascript">
document.getElementById('dateon').valueAsDate = new Date();

function calcActualWeight() {
   var actual = 0;
   var gross = parseInt($('#grossweight').val())
   var numofbori = parseInt($('#numofbori').val());
   var numoftora = parseInt($('#numoftora').val());
   if (gross > 0)
      actual = gross - 2 * numofbori - 1.5 * numoftora;

   $('#actualweight').val(actual);
   // $('#basicprice').html("B.P: " + actual * unitprice + " + Addl: " + additionalcost + " = " + (actual * unitprice + additionalcost));

}
</script>
@endsection