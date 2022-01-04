@extends('layouts.user')
@section('page-content')

<div class="frow h-80 centered bg-light-grey">

   <div class="fcol w-15 ml-5 border bg-success">
      <a href="{{route('deals.index')}}">
         <div class="fcol centered p-4">
            <div class="txt-l my-2"><i data-feather='shopping-cart' class="feather-larger"></i></i></div>
         </div>
         <div class="frow centered border-top py-2 txt-m">Deals</div>
      </a>
   </div>
   <div class="fcol w-15 ml-5 border bg-teal">
      <a href="{{route('payments.index')}}">
         <div class="fcol centered p-4">
            <div class="txt-l txt-white my-2">Rs.</div>
         </div>
         <div class="frow centered border-top py-2 txt-white txt-m">Payments</div>
      </a>
   </div>
   <div class="fcol w-15 ml-5 border">
      <a href="{{route('reports.index')}}">
         <div class="fcol centered p-4">
            <div class="txt-l my-2"><i data-feather='printer' class="feather-larger"></i></i></div>
         </div>
         <div class="frow centered border-top py-2 txt-m">Reports</div>
      </a>
   </div>
</div>
@endsection