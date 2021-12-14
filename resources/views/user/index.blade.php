@extends('layouts.user')
@section('page-content')

<div class="frow h-80 centered bg-light-grey">

   <div class="fcol w-15 ml-5 border bg-success">
      <a href="{{route('deals.index')}}">
         <div class="fcol centered p-4">
            <div class="txt-l txt-b">123</div>
            <div class="txt-l my-2"><i data-feather='clock' class="feather-larger"></i></i></div>

         </div>
      </a>
      <a href="{{route('deals.index')}}">
         <div class="frow centered border-top py-2"><i data-feather='shopping-cart' class="feather-larger mr-2"></i><span class="txt-m txt-b">Deals</span></div>
      </a>
   </div>
   <div class="fcol w-15 ml-5 border bg-success">
      <a href="{{route('purchases.index')}}">
         <div class="fcol centered p-4">
            <div class="txt-l txt-b">123</div>
            <div class="txt-l my-2"><i data-feather='clock' class="feather-larger"></i></i></div>

         </div>
      </a>
      <a href="{{route('purchases.index')}}">
         <div class="frow centered border-top py-2"><i data-feather='shopping-cart' class="feather-larger mr-2"></i><span class="txt-m txt-b">Purchases</span></div>
      </a>
   </div>
   <div class="fcol w-15 ml-5 border bg-info">
      <a href="{{route('purchases.index')}}">
         <div class="fcol centered p-4">
            <div class="txt-l txt-b">123</div>
            <div class="txt-l my-2"><i data-feather='clock' class="feather-larger"></i></i></div>

         </div>
      </a>
      <a href="{{route('purchases.index')}}">
         <div class="frow centered border-top py-2"><i data-feather='truck' class="feather-larger mr-2"></i><span class="txt-m txt-b">Sales</span></div>
      </a>
   </div>
   <div class="fcol w-15 ml-5 border bg-teal">
      <a href="{{route('purchases.index')}}">
         <div class="fcol centered p-4">
            <div class="txt-l txt-b">123</div>
            <div class="txt-l my-2"><i data-feather='clock' class="feather-larger"></i></i></div>

         </div>
      </a>
      <a href="{{route('purchases.index')}}">
         <div class="frow centered border-top py-2"><i data-feather='database' class="feather-larger mr-2"></i><span class="txt-m txt-b">Storage</span></div>
      </a>
   </div>
   <div class="fcol w-15 ml-5 border bg-light-grey">
      <a href="{{route('purchases.index')}}">
         <div class="fcol centered p-4">
            <div class="txt-l txt-b">123</div>
            <div class="txt-l my-2"><i data-feather='list' class="feather-larger"></i></i></div>
         </div>
         <div class="frow centered border-top py-2"><i data-feather='users' class="feather-larger mr-2"></i><span class="txt-m txt-b">Accounts</span></div>
      </a>
   </div>

</div>
@endsection