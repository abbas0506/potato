@extends('layouts.user')

@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Payments</div>
   <div class="frow"> <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      <a href="{{url('payments')}}" class="hover-orange"> Payment Options </a> <span class="mx-2">/</span>
      <a href="{{route('payments.show',2)}}" class="hover-orange"> Buyers</a> <span class="mx-2">/</span>
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
   <div class="fcol w-50">
      <div class="w-100 bg-light my-4">
         <div class="border-1 border-left border-success py-2 text-primary txt-m" style="background-color: #eee;">
            <div class="frow px-4 stretched">
               <div>New Payment</div>
               <div class="frow txt-s centered">{{$buyer->name}}</div>
            </div>
         </div>
         <form action="{{route('buyerpayments.store')}}" method='post'>
            @csrf
            <!-- <div class="txt-m txt-b txt-red my-2 px-4 border-left border-2 border-success">Purchasing</div> -->
            <input type="text" name="buyer_id" value="{{$buyer->id}}" hidden>
            <div class="frow mt-5">
               <div class="fancyinput w-24">
                  <input type="number" class="text-center" name='paid' min="0" value="0" required>
                  <label for="Name">Amount</label>
               </div>
               <div class="fancyselect w-48 ml-3">
                  <select name="mode" id="" required>
                     <option value="Cash">Cash</option>
                     <option value="Cheque">Cheque</option>
                     <option value="Online">Online Trasfer</option>
                  </select>
                  <label for="Name">Mode of Payment</label>
               </div>

            </div>
            <div class="fancyinput mt-3">
               <input type="text" class="text-center" name='note' value="" required>
               <label for="Name">Note</label>
            </div>
            <div class="text-right mt-3">
               <button type="submit" class="btn btn-primary">Submit</button>
            </div>
         </form>
      </div>
   </div>
</div>

@endsection