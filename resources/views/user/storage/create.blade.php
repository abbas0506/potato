@extends('layouts.user')
@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">New Storage</div>
   <div class="frow">
      <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      <a href="{{route('purchases.index')}}" class="hover-orange"> Purchases </a> <span class="mx-2">/</span>
      Store
   </div>
</div>
<div class="frow centered txt-s txt-grey my-2">{{now()}}</div>
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
   <div class="fcol w-60">
      <div class="w-100 bg-light my-3">
         <form action="{{url('purchases/store', $purchase)}}" method='post'>
            @csrf
            <input type="hidden" name="purchase_id" value="{{$purchase->id}}">
            <div class="txt-m txt-b txt-red my-2 px-4 border-left border-2 border-success">{{$purchase->product->name}}</div>
            <div class="frow stretched mt-4">
               <div class="fancyinput w-24">
                  <input type="date" name='dateon' id='dateon' placeholder="Enter name" required>
                  <label for="Name">Date (mm-dd-yyyy)</label>
               </div>
               <div class="fcol w-72">
                  <div class="fancyselect">
                     <select name="store_id" id="" required>
                        @foreach($stores as $store)
                        <option value="{{$store->id}}">{{$store->name}}</option>
                        @endforeach
                     </select>
                     <label for="Name">Cold Store Name</label>
                  </div>
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
                        <input type="number" name='carriage' id='carriage' value="0" oninput="calcPrice()" required>
                        <label for="Name">Carriage</label>
                     </div>
                     <div class="fancyinput w-48">
                        <input type="number" name='storagecost' min="0" value="0" required>
                        <label for="Name" class="bg-transparent">Storage Cost</label>
                     </div>
                  </div>
               </div>
            </div>

            <div class="frow stretched mt-3">
               <div class="fancyinput w-100">
                  <input type="text" name='note' id='note'>
                  <label for="Name">Extra Note (if any)</label>
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
   // var unitprice = parseInt($('#unitprice').val());

   // var commission = parseInt($('#commission').val());
   // var bagscost = parseInt($('#bagscost').val());
   // var selectorcost = parseInt($('#selectorcost').val());
   // var packingcost = parseInt($('#packingcost').val());
   // var loadingcost = parseInt($('#loadingcost').val());

   // var additionalcost = commission + bagscost + selectorcost + packingcost + loadingcost;

   if (gross > 0)
      actual = gross - 2 * numofbori - 1.5 * numoftora;

   $('#actualweight').val(actual);
   // $('#basicprice').html("B.P: " + actual * unitprice + " + Addl: " + additionalcost + " = " + (actual * unitprice + additionalcost));

}

function toggle_div_sellfromstorage(event) {
   // alert();
   if (event.target.value == 0)
      $('#div_sellfromstorage').addClass('hide');
   else
      $('#div_sellfromstorage').removeClass('hide');
}
</script>
@endsection