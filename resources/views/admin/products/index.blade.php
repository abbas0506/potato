@extends('layouts.admin')
@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Products</div>
   <div class="frow"> <a href='admin' class="hover-orange"> Home </a> <span class="mx-2">/</span> products list</div>

</div>
@endsection
@section('page-content')
<div class="frow centered">
   <div class="fcol w-60">
      <!-- <div class="fcol w-70 centered bg-light-grey"> -->
      <div class="w-100 bg-light px-4 pb-2 my-4 border-left border-2 border-success">
         <div class="txt-b txt-orange">Create New product</div>
         <form action="{{route('products.store')}}" method='post'>
            @csrf
            <div class="frow stretched mt-3">
               <div class="fancyinput w-80">
                  <input type="text" name='name' placeholder="Enter name" required>
                  <label for="Name">Name</label>
               </div>
               <div class="w-15">
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
            <div class="frow mid-left w-80"><span class='txt-b'> Product Name </span><span class="txt-s txt-grey ml-4">(Click on <i data-feather='edit-3' class="feather-xsmall mx-1"></i> to edit or <i data-feather='x' class="feather-xsmall mx-1"></i> to remove the record)</span> </div>
            <div class="fcol mid-right pr-3 w-20"><i data-feather='settings' class="feather-xsmall"></i></div>
         </div>

         @foreach($products as $product)
         <div class="frow px-2 my-2 tr">
            <div class="fcol mid-left w-80">{{$product->name}}</div>
            <div class="fcol mid-right w-20">
               <div class="frow stretched">
                  <a href="{{route('products.edit',$product)}}"><i data-feather='edit-2' class="feather-xsmall mx-1 txt-blue"></i></a>
                  <div>
                     <form action="{{route('products.destroy',$product)}}" method="POST" id='del_form{{$product->id}}'>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-transparent p-0 border-0" onclick="delme('{{$product->id}}')"><i data-feather='x' class="feather-xsmall mx-1 txt-red"></i></button>
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