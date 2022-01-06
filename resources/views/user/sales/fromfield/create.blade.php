@extends('layouts.user')
@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Deal # {{$deal->id}}</div>
   <div class="frow"> <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      <a href="{{url('deals')}}" class="hover-orange"> Deals </a> <span class="mx-2">/</span>
      <a href="{{route('deals.show',$deal)}}" class="hover-orange">{{$deal->id}} </a> <span class="mx-2">/</span>New Sale
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
               <div class="">New Sale <span class="txt-s">(from field)</span></div>
               <div class="frow centered txt-s"><b>{{$deal->seller->name}} </b>[ Deal No. {{$deal->id}} dated {{$deal->dateon->format('d/m/y')}}, {{$deal->product->name}}@Rs.{{$deal->priceperkg}}]</div>
            </div>
         </div>

         <form action="{{route('sales.store')}}" method='post'>
            @csrf
            <div class="frow centered stretched mt-4">
               <div class="w-72">
                  <input type="hidden" name="purchase_id" value="{{$purchase->id}}">
                  <input type="hidden" id="_reduction0" value="{{$purchase->reduction0}}">
                  <input type="hidden" id="_reduction1" value="{{$purchase->reduction1}}">
                  <div class="frow mid-left">
                     <div class="fancyinput">
                        <input type="date" name='dateon' id='dateon' placeholder="Enter name" required>
                        <label for="Name">Date (mm-dd-yyyy)</label>
                     </div>

                     <div class="rounded-pill bg-warning px-2 mx-5"><i data-feather='map-pin' class="feather-xsmall mb-1 mr-2"></i> {{$purchase->left()}} </div>


                  </div>

                  <div class=" mt-4 txt-s txt-blue">Sale Quantity & Respective Cost Info --------------------</div>
                  <div class="frow stretched mt-4" @if($purchase->numofbori_left()==0) hidden @endif>
                     <div class="fancyinput w-20">
                        <input type="number" class='text-center' name='numofbori' id='numofbori' value="{{$purchase->numofbori_left()}}" oninput="calcProfit()" required>
                        <label for="Name">Number of Bori</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class='text-center' name='reduction0' id='reduction0' value="@if($purchase->numofbori_left()==0) 0 @else {{$config->reduction0}} @endif" oninput="calcProfit()" required>
                        <label for="Name">@ reduction</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class="text-center" name='commission0' id='commission0' min="0" value="@if($purchase->numofbori_left()==0) 0 @else {{$config->commission0}} @endif" oninput="calcProfit()" required>
                        <label for="Name">@ Comm.</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class='text-center' name='bagprice0' id='bagprice0' value="@if($purchase->numofbori_left()==0) 0 @else {{$config->bagprice0}} @endif" oninput="calcProfit()">
                        <label for="Name">@ bag price</label>
                     </div>

                     <div class="fancyinput w-15">
                        <input type="text" class='text-center' name='packing0' id='packing0' value="@if($purchase->numofbori_left()==0) 0 @else {{$config->packing0}} @endif" oninput="calcProfit()">
                        <label for="Name">@ packing</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class='text-center' name='loading0' id='loading0' value="@if($purchase->numofbori_left()==0) 0 @else {{$config->loading0}} @endif" oninput="calcProfit()">
                        <label for="Name">@ loading</label>
                     </div>

                  </div>
                  <div class="frow stretched mt-3" @if($purchase->numoftora_left()==0) hidden @endif>
                     <div class="fancyinput w-20">
                        <input type="number" class='text-center' name='numoftora' id='numoftora' value="{{$purchase->numoftora_left()}}" oninput="calcProfit()" required>
                        <label for="Name">Number of Tora</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class='text-center' name='reduction1' id='reduction1' value="@if($purchase->numoftora_left()==0) 0 @else {{$config->reduction1}} @endif" oninput="calcProfit()" required>
                        <label for="Name">@ reduction</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class="text-center" name='commission1' id='commission1' min="0" value="@if($purchase->numoftora_left()==0) 0 @else {{$config->commission1}} @endif" oninput="calcProfit()" required>
                        <label for="Name">@ Comm.</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class='text-center' name='bagprice1' id='bagprice1' value="@if($purchase->numoftora_left()==0) 0 @else {{$config->bagprice1}} @endif" oninput="calcProfit()">
                        <label for="Name">@ bag price</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class='text-center' name='packing1' id='packing1' value="@if($purchase->numoftora_left()==0) 0 @else {{$config->packing1}} @endif" oninput="calcProfit()">
                        <label for="Name">@ packing</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class='text-center' name='loading1' id='loading1' value="@if($purchase->numoftora_left()==0) 0 @else {{$config->loading1}} @endif" oninput="calcProfit()">
                        <label for="Name">@ loading</label>
                     </div>
                  </div>

                  <div class="frow stretched mt-4">
                     <div class="fancyinput w-24">
                        <input type="number" class='text-center' name='selector' id='selector' value="0" oninput="calcProfit()">
                        <label for="Name">Selector</label>
                     </div>
                     <div class="fancyinput w-24">
                        <input type="number" class='text-center' name='sorting' id='sorting' value="0" oninput="calcProfit()">
                        <label for="Name">Sorting</label>
                     </div>
                     <div class="fancyinput w-24">
                        <input type="number" class='text-center' name='random' id='random' min='0' value="0" oninput="calcProfit()">
                        <label for="Name">Random</label>
                     </div>
                     <div class="fancyinput w-24">
                        <input type="number" class='text-center' name='sadqa' id='sadqa' min='0' value="500" oninput="calcProfit()">
                        <label for="Name">Sadqa</label>
                     </div>
                  </div>
                  <div class=" mt-4 txt-s txt-blue">Buyer, Gross Weight & Sale Price Info --------------------</div>
                  <div class="frow stretched mt-3">
                     <div class="fancyselect w-48">
                        <select name="buyer_id" id="" required>
                           <option value="">Select an option ...</option>
                           @foreach($buyers as $buyer)
                           <option value="{{$buyer->id}}">{{$buyer->name}}</option>
                           @endforeach
                        </select>
                        <label for="Name">Buyer Name</label>
                     </div>
                     <div class="fancyinput w-24">
                        <input type="number" class='text-center' name='grossweight' id='grossweight' min='0' value="0" oninput="calcProfit()">
                        <label for="Name">Gross</label>
                     </div>
                     <div class="fancyinput w-24">
                        <input type="number" class="text-center txt-red txt-b" name='saleprice' id='saleprice' min="0" value="0" oninput="calcProfit()" required>
                        <label for="Name">Final Sale Price</label>
                     </div>
                  </div>
                  <div>
                     <div class="fancyinput mt-3">
                        <input type="text" class='text-center' name='note' id='note'>
                        <label for="Name">Any Note</label>
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
                        <div class="w-48 txt-s">Seller Price / kg</div>
                        <div class="w-48 txt-s text-right" id='lbl_costperkg'>{{$purchase->priceperkg}}</div>
                     </div>
                     <div class="frow stretched">
                        <div class="w-48 txt-s">Addl Cost</div>
                        <div class="w-48 txt-s text-right" id='lbl_addlcost'></div>
                     </div>
                     <div class="frow stretched txt-b">
                        <div class="w-48 txt-s">Cost Price</div>
                        <div class="w-48 txt-s text-right" id='lbl_costprice'></div>
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
   var numofbori = parseInt($('#numofbori').val());
   var numoftora = parseInt($('#numoftora').val());

   var reduction0 = parseFloat($('#reduction0').val());
   var commission0 = parseFloat($('#commission0').val());
   var bagprice0 = parseFloat($('#bagprice0').val());
   var packing0 = parseFloat($('#packing0').val());
   var loading0 = parseFloat($('#loading0').val());

   var reduction1 = parseFloat($('#reduction1').val());
   var commission1 = parseFloat($('#commission1').val());
   var bagprice1 = parseFloat($('#bagprice1').val());
   var packing1 = parseFloat($('#packing1').val());
   var loading1 = parseFloat($('#loading1').val());

   var selector = parseInt($('#selector').val());
   var sorting = parseInt($('#sorting').val());
   var random = parseInt($('#random').val());
   var sadqa = parseInt($('#sadqa').val());


   var costperkg = parseFloat($('#lbl_costperkg').html());

   // alert(purchaseprice)
   var gross = parseInt($('#grossweight').val())
   var saleprice = parseInt($('#saleprice').val());


   if (gross > 0)
      actual = gross - reduction0 * numofbori - reduction1 * numoftora;

   var addlcost = selector + sorting + random + sadqa + numofbori * (bagprice0 + commission0 + packing0 + loading0) + numoftora * (bagprice1 + commission1 + packing1 + loading1)
   costprice = actual * costperkg + addlcost;
   var profit = saleprice - costprice;

   $('#lbl_grossweight').html(gross);
   $('#lbl_reduction').html(reduction0 * numofbori + reduction1 * numoftora);
   $('#lbl_actualweight').html(actual);
   $('#lbl_addlcost').html(addlcost);
   $('#lbl_costprice').html(costprice);
   $('#lbl_saleprice').html(saleprice);
   $('#lbl_profit').html(profit);
}
</script>
@endsection