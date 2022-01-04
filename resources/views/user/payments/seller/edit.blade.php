@extends('layouts.user')

@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Deal # {{$deal->id}}</div>
   <div class="frow"> <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      <a href="{{url('deals')}}" class="hover-orange"> Deals </a> <span class="mx-2">/</span>
      <a href="{{route('payments.index')}}" class="hover-orange"> Payments </a> <span class="mx-2">/</span>
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
   <div class="fcol w-70">
      <div class="w-100 bg-light my-3">
         <div class="border-1 border-left border-success py-2 text-primary txt-m" style="background-color: #eee;">
            <div class="frow px-4 stretched">
               <div>
                  {{$deal->seller->name}} <span class="txt-s ml-4">Agreement => {{$deal->product->name}} : {{$deal->numofbori}} + {{$deal->numoftora}} @ Rs. {{$deal->priceperkg}} dated {{$deal->dateon->format('d/m/y')}}</span>
               </div>
               <div class="frow centered">
                  <a href="{{route('deals.show', $deal)}}" class="hover-orange txt-s"> Pick Detail </a> <span class="mx-2 txt-s">|</span>
                  <div class="frow txt-s mid-right"> Edit Payment</div>
               </div>
            </div>
         </div>
         <form action="{{route('payments.update', $payment)}}" method='post'>
            @csrf
            @method('PATCH')
            <!-- <div class="txt-m txt-b txt-red my-2 px-4 border-left border-2 border-success">Purchasing</div> -->
            <input type="text" name="deal_id" value="{{$deal->id}}" hidden>
            <input type="text" name="seller_id" value="{{$deal->seller->id}}" hidden>
            <div class="frow mt-5">
               <div class="fancyinput">
                  <input type="number" class="text-center" name='paid' min="0" value="{{$payment->paid}}" required>
                  <label for="Name">Paid</label>
               </div>
               <div class="fancyselect w-48 ml-3">
                  <select name="mode" id="" required>
                     <option value="Cash" @if($payment->mode=='Cash') selected @endif>Cash</option>
                     <option value="Cheque" @if($payment->mode=='Cheque') selected @endif>Cheque</option>
                     <option value="Online" @if($payment->mode=='Online') selected @endif>Online Trasfer</option>
                  </select>
                  <label for="Name">Mode of Payment</label>
               </div>

            </div>
            <div class="fancyinput mt-3">
               <input type="text" class="text-center" name='note' value="{{$payment->note}}" required>
               <label for="Name">Note</label>
            </div>
            <div class="text-right mt-3 ml-3">
               <button type="submit" class="btn btn-primary">Update</button>
            </div>
      </div>
      </form>
   </div>
</div>
</div>

@endsection