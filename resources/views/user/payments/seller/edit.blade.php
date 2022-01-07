@extends('layouts.user')

@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Payments</div>
   <div class="frow"> <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      <a href="{{url('payments')}}" class="hover-orange"> Payment Options </a> <span class="mx-2">/</span>
      <a href="{{route('sellerpayments.index')}}" class="hover-orange"> Sellers</a> <span class="mx-2">/</span>
      Edit
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
               <div>Edit Payment</div>
               <div class="frow centered txt-s"><b>{{$deal->seller->name}}</b> [ Deal No. {{$deal->id}} dated {{$deal->dateon->format('d/m/y')}}, {{$deal->product->name}}@Rs.{{$deal->priceperkg}}]</div>
            </div>
         </div>
         <form action="{{route('sellerpayments.update', $sellerpayment)}}" method='post'>
            @csrf
            @method('PATCH')
            <!-- <div class="txt-m txt-b txt-red my-2 px-4 border-left border-2 border-success">Purchasing</div> -->
            <input type="text" name="deal_id" value="{{$deal->id}}" hidden>
            <input type="text" name="seller_id" value="{{$deal->seller->id}}" hidden>
            <div class="frow mt-5">
               <div class="fancyinput">
                  <input type="number" class="text-center" name='paid' min="0" value="{{$sellerpayment->paid}}" required>
                  <label for="Name">Paid</label>
               </div>
               <div class="fancyselect w-48 ml-3">
                  <select name="mode" id="" required>
                     <option value="Cash" @if($sellerpayment->mode=='Cash') selected @endif>Cash</option>
                     <option value="Cheque" @if($sellerpayment->mode=='Cheque') selected @endif>Cheque</option>
                     <option value="Online" @if($sellerpayment->mode=='Online') selected @endif>Online Trasfer</option>
                  </select>
                  <label for="Name">Mode of Payment</label>
               </div>

            </div>
            <div class="fancyinput mt-3">
               <input type="text" class="text-center" name='note' value="{{$sellerpayment->note}}" required>
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