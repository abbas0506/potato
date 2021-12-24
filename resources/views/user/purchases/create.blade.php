@extends('layouts.user')
@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Deal # {{$deal->id}}</div>
   <div class="frow"> <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      <a href="{{url('deals')}}" class="hover-orange"> Deals </a> <span class="mx-2">/</span>
      <a href="{{route('deals.show',$deal)}}" class="hover-orange">Purchases </a> <span class="mx-2">/</span> New
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
               <span class="txt-b">New Pick</span>
            </div>
         </div>
      </div>
      <form action="{{route('purchases.store')}}" method='post'>
         <div class="frow stretched mb-3">

            @csrf
            <div class="w-70 bg-light">
               <input type="hidden" name='deal_id' value="{{$deal->id}}">
               <div class="frow stretched mt-3">
                  <div class="fancyinput w-24">
                     <input type="date" name='dateon' id='dateon' required>
                     <label for="Name">Date (mm-dd-yyyy)</label>
                  </div>

               </div>

               <div class="frow stretched mt-3">
                  <div class="fancyselect w-40 py-1">
                     <select name="transporter_id" id="" required>
                        <option value="">Select an option ...</option>
                        @foreach($transporters as $transporter)
                        <option value="{{$transporter->id}}">{{$transporter->name}}</option>
                        @endforeach
                     </select>
                     <label for="Name">Transport Company</label>
                  </div>
                  <div class="fancyinput w-20">
                     <input type="text" class='text-center' name='vehicleno' id='vehicleno' placeholder="LPT 2314" value='-' required>
                     <label for="Name">Vehicle No.</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="text" class='text-center' name='grossweight' id='grossweight' value="0" oninput='calcPrice()' required>
                     <label for="Name">Gross (kg)</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="text" class='text-center' name='priceperkg' id='priceperkg' value="{{$deal->unitprice}}" oninput="calcPrice()" required>
                     <label for="Name">@ kg (Rs)</label>
                  </div>
               </div>
               <div class="frow stretched mt-5">
                  <div class="fancyinput w-20">
                     <input type="number" class='text-center' name='numofbori' id='numofbori' value="0" required oninput="calcPrice()">
                     <label for="Name">Number of Bori</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="text" class='text-center' name='reductionperbori' id='reductionperbori' value="{{$config->reductionperbori}}" oninput="calcPrice()" required>
                     <label for="Name">@ reduction</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="text" class='text-center' name='bagpriceperbori' id='bagpriceperbori' value="{{$config->bagpriceperbori}}" oninput="calcPrice()" required>
                     <label for="Name">@ bag price</label>
                  </div>

                  <div class="fancyinput w-15">
                     <input type="text" class='text-center' name='packingcostperbori' id='packingcostperbori' value="{{$config->packingcostperbori}}" oninput="calcPrice()" required>
                     <label for="Name">@ packing</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="text" class='text-center' name='loadingcostperbori' id='loadingcostperbori' value="{{$config->loadingcostperbori}}" oninput="calcPrice()" required>
                     <label for="Name">@ loading</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="text" class='text-center' name='commissionperbori' id='commissionperbori' value="{{$config->commissionperbori}}" oninput="calcPrice()" required>
                     <label for="Name">@ commission</label>
                  </div>
               </div>


               <div class="frow stretched mt-3">

                  <div class="fancyinput w-20">
                     <input type="number" class='text-center' name='numoftora' id='numoftora' value="0" required oninput="calcPrice()">
                     <label for="Name">Number of Tora</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="text" class='text-center' name='reductionpertora' id='reductionpertora' value="{{$config->reductionpertora}}" oninput="calcPrice()" required>
                     <label for="Name">@ reduction</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="text" class='text-center' name='bagpricepertora' id='bagpricepertora' value="{{$config->bagpricepertora}}" oninput="calcPrice()" required>
                     <label for="Name">@ bag price</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="text" class='text-center' name='packingcostpertora' id='packingcostpertora' value="{{$config->packingcostpertora}}" oninput="calcPrice()" required>
                     <label for="Name">@ packing</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="text" class='text-center' name='loadingcostpertora' id='loadingcostpertora' value="{{$config->loadingcostpertora}}" oninput="calcPrice()" required>
                     <label for="Name">@ loading</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="text" class='text-center' class='text-center' name='commissionpertora' id='commissionpertora' value="{{$config->commissionpertora}}" oninput="calcPrice()" required>
                     <label for="Name">@ commision</label>
                  </div>

               </div>

               <div class="frow stretched mt-5">
                  <div class="fancyinput w-15">
                     <input type="text" class='text-center' name='selectorcost' id='selectorcost' value="0" oninput="calcPrice()" required>
                     <label for="Name">Selector</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="text" class='text-center' name='sortingcost' id='sortingcost' value="0" oninput="calcPrice()" required>
                     <label for="Name">Sorting</label>
                  </div>
                  <div class="fancyinput w-15">
                     <input type="number" class='text-center' name='randomcost' id='randomcost' min='0' value="0" oninput="calcPrice()" required>
                     <label for="Name">Random</label>
                  </div>
                  <div class="fancyinput w-50">
                     <input type="text" class='text-center' name='randomnote' id='randomnote' value="">
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
                     <div class="w-48 txt-xs text-right" id='lbl_selectorcost'>0</div>
                  </div>
                  <div class="frow stretched">
                     <div class="w-48 txt-xs">Sorting</div>
                     <div class="w-48 txt-xs text-right" id='lbl_sortingcost'>0</div>
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
                     <div class="w-48 txt-xs text-right" id='lbl_randomcost'>0</div>
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
   var reductionperbori = parseFloat($('#reductionperbori').val());
   var reductionpertora = parseFloat($('#reductionpertora').val());

   var bagpriceperbori = parseFloat($('#bagpriceperbori').val());
   var bagpricepertora = parseFloat($('#bagpricepertora').val());
   var selectorcost = parseInt($('#selectorcost').val());
   var sortingcost = parseInt($('#sortingcost').val());
   var packingcostperbori = parseFloat($('#packingcostperbori').val());
   var packingcostpertora = parseFloat($('#packingcostpertora').val());
   var loadingcostperbori = parseFloat($('#loadingcostperbori').val());
   var loadingcostpertora = parseFloat($('#loadingcostpertora').val());
   var commissionperbori = parseFloat($('#commissionperbori').val());
   var commissionpertora = parseFloat($('#commissionpertora').val());
   var randomcost = parseInt($('#randomcost').val());

   var additionalcost = selectorcost + sortingcost + numofbori * (bagpriceperbori + packingcostperbori + loadingcostperbori + commissionperbori) + numoftora * (bagpricepertora + packingcostpertora + loadingcostpertora + commissionpertora) + randomcost;
   //alert('rb:' + reductionperbori + "rt" + reductionpertora)
   if (gross > 0)
      actual = gross - reductionperbori * numofbori - reductionpertora * numoftora;

   $('#lbl_grossweight').html(gross);
   $('#lbl_reduction').html(reductionperbori * numofbori + reductionpertora * numoftora);
   $('#lbl_actualweight').html(actual);
   $('#lbl_basicprice').html(actual * priceperkg);
   $('#lbl_addlcost').html(additionalcost);
   //additional detail
   $('#lbl_selectorcost').html(selectorcost);
   $('#lbl_sortingcost').html(sortingcost);
   $('#lbl_bagscost').html(bagpriceperbori * numofbori + bagpricepertora * numoftora);
   $('#lbl_packingcost').html(packingcostperbori * numofbori + packingcostpertora * numoftora);
   $('#lbl_loadingcost').html(loadingcostperbori * numofbori + loadingcostpertora * numoftora);
   $('#lbl_commission').html(commissionperbori * numofbori + commissionpertora * numoftora);
   $('#lbl_randomcost').html(randomcost);



   $('#lbl_total').html(actual * priceperkg + additionalcost);


}
</script>
@endsection