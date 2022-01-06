@extends('layouts.admin')
@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Deals</div>
   <div class="frow">
      <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      Payment Options
   </div>
</div>
@endsection
@section('page-content')
<div class="frow centered">
   <div class="fcol w-50 h-70 centered">
      <a href="{{route('sellerpayments.index')}}" class="frow w-100 py-2 my-3 text-primary border-1 border-left border-success" style="background-color: #eee;">
         <div class="fcol centered w-10"><i data-feather='users' class="feather-xsmall"></i></div>
         <div class="txt-m">Sellers Payments</div>
      </a>
      <a href="{{route('buyerpayments.index')}}" class="frow w-100 py-2 my-3 text-primary border-1 border-left border-success" style="background-color: #eee;">
         <div class="fcol centered w-10"><i data-feather='users' class="feather-xsmall"></i></div>
         <div class="txt-m">Buyers Payments</div>
      </a>
   </div>
</div>
@endsection