@extends('layouts.admin')
@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Reports</div>
   <div class="frow">
      <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      Stores list
   </div>
</div>
@endsection
@section('page-content')
<div class="frow centered">
   <div class="fcol w-60">

      <div class="border-1 border-left border-success py-2 my-3 text-primary txt-m" style="background-color: #eee;">
         <div class="frow px-4 stretched">
            <div>
               Stores List
            </div>
            <div class="frow spaced txt-s mid-right">
               <a href="{{url('sellers/list')}}" class="hover-orange">Seller Report</a><span class="mx-1">|</span>
               <a href="{{url('buyers/list')}}" class="hover-orange">Buyer Report</a>
            </div>
         </div>
      </div>
      <!-- page content -->
      <div class="bg-custom-light p-4">
         <div class="fancy-search-grow">
            <input type="text" placeholder="Search" oninput="search(event)"><i data-feather='search' class="feather-small" style="position:relative; right:24;"></i>
         </div>

         <div class="frow px-2 py-1 my-3 border-bottom">
            <div class="w-10"><span class='txt-b'> ID</div>
            <div class="w-80"><span class='txt-b'> Store Name</div>
            <div class="w-10"><span class='txt-b'> Report</div>
         </div>
         @foreach($stores as $store)
         <div class="frow px-2 txt-s my-2 tr">
            <div class="w-10">{{$store->id}}</div>
            <div class="w-80">{{$store->name}}</div>
            <div class="w-10 text-center"><a href="{{url('print/store/report/'.$store->id)}}" class="hover-orange" target="_blank"><i data-feather='printer' class="feather-xsmall"></i></a></div>

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