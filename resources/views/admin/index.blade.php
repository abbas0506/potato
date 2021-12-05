@extends('layouts.admin')
@section('page-content')

<div class="frow h-80 centered bg-light-grey">

   <div class="fcol w-15 ml-5 border bg-success">
      <a href="{{route('products.index')}}">
         <div class="fcol centered p-4">
            <div class="txt-l txt-b">123</div>
            <div class="txt-l my-2"><i data-feather='list' class="feather-larger"></i></i></div>
         </div>
         <div class="frow centered border-top py-2">Products</div>
      </a>
   </div>
   <div class="fcol w-15 ml-5 border bg-info">
      <a href="{{route('clients.index')}}">
         <div class="fcol centered p-4">
            <div class="txt-l txt-b">123</div>
            <div class="txt-l my-2"><i data-feather='users' class="feather-larger"></i></i></div>
         </div>
         <div class="frow centered border-top py-2">Clients</div>
      </a>
   </div>

</div>
@endsection