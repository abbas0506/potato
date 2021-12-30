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
               New Deal
            </div>
         </div>

         <!-- table header row -->
         <div class="frow px-2 py-1 my-3 txt-s border-bottom" style="color:teal">
            <div class="w-5">ID</div>
            <div class="w-10">Date</div>
            <div class="w-20">Seller</div>
            <div class="w-15">Product</div>
            <div class="w-10">Agreed</div>
            <div class="w-10">@ kg</div>
            <div class="w-10">Picked</div>
            <div class="w-10">Sold</div>
            <div class="w-10">Stored</div>
            <div class="w-10">Wasted</div>
            <div class="w-10 text-center"><i data-feather='map-pin' class="feather-xsmall"></i></div>
            <div class="w-10 text-center"><i data-feather='settings' class="feather-xsmall"></i></div>
         </div>

         @foreach($deals as $deal)
         <div class="frow px-2 my-2 stretched tr ">
            <div class="w-5 txt-s"><a href="{{route('deals.show',$deal)}}" class="txt-blue txt-b">{{$deal->id}}</a></div>
            <div class="w-10 txt-s">{{$deal->dateon}}</div>
            <div class="w-20 txt-s">{{$deal->seller->name}}</div>
            <div class="w-15 txt-s">{{$deal->product->name}}</div>
            <div class="w-10 txt-s">{{$deal->numofbori}} + {{$deal->numoftora}}</div>
            <div class="w-10 txt-s">{{$deal->priceperkg}}</div>
            <div class="w-10 txt-s">{{$deal->numofbori_picked()}} + {{$deal->numoftora_picked()}}</div>
            <div class="w-10 txt-s">{{$deal->sold()}}</div>
            <div class="w-10 txt-s">{{$deal->stored()}}</div>
            <div class="w-10 txt-s">{{$deal->wasted()}}</div>
            <div class="w-10 txt-s text-center">{{$deal->left()}}</div>
            <div class="frow w-10 centered">
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
            $(this).children().eq(0).prop('outerText').toLowerCase().includes(searchtext) ||
            $(this).children().eq(1).prop('outerText').toLowerCase().includes(searchtext) ||
            $(this).children().eq(2).prop('outerText').toLowerCase().includes(searchtext)
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