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
                  {{$deal->client->name}} <span class="txt-s ml-4">Agreement => {{$deal->product->name}} : {{$deal->numofbori}} + {{$deal->numoftora}} @ Rs. {{$deal->unitprice}} dated {{$deal->dateon}}</span>
               </div>
               <div class="frow spaced txt-s mid-right">
                  <span class="txt-b">New Sale [ Store ]</span>
               </div>
            </div>
         </div>

         <form action="{{route('sales.store')}}" method='post'>
            @csrf
            <div class="frow centered stretched mt-4">
               <div class="w-70">
                  <input type="hidden" name="purchase_id" value="{{$purchase->id}}">
                  <input type="hidden" id="_reductionperbori" value="{{$purchase->reductionperbori}}">
                  <input type="hidden" id="_reductionpertora" value="{{$purchase->reductionpertora}}">
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
                  <div class="frow stretched mt-3">

                     <div class="fancyselect w-32">
                        <select name="store_id" id="" required>
                           @foreach($stores as $store)
                           <option value="{{$store->id}}">{{$store->name}}</option>
                           @endforeach
                        </select>
                        <label for="Name">Cold Store Name</label>
                     </div>
                     <div class="fancyselect w-32">
                        <select name="transporter_id" id="" required>
                           <option value="">Select an option ...</option>
                           @foreach($transporters as $transporter)
                           <option value="{{$transporter->id}}">{{$transporter->name}}</option>
                           @endforeach
                        </select>
                        <label for="Name">Transport Company</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class='text-center' name='vehicleno' id='vehicleno' placeholder="LPT 2314" value='-' required>
                        <label for="Name">Vehicle No.</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="number" class='text-center' name='grossweight' id='grossweight' value="0" oninput='calcProfit()' required>
                        <label for="Name">Gross (kg)</label>
                     </div>
                  </div>
                  <div class="frow stretched mt-5">
                     <div class="fancyinput w-20">
                        <input type="number" class='text-center' name='numofbori' id='numofbori' value="0" required oninput="calcProfit()">
                        <label for="Name">Number of Bori</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class='text-center' name='reductionperbori' id='reductionperbori' value="{{$config->reductionperbori}}" oninput="calcProfit()" required>
                        <label for="Name">@ reduction</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class='text-center' name='bagpriceperbori' id='bagpriceperbori' value="{{$config->bagpriceperbori}}" oninput="calcProfit()" required>
                        <label for="Name">@ bag price</label>
                     </div>

                     <div class="fancyinput w-15">
                        <input type="text" class='text-center' name='packingcostperbori' id='packingcostperbori' value="{{$config->packingcostperbori}}" oninput="calcProfit()" required>
                        <label for="Name">@ packing</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class='text-center' name='loadingcostperbori' id='loadingcostperbori' value="{{$config->loadingcostperbori}}" oninput="calcProfit()" required>
                        <label for="Name">@ loading</label>
                     </div>
                  </div>


                  <div class="frow stretched mt-3">

                     <div class="fancyinput w-20">
                        <input type="number" class='text-center' name='numoftora' id='numoftora' value="0" required oninput="calcProfit()">
                        <label for="Name">Number of Tora</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class='text-center' name='reductionpertora' id='reductionpertora' value="{{$config->reductionpertora}}" oninput="calcProfit()" required>
                        <label for="Name">@ reduction</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class='text-center' name='bagpricepertora' id='bagpricepertora' value="{{$config->bagpricepertora}}" oninput="calcProfit()" required>
                        <label for="Name">@ bag price</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class='text-center' name='packingcostpertora' id='packingcostpertora' value="{{$config->packingcostpertora}}" oninput="calcProfit()" required>
                        <label for="Name">@ packing</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class='text-center' name='loadingcostpertora' id='loadingcostpertora' value="{{$config->loadingcostpertora}}" oninput="calcProfit()" required>
                        <label for="Name">@ loading</label>
                     </div>

                  </div>

                  <div class="frow stretched mt-5">
                     <div class="fancyinput w-15">
                        <input type="number" class='text-center' name='selectorcost' id='selectorcost' value="0" oninput="calcProfit()" required>
                        <label for="Name">Selector</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="number" class='text-center' name='sortingcost' id='sortingcost' value="0" oninput="calcProfit()" required>
                        <label for="Name">Sorting</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="number" class='text-center' name='randomcost' id='randomcost' min='0' value="0" oninput="calcProfit()" required>
                        <label for="Name">Random</label>
                     </div>
                     <div class="fancyinput w-50">
                        <input type="text" class='text-center' name='randomnote' id='randomnote' value="">
                        <label for="Name">Random Note</label>
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
               <div class="fcol w-24 stretched">
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
   var reductionperbori = parseFloat($('#_reductionperbori').val());
   var reductionpertora = parseFloat($('#_reductionpertora').val());
   var actualcostperkg = parseFloat($('#lbl_actualcostperkg').html());

   // alert(purchaseprice)
   var saleprice = parseInt($('#saleprice').val());


   if (gross > 0)
      actual = gross - reductionperbori * numofbori - reductionpertora * numoftora;

   costprice = actual * actualcostperkg;
   var profit = saleprice - costprice;

   $('#lbl_grossweight').html(gross);
   $('#lbl_reduction').html(reductionperbori * numofbori + reductionpertora * numoftora);
   $('#lbl_actualweight').html(actual);
   $('#lbl_basicprice').html(costprice);
   $('#lbl_saleprice').html(saleprice);
   $('#lbl_profit').html(profit);
}
</script>
@endsection