@extends('layouts.user')

@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Payments</div>
   <div class="frow">
      <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      <a href="{{url('payments')}}" class="hover-orange"> Payment Options </a> <span class="mx-2">/</span>
      Sellers
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
   <div class="fcol w-70">
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
               <div class="w-10"><span class='txt-b'> Deal</div>
               <div class="w-15"><span class='txt-b'> Date</div>
               <div class="w-20"><span class='txt-b'> Product</div>
               <div class="w-10"><span class='txt-b'> Qty</div>
               <div class="w-10"><span class='txt-b'> Picked</div>
               <div class="w-10"><span class='txt-b'> Left</div>
               <div class="w-10"><span class='txt-b'> Bill</div>
               <div class="w-10"><span class='txt-b'> Paid</div>
               <div class="w-10"><span class='txt-b'> Due</div>
               <div class="w-10 text-center">Payment</div>
            </div>
            @php $sr=1; @endphp
            @foreach($seller->deals as $deal)
            <div class="frow stretched px-2 my-2 txt-s">
               <div class="w-10">{{$deal->id}}</div>
               <div class="w-15">{{$deal->dateon->format('d/m/y')}}</div>
               <div class="w-20">{{$deal->product->name}}</div>
               <div class="w-10">{{$deal->qty()}}</div>
               <div class="w-10">{{$deal->picked()}}</div>
               <div class="w-10">{{$deal->left()}}</div>
               <div class="w-10">{{$deal->bill()}}</div>
               <div class="w-10"><a href="#deal{{$deal->id}}" data-toggle="collapse" class="hover-orange">{{$deal->paid()}}</a></div>
               <div class="w-10">{{$deal->bill()-$deal->paid()}}</div>
               <div class="frow w-10 centered">
                  <a href="{{url('sellerpayment/create',$deal->id)}}" class="hover-orange"><i data-feather='plus-square' class="feather-xsmall"></i></a>
               </div>
            </div>

            <div class="p-3 bg-light border thin collapse" id='deal{{$deal->id}}'>
               <div class="frow stretched px-2 py-1 my-3 txt-s border-bottom" style="color:teal">
                  <div class="w-10">ID</div>
                  <div class="w-20">Date</div>
                  <div class="w-10">Paid</div>
                  <div class="w-20">Mode</div>
                  <div class="w-30">Note</div>
                  <div class="fcol centered w-10"><i data-feather='settings' class="feather-xsmall"></i></div>
               </div>

               @foreach($deal->payments()->get()->sortDesc() as $payment)
               <div class="frow px-2 my-2 stretched ">
                  <div class="w-10 txt-s">{{$payment->id}}</div>
                  <div class="w-20 txt-s">{{$payment->created_at->format('d/m/y')}}</div>
                  <div class="w-10 txt-s">{{$payment->paid}}</div>
                  <div class="w-20 txt-s">{{$payment->mode}}</div>
                  <div class="w-30 txt-s">{{$payment->note}}</div>
                  <div class="frow w-10 centered">
                     <a href="{{route('sellerpayments.edit', $payment)}}"><i data-feather='edit-2' class="feather-xsmall mx-1 txt-blue"></i></a>
                     <div>
                        <form action="{{route('sellerpayments.destroy', $payment)}}" method="POST" id='del_form{{$payment->id}}'>
                           @csrf
                           @method('DELETE')
                           <button type="submit" class="bg-transparent p-0 border-0" onclick="delme('{{$payment->id}}')"><i data-feather='x' class="feather-xsmall mx-1 txt-red"></i></button>
                        </form>
                     </div>
                  </div>
               </div>
               @endforeach
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