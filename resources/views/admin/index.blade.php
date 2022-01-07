@extends('layouts.admin')

@section('page-content')

<div class="fcol centered w-100 h-80 bg-light-grey">
   <div class="frow w-50 stretched mb-5">
      <div class="fcol w-30 border bg-success">
         <a href="{{route('products.index')}}">
            <div class="fcol centered p-4">
               <div class="txt-l my-2"><i data-feather='list' class="feather-larger"></i></i></div>
            </div>
            <div class="frow centered border-top py-2">Products</div>
         </a>
      </div>
      <div class="fcol w-30 border bg-info">
         <a href="{{route('sellers.index')}}">
            <div class="fcol centered p-4">
               <div class="txt-l my-2"><i data-feather='users' class="feather-larger"></i></i></div>
            </div>
            <div class="frow centered border-top py-2">Sellers</div>
         </a>
      </div>
      <div class="fcol w-30 border bg-info">
         <a href="{{route('buyers.index')}}">
            <div class="fcol centered p-4">
               <div class="txt-l my-2"><i data-feather='users' class="feather-larger"></i></i></div>
            </div>
            <div class="frow centered border-top py-2">Buyers</div>
         </a>
      </div>
   </div>

   <!-- Row # 02 -->

   <div class="frow w-50 stretched">
      <div class="fcol w-30 border bg-teal">
         <a href="{{route('stores.index')}}">
            <div class="fcol centered p-4">
               <div class="txt-l my-2"><i data-feather='database' class="feather-larger text-light"></i></i></div>
            </div>
            <div class="frow centered border-top py-2 text-light">Cold stores</div>
         </a>
      </div>
      <div class="fcol w-30 border bg-teal">
         <a href="{{route('transporters.index')}}">
            <div class="fcol centered p-4">
               <div class="txt-l my-2"><i data-feather='truck' class="feather-larger text-light"></i></i></div>
            </div>
            <div class="frow centered border-top py-2 text-light">Transporters</div>
         </a>
      </div>
      <div class="fcol w-30 border bg-teal">
         <a href="{{route('configs.index')}}">
            <div class="fcol centered p-4">
               <div class="txt-l my-2"><i data-feather='settings' class="feather-larger text-light"></i></i></div>
            </div>
            <div class="frow centered border-top py-2 text-light">Config</div>
         </a>
      </div>

   </div>
</div>


@endsection