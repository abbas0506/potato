@extends('layouts.user')

@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Payments</div>
   <div class="frow"> <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      <a href="{{url('buyerpayments/'.$buyer->id)}}" class="hover-orange"> Buyer Payments </a> <span class="mx-2">/</span>
      New
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
   <div class="fcol w-60">
      <div class="w-100 bg-light my-3">
         <div class="border-1 border-left border-success py-2 text-primary txt-m" style="background-color: #eee;">
            <div class="frow px-4 stretched">
               <div>
                  Buyer Payment
               </div>
               <div class="frow centered">
                  <a href="{{url('buyerpayments/'.$buyer->id)}}" class="hover-orange txt-s"> Buyers List </a> <span class="mx-2 txt-s">|</span>
                  <div class="frow txt-s mid-right"> New Payment</div>
               </div>
            </div>
         </div>
         <form action="{{url('buyerpayments',$buyerpayment->id)}}" method='post'>
            @csrf
            @method('PATCH')
            <div class="txt-l mt-3">{{$buyerpayment->mode}}
               <div class="frow mt-3 stretched">
                  <div class="fancyinput w-24">
                     <input type="number" class="text-center" name='paid' min="0" value="{{$buyerpayment->paid}}" required>
                     <label for="Name">Amount</label>
                  </div>
                  <div class="fancyinput w-72">
                     <input type="text" class="text-center" name='note' value="{{$buyerpayment->note}}" required>
                     <label for="Name">Note</label>
                  </div>
               </div>
               <div class="text-right mt-3">
                  <button type="submit" class="btn btn-primary">Update</button>
               </div>
         </form>
      </div>
   </div>
</div>

@endsection