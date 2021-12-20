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
                  <input type="text" name='reductionperbori' placeholder="reduction per bori" value="{{$config->reductionperbori}}" required>
                  <label for="Name">Weight Reduction / Bori</label>
               </div>
               <div class="fancyinput w-48">
                  <input type="text" name='reductionpertora' placeholder="reduction per tora" value="{{$config->reductionpertora}}" required>
                  <label for="Name">Weight Reduction / Tora</label>
               </div>
            </div>

            <div class="frow stretched mt-3">
               <div class="fancyinput w-48">
                  <input type="text" name='bagpriceperbori' placeholder="material cost per bori" value="{{$config->bagpriceperbori}}" required>
                  <label for="Name">Material Cost / Bori</label>
               </div>
               <div class="fancyinput w-48">
                  <input type="text" name='bagpricepertora' placeholder="material cost per tora" value="{{$config->bagpricepertora}}" required>
                  <label for="Name">Material Cost / Tora</label>
               </div>
            </div>
            <div class="frow stretched mt-3">
               <div class="fancyinput w-48">
                  <input type="text" name='commissionperbori' placeholder="Commission / Bori" value="{{$config->commissionperbori}}" required>
                  <label for="Name">Commission / Bori</label>
               </div>
               <div class="fancyinput w-48">
                  <input type="text" name='commissionpertora' placeholder="Commission / Tora" value="{{$config->commissionpertora}}" required>
                  <label for="Name">Commission / Tora</label>
               </div>
            </div>
            <div class="frow stretched mt-3">
               <div class="fancyinput w-48">
                  <input type="text" name='packingcostperbori' placeholder="Packing Cost / Bori" value="{{$config->packingcostperbori}}" required>
                  <label for="Name">Packing Cost / Bori</label>
               </div>
               <div class="fancyinput w-48">
                  <input type="text" name='packingcostpertora' placeholder="Commission / Tora" value="{{$config->packingcostpertora}}" required>
                  <label for="Name">Packing Cost / Tora</label>
               </div>
            </div>
            <div class="frow stretched mt-3">
               <div class="fancyinput w-48">
                  <input type="text" name='loadingcostperbori' placeholder="Loading Cost / Bori" value="{{$config->loadingcostperbori}}" required>
                  <label for="Name">Loading Cost / Bori</label>
               </div>
               <div class="fancyinput w-48">
                  <input type="text" name='loadingcostpertora' placeholder="Loading Cost / Tora" value="{{$config->loadingcostpertora}}" required>
                  <label for="Name">Loading Cost / Tora</label>
               </div>
            </div>

            <div class="w-100 mt-3 text-right">
               <button type="submit" class="btn btn-success">Update</button>
            </div>
         </form>

      </div>
      @endsection