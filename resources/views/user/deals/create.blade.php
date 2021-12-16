@extends('layouts.user')
@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">New Deal</div>
   <div class="frow">
      <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      <a href="{{route('deals.index')}}" class="hover-orange"> Deals </a> <span class="mx-2">/</span>
      New
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
         <form action="{{route('deals.store')}}" method='post'>
            @csrf
            <!-- <div class="txt-m txt-b txt-red my-2 px-4 border-left border-2 border-success">Purchasing</div> -->
            <div class="frow stretched mt-4">
               <div class="fancyinput w-24">
                  <input type="date" name='dateon' id='dateon' placeholder="Enter name" required>
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
                        <input type="number" name='numofbori' id='numofbori' min="0" value="0" required oninput="calcPrice()">
                        <label for="Name">Number of Bori</label>
                     </div>
                     <div class="fancyinput w-48">
                        <input type="number" name='numoftora' id='numoftora' min="0" value="0" required oninput="calcPrice()">
                        <label for="Name">Number of Tora</label>
                     </div>
                  </div>
               </div>
            </div>

            <div class="frow stretched mt-3">
               <div class="fancyinput w-48">
                  <input type="number" name='unitprice' id='unitprice' value="0" oninput="calcPrice()" required>
                  <label for="Name">Unit Price</label>
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