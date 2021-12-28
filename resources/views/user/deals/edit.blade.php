@extends('layouts.user')
@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Edit Deal</div>
   <div class="frow">
      <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      <a href="{{route('deals.index')}}" class="hover-orange"> Deals </a> <span class="mx-2">/</span>
      Edit
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
   <div class="fcol w-70">
      <div class="w-100 bg-light my-3">
         <form action="{{route('deals.update', $deal)}}" method='post'>
            @csrf
            @method('PATCH')
            <!-- <div class="txt-m txt-b txt-red my-2 px-4 border-left border-2 border-success">Purchasing</div> -->
            <div class="frow stretched mt-4">
               <div class="fancyinput w-24">
                  <input type="date" name='dateon' id='dateon' placeholder="Enter name" required>
                  <label for="Name">Date (mm-dd-yyyy)</label>
               </div>
            </div>
            <div class="frow stretched mt-4">

               <div class="fancyselect w-48">
                  <select name="seller_id" id="" required>
                     <option value="">Select an option ...</option>
                     @foreach($sellers as $seller)
                     @if($seller->id==$deal->seller->id)
                     <option value="{{$seller->id}}" selected>{{$seller->name}}</option>
                     @else
                     <option value="{{$seller->id}}">{{$seller->name}}</option>
                     @endif
                     @endforeach
                  </select>
                  <label for="Name">Seller</label>
               </div>
               <div class="fancyselect w-48">
                  <select name="product_id" id="">
                     <option value="">Select an option ...</option>
                     @foreach($products as $product)
                     @if($product->id==$deal->product->id)
                     <option value="{{$product->id}}" selected>{{$product->name}}</option>
                     @lse
                     <option value="{{$product->id}}">{{$product->name}}</option>
                     @endif
                     @endforeach
                  </select>
                  <label for="Name">Product</label>
               </div>

            </div>
            <div class="frow stretched mt-3">


               <div class="fancyinput w-25">
                  <input type="number" class="text-center" name='numofbori' id='numofbori' min="0" value="{{$deal->numofbori}}" required oninput="calcPrice()">
                  <label for="Name">Number of Bori</label>
               </div>
               <div class="fancyinput w-25">
                  <input type="number" class="text-center" name='numoftora' id='numoftora' min="0" value="{{$deal->numoftora}}" required oninput="calcPrice()">
                  <label for="Name">Number of Tora</label>
               </div>
               <div class="fancyinput w-15">
                  <input type="text" class="text-center" name='reduction0' id='reduction0' value="{{$deal->reduction0}}" required oninput="calcPrice()">
                  <label for="Name">Reduction / bori</label>
               </div>
               <div class="fancyinput w-15">
                  <input type="text" class="text-center" name='reduction1' id='reduction1' value="{{$deal->reduction1}}" required oninput="calcPrice()">
                  <label for="Name">Reduction / tora</label>
               </div>
               <div class="fancyinput w-15">
                  <input type="text" class="text-center" name='priceperkg' id='priceperkg' value="{{$deal->priceperkg}}" oninput="calcPrice()" required>
                  <label for="Name">@ kg</label>
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
</script>
@endsection