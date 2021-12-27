@extends('layouts.user')
@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Deal # {{$deal->id}}</div>
   <div class="frow"> <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      <a href="{{url('deals')}}" class="hover-orange"> Deals </a> <span class="mx-2">/</span>
      <a href="{{route('deals.show',$deal)}}" class="hover-orange">Picks </a> <span class="mx-2">/</span> Edit
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
      <div class="border-1 border-left border-success py-2 my-3 text-primary txt-m" style="background-color: #eee;">
         <div class="frow px-4 stretched">
            <div>
               {{$deal->client->name}} <span class="txt-s ml-4">Agreement => {{$deal->product->name}} : {{$deal->numofbori}} + {{$deal->numoftora}} @ Rs. {{$deal->priceperkg}} dated {{$deal->dateon}}</span>
            </div>
            <div class="frow spaced txt-s mid-right">
               <span class="txt-b">Edit Pick</span>
            </div>
         </div>
      </div>
      <form action="{{route('purchases.update', $purchase)}}" method='post'>
         <div class="frow stretched mb-3">

            @csrf
            @method('PATCH')
            <div class="w-70 bg-light">
               <input type="hidden" name='deal_id' value="{{$deal->id}}">
               <div class="txt-s txt-b txt-red my-3">Pick Date: {{$purchase->dateon}}</div>
               <div class="frow stretched mt-3">
                  <div class="fancyselect w-40 py-1">
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
                  <div class="fancyinput w-20">
                     <input type="text" class='text-center' name='vehicleno' id='vehicleno' placeholder="LPT 2314" value='{{$purchase->vehicleno}}' required>
                     <label for="Name">Vehicle No.</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="number" class='text-center' name='grossweight' id='grossweight' value="{{$purchase->grossweight}}" oninput='calcPrice()' required>
                     <label for="Name">Gross (kg)</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="text" class='text-center' name='priceperkg' id='priceperkg' value="{{$purchase->priceperkg}}" oninput="calcPrice()" required>
                     <label for="Name">@ kg (Rs)</label>
                  </div>
               </div>
               <div class="frow stretched mt-5">
                  <div class="fancyinput w-20">
                     <input type="number" class='text-center' name='numofbori' id='numofbori' value="{{$purchase->numofbori}}" required oninput="calcPrice()">
                     <label for="Name">Number of Bori</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="text" class='text-center' name='reduction0' id='reduction0' value="{{$purchase->reduction0}}" oninput="calcPrice()" required>
                     <label for="Name">@ reduction</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="text" class='text-center' name='bagprice0' id='bagprice0' value="{{$purchase->bagprice0}}" oninput="calcPrice()" required>
                     <label for="Name">@ bag price</label>
                  </div>

                  <div class="fancyinput w-15">
                     <input type="text" class='text-center' name='packing0' id='packing0' value="{{$purchase->packing0}}" oninput="calcPrice()" required>
                     <label for="Name">@ packing</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="text" class='text-center' name='loading0' id='loading0' value="{{$purchase->loading0}}" oninput="calcPrice()" required>
                     <label for="Name">@ loading</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="text" class='text-center' name='commission0' id='commission0' value="{{$purchase->commission0}}" oninput="calcPrice()" required>
                     <label for="Name">@ commission</label>
                  </div>
               </div>


               <div class="frow stretched mt-3">

                  <div class="fancyinput w-20">
                     <input type="number" class='text-center' name='numoftora' id='numoftora' value="{{$purchase->numoftora}}" required oninput="calcPrice()">
                     <label for="Name">Number of Tora</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="text" class='text-center' name='reduction1' id='reduction1' value="{{$purchase->reduction1}}" oninput="calcPrice()" required>
                     <label for="Name">@ reduction</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="text" class='text-center' name='bagprice1' id='bagprice1' value="{{$purchase->bagprice1}}" oninput="calcPrice()" required>
                     <label for="Name">@ bag price</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="text" class='text-center' name='packing1' id='packing1' value="{{$purchase->packing1}}" oninput="calcPrice()" required>
                     <label for="Name">@ packing</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="text" class='text-center' name='loading1' id='loading1' value="{{$purchase->loading1}}" oninput="calcPrice()" required>
                     <label for="Name">@ loading</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="text" class='text-center' class='text-center' name='commission1' id='commission1' value="{{$purchase->commission1}}" oninput="calcPrice()" required>
                     <label for="Name">@ commision</label>
                  </div>

               </div>

               <div class="frow stretched mt-5">
                  <div class="fancyinput w-15">
                     <input type="number" class='text-center' name='selector' id='selector' value="{{$purchase->selector}}" oninput="calcPrice()" required>
                     <label for="Name">Selector</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="number" class='text-center' name='sorting' id='sorting' value="{{$purchase->sorting}}" oninput="calcPrice()" required>
                     <label for="Name">Sorting</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="number" class='text-center' name='random' id='random' min='0' value="{{$purchase->random}}" oninput="calcPrice()" required>
                     <label for="Name">Random</label>
                  </div>
                  <div class="fancyinput w-50">
                     <input type="text" class='text-center' name='note' id='note' value="{{$purchase->note}}">
                     <label for="Name">Random Note</label>
                  </div>
               </div>


            </div>

            <div class="fcol w-24 mt-3 stretched">
               <div class="border p-2">
                  <div class="frow stretched">
                     <div class="w-48 txt-s txt-b">Gross Weight</div>
                     <div class="w-48 txt-s text-right" id='lbl_grossweight'>0</div>
                  </div>
                  <div class="frow stretched">
                     <div class="w-48 txt-s txt-b">Reduction</div>
                     <div class="w-48 txt-s text-right" id='lbl_reduction'>0</div>
                  </div>
                  <div class="frow stretched">
                     <div class="w-48 txt-s txt-b">Actual Weight</div>
                     <div class="w-48 txt-s text-right" id='lbl_actualweight'>0</div>
                  </div>
                  <div class="frow stretched">
                     <div class="w-48 txt-s txt-b">Basic Price</div>
                     <div class="w-48 txt-s text-right" id='lbl_basicprice'>0</div>
                  </div>
                  <div class="frow stretched">
                     <div class="w-48 txt-s txt-b">Addl. Cost</div>
                     <div class="w-48 txt-s text-right" id='lbl_addlcost'>0</div>
                  </div>
                  <div class="frow stretched">
                     <div class="w-48 txt-xs">Selector</div>
                     <div class="w-48 txt-xs text-right" id='lbl_selector'>0</div>
                  </div>
                  <div class="frow stretched">
                     <div class="w-48 txt-xs">Sorting</div>
                     <div class="w-48 txt-xs text-right" id='lbl_sorting'>0</div>
                  </div>
                  <div class="frow stretched">
                     <div class="w-48 txt-xs">Bags</div>
                     <div class="w-48 txt-xs text-right" id='lbl_bagscost'>0</div>
                  </div>
                  <div class="frow stretched">
                     <div class="w-48 txt-xs">Packing</div>
                     <div class="w-48 txt-xs text-right" id='lbl_packingcost'>0</div>
                  </div>
                  <div class="frow stretched">
                     <div class="w-48 txt-xs">Loading</div>
                     <div class="w-48 txt-xs text-right" id='lbl_loadingcost'>0</div>
                  </div>
                  <div class="frow stretched">
                     <div class="w-48 txt-xs">Commission</div>
                     <div class="w-48 txt-xs text-right" id='lbl_commission'>0</div>
                  </div>
                  <div class="frow stretched">
                     <div class="w-48 txt-xs">Random</div>
                     <div class="w-48 txt-xs text-right" id='lbl_random'>0</div>
                  </div>
                  <div class="frow stretched txt-red">
                     <div class="w-48 txt-s txt-b">Total</div>
                     <div class="w-48 txt-s text-right" id='lbl_total'>0</div>
                  </div>
               </div>
               <div class="frow mt-4">
                  <button type="submit" class="btn btn-primary w-100">Submit</button>
               </div>
            </div>

         </div>
      </form>
   </div>
</div>

@endsection

@section('script')
<script lang="javascript">
   document.getElementById('dateon').valueAsDate = new Date();

   function search(event) {
      var searchtext = event.target.value.toLowerCase();
      var str = 0;
      $('.tr').each(function() {
         if (!(
               $(this).children().eq(0).prop('outerText').toLowerCase().includes(searchtext)
            )) {
            $(this).addClass('hide');
         } else {
            $(this).removeClass('hide');
         }
      });
   }

   function calcPrice() {
      var actual = 0;

      var gross = parseFloat($('#grossweight').val())

      var numofbori = parseInt($('#numofbori').val());
      var numoftora = parseInt($('#numoftora').val());
      var priceperkg = parseFloat($('#priceperkg').val());
      var reduction0 = parseFloat($('#reduction0').val());
      var reduction1 = parseFloat($('#reduction1').val());

      var bagprice0 = parseFloat($('#bagprice0').val());
      var bagprice1 = parseFloat($('#bagprice1').val());
      var selector = parseInt($('#selector').val());
      var sorting = parseInt($('#sorting').val());
      var packing0 = parseFloat($('#packing0').val());
      var packing1 = parseFloat($('#packing1').val());
      var loading0 = parseFloat($('#loading0').val());
      var loading1 = parseFloat($('#loading1').val());
      var commission0 = parseFloat($('#commission0').val());
      var commission1 = parseFloat($('#commission1').val());
      var random = parseInt($('#random').val());

      var additionalcost = selector + sorting + numofbori * (bagprice0 + packing0 + loading0 + commission0) + numoftora * (bagprice1 + packing1 + loading1 + commission1) + random;
      //alert('rb:' + reduction0 + "rt" + reduction1)
      if (gross > 0)
         actual = gross - reduction0 * numofbori - reduction1 * numoftora;

      $('#lbl_grossweight').html(gross);
      $('#lbl_reduction').html(reduction0 * numofbori + reduction1 * numoftora);
      $('#lbl_actualweight').html(actual);
      $('#lbl_basicprice').html(actual * priceperkg);
      $('#lbl_addlcost').html(additionalcost);
      //additional detail
      $('#lbl_selector').html(selector);
      $('#lbl_sorting').html(sorting);
      $('#lbl_bagscost').html(bagprice0 * numofbori + bagprice1 * numoftora);
      $('#lbl_packingcost').html(packing0 * numofbori + packing1 * numoftora);
      $('#lbl_loadingcost').html(loading0 * numofbori + loading1 * numoftora);
      $('#lbl_commission').html(commission0 * numofbori + commission1 * numoftora);
      $('#lbl_random').html(random);



      $('#lbl_total').html(actual * priceperkg + additionalcost);


   }
</script>
@endsection