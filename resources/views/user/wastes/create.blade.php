@extends('layouts.user')
@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Deal # {{$deal->id}}</div>
   <div class="frow"> <a href="{{url('user')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      <a href="{{url('deals')}}" class="hover-orange"> Deals </a> <span class="mx-2">/</span>
      <a href="{{route('deals.show',$deal)}}" class="hover-orange">Picks </a> <span class="mx-2">/</span> Storage
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
<!-- purchasing -->
<div class="frow centered">
   <div class="fcol w-70">
      <div class="w-100 bg-light my-3">
         <div class="border-1 border-left border-success py-2 text-primary txt-m" style="background-color: #eee;">
            <div class="frow px-4 stretched">
               <div class="">New Waste</div>
               <div class="frow centered txt-s"><b>{{$deal->seller->name}} </b>[ Deal No. {{$deal->id}} dated {{$deal->dateon->format('d/m/y')}}, {{$deal->product->name}}@Rs.{{$deal->priceperkg}}]</div>
            </div>
         </div>

         <form action="{{route('wastes.store')}}" method='post'>
            @csrf
            <input type="hidden" name="purchase_id" value="{{$purchase->id}}">
            <div class="frow mid-left mt-4">
               <div class="fancyinput w-24">
                  <input type="date" name='dateon' id='dateon' placeholder="Enter name">
                  <label for="Name">Date (mm-dd-yyyy)</label>
               </div>
               <div class="txt-m txt-b txt-red ml-3"><span class="badge badge-warning rounded txt-s"> Max Wastable : {{$store->retained($purchase->id)}} </span></div>
            </div>
            <div class="frow stretched mt-4">
               <div class="fancyselect w-60">
                  <select name="store_id" id="">
                     <option value="{{$store->id}}">{{$store->name}}</option>
                  </select>
                  <label for="Name">Cold Store Name</label>
               </div>
               <div class="fancyinput w-18">
                  <input type="number" class='text-center' name='numofbori' id='numofbori' value="{{$store->numofbori_retained($purchase->id)}}" required>
                  <label for="Name">Number of Bori</label>
               </div>
               <div class="fancyinput w-18">
                  <input type="number" class='text-center' name='numoftora' id='numoftora' value="{{$store->numoftora_retained($purchase->id)}}" required>
                  <label for="Name">Number of Tora</label>
               </div>
            </div>

            <div class="fancyinput mt-4">
               <input type="text" class='text-center' name='note' id='note' value="">
               <label for="Name">Note</label>
            </div>
      </div>

      <div class="frow mid-right mt-4">
         <button type="submit" class="btn btn-primary">Submit</button>
      </div>

      </form>
   </div>
</div>
</div>

@endsection

@section('script')
<script lang="javascript">
document.getElementById('dateon').valueAsDate = new Date();
</script>
@endsection