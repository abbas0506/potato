@extends('layout')
@section('menu')
<x-sidebar__menu></x-sidebar__menu>
@endsection
@section('page')
<div class="flexrow justify-content-between p-4 auto-col">
   <!-- color pallets for different groups -->
   @php
   $palletColors=array('bg-danger','bg-success','bg-primary','bg-dark-grey');
   $i=0;
   @endphp

   <!-- show group pallets -->
   @foreach($groups as $group)
   <a href="registrationfilter/{{$group->id}}">
      <div class="flexcol text-light col-center {{$palletColors[$i++]}} text-center box-120x200">
         <div class="txt-m txt-white">{{$group->name}}</div>
         <div class="txt-m txt-white">{{$group->registrations()->count()}}</div>
      </div>
   </a>
   @endforeach

</div>
<!-- show total strength -->
<div class="flexrow row-center w-100 vh-60">
   <div class="flexcol hw-25 col-center">
      <a href="{{route('registration.index')}}">
         <div class="flexrow row-center txt-xl txt-b border rounded-circle box-200">{{$registrations->count()}}</div>
      </a>
      <div class="mt-2 txt-m">Total Forms</div>
   </div>
</div>
@endsection