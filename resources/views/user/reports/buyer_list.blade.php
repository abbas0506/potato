@extends('layouts.admin')
@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Reports</div>
   <div class="frow">
      <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      Reports / Buyer
   </div>
</div>
@endsection
@section('page-content')
<div class="frow centered">
   <div class="fcol w-60">

      <div class="border-1 border-left border-success py-2 my-3 text-primary txt-m" style="background-color: #eee;">
         <div class="frow px-4 stretched">
            <div>
               Buyers List
            </div>
            <div class="frow spaced txt-s mid-right">
               <div class=""><a href="{{url('seller/list')}}" class="hover-orange">Seller Report</a></div><span class="mx-1">|</span>
               <div class="txt-b">Buyer Report</div><span class="mx-1">|</span>
               <div class="">Storage Report</div>
            </div>
         </div>
      </div>
      <!-- page content -->
      <div class="bg-custom-light p-4">
         <div class="fancy-search-grow">
            <input type="text" placeholder="Search" oninput="search(event)"><i data-feather='search' class="feather-small" style="position:relative; right:24;"></i>
         </div>

         <div class="frow px-2 py-1 my-3 border-bottom">
            <div class="w-5"><span class='txt-b'> ID</div>
            <div class="w-30"><span class='txt-b'> Buyer Name</div>
            <div class="w-15"><span class='txt-b'> Phone</div>
            <div class="w-30"><span class='txt-b'> Address</div>
            <div class="w-10"><span class='txt-b'> Payment</div>
            <div class="w-10"><span class='txt-b'> Report</div>
         </div>
         @foreach($buyers as $buyer)
         <div class="frow px-2 txt-s my-2 tr">
            <div class="w-5">{{$buyer->id}}</div>
            <div class="w-30">{{$buyer->name}}</div>
            <div class="w-15">{{$buyer->phone}}</div>
            <div class="w-30">{{$buyer->address}}</div>
            <div class="w-10 text-center"><a href="{{url('buyerpayments/'.$buyer->id)}}" class="hover-orange"><i data-feather='plus-square' class="feather-xsmall mr-1"></i></a></div>
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