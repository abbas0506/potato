@extends('layouts.admin')
@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Transporters</div>
   <div class="frow"> <a href="{{url('admin')}}" class="hover-orange"> Home </a> <span class="mx-2">/</span>
      <a href="{{route('transporters.index')}}" class="hover-orange"> Transporters list </a> <span class="mx-2">/</span> Edit
   </div>

</div>
@endsection
@section('page-content')
<div class="frow centered">
   <div class="fcol w-60">
      <!-- <div class="fcol w-70 centered bg-light-grey"> -->
      <div class="w-100 bg-light px-4 pb-2 my-4 border-left border-2 border-success">
         <div class="txt-b txt-orange">Edit Transporter</div>
         <form action="{{route('transporters.update', $transporter)}}" method='post'>
            @csrf
            @method('PATCH')
            <div class="fcol stretched mt-3">
               <div class="frow stretched">
                  <div class="fancyinput w-48">
                     <input type="text" name='name' placeholder="Enter transporter name" value="{{$transporter->name}}" required>
                     <label for="Name">Name</label>
                  </div>
                  <div class="fancyinput w-48">
                     <input type="text" name='phone' placeholder="03001234567" value="{{$transporter->phone}}" required>
                     <label for="Name">Phone</label>
                  </div>
               </div>
               <div class="fancyinput w-100 mt-3">
                  <input type="text" name='address' placeholder="ABC Commission Shop, Lahore" value="{{$transporter->address}}" required>
                  <label for="Name">Address</label>
               </div>

               <div class="fcol mid-right w-100 mt-3">
                  <button type="submit" class="btn btn-success">Update</button>
               </div>
            </div>
         </form>

      </div>
      @endsection