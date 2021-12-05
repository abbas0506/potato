@extends('layouts.admin')
@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Products</div>
   <div class="frow"> <a href='admin' class="hover-orange"> Home </a> <span class="mx-2">/</span>
      <a href="{{route('products.index')}}" class="hover-orange"> Products list </a> <span class="mx-2">/</span> Edit
   </div>
</div>
@endsection
@section('page-content')
<div class="frow centered">
   <div class="fcol w-60">
      <!-- <div class="fcol w-70 centered bg-light-grey"> -->
      <div class="w-100 bg-light px-4 pb-2 my-4 border-left border-2 border-success">
         <div class="txt-b txt-orange">Edit Product</div>
         <form action="{{route('products.update', $product)}}" method='post'>
            @csrf
            @method('PATCH')
            <div class="frow stretched mt-3">
               <div class="fancyinput w-80">
                  <input type="text" name='name' placeholder="Enter name" value="{{$product->name}}" required>
                  <label for="Name">Name</label>
               </div>
               <div class="w-15">
                  <button type="submit" class="btn btn-success">Update</button>
               </div>
            </div>
         </form>

      </div>
      @endsection