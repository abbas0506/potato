@extends('layouts.user')
@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Deal # {{$deal->id}}</div>
   <div class="frow"> <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      <a href="{{url('deals')}}" class="hover-orange"> Deals </a> <span class="mx-2">/</span>
      <a href="{{route('deals.show',$deal)}}" class="hover-orange">Picks </a> <span class="mx-2">/</span> Sale <span class="mx-2">/</span>{{$sale->id}}<span class="mx-2">/</span>Edit
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
                  {{$deal->seller->name}} <span class="txt-s ml-4">Agreement => {{$deal->product->name}} : {{$deal->numofbori}} + {{$deal->numoftora}} @ Rs. {{$deal->priceperkg}} dated {{$deal->dateon->format('d/m/y')}}</span>
               </div>
               <div class="frow spaced txt-s mid-right">
                  <span class="txt-b">Edit Sale</span>
               </div>
            </div>
         </div>

         <form action="{{route('sales.update', $sale)}}" method='post'>
            @csrf
            @method('PATCH')
            <div class="txt-red mt-4">Sale Date: {{$sale->dateon->format('d/m/y')}}</div>
            <div class="frow centered stretched">
               <div class="w-100">
                  <div class=" mt-4 txt-s txt-blue">Sale Quantity & Respective Cost Info --------------------</div>
                  <div class="frow stretched mt-4" @if($sale->numofbori==0) hidden @endif>
                     <div class="fancyinput w-20">
                        <input type="number" class='text-center' name='numofbori' id='numofbori' value="{{$sale->numofbori}}" required>
                        <label for="Name">Number of Bori</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class='text-center' name='reduction0' id='reduction0' value="{{$sale->reduction0}}" required>
                        <label for="Name">@ reduction</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class="text-center" name='commission0' id='commission0' min="0" value="{{$cost->commission0}}" required>
                        <label for="Name">@ Comm.</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class='text-center' name='bagprice0' id='bagprice0' value="{{$cost->bagprice0}}">
                        <label for="Name">@ bag price</label>
                     </div>

                     <div class="fancyinput w-15">
                        <input type="text" class='text-center' name='packing0' id='packing0' value="{{$cost->packing0}}">
                        <label for="Name">@ packing</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class='text-center' name='loading0' id='loading0' value="{{$cost->loading0}}">
                        <label for="Name">@ loading</label>
                     </div>

                  </div>
                  <div class="frow stretched mt-3" @if($sale->numoftora==0) hidden @endif>
                     <div class="fancyinput w-20">
                        <input type="number" class='text-center' name='numoftora' id='numoftora' value="{{$sale->numoftora}}" required>
                        <label for="Name">Number of Tora</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class='text-center' name='reduction1' id='reduction1' value="{{$sale->numoftora}}" required>
                        <label for="Name">@ reduction</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class="text-center" name='commission1' id='commission1' min="0" value="{{$cost->commission1}}" required>
                        <label for="Name">@ Comm.</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class='text-center' name='bagprice1' id='bagprice1' value="{{$cost->bagprice1}}">
                        <label for="Name">@ bag price</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class='text-center' name='packing1' id='packing1' value="{{$cost->packing1}}">
                        <label for="Name">@ packing</label>
                     </div>
                     <div class="fancyinput w-15">
                        <input type="text" class='text-center' name='loading1' id='loading1' value="{{$cost->loading1}}">
                        <label for="Name">@ loading</label>
                     </div>
                  </div>

                  <div class="frow stretched mt-4">
                     <div class="fancyinput w-24">
                        <input type="number" class='text-center' name='selector' id='selector' value="{{$cost->selector}}">
                        <label for="Name">Selector</label>
                     </div>
                     <div class="fancyinput w-24">
                        <input type="number" class='text-center' name='sorting' id='sorting' value="{{$cost->sorting}}">
                        <label for="Name">Sorting</label>
                     </div>
                     <div class="fancyinput w-24">
                        <input type="number" class='text-center' name='random' id='random' min='0' value="{{$cost->random}}">
                        <label for="Name">Random</label>
                     </div>
                     <div class="fancyinput w-24">
                        <input type="number" class='text-center' name='sadqa' id='sadqa' min='0' value="{{$cost->sadqa}}">
                        <label for="Name">Sadqa</label>
                     </div>
                  </div>
                  <div class=" mt-4 txt-s txt-blue">Buyer, Gross Weight & Sale Price Info --------------------</div>
                  <div class="frow stretched mt-3">
                     <div class="w-48 txt-m"> Buyer: {{$sale->buyer->name}}</div>
                     <div class="fancyinput w-24">
                        <input type="number" class='text-center' name='grossweight' id='grossweight' min='0' value="{{$sale->grossweight}}">
                        <label for="Name">Gross</label>
                     </div>
                     <div class="fancyinput w-24">
                        <input type="number" class="text-center txt-red txt-b" name='saleprice' id='saleprice' min="0" value="{{$sale->saleprice}}" required>
                        <label for="Name">Final Sale Price</label>
                     </div>
                  </div>
                  <div>
                     <div class="fancyinput mt-3">
                        <input type="text" class='text-center' name='note' id='note' value="{{$cost->note}}">
                        <label for="Name">Any Note</label>
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