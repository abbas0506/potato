@extends('layouts.user')
@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Purchases</div>
   <div class="frow"> <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span> purchase list</div>

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
         <div class="frow my-4 mid-left fancy-search-grow">
            <input type="text" placeholder="Search" oninput="search(event)"><i data-feather='search' class="feather-small" style="position:relative; right:24;"></i>
            <div class="frow">
               <a href="{{route('purchases.create')}}">
                  <div class="frow circular-25 bg-teal text-light centered mr-2 hoverable">+</div>
               </a>
               Create New
            </div>
         </div>

         <!-- table header row -->
         <div class="frow px-2 py-1 my-3 txt-s border-bottom" style="color:teal">
            <div class="w-10">ID</div>
            <div class="w-20">Seller Client</div>
            <div class="w-20">Product</div>
            <div class="w-10">Qty.(B+T)</div>
            <div class="w-10">Unit Rate</div>
            <div class="w-10">Sold</div>
            <div class="w-10">Stored</div>
            <div class="w-10">Air Stock</div>
            <div class="fcol centered w-10"><i data-feather='settings' class="feather-xsmall"></i></div>
         </div>

         @foreach($purchases as $purchase)
         <div class="frow px-2 my-2 stretched tr ">
            <div class="w-10 txt-s">{{$purchase->id}}</div>
            <div class="w-20 txt-s">{{$purchase->client->name}}</div>
            <div class="w-20 txt-s">{{$purchase->product->name}}</div>
            <div class="w-10 txt-s">{{$purchase->numofbori}} + {{$purchase->numoftora}}</div>
            <div class="w-10 txt-s">{{$purchase->unitprice}}</div>
            <div class="w-10 txt-s">Sold</div>
            <div class="w-10 txt-s">Stored</div>
            <div class="w-10 txt-s">Stock</div>
            <div class="frow w-10 centered">
               <a href="{{url('purchases/sell',$purchase)}}"><i data-feather='truck' class="feather-xsmall mx-1 txt-primary"></i></a>
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