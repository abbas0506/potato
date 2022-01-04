@extends('layouts.admin')
@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Reports</div>
   <div class="frow">
      <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      <a href="{{route('reports.index')}}" class="hover-orange"> Report Options </a> <span class="mx-2">/</span>
      Sellers List
   </div>
</div>
@endsection
@section('page-content')
<div class="frow centered">
   <div class="fcol w-60">
      <div class="border-1 border-left border-success py-2 pl-4 my-4 text-primary txt-m" style="background-color: #eee;">
         Sellers List
      </div>
      <!-- page content -->
      <div class="bg-custom-light">
         <div class="fancy-search-grow">
            <input type="text" placeholder="Search" oninput="search(event)"><i data-feather='search' class="feather-small" style="position:relative; right:24;"></i>
         </div>

         <div class="frow px-2 py-1 my-3 border-bottom">
            <div class="w-10"><span class='txt-b'> ID</div>
            <div class="w-30"><span class='txt-b'> Seller Name</div>
            <div class="w-20"><span class='txt-b'> Phone</div>
            <div class="w-40"><span class='txt-b'> Address</div>
         </div>
         @foreach($sellers as $seller)
         <div class="frow px-2 my-2 tr">
            <div class="w-10">{{$seller->id}}</div>
            <div class="w-30"><a href="#seller{{$seller->id}}" data-toggle="collapse" class="hover-orange">{{$seller->name}}</a></div>
            <div class="w-20">{{$seller->phone}}</div>
            <div class="w-40">{{$seller->address}}</div>
         </div>
         <div class="p-3 bg-light-grey collapse" id='seller{{$seller->id}}'>

            @if($seller->deals()->count()>0)
            <div class="frow stretched txt-s px-2 py-1 mb-3 border-bottom">
               <div class="w-10"><span class='txt-b'> ID</div>
               <div class="w-20"><span class='txt-b'> Date</div>
               <div class="w-10"><span class='txt-b'> Qty</div>
               <div class="w-10"><span class='txt-b'> Picked</div>
               <div class="w-10"><span class='txt-b'> Left</div>
               <div class="w-10"><span class='txt-b'> Payable</div>
               <div class="w-10"><span class='txt-b'> Paid</div>
               <div class="w-10"><span class='txt-b'> Balance</div>
               <div class="w-10 text-center"><i data-feather='settings' class="feather-xsmall"></i></div>
            </div>
            @php $sr=1; @endphp
            @foreach($seller->deals()->get() as $deal)
            <div class="frow stretched px-2 my-2 txt-s">
               <div class="w-10">{{$deal->id}}</div>
               <div class="w-20">{{$deal->dateon->format('d/m/y')}}</div>
               <div class="w-10">{{$deal->qty()}}</div>
               <div class="w-10">{{$deal->picked()}}</div>
               <div class="w-10">{{$deal->left()}}</div>
               <div class="w-10">{{$deal->bill()}}</div>
               <div class="w-10">{{$deal->paid()}}</div>
               <div class="w-10">{{$deal->bill()-$deal->paid()}}</div>
               <div class="frow w-10 centered">
                  <a href="{{url('print/seller/report/'.$deal->id)}}" target="_blank" class="hover-orange"><i data-feather='printer' class="feather-xsmall"></i></a>
               </div>
            </div>
            @endforeach
            @else
            <div class="text-center">0 deals found</div>
            @endif
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