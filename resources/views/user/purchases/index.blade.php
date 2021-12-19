@extends('layouts.user')

@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Deal # {{$deal->id}}</div>
   <div class="frow"> <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      <a href="{{url('deals')}}" class="hover-orange"> Deals </a> <span class="mx-2">/</span>
      Purchases
   </div>
</div>
@endsection
@section('page-content')
<!-- display record save, del, update message if any -->
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
            <div class="frow px-4 stretched">
               <div>
                  {{$deal->client->name}} <span class="txt-s ml-4">Agreement => {{$deal->product->name}} : {{$deal->numofbori}} + {{$deal->numoftora}} @ Rs. {{$deal->unitprice}} dated {{$deal->dateon}}</span>
               </div>
               <div class="frow spaced txt-s mid-right">
                  <span class="txt-orange txt-b">Purchase</span> <span class="mx-2">|</span>
                  <a href="http://" class="hover-orange">Sale</a> <span class="mx-2">|</span>
                  <a href="http://" class="hover-orange">Storage</a> <span class="mx-2">|</span>
                  <a href="http://" class="hover-orange">Payments</a>
               </div>
            </div>
         </div>
         <div class="frow my-4 mid-left fancy-search-grow">
            <input type="text" placeholder="Search" oninput="search(event)"><i data-feather='search' class="feather-small" style="position:relative; right:24;"></i>
            <div class="frow">
               <a href="{{route('purchases.create')}}">
                  <div class="frow circular-25 bg-teal text-light centered mr-2 hoverable">+</div>
               </a>
               New Purchase
            </div>
         </div>

         <!-- table header row -->
         <div class="frow px-2 py-1 my-3 txt-s border-bottom" style="color:teal">
            <div class="w-10">Purchase ID</div>
            <div class="w-20">Date</div>
            <div class="w-20">Purcahsed Qty.</div>
            <div class="w-10">Unit Rate</div>
            <div class="w-10">Sold Qty.</div>
            <div class="w-10">Stored Qty.</div>
            <div class="w-10">Field Qty.</div>
            <div class="fcol centered w-10"><i data-feather='settings' class="feather-xsmall"></i></div>
         </div>

         @foreach($deal->purchases as $purchase)
         <div class="frow px-2 my-2 stretched tr ">
            <div class="w-10 txt-s"><a href="{{route('purchases.show', $purchase)}}">{{$purchase->id}}</a></div>
            <div class="w-20 txt-s">{{$purchase->dateon}}</div>
            <div class="w-20 txt-s">{{$purchase->numofbori}} + {{$purchase->numoftora}}</div>
            <div class="w-10 txt-s">{{$purchase->unitprice}}</div>
            <div class="w-10 txt-s">{{$purchase->numofbori_sold()}} + {{$purchase->numoftora_sold()}}</div>
            <div class="w-10 txt-s">{{$purchase->numofbori_stored()}} + {{$purchase->numoftora_stored()}}</div>
            <div class="w-10 txt-s">{{$purchase->numofbori_left()}} + {{$purchase->numoftora_left()}}</div>
            <div class="frow w-10 centered">
               <a href="{{url('sell/fromfield',$purchase)}}"><i data-feather='truck' class="feather-xsmall mx-1 txt-primary"></i></a>
               <a href="{{url('purchases/store',$purchase)}}"><i data-feather='database' class="feather-xsmall mx-1 txt-info"></i></a>
               <a href="{{route('purchases.edit',$purchase)}}"><i data-feather='edit-2' class="feather-xsmall mx-1 txt-blue"></i></a>
               <div>
                  <form action="{{route('purchases.destroy',$purchase)}}" method="POST" id='del_form{{$purchase->id}}'>
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="bg-transparent p-0 border-0" onclick="delme('{{$purchase->id}}')"><i data-feather='x' class="feather-xsmall mx-1 txt-red"></i></button>
                  </form>
               </div>
            </div>
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
            $(this).children().eq(0).prop('outerText').toLowerCase().includes(searchtext)
         )) {
         $(this).addClass('hide');
      } else {
         $(this).removeClass('hide');
      }
   });
}

function delme(formid) {
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
         $('#del_form' + formid).submit();
      }
   });
}
</script>
@endsection