@extends('layouts.user')
@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Purchases</div>
   <div class="frow"> <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span> purchase list</div>

</div>
@endsection
@section('page-content')
<div class="frow centered">
   <div class="fcol w-60">
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

         <div class="frow px-2 py-1 my-3 border-bottom">
            <div class="frow mid-left w-80"><span class='txt-b'> purchase Name </span><span class="txt-s txt-grey ml-4">(Click on <i data-feather='edit-3' class="feather-xsmall mx-1"></i> to edit or <i data-feather='x' class="feather-xsmall mx-1"></i> to remove the record)</span> </div>
            <div class="fcol mid-right pr-3 w-20"><i data-feather='settings' class="feather-xsmall"></i></div>
         </div>

         @foreach($purchases as $purchase)
         <div class="frow px-2 my-2 tr">
            <div class="fcol mid-left w-80">{{$purchase->client_id}}</div>
            <div class="fcol mid-right w-20">
               <div class="frow stretched">
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