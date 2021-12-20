@extends('layouts.admin')

@section('page-content')
<div class="frow h-80 centered bg-light-grey">

   <div class="fcol w-15 ml-5 border bg-success">
      <a href="{{route('products.index')}}">
         <div class="fcol centered p-4">
            <div class="txt-l txt-b">{{$products->count()}}</div>
            <div class="txt-l my-2"><i data-feather='list' class="feather-larger"></i></i></div>
         </div>
         <div class="frow centered border-top py-2">Products</div>
      </a>
   </div>
   <div class="fcol w-15 ml-5 border bg-info">
      <a href="{{route('clients.index')}}">
         <div class="fcol centered p-4">
            <div class="txt-l txt-b">{{$clients->count()}}</div>
            <div class="txt-l my-2"><i data-feather='users' class="feather-larger"></i></i></div>
         </div>
         <div class="frow centered border-top py-2">Clients</div>
      </a>
   </div>
   <div class="fcol w-15 ml-5 border bg-teal">
      <a href="{{route('stores.index')}}">
         <div class="fcol centered p-4">
            <div class="txt-l txt-b txt-white">{{$stores->count()}}</div>
            <div class="txt-l my-2"><i data-feather='database' class="feather-larger text-light"></i></i></div>
         </div>
         <div class="frow centered border-top py-2 text-light">Cold stores</div>
      </a>
   </div>
   <div class="fcol w-15 ml-5 border bg-teal">
      <a href="{{route('transporters.index')}}">
         <div class="fcol centered p-4">
            <div class="txt-l txt-b txt-white">{{$transporters->count()}}</div>
            <div class="txt-l my-2"><i data-feather='truck' class="feather-larger text-light"></i></i></div>
         </div>
         <div class="frow centered border-top py-2 text-light">Transporters</div>
      </a>
   </div>
   <div class="fcol w-15 ml-5 border bg-teal">
      <a href="{{route('configs.index')}}">
         <div class="fcol centered p-4">
            <div class="txt-l txt-b txt-white">-</div>
            <div class="txt-l my-2"><i data-feather='settings' class="feather-larger text-light"></i></i></div>
         </div>
         <div class="frow centered border-top py-2 text-light">Default</div>
      </a>
   </div>

</div>
@endsection