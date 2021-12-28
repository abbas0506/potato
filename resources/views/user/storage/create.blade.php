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
               <div>
                  {{$deal->seller->name}} <span class="txt-s ml-4">Agreement => {{$deal->product->name}} : {{$deal->numofbori}} + {{$deal->numoftora}} @ Rs. {{$deal->priceperkg}} dated {{$deal->dateon}}</span>
               </div>
               <div class="frow spaced txt-s mid-right">
                  <span class="txt-b">New Storage</span>
               </div>
            </div>
         </div>

         <form action="{{route('storage.store')}}" method='post'>
            @csrf
            <input type="hidden" name="purchase_id" value="{{$purchase->id}}">
            <div class="frow mid-left mt-4">
               <div class="fancyinput w-24">
                  <input type="date" name='dateon' id='dateon' placeholder="Enter name">
                  <label for="Name">Date (mm-dd-yyyy)</label>
               </div>
               <div class="txt-m txt-b txt-red ml-3"><span class="badge badge-warning rounded txt-s"> Max Storable : {{$purchase->numofbori_left()}} + {{$purchase->numoftora_left()}} </span></div>
            </div>
            <div class="frow stretched mt-4">
               <div class="fancyselect w-60">
                  <select name="store_id" id="">
                     @foreach($stores as $store)
                     <option value="{{$store->id}}">{{$store->name}}</option>
                     @endforeach
                  </select>
                  <label for="Name">Cold Store Name</label>
               </div>
               <div class="fancyinput w-18" @if($purchase->numofbori==0) hidden @endif>
                  <input type="number" class='text-center' name='numofbori' id='numofbori' value="{{$purchase->numofbori_left()}}" required>
                  <label for="Name">Number of Bori</label>
               </div>
               <div class="fancyinput w-18" @if($purchase->numoftora==0) hidden @endif>
                  <input type="number" class='text-center' name='numoftora' id='numoftora' value="{{$purchase->numoftora_left()}}" required>
                  <label for="Name">Number of Tora</label>
               </div>
            </div>
            <div class="frow stretched mt-4" @if($purchase->numofbori==0) hidden @endif>
               <div class="w-20 text-danger text-center txt-b bg-light-grey py-2">Per Bori >></div>
               <div class="fancyinput w-12">
                  <input type="text" class='text-center' name='commission0' id='commission0' value="{{$config->commission0}}">
                  <label for="Name">@ commission</label>
               </div>
               <div class="fancyinput w-12">
                  <input type="text" class='text-center' name='bagprice0' id='bagprice0' value="{{$config->bagprice0}}">
                  <label for="Name">@ bag price</label>
               </div>

               <div class="fancyinput w-12">
                  <input type="text" class='text-center' name='packing0' id='packing0' value="{{$config->packing0}}">
                  <label for="Name">@ packing</label>
               </div>
               <div class="fancyinput w-12">
                  <input type="text" class='text-center' name='loading0' id='loading0' value="{{$config->loading0}}">
                  <label for="Name">@ loading</label>
               </div>
               <div class="fancyinput w-12">
                  <input type="text" class='text-center' name='carriage0' id='carriage0' value="{{$config->carriage0}}">
                  <label for="Name">@ carriage</label>
               </div>
               <div class="fancyinput w-12">
                  <input type="number" class="text-center" name='storage0' id='storage0' min="0" value="{{$config->storage0}}">
                  <label for="Name">@ Storage</label>
               </div>

            </div>


            <div class="frow stretched mt-3" @if($purchase->numoftora==0 ) hidden @endif>
               <div class="w-20 text-danger text-center txt-b bg-light-grey py-2">Per Tora >></div>
               <div class="fancyinput w-12">
                  <input type="text" class='text-center' class='text-center' name='commission1' id='commission1' value="{{$config->commission1}}">
                  <label for="Name">@ commision</label>
               </div>
               <div class="fancyinput w-12">
                  <input type="text" class='text-center' name='bagprice1' id='bagprice1' value="{{$config->bagprice1}}">
                  <label for="Name">@ bag price</label>
               </div>
               <div class="fancyinput w-12">
                  <input type="text" class='text-center' name='packing1' id='packing1' value="{{$config->packing1}}">
                  <label for="Name">@ packing</label>
               </div>
               <div class="fancyinput w-12">
                  <input type="text" class='text-center' name='loading1' id='loading1' value="{{$config->loading1}}">
                  <label for="Name">@ loading</label>
               </div>
               <div class="fancyinput w-12">
                  <input type="text" class='text-center' name='carriage1' id='carriage1' value="{{$config->carriage1}}">
                  <label for="Name">@ carriage</label>
               </div>
               <div class="fancyinput w-12">
                  <input type="number" class="text-center" name='storage1' id='storage1' min="0" value="{{$config->storage1}}">
                  <label for="Name">@ Storage</label>
               </div>

            </div>

            <div class="frow stretched mt-4">
               <div class="w-20 text-danger text-center txt-b bg-light-grey py-2">Misc. >></div>
               <div class="fancyinput w-12">
                  <input type="number" class='text-center' name='selector' id='selector' value="0">
                  <label for="Name">Selector</label>
               </div>
               <div class="fancyinput w-12">
                  <input type="number" class='text-center' name='sorting' id='sorting' value="0">
                  <label for="Name">Sorting</label>
               </div>
               <div class="fancyinput w-12">
                  <input type="number" class='text-center' name='random' id='random' min='0' value="0">
                  <label for="Name">Random</label>
               </div>
               <div class="fancyinput w-40">
                  <input type="text" class='text-center' name='note' id='note' value="">
                  <label for="Name">Random Note</label>
               </div>
            </div>

            <div class="frow mid-right mt-4" @if($purchase->numoftora==0 || $purchase->numoftora_left()==0) hidden @endif>
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