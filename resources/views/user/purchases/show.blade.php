@extends('layouts.user')

@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Deal # {{$deal->id}}</div>
   <div class="frow"> <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      <a href="{{url('deals')}}" class="hover-orange"> Deals </a> <span class="mx-2">/</span>
      <a href="{{route('purchases.index')}}" class="hover-orange"> Purchases </a> <span class="mx-2">/</span>
      {{$purchase->id}}
   </div>
</div>
@endsection
@section('page-content')
<div class="frow centered">
   <div class="fcol w-80">
      <!-- page content -->
      <div class="bg-custom-light p-4">
         <div class="border-1 border-left border-success py-2 text-primary txt-m" style="background-color: #eee;">
            <div class="frow px-4 stretched">
               <div>
                  {{$deal->client->name}} <span class="txt-s ml-4">Agreement => {{$deal->product->name}} : {{$deal->numofbori}} + {{$deal->numoftora}} @ Rs. {{$deal->unitprice}} dated {{$deal->dateon}}</span>
               </div>
               <div class="frow spaced txt-s mid-right">
                  <a href="http://" class="hover-orange">Sale</a> <span class="mx-2">|</span>
                  <a href="http://" class="hover-orange">Storage</a> <span class="mx-2">|</span>
                  <a href="http://" class="hover-orange">Payments</a>
               </div>
            </div>
         </div>
         <div class="frow my-4 mid-left fancy-search-grow">
            Sales
         </div>

         <!-- table header row -->
         <div class="frow px-2 py-1 my-3 txt-s border-bottom" style="color:teal">
            <div class="w-10">ID</div>
            <div class="w-20">Date</div>
            <div class="w-20">Purcahsed Qty.</div>
            <div class="w-10">Unit Rate</div>
            <div class="w-10">Sold Qty.</div>
            <div class="w-10">Stored Qty.</div>
            <div class="w-10">Float Qty.</div>
            <div class="fcol centered w-10"><i data-feather='settings' class="feather-xsmall"></i></div>
         </div>

         @foreach($purchase->sales as $sale)
         <div class="frow px-2 my-2 stretched tr ">
            <div class="w-10 txt-s">{{$sale->id}}</div>
            <div class="w-20 txt-s">{{$sale->dateon}}</div>
            <div class="w-20 txt-s">{{$sale->numofbori}} + {{$sale->numoftora}}</div>
            <div class="w-10 txt-s">{{$sale->saleprice}}</div>
            <div class="w-10 txt-s">Total Amount</div>
            <div class="frow w-10 centered">
               <div>
                  <form action="{{route('sales.destroy',$sale)}}" method="POST" id='del_form{{$sale->id}}'>
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="bg-transparent p-0 border-0" onclick="delme('{{$sale->id}}')"><i data-feather='x' class="feather-xsmall mx-1 txt-red"></i></button>
                  </form>
               </div>
            </div>
         </div>
         @endforeach
      </div>

   </div>

</div>

@endsection