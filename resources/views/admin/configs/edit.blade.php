@extends('layouts.admin')
@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Default Setting</div>
   <div class="frow"> <a href="{{url('admin')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      Default
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
      <!-- <div class="fcol w-70 centered bg-light-grey"> -->
      <div class="w-100 bg-light px-4 pb-2 m-4">
         <form action="{{route('configs.update', $config)}}" method='post'>
            @csrf
            @method('PATCH')
            <div class="frow centered mb-4 txt-s txt-red">** All entries will be considered in Rs.</div>
            <div class="frow stretched mt-3">
               <div class="fancyinput w-48">
                  <input type="text" name='reduction0' placeholder="reduction per bori" value="{{$config->reduction0}}" required>
                  <label for="Name">Weight Reduction / Bori</label>
               </div>
               <div class="fancyinput w-48">
                  <input type="text" name='reduction1' placeholder="reduction per tora" value="{{$config->reduction1}}" required>
                  <label for="Name">Weight Reduction / Tora</label>
               </div>
            </div>

            <div class="frow stretched mt-3">
               <div class="fancyinput w-48">
                  <input type="text" name='bagprice0' placeholder="material cost per bori" value="{{$config->bagprice0}}" required>
                  <label for="Name">Bag Price / Bori</label>
               </div>
               <div class="fancyinput w-48">
                  <input type="text" name='bagprice1' placeholder="material cost per tora" value="{{$config->bagprice1}}" required>
                  <label for="Name">Bag Price / Tora</label>
               </div>
            </div>
            <div class="frow stretched mt-3">
               <div class="fancyinput w-48">
                  <input type="text" name='commission0' placeholder="Commission / Bori" value="{{$config->commission0}}" required>
                  <label for="Name">Commission / Bori</label>
               </div>
               <div class="fancyinput w-48">
                  <input type="text" name='commission1' placeholder="Commission / Tora" value="{{$config->commission1}}" required>
                  <label for="Name">Commission / Tora</label>
               </div>
            </div>
            <div class="frow stretched mt-3">
               <div class="fancyinput w-48">
                  <input type="text" name='packing0' placeholder="Packing Cost / Bori" value="{{$config->packing0}}" required>
                  <label for="Name">Packing Cost / Bori</label>
               </div>
               <div class="fancyinput w-48">
                  <input type="text" name='packing1' placeholder="Commission / Tora" value="{{$config->packing1}}" required>
                  <label for="Name">Packing Cost / Tora</label>
               </div>
            </div>
            <div class="frow stretched mt-3">
               <div class="fancyinput w-48">
                  <input type="text" name='loading0' placeholder="Loading Cost / Bori" value="{{$config->loading0}}" required>
                  <label for="Name">Loading Cost / Bori</label>
               </div>
               <div class="fancyinput w-48">
                  <input type="text" name='loading1' placeholder="Loading Cost / Tora" value="{{$config->loading1}}" required>
                  <label for="Name">Loading Cost / Tora</label>
               </div>
            </div>

            <div class="w-100 mt-3 text-right">
               <button type="submit" class="btn btn-success">Update</button>
            </div>
         </form>

      </div>
      @endsection