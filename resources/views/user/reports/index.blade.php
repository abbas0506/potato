@extends('layouts.admin')
@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Reports</div>
   <div class="frow">
      <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      Report Options
   </div>
</div>
@endsection
@section('page-content')
<div class="frow centered">
   <div class="fcol w-50 h-70 centered">
      <a href="{{route('reports.show',1)}}" class="frow w-100 py-2 my-3 text-primary border-1 border-left border-success" style="background-color: #eee;">
         <div class="fcol centered w-10"><i data-feather='users' class="feather-xsmall"></i></div>
         <div class="txt-m">Sellers Report</div>
      </a>
      <a href="{{route('reports.show',2)}}" class="frow w-100 py-2 my-3 text-primary border-1 border-left border-success" style="background-color: #eee;">
         <div class="fcol centered w-10"><i data-feather='users' class="feather-xsmall"></i></div>
         <div class="txt-m">Buyers Report</div>
      </a>
      <a href="{{route('reports.show',3)}}" class="frow w-100 py-2 my-3 text-primary border-1 border-left border-success" style="background-color: #eee;">
         <div class="fcol centered w-10"><i data-feather='database' class="feather-xsmall"></i></div>
         <div class="txt-m">Storage Report</div>
      </a>

   </div>
</div>
@endsection