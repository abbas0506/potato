@extends('layout')
@section('menu')
<x-sidebar__menu></x-sidebar__menu>
@endsection
@section('page')
<!-- page title -->
<div class="flexrow hw-100 row-mid-left justify-content-between txt-m bg-light-grey px-10 py-2 auto-col">
   <div>Fee Collection</div>
   <div class="txt-s">Who have paid Paid <span class='bage badge-pill badge-success ml-2 p-0 px-2 txt-xs'>{{$registrations->whereNotNull('paidat')->count()}}</span></div>
   <div class="txt-s">Unpaid <span class='bage badge-pill badge-danger ml-2 p-0 px-2 txt-xs'>{{$registrations->whereNull('paidat')->count()}}</span></div>
   <div>
      <input type="text" class='input-rounded' placeholder="Search" oninput="search(event)"><i data-feather='search' class="feather-small" style="position:relative; right:24; top:-2px"></i>
   </div>
</div>

<!-- help text-->
<div class="flexrow hw-100 justify-content-between row-mid-left px-10 my-4 auto-col">
   <div class="auto-expand txt-xs text-justify">
      <i data-feather='help-circle' class="feather-small" style="position:relative; top:-2px"></i>
      Use <i data-feather='rotate-ccw' class="feather-xsmall mx-1 txt-red"></i> to undo fee collection.
   </div>
</div>

<!-- display record save, del, update message if any -->
@if ($errors->any())
<div class="alert alert-danger mx-10 mt-2">
   <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
   </ul>
</div>
<br />
@elseif(session('success'))
<div class="alert alert-success mx-10 mt-2">
   {{session('success')}}
</div>
<br />

@endif

<!-- page content -->
<div class="flexrow pl-2 mb-2 txt-b bg-info mx-10">
   <div class="flexcol col-mid-left hw-10">Form </div>
   <div class="flexcol col-mid-left hw-25">Name </div>
   <div class="flexcol col-mid-left hw-15">Group </div>
   <div class="flexcol col-mid-left hw-15">Missing</div>
   <div class="flexcol col-mid-left hw-10">Fee</div>
   <div class="flexcol col-center hw-15">Status</div>
   <div class="flexcol col-top-mid hw-10">...</div>
</div>

<!-- red color bulltes of the lsit -->
<style>
ul {
   list-style: none;
}

ul li::before {
   content: "\2022";
   color: red;
   font-weight: bold;
   display: inline-block;
   width: 1em;
   margin-left: -2.5em;
}
</style>

@foreach($registrations as $registration)
<div class="flexrow pl-2 mx-10 my-1 tr">
   <div class="flexcol col-mid-left hw-10">{{$registration->id}} </div>
   <div class="flexcol col-mid-left hw-25"> {{$registration->name}} </div>
   <div class="flexcol col-mid-left hw-15">{{$registration->group->name}} </div>
   <div class="flexcol col-mid-left hw-15 txt-xs">
      @if($registration->deficiencyCode())
      <ul>
         <li>{{$registration->deficiencyCode()}}</li>
      </ul>
      @else
      <span class='txt-xs txt-green pl-2'><i data-feather='check' class="feather-xsmall"></i></span>
      @endif
   </div>
   <div class="flexcol col-mid-left hw-10">{{$registration->group->fee}} </div>
   <div class='flexcol col-center hw-15'>
      @if($registration->paidat)
      <span class='txt-s txt-green'>Paid</span>
      @else
      <span class='txt-xs txt-red'>?</span>
      @endif
   </div>
   <div class='flexcol col-top-mid hw-10'>
      @if($registration->paidat)
      <form action="{{url('cancelfee',$registration->id)}}" method='post'>
         @csrf
         <button type='submit' class='bg-transparent p-0 border-0'><i data-feather='rotate-ccw' class="feather-xsmall txt-red"></i></button>
      </form>
      @else
      <form action="{{url('payfee',$registration->id)}}" method='post'>
         @csrf
         <button type='submit' class='btn btn-sm btn-success p-0 px-2' style='border-radius:50px;'>Pay</button>
      </form>
      @endif
   </div>

</div>

@endforeach

@endsection
@section('script')
<script lang="javascript">
function search(event) {
   var searchtext = event.target.value.toLowerCase();
   var str = 0;
   $('.tr').each(function() {
      if (!(
            $(this).children().eq(0).prop('outerText').toLowerCase().includes(searchtext) ||
            $(this).children().eq(1).prop('outerText').toLowerCase().includes(searchtext) ||
            $(this).children().eq(2).prop('outerText').toLowerCase().includes(searchtext) ||
            $(this).children().eq(5).prop('outerText').toLowerCase().includes(searchtext)
         )) {
         $(this).addClass('hide');
      } else {
         $(this).removeClass('hide');
      }


   });
}
</script>
@endsection