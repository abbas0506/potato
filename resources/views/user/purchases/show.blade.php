@extends('layouts.user')

@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Deal # {{$deal->id}}</div>
   <div class="frow"> <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      <a href="{{url('deals')}}" class="hover-orange"> Deals </a> <span class="mx-2">/</span>
      <a href="{{route('deals.show',$deal)}}" class="hover-orange"> {{$deal->id}} </a> <span class="mx-2">/</span>
      Collections<span class="mx-2">/</span>{{$purchase->id}}
   </div>
</div>
@endsection
@section('page-content')

@if ($errors->any())
<div class="alert alert-danger mt-5">
   <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
   </ul>
</div>
<br />
@elseif(session('success'))
<script>
Swal.fire({
   icon: 'success',
   title: "Successful",
   showConfirmButton: false,
   timer: 1500
});
</script>
@endif

<div class="frow centered">
   <div class="fcol w-80">
      <!-- page content -->
      <div class="bg-custom-light p-4">
         <div class="border-1 border-left border-success py-2 text-primary txt-m" style="background-color: #eee;">
            <div class="frow mid-left px-4 txt-m"><b>Vehicle No. {{$purchase->vehicleno}} </b> &nbsp dated &nbsp {{$purchase->dateon->format('d/m/y')}}</div>
         </div>
         <div class="frow my-4 mid-left">
            <div class="mr-4 txt-b"><u>SALES</u></div>
            <a href="{{url('sale/from/field',$purchase)}}">
               <div class="frow circular-20 bg-teal text-light centered mr-2 hoverable">+</div>
            </a>
            New
         </div>
         <!-- table header row -->
         <div class="frow px-2 py-1 my-3 txt-s border-bottom" style="color:teal">
            <div class="w-5">ID</div>
            <div class="w-10">Date</div>
            <div class="w-20">Buyer Name</div>
            <div class="w-10">Qty</div>
            <div class="w-10">Gross</div>
            <div class="w-10">Actual</div>
            <div class="w-10">@kg</div>
            <div class="w-10">Seller</div>
            <div class="w-10">Previous</div>
            <div class="w-10">Current</div>
            <div class="w-10">Cost Price</div>
            <div class="w-10">Sale Price</div>
            <div class="w-10">Profit</div>
            <div class="fcol centered w-10"><i data-feather='settings' class="feather-xsmall"></i></div>
         </div>

         @foreach($purchase->sales as $sale)
         <div class="frow px-2 my-2 stretched tr ">
            <div class="w-5 txt-s">{{$sale->id}}</div>
            <div class="w-10 txt-s">{{$sale->dateon->format('d/m/y')}}</div>
            <div class="w-20 txt-s">{{$sale->buyer->name}}</div>
            <div class="w-10 txt-s">{{$sale->qty()}}</div>
            <div class="w-10 txt-s">{{round($sale->grossweight)}}</div>
            <div class="w-10 txt-s">{{round($sale->actual())}}</div>
            <div class="w-10 txt-s">{{round($sale->purchase->priceperkg,5)}}</div>
            <div class="w-10 txt-s">{{round($sale->basicprice())}}</div>
            <div class="w-10 txt-s">{{round($sale->precost())}}</div>
            <div class="w-10 txt-s">{{round($sale->currentcost())}}</div>
            <div class="w-10 txt-s">{{round($sale->costprice())}}</div>
            <div class="w-10 txt-s">{{round($sale->saleprice)}}</div>
            <div class="w-10 txt-s">{{round($sale->profit())}}</div>
            <div class="frow w-10 centered">
               <a href="{{route('sales.edit',$sale)}}"><i data-feather='edit-2' class="feather-xsmall mx-1 txt-blue"></i></a>
               <div>
                  <form action="{{route('sales.destroy',$sale)}}" method="POST" id='del_sale{{$sale->id}}'>
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="bg-transparent p-0 border-0" onclick="delsale('{{$sale->id}}')"><i data-feather='x' class="feather-xsmall mx-1 txt-red"></i></button>
                  </form>
               </div>
            </div>
         </div>
         @endforeach


         <div class="frow my-4 mid-left">
            <div class="mr-4 txt-b"><u>STORAGE</u></div>
            <a href="{{url('purchases/store',$purchase)}}">
               <div class="frow circular-20 bg-teal text-light centered mr-2 hoverable">+</div>
            </a>
            New
         </div>
         <!-- storage summary header -->
         <div class="frow stretched px-2 py-1 my-3 txt-s border-bottom" style="color:teal">
            <div class="w-10">ID</div>
            <div class="w-30">Store Name</div>
            <div class="w-10">Stored</div>
            <div class="w-10">Exported</div>
            <div class="w-10">Wasted </div>
            <div class="w-10">Retained</div>
            <div class="w-10">~Value</div>
            <div class="w-10 text-center"><i data-feather='settings' class="feather-xsmall"></i></div>

         </div>
         @php $sr=1; @endphp
         @foreach($purchase->stores() as $store)
         <div class="frow stretched px-2 my-2 tr">
            <div class="w-10 txt-s">{{$sr++}}</div>
            <div class="w-30 txt-s"><a href="#store{{$store->id}}" data-toggle="collapse" class="hover-orange">{{$store->name}}</a></div>
            <div class="w-10 txt-s">{{$store->stored($purchase->id)}}</div>
            <div class="w-10 txt-s">{{$store->exported($purchase->id)}}</div>
            <div class="w-10 txt-s">{{$store->wasted($purchase->id)}}</div>
            <div class="w-10 txt-s">{{$store->retained($purchase->id)}}</div>
            <div class="w-10 txt-s">{{round($store->approxvalue_retained($purchase->id),2)}}</div>
            <div class="frow w-10 centered">
               <a href="{{url('sale/from/store/'.$purchase->id.'/'.$store->id)}}"><i data-feather='truck' class="feather-xsmall mx-1 txt-primary"></i></a>
               <a href="{{url('wastes/create/'.$store->id.'/'.$purchase->id)}}"><i data-feather='trash-2' class="feather-xsmall mx-1 txt-red"></i></a>
            </div>
         </div>
         <!-- Storage detail -->
         <div class="container bg-light-grey w-80 p-3 centered collapse" id='store{{$store->id}}'>
            <div class="frow stretched txt-s border-bottom" style="color:teal">
               <div class="w-10">ID</div>
               <div class="w-15">Date</div>
               <div class="w-15">Qty.</div>
               <div class="w-50">~ Cost</div>
               <div class="w-10 text-center"><i data-feather='settings' class="feather-xsmall"></i></div>

            </div>
            @foreach($store->storages($purchase->id)->get()->sortDesc() as $storage)
            <div class="frow stretched my-2">
               <div class="w-10 txt-s">{{$storage->id}}</div>
               <div class="w-15 txt-s">{{$storage->dateon->format('d/m/y')}}</div>
               <div class="w-15 txt-s">{{$storage->qty()}}</div>
               <div class="w-50 txt-s">{{$storage->approxcost()}}</div>

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
         $('#del_sale' + formid).submit();
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