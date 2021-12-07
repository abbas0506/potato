@extends('layouts.user')
@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">New Purchase</div>
   <div class="frow">
      <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      <a href="{{route('purchases.index')}}" class="hover-orange"> Purchases </a> <span class="mx-2">/</span>
      New
   </div>
</div>
<div class="frow centered txt-s txt-grey my-2">{{now()}}</div>
@endsection
@section('page-content')
<!-- purchasing -->
<div class="frow centered">
   <div class="fcol w-60">
      <div class="w-100 bg-light my-3">
         <form action="{{route('purchases.store')}}" method='post'>
            @csrf
            <div class="txt-m txt-b txt-red my-2 px-4 border-left border-2 border-success">Purchasing</div>
            <div class="fcol w-24 mt-4">
               <div class="fancyinput">
                  <input type="date" name='dateon' placeholder="Enter name" required>
                  <label for="Name">Date (mm-dd-yyyy)</label>
               </div>
            </div>
            <div class="frow stretched mt-3">
               <div class="fcol w-100">
                  <div class="fancyselect">
                     <select name="client_id" id="" required>
                        <option value="">Select an option ...</option>
                        @foreach($clients as $client)
                        <option value="{{$client->id}}">{{$client->name}}</option>
                        @endforeach
                     </select>
                     <label for="Name">Client (Seller)</label>
                  </div>
               </div>
            </div>
            <div class="frow stretched mt-3">
               <div class="fcol w-48">
                  <div class="fancyselect">
                     <select name="product_id" id="">
                        <option value="">Select an option ...</option>
                        @foreach($products as $product)
                        <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                     </select>
                     <label for="Name">Product</label>
                  </div>
               </div>
               <div class="fcol w-48">
                  <div class="frow stretched">
                     <div class="fancyinput w-48">
                        <input type="number" name='numofbori' min="0" value="0" required>
                        <label for="Name">Number of Bori</label>
                     </div>
                     <div class="fancyinput w-48">
                        <input type="number" name='numoftora' min="0" value="0" required>
                        <label for="Name">Number of Tora</label>
                     </div>
                  </div>
               </div>
            </div>

            <div class="frow stretched mt-3">
               <div class="fancyinput w-48">
                  <input type="number" name='grosswieght' min="0" value="0" required>
                  <label for="Name">Gross Weight</label>
               </div>
               <div class="fancyinput w-48">
                  <input type="number" name='actualweight' min="0" value="0" required>
                  <label for="Name">Actual Weight</label>
               </div>
            </div>

            <div class="frow stretched mt-3">
               <div class="fancyinput w-48">
                  <input type="number" name='basicprice' min="0" value="0" required>
                  <label for="Name">Basic Price</label>
               </div>
               <div class="fancyinput w-48">
                  <input type="number" name='commission' min="0" value="0" required>
                  <label for="Name">Commission</label>
               </div>
            </div>


            <div class="frow stretched mt-3">
               <div class="fancyinput w-48">
                  <input type="number" name='bagscost' min="0" value="0" required>
                  <label for="Name">Bags Cost</label>
               </div>
               <div class="fancyinput w-48">
                  <input type="number" name='selectorcost' min="0" value="0" required>
                  <label for="Name">Selector Cost</label>
               </div>
            </div>
            <div class="frow stretched mt-3">
               <div class="fancyinput w-48">
                  <input type="number" name='packingcost' min="0" value="0" required>
                  <label for="Name">Packing Cost</label>
               </div>
               <div class="fancyinput w-48">
                  <input type="number" name='loadingcost' min="0" value="0" required>
                  <label for="Name">Loading Cost</label>
               </div>
            </div>

            <!-- tranportation -->

            <div class="txt-m txt-b txt-blue mt-5 px-4 border-left border-2 border-success">Transportation</div>
            <div class="frow stretched mt-4">
               <div class="fancyselect w-48">
                  <select name="transporter_id" id="">
                     <option value="">Select an option ...</option>
                     @foreach($transporters as $transporter)
                     <option value="{{$transporter->id}}">{{$transporter->name}}</option>
                     @endforeach
                  </select>
                  <label for="Name">Transport Company</label>
               </div>
               <div class="fancyinput w-48">
                  <input type="text" name='vehicle' placeholder="Vehicle No." value="" required>
                  <label for="Name">Vehicle No.</label>
               </div>

            </div>

            <!-- Sale -->
            <div class="txt-m txt-b mt-5 txt-red px-4 border-left border-2 border-success">Sale</div>
            <div class="frow stretched mt-4">
               <div class="fancyselect w-100">
                  <select name="buyer_id" id="">
                     <option value="">Select an option ...</option>
                     @foreach($clients as $client)
                     <option value="{{$client->id}}">{{$client->name}}</option>
                     @endforeach
                  </select>
                  <label for="Name">Client (Buyer)</label>
               </div>
            </div>
            <div class="frow stretched mt-4">
               <div class="fancyinput w-48">
                  <div class="frow stretched">
                     <div class="fancyinput w-48">
                        <input type="number" name='numofbori' min="0" value="0" required>
                        <label for="Name">Number of Bori</label>
                     </div>
                     <div class="fancyinput w-48">
                        <input type="number" name='numoftora' min="0" value="0" required>
                        <label for="Name">Number of Tora</label>
                     </div>
                  </div>

               </div>
               <div class="fancyinput w-48">
                  <div class="frow stretched">
                     <div class="fancyinput w-48">
                        <input type="number" name='numofbori' min="0" value="0" required>
                        <label for="Name">Gross Weight</label>
                     </div>
                     <div class="fancyinput w-48">
                        <input type="number" name='numoftora' min="0" value="0" required>
                        <label for="Name">Actual Weight</label>
                     </div>
                  </div>
               </div>

            </div>
            <div class="frow stretched mt-4">
               <div class="fancyinput w-48">
                  <input type="number" name='lumsumcomm' value="0" min="0">
                  <label for="Name">Lumsum Commission</label>
               </div>
               <div class="fancyinput w-48">
                  <input type="number" name='lumsumcomm' value="0" min="0">
                  <label for="Name">Sales Price</label>
               </div>

            </div>

            <!-- Storage -->
            <div class="txt-m txt-b mt-5 txt-red px-4 border-left border-2 border-success">Storage</div>
            <div class="frow stretched mt-4">
               <div class="fancyselect w-100">
                  <select name="store_id" id="">
                     <option value="">Select an option ...</option>
                     @foreach($stores as $store)
                     <option value="{{$store->id}}">{{$store->name}}</option>
                     @endforeach
                  </select>
                  <label for="Name">Cold Store</label>
               </div>
            </div>
            <div class="frow stretched mt-4">
               <div class="fancyinput w-48">
                  <input type="number" name='storagecost' value="0" min="0">
                  <label for="Name">Storage Cost</label>
               </div>
               <div class="fancyinput w-48">
                  <div class="frow stretched">
                     <div class="fancyinput w-48">
                        <input type="number" name='numofbori' min="0" value="0" required>
                        <label for="Name">Number of Bori</label>
                     </div>
                     <div class="fancyinput w-48">
                        <input type="number" name='numoftora' min="0" value="0" required>
                        <label for="Name">Number of Tora</label>
                     </div>
                  </div>
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

function delme(formid) {
   event.preventDefault();
   Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
   }).then((result) => {
      if (result.value) {
         //submit corresponding form
         $('#del_form' + formid).submit();
      }
   });
}
</script>
@endsection