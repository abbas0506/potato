@extends('layouts.user')
@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Deals</div>
   <div class="frow"> <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span> Deals</div>

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
               <a href="{{route('deals.create')}}">
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
            <div class="w-10">Agreed Qty.</div>
            <div class="w-10">Unit Rate</div>
            <div class="w-10">Picked Qty.</div>
            <div class="w-10">Left Qty.</div>
            <div class="fcol centered w-10"><i data-feather='settings' class="feather-xsmall"></i></div>
         </div>

         @foreach($deals as $deal)
         <div class="frow px-2 my-2 stretched tr ">
            <div class="w-10 txt-s">{{$deal->id}}</div>
            <div class="w-20 txt-s">{{$deal->client->name}}</div>
            <div class="w-20 txt-s">{{$deal->product->name}}</div>
            <div class="w-10 txt-s">{{$deal->numofbori}} + {{$deal->numoftora}}</div>
            <div class="w-10 txt-s">{{$deal->unitprice}}</div>
            <div class="w-10 txt-s">{{$deal->sold()}}</div>
            <div class="w-10 txt-s">{{$deal->left()}}</div>
            <div class="frow w-10 centered">
               <a href="{{route('deals.show',$deal)}}"><i data-feather='truck' class="feather-xsmall mx-1 txt-primary"></i></a>
               <a href="{{route('deals.edit',$deal)}}"><i data-feather='edit-2' class="feather-xsmall mx-1 txt-blue"></i></a>
               <div>
                  <form action="{{route('deals.destroy',$deal)}}" method="POST" id='del_form{{$deal->id}}'>
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="bg-transparent p-0 border-0" onclick="delme('{{$deal->id}}')"><i data-feather='x' class="feather-xsmall mx-1 txt-red"></i></button>
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