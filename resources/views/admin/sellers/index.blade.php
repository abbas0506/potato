@extends('layouts.admin')
@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Sellers</div>
   <div class="frow"> <a href="{{url('admin')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span> sellers</div>

</div>
@endsection
@section('page-content')
<div class="frow centered">
   <div class="fcol w-60">
      <!-- <div class="fcol w-70 centered bg-light-grey"> -->
      <div class="w-100 bg-light px-4 pb-2 my-4 border-left border-2 border-success">
         <div class="txt-b txt-orange">Create New seller</div>
         <form action="{{route('sellers.store')}}" method='post'>
            @csrf
            <div class="fcol stretched mt-3">
               <div class="frow stretched">
                  <div class="fancyinput w-48">
                     <input type="text" name='name' placeholder="Enter seller name" required>
                     <label for="Name">Name</label>
                  </div>
                  <div class="fancyinput w-48">
                     <input type="text" name='phone' placeholder="03001234567" oninput="formatAsPhone(event)" required>
                     <label for="Name">Phone</label>
                  </div>
               </div>
               <div class="fancyinput w-100 mt-3">
                  <input type="text" name='address' placeholder="ABC Commission Shop, Lahore" required>
                  <label for="Name">Address</label>
               </div>

               <div class="fcol mid-right w-100 mt-3">
                  <button type="submit" class="btn btn-success">Create</button>
               </div>
            </div>
         </form>

      </div>
      <!-- page content -->
      <div class="bg-custom-light p-4">
         <div class="fancy-search-grow">
            <input type="text" placeholder="Search" oninput="search(event)"><i data-feather='search' class="feather-small" style="position:relative; right:24;"></i>
         </div>

         <div class="frow px-2 py-1 my-3 border-bottom">
            <div class="frow mid-left w-30"><span class='txt-b'> seller Name</div>
            <div class="frow mid-left w-20"><span class='txt-b'> Phone</div>
            <div class="frow mid-left w-30"><span class='txt-b'> Address</div>

            <div class="fcol mid-right pr-3 w-20"><i data-feather='settings' class="feather-xsmall"></i></div>
         </div>

         @foreach($sellers as $seller)
         <div class="frow px-2 my-2 tr">
            <div class="fcol mid-left w-30">{{$seller->name}}</div>
            <div class="fcol mid-left w-20">{{$seller->phone}}</div>
            <div class="fcol mid-left w-30">{{$seller->address}}</div>
            <div class="fcol mid-right w-20">
               <div class="frow stretched">
                  <a href="{{route('sellers.edit',$seller)}}"><i data-feather='edit-2' class="feather-xsmall mx-1 txt-blue"></i></a>
                  <div>
                     <form action="{{route('sellers.destroy',$seller)}}" method="POST" id='del_form{{$seller->id}}'>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-transparent p-0 border-0" onclick="delme('{{$seller->id}}')"><i data-feather='x' class="feather-xsmall mx-1 txt-red"></i></button>
                     </form>
                  </div>
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