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
   <div class="fcol w-70">
      <div class="w-100 bg-light my-3">
         <div class="border-1 border-left border-success py-2 text-primary txt-m" style="background-color: #eee;">
            <div class="frow px-4 stretched">
               <div>
                  {{$deal->client->name}} <span class="txt-s ml-4">Agreement => {{$deal->product->name}} : {{$deal->numofbori}} + {{$deal->numoftora}} @ Rs. {{$deal->unitprice}} dated {{$deal->dateon}}</span>
               </div>
               <div class="frow spaced txt-s mid-right">
                  <span class="txt-b">New Purchase</span>
               </div>
            </div>
         </div>

         <form action="{{route('purchases.store')}}" method='post'>
            @csrf
            <!-- <div class="txt-m txt-b txt-red my-2 px-4 border-left border-2 border-success">Purchasing</div> -->
            <input type="hidden" name='deal_id' value="{{$deal->id}}">
            <div class="frow stretched mt-4">
               <div class="fancyinput w-24">
                  <input type="date" name='dateon' id='dateon' placeholder="Enter name" required>
                  <label for="Name">Date (mm-dd-yyyy)</label>
               </div>

               <div class="frow centered border border-1 border-primary w-50 py-2">
                  <span class="badge badge-primary badge-sm txt-s">Basic</span> <span id='span_basicprice' class="mx-1">0</span> +
                  <span class="badge badge-primary badge-sm txt-s ml-1">Addl</span> <span id='span_addlcost' class="mx-1">0</span> =
                  <span id='span_total' class="txt-m txt-red mx-1">0</span>
               </div>
            </div>
            <div class="frow stretched mt-3">
               <div class="fcol w-48">
                  <div class="frow stretched">
                     <div class="fancyinput w-48">
                        <input type="number" name='numofbori' id='numofbori' min="0" value="0" required oninput="calcPrice()">
                        <label for="Name">Number of Bori</label>
                     </div>
                     <div class="fancyinput w-48">
                        <input type="number" name='numoftora' id='numoftora' min="0" value="0" required oninput="calcPrice()">
                        <label for="Name">Number of Tora</label>
                     </div>
                  </div>
               </div>
               <div class="fcol w-48">
                  <div class="frow stretched">
                     <div class="fancyinput w-48">
                        <input type="number" name='grossweight' id='grossweight' min="0" value="0" oninput='calcPrice()' required>
                        <label for="Name">Gross Weight</label>
                     </div>
                     <div class="fancyinput w-48">
                        <input type="number" name='actualweight' id='actualweight' min="0" value="0" disabled class="txt-b txt-red text-center">
                        <label for="Name">Actual Weight</label>
                     </div>
                  </div>
               </div>
            </div>

            <div class="frow stretched mt-3">
               <div class="fancyinput w-48">
                  <input type="number" name='unitprice' id='unitprice' value="0" oninput="calcPrice()" required>
                  <label for="Name">Unit Price</label>
               </div>
               <div class="fancyinput w-48">
                  <input type="number" name='commission' id='commission' min="0" value="0" oninput="calcPrice()" required>
                  <label for="Name">Commission</label>
               </div>
            </div>


            <div class="frow stretched mt-3">
               <div class="fancyinput w-48">
                  <input type="number" name='bagscost' id='bagscost' min="0" value="0" oninput="calcPrice()" required>
                  <label for="Name">Bags Cost</label>
               </div>
               <div class="fancyinput w-48">
                  <input type="number" name='selectorcost' id='selectorcost' min="0" value="0" oninput="calcPrice()" required>
                  <label for="Name">Selector Cost</label>
               </div>
            </div>
            <div class="frow stretched mt-3">
               <div class="fancyinput w-48">
                  <input type="number" name='packingcost' id='packingcost' min="0" value="0" oninput="calcPrice()" required>
                  <label for="Name">Packing Cost</label>
               </div>
               <div class="fancyinput w-48">
                  <input type="number" name='loadingcost' id='loadingcost' min="0" value="0" oninput="calcPrice()" required>
                  <label for="Name">Loading Cost</label>
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
   var gross = parseInt($('#grossweight').val())
   var numofbori = parseInt($('#numofbori').val());
   var numoftora = parseInt($('#numoftora').val());
   var unitprice = parseInt($('#unitprice').val());

   var commission = parseInt($('#commission').val());
   var bagscost = parseInt($('#bagscost').val());
   var selectorcost = parseInt($('#selectorcost').val());
   var packingcost = parseInt($('#packingcost').val());
   var loadingcost = parseInt($('#loadingcost').val());

   var additionalcost = commission + bagscost + selectorcost + packingcost + loadingcost;

   if (gross > 0)
      actual = gross - 2 * numofbori - 0.5 * numoftora;

   $('#actualweight').val(actual);
   $('#span_basicprice').html(actual * unitprice);
   $('#span_addlcost').html(additionalcost);
   $('#span_total').html(actual * unitprice + additionalcost);


}
</script>
@endsection