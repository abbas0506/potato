@extends('layouts.admin')
@section('page-header')
<div class="fcol bg-teal txt-white centered py-2 sticky-top">
   <div class="txt-l txt-b">Clients</div>
   <div class="frow"> <a href='admin' class="hover-orange"> Home </a> <span class="mx-2">/</span>
      <a href="{{route('clients.index')}}" class="hover-orange"> Clients list </a> <span class="mx-2">/</span> Edit
   </div>

</div>
@endsection
@section('page-content')
<div class="frow centered">
   <div class="fcol w-60">
      <!-- <div class="fcol w-70 centered bg-light-grey"> -->
      <div class="w-100 bg-light px-4 pb-2 my-4 border-left border-2 border-success">
         <div class="txt-b txt-orange">Edit Client</div>
         <form action="{{route('clients.update', $client)}}" method='post'>
            @csrf
            @method('PATCH')
            <div class="fcol stretched mt-3">
               <div class="frow stretched">
                  <div class="fancyinput w-48">
                     <input type="text" name='name' placeholder="Enter client name" value="{{$client->name}}" required>
                     <label for="Name">Name</label>
                  </div>
                  <div class="fancyinput w-48">
                     <input type="text" name='phone' placeholder="03001234567" value="{{$client->phone}}" required>
                     <label for="Name">Phone</label>
                  </div>
               </div>
               <div class="fancyinput w-100 mt-3">
                  <input type="text" name='address' placeholder="ABC Commission Shop, Lahore" value="{{$client->address}}" required>
                  <label for="Name">Address</label>
               </div>

               <div class="fcol mid-right w-100 mt-3">
                  <button type="submit" class="btn btn-success">Update</button>
               </div>
            </div>
         </form>

      </div>
      @endsection