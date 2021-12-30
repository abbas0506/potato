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
               {{$deal->seller->name}} <span class="txt-s ml-4">Agreement => {{$deal->product->name}} : {{$deal->numofbori}} + {{$deal->numoftora}} @ Rs. {{$deal->priceperkg}} dated {{$deal->dateon}}</span>
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
               <div class="txt-red mt-3">Pick Date: {{$purchase->dateon}}</div>

               <div class="frow stretched mt-3">
                  <div class="fancyselect w-72 py-1">
                     <select name="transporter_id" id="" required>
                        <option value="">Select an option ...</option>
                        @foreach($transporters as $transporter)
                        @if($transporter->id==$purchase->transporter->id)
                        <option value="{{$transporter->id}}" selected>{{$transporter->name}}</option>
                        @else
                        <option value="{{$transporter->id}}">{{$transporter->name}}</option>
                        @endif
                        @endforeach
                     </select>
                     <label for="Name">Transport Company</label>
                  </div>
                  <div class="fancyinput w-24">
                     <input type="text" class='text-center' name='vehicleno' id='vehicleno' placeholder="LPT 2314" value='{{$purchase->vehicleno}}' required>
                     <label for="Name">Vehicle No.</label>
                  </div>
               </div>
               <div class="frow stretched mt-3">
                  <div class="fancyinput w-24">
                     <input type="number" class='text-center' name='numofbori' id='numofbori' min='0' max='{{$deal->numofbori_left()+$purchase->numofbori}}' value="{{$purchase->numofbori}}" required oninput="calcPrice()">
                     <label for="Name">Number of Bori</label>
                  </div>
                  <div class="fancyinput w-24">
                     <input type="number" class='text-center' name='numoftora' id='numoftora' min='0' max='{{$deal->numoftora_left()+$purchase->numoftora}}' value="{{$purchase->numoftora}}" required oninput="calcPrice()">
                     <label for="Name">Number of Tora</label>
                  </div>

                  <input type="text" id='_reduction0' value="{{$deal->reduction0}}" hidden>
                  <input type="text" id='_reduction1' value="{{$deal->reduction1}}" hidden>

                  <div class="fancyinput w-24">
                     <input type="text" class='text-center' name='priceperkg' id='priceperkg' value="{{$purchase->priceperkg}}" oninput="calcPrice()" required>
                     <label for="Name">Rate / kg</label>
                  </div>
                  <div class="fancyinput w-24">
                     <input type="number" class='text-center' name='grossweight' id='grossweight' value="{{$purchase->grossweight}}" oninput='calcPrice()' required>
                     <label for="Name">Gross (kg)</label>
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
                     <div class="w-48 txt-s txt-b">Seller Amount</div>
                     <div class="w-48 txt-s text-right" id='lbl_basicprice'>0</div>
                  </div>
               </div>
               <div class="frow mt-4">
                  <button type="submit" class="btn btn-primary w-100">Update</button>
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
   var reduction0 = parseFloat($('#_reduction0').val());
   var reduction1 = parseFloat($('#_reduction1').val());

   if (gross > 0)
      actual = gross - reduction0 * numofbori - reduction1 * numoftora;

   $('#lbl_grossweight').html(gross);
   $('#lbl_reduction').html(reduction0 * numofbori + reduction1 * numoftora);
   $('#lbl_actualweight').html(actual);
   $('#lbl_basicprice').html(actual * priceperkg)

}
</script>
@endsection