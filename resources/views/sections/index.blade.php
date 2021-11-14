@extends('layout')
@section('menu')
<x-sidebar__menu></x-sidebar__menu>
@endsection
@section('page')
<!-- page title -->
<div class="flexrow row-mid-left txt-m bg-teal px-5 py-2 txt-white auto-col">
   <div class="mr-5">
      <span class='text-light mr-5'>Section Enrollment</span>
      <span class="mx-2 txt-s">Total</span>
      <span class='bage badge-pill badge-success mr-5 p-0 px-2 txt-s'>{{$registrations->count()}}</span>
      <span class="mx-2 txt-s">Section Count</span>
      <span class='bage badge-pill badge-warning mr-5 p-0 px-2 txt-s'>{{$registrations->whereNotNull('section_id')->count()}}</span>
      <span class="mx-2 txt-s">Pool</span>
      <span class='bage badge-pill badge-info ml-2 p-0 px-2 txt-s'>{{$registrations->whereNull('section_id')->count()}}</span>
   </div>
</div>

<!-- display record save, del, update message if any -->
@if ($errors->any())
<div class="alert alert-danger mx-5">
   <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
   </ul>
</div>
<br />
@elseif(session('success'))
<div class="alert alert-success mx-5">
   {{session('success')}}
</div>
<br />

@endif
<div class="flexcol mt-5 centered">
   <!-- page content -->
   <div class="flexrow pl-2 mx-5 mb-2 txt-b txt-grey hw-60">
      <div class="flexcol col-mid-left hw-90">Section </div>
      <div class="flexcol col-mid-right hw-10">Strength </div>
   </div>

   @foreach($sections as $section)
   <div class="flexrow pl-2 mx-5 my-1 border-bottom tr hw-60">
      <div class="flexcol col-mid-left hw-90"> <a href="{{route('sections.show',$section)}}">{{$section->name}} </a></div>
      <div class="flexcol col-mid-right hw-10">{{$section->count()}} </div>
   </div>

   @endforeach
</div>


@endsection