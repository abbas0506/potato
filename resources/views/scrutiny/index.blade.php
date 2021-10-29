@extends('layout')
@section('menu')
<x-sidebar__menu></x-sidebar__menu>
@endsection
@section('page')
<!-- page title -->
<div class="flexrow row-mid-left justify-content-between txt-m bg-light-grey px-10 py-2 auto-col">
   <div>Docs Scrutiny </div>
   <div><input type="text" class='input-rounded' placeholder="Search" oninput="search(event)"><i data-feather='search' class="feather-small" style="position:relative; right:24; top:-2px"></i></div>
</div>

<!-- help text-->
<div class="flexrow hw-100 justify-content-between row-mid-left px-10 my-4 auto-col">
   <div class="auto-expand txt-xs text-justify">
      <i data-feather='help-circle' class="feather-small" style="position:relative; top:-2px"></i>
      Use <i data-feather='layers' class="feather-xsmall mx-1 txt-blue"></i> scrutnize any registered form.
   </div>
</div>

<!-- display record save, del, update message if any -->
@if ($errors->any())
<div class="alert alert-danger mx-10 mt-5">
   <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
   </ul>
</div>
<br />
@elseif(session('success'))
<div class="alert alert-success mx-10 mt-5">
   {{session('success')}}
</div>
<br />

@endif
<!-- page content -->
<div class="flexrow pl-2 mx-10 mb-2 txt-b bg-info">
   <div class="flexcol col-mid-left hw-10">Form </div>
   <div class="flexcol col-mid-left hw-30">Name </div>
   <div class="flexcol col-mid-left hw-15">Group </div>
   <div class="flexcol col-top-left hw-15">Fee Status</div>
   <div class="flexcol col-mid-left hw-20">Deficiencies</div>
   <div class="flexcol col-top-mid hw-10">Scrutinize</div>
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
   margin-left: -1em;
}
</style>

@foreach($registrations as $registration)
<div class="flexrow pl-2 mx-10 my-1 tr">
   <div class="flexcol col-top-left hw-10">{{$registration->id}} </div>
   <div class="flexcol col-top-left hw-30"> {{$registration->name}} </div>
   <div class="flexcol col-top-left hw-15">{{$registration->group->name}} </div>
   <div class='flexcol col-top-left hw-15'>@if($registration->paidat) Paid @else ? @endif</div>
   <div class="flexcol col-mid-left hw-20">
      @if($registration->deficiencies()->count()>0)

      <ul class="m-0 pl-3">
         @foreach($registration->deficiencies() as $deficiency)
         <li> {{$deficiency}}</li>
         @endforeach

      </ul>

      @else
      -
      @endif
   </div>
   <div class='flexcol col-top-mid hw-10'><a href="{{route('scrutiny.edit',$registration->id)}}"><i data-feather='layers' class="feather-small txt-blue"></i></a></div>


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
            $(this).children().eq(3).prop('outerText').toLowerCase().includes(searchtext)
         )) {
         $(this).addClass('hide');
      } else {
         $(this).removeClass('hide');
      }


   });
}
</script>
@endsection