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
   <div class="fcol w-80">
      <div class="w-100 bg-light my-3">
         <div class="border-1 border-left border-success py-2 text-primary txt-m" style="background-color: #eee;">
            <div class="frow px-4 stretched">
               <div>
                  {{$deal->client->name}} <span class="txt-s ml-4">Agreement => {{$deal->product->name}} : {{$deal->numofbori}} + {{$deal->numoftora}} @ Rs. {{$deal->priceperkg}} dated {{$deal->dateon}}</span>
               </div>
               <div class="frow spaced txt-s mid-right">
                  <span class="txt-b">New Sale [ Field ]</span>
               </div>
            </div>
         </div>

         <form action="{{route('sales.store')}}" method='post'>
            @csrf
            <div class="frow centered stretched mt-4">
               <div class="w-70">
                  <input type="hidden" name="purchase_id" value="{{$purchase->id}}">
                  <input type="hidden" id="_reduction0" value="{{$purchase->reduction0}}">
                  <input type="hidden" id="_reduction1" value="{{$purchase->reduction1}}">
                  <div class="frow mid-left">
                     <div class="fancyinput">
                        <input type="date" name='dateon' id='dateon' placeholder="Enter name" required>
                        <label for="Name">Date (mm-dd-yyyy)</label>
                     </div>
                     <div class="frow ml-5">
                        <div class="txt-b txt-red mr-4">Where to sell from???</div>
                        <div class="rounded-pill bg-warning px-2 mx-2"><i data-feather='map-pin' class="feather-xsmall mb-1 mr-2"></i> {{$purchase->numofbori_left()}} + {{$purchase->numoftora_left()}} </div>
                        <a href="{{url('sell/fromstore',$purchase)}}">
                           <div class="rounded-pill bg-light-grey px-2"><i data-feather='database' class="feather-xsmall mb-1 mr-2"></i> {{$purchase->numofbori_stored()}} + {{$purchase->numoftora_stored()}} </div>
                        </a>
                     </div>
                  </div>
                  <div class="frow stretched mt-3">
                     <div class="fancyselect w-32">
                        <select name="transporter_id" id="" required>
                           <option value="">Select an option ...</option>
                           @foreach($transporters as $transporter)
                           @if($transporter->id==$purchase->transporter_id)
                           <option value="{{$transporter->id}}" selected>{{$transporter->name}}</option>
                           @else
                           <option value="{{$transporter->id}}" selected>{{$transporter->name}}</option>
                           @endif
                           @endforeach
                        </select>
                        <label for="Name">Transport Company</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class="text-center" name='vehicleno' value="{{$purchase->vehicleno}}">
                        <label for="Name">Vehicle No</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="number" class="text-center" name='grossweight' id='grossweight' min="0" value="0" required oninput="calcProfit()">
                        <label for=" Name">Gross (kg)</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="number" class="text-center" name='numofbori' id='numofbori' min="0" max='{{$purchase->numofbori_left()}}' value="{{$purchase->numofbori_left()}}" required oninput="calcProfit()">
                        <label for="Name">No. of Bori</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="number" class="text-center" name='numoftora' id='numoftora' min="0" max='{{$purchase->numoftora_left()}}' value="{{$purchase->numoftora_left()}}" required oninput="calcProfit()">
                        <label for="Name">No. of Tora</label>
                     </div>
                  </div>
                  <div class="frow stretched mt-3">
                     <div class="fancyselect w-48">
                        <select name="client_id" id="" required>
                           <option value="">Select an option ...</option>
                           @foreach($clients as $client)
                           <option value="{{$client->id}}">{{$client->name}}</option>
                           @endforeach
                        </select>
                        <label for="Name">Client (Buyer)</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="number" class="text-center" name='carriage' id='carriage' value="0" oninput="calcProfit()" required>
                        <label for="Name">Carriage</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="number" class="text-center" name='commission' id='commission' min="0" value="0" oninput="calcProfit()" required>
                        <label for="Name">Commission</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="number" class="text-center" name='saleprice' id='saleprice' min="0" value="0" oninput="calcProfit()" required>
                        <label for="Name">Final Sale Price</label>
                     </div>
                  </div>
               </div>
               <div class="w-24 stretched">
                  <div class="border p-2">
                     <div class="frow stretched">
                        <div class="w-48 txt-s">Gross Weight</div>
                        <div class="w-48 txt-s text-right" id='lbl_grossweight'>0</div>
                     </div>
                     <div class="frow stretched">
                        <div class="w-48 txt-s">Reduction</div>
                        <div class="w-48 txt-s text-right" id='lbl_reduction'>0</div>
                     </div>
                     <div class="frow stretched">
                        <div class="w-48 txt-s">Actual Weight</div>
                        <div class="w-48 txt-s text-right" id='lbl_actualweight'>0</div>
                     </div>
                     <div class="frow stretched">
                        <div class="w-48 txt-s">Actual Cost / kg</div>
                        <div class="w-48 txt-s text-right" id='lbl_actualcostperkg'>{{$purchase->finalcostperkg()}}</div>
                     </div>
                     <div class="frow stretched txt-b">
                        <div class="w-48 txt-s">Cost Price</div>
                        <div class="w-48 txt-s text-right" id='lbl_basicprice'></div>
                     </div>
                     <div class="frow stretched txt-b">
                        <div class="w-48 txt-s">Final Sale Price</div>
                        <div class="w-48 txt-s text-right" id='lbl_saleprice'>0</div>
                     </div>

                     <div class="frow stretched txt-red">
                        <div class="w-48 txt-s txt-b">Net Profit</div>
                        <div class="w-48 txt-s text-right" id='lbl_profit'>0</div>
                     </div>

                  </div>
                  <div class="frow mid-right mt-4">
                     <button type="submit" class="btn btn-primary w-100">Submit</button>
                  </div>
               </div>

            </div>


         </form>
      </div>
   </div>
</div>

@endsection

@section('script')
<script lang="javascript">
   document.getElementById('dateon').valueAsDate = new Date();

   function calcProfit() {
      var actual = 0;
      var gross = parseInt($('#grossweight').val())
      var numofbori = parseInt($('#numofbori').val());
      var numoftora = parseInt($('#numoftora').val());
      var reduction0 = parseFloat($('#_reduction0').val());
      var reduction1 = parseFloat($('#_reduction1').val());
      var actualcostperkg = parseFloat($('#lbl_actualcostperkg').html());

      // alert(purchaseprice)
      var saleprice = parseInt($('#saleprice').val());


      if (gross > 0)
         actual = gross - reduction0 * numofbori - reduction1 * numoftora;

      costprice = actual * actualcostperkg;
      var profit = saleprice - costprice;

      $('#lbl_grossweight').html(gross);
      $('#lbl_reduction').html(reduction0 * numofbori + reduction1 * numoftora);
      $('#lbl_actualweight').html(actual);
      $('#lbl_basicprice').html(costprice);
      $('#lbl_saleprice').html(saleprice);
      $('#lbl_profit').html(profit);
   }
</script>
@endsection