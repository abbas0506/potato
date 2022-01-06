@extends('layouts.admin')
@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Reports</div>
   <div class="frow">
      <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      <a href="{{route('reports.index')}}" class="hover-orange"> Report Options </a> <span class="mx-2">/</span>
      Buyers List
   </div>
</div>
@endsection
@section('page-content')
<div class="frow centered">
   <div class="fcol w-60">
      <div class="border-1 border-left border-success py-2 pl-4 my-4 text-primary txt-m" style="background-color: #eee;">
         Buyers List
      </div>
      <!-- page content -->
      <div class="bg-custom-light">
         <div class="fancy-search-grow">
            <input type="text" placeholder="Search" oninput="search(event)"><i data-feather='search' class="feather-small" style="position:relative; right:24;"></i>
         </div>

         <div class="frow px-2 py-1 my-3 border-bottom stretched">
            <div class="w-5"><span class='txt-b'> ID</div>
            <div class="w-30"><span class='txt-b'> Buyer Name</div>
            <div class="w-15"><span class='txt-b'> Phone</div>
            <div class="w-30"><span class='txt-b'> Address</div>
            <div class="w-10"><span class='txt-b'> Report</div>
         </div>
         @foreach($buyers as $buyer)
         <div class="frow px-2 txt-s my-2 tr stretched">
            <div class="w-5">{{$buyer->id}}</div>
            <div class="w-30">{{$buyer->name}}</div>
            <div class="w-15">{{$buyer->phone}}</div>
            <div class="w-30">{{$buyer->address}}</div>
            <div class="w-10 text-center"><a href="{{url('print/buyer/report/'.$buyer->id)}}" class="hover-orange" target="_blank"><i data-feather='printer' class="feather-xsmall"></i></a></div>

         </div>
         @endforeach
      </div>

   </div>

</div>

@endsection

@section('script')
<script lang="javascript">
function search(event) {
   var searchtext = event.target.value.toLowerCase();
   var str = 0;
   $('.tr').each(function() {
      if (!(
            $(this).children().eq(1).prop('outerText').toLowerCase().includes(searchtext)
         )) {
         $(this).addClass('hide');
      } else {
         $(this).removeClass('hide');
      }
   });
}
</script>
@endsection