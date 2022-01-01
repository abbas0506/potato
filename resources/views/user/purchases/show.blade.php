@extends('layouts.user')

@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Deal # {{$deal->id}}</div>
   <div class="frow"> <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      <a href="{{url('deals')}}" class="hover-orange"> Deals </a> <span class="mx-2">/</span>
      <a href="{{route('deals.show',$deal)}}" class="hover-orange"> Purchases </a> <span class="mx-2">/</span>
      {{$purchase->id}}
   </div>
</div>
@endsection
@section('page-content')
<div class="frow centered">
   <div class="fcol w-80">
      <!-- page content -->
      <div class="bg-custom-light p-4">
         <div class="border-1 border-left border-success py-2 text-primary txt-m" style="background-color: #eee;">
            <div class="frow px-4 stretched">
               <div>
                  {{$deal->seller->name}} <span class="txt-s ml-4">Agreement => {{$deal->product->name}} : {{$deal->numofbori}} + {{$deal->numoftora}} @ Rs. {{$deal->priceperkg}} dated {{$deal->dateon->format('d/m/y')}}</span>
               </div>
               <div class="frow spaced txt-s mid-right">Sales & Storage Detail</div>
            </div>
         </div>
         <div class="frow my-4 mid-left txt-b txt-red">Sales</div>
         <!-- table header row -->
         <div class="frow px-2 py-1 my-3 txt-s border-bottom" style="color:teal">
            <div class="w-5">ID</div>
            <div class="w-15">Date</div>
            <div class="w-30">Buyer Name</div>
            <div class="w-10">Qty</div>
            <div class="w-10">Gross</div>
            <div class="w-10">Actual</div>
            <div class="w-10">Basic Price</div>
            <div class="w-10">Addl Cost</div>
            <div class="w-10">Sale Price</div>
            <div class="w-10">Profit</div>
            <div class="fcol centered w-10"><i data-feather='settings' class="feather-xsmall"></i></div>
         </div>

         @foreach($purchase->sales as $sale)
         <div class="frow px-2 my-2 stretched tr ">
            <div class="w-5 txt-s">{{$sale->id}}</div>
            <div class="w-15 txt-s">{{$sale->dateon->format('d/m/y')}}</div>
            <div class="w-30 txt-s">{{$sale->buyer->name}}</div>
            <div class="w-10 txt-s">{{$sale->numofbori}} + {{$sale->numoftora}}</div>
            <div class="w-10 txt-s">{{$sale->grossweight}}</div>
            <div class="w-10 txt-s">{{$sale->actual()}}</div>
            <div class="w-10 txt-s">{{$sale->basicprice()}}</div>
            <div class="w-10 txt-s">{{$sale->addlcost()}}</div>
            <div class="w-10 txt-s">{{$sale->saleprice}}</div>
            <div class="w-10 txt-s">{{$sale->profit()}}</div>
            <div class="frow w-10 centered">
               <a href="{{route('sales.edit',$sale)}}"><i data-feather='edit-2' class="feather-xsmall mx-1 txt-blue"></i></a>
            </div>
         </div>
         @endforeach


         <div class="frow my-4 mid-left txt-b txt-green">Storage</div>
         <!-- storage summary header -->
         <div class="frow stretched px-2 py-1 my-3 txt-s border-bottom" style="color:teal">
            <div class="w-10">ID</div>
            <div class="w-30">Store Name</div>
            <div class="w-10">Stored Qty.</div>
            <div class="w-10">~Weight</div>
            <div class="w-10">~Value</div>
            <div class="w-10">Exported</div>
            <div class="w-10">Wasted </div>
            <div class="w-10">Retained</div>
            <div class="w-10 text-center"><i data-feather='settings' class="feather-xsmall"></i></div>

         </div>
         @php $sr=1; @endphp
         @foreach($purchase->stores() as $store)
         <div class="frow stretched px-2 my-2 tr">
            <div class="w-10 txt-s">{{$sr++}}</div>
            <div class="w-30 txt-s"><a href="#store{{$store->id}}" data-toggle="collapse" class="txt-blue">{{$store->name}}</a></div>
            <div class="w-10 txt-s">{{$store->numofbori_stored($purchase->id)}}+{{$store->numoftora_stored($purchase->id)}}</div>
            <div class="w-10 txt-s">~Weight</div>
            <div class="w-10 txt-s">~Value</div>
            <div class="w-10 txt-s">{{$store->numofbori_sold($purchase->id)}}+{{$store->numoftora_sold($purchase->id)}}</div>
            <div class="w-10 txt-s">{{$store->numofbori_wasted($purchase->id)}}+{{$store->numoftora_wasted($purchase->id)}}</div>
            <div class="w-10 txt-s">{{$store->numofbori_left($purchase->id)}}+{{$store->numoftora_left($purchase->id)}}</div>
            <div class="frow w-10 centered">
               <a href="{{url('wastes/create/'.$store->id.'/'.$purchase->id)}}"><i data-feather='trash' class="feather-xsmall mx-1 txt-red"></i></a>
            </div>
         </div>
         <!-- Storage detail -->
         <div class="container bg-light-grey w-80 p-3 centered collapse" id='store{{$store->id}}'>
            <div class="frow stretched txt-s border-bottom" style="color:teal">
               <div class="w-10">ID</div>
               <div class="w-30">Date</div>
               <div class="w-50">Qty.</div>
               <div class="w-10 text-center"><i data-feather='settings' class="feather-xsmall"></i></div>

            </div>
            @foreach($store->storages($purchase->id)->get()->sortDesc() as $storage)
            <div class="frow stretched my-2">
               <div class="w-10 txt-s">{{$storage->id}}</div>
               <div class="w-30 txt-s">{{$storage->dateon->format('d/m/y')}}</div>
               <div class="w-50 txt-s">{{$storage->numofbori}} +{{$storage->numoftora}}</div>
               <div class="frow w-10 centered">
                  <a href="{{route('storage.edit',$storage)}}"><i data-feather='edit-2' class="feather-xsmall mx-1 txt-blue"></i></a>
               </div>
            </div>
            @endforeach
         </div>

         @endforeach
      </div>

   </div>

</div>

@endsection

@section('script')
<script lang="javascript">
function delsale(formid) {
   event.preventDefault();
   Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
   }).then((result) => {
      if (result.value) {
         //submit corresponding form
         $('#del_from_sale' + formid).submit();
      }
   });
}

function delstorage(formid) {
   event.preventDefault();
   Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
   }).then((result) => {
      if (result.value) {
         //submit corresponding form
         $('#del_from)storage' + formid).submit();
      }
   });
}
</script>
@endsection