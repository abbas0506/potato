@extends('layout')
@section('menu')
<x-sidebar__menu></x-sidebar__menu>
@endsection
@section('page')
<!-- page title -->
<div class="flexrow row-mid-left justify-content-between txt-m bg-light-grey px-10 py-2 auto-col">
   <div>Auto Enrolled <span class='bage badge-pill badge-success ml-2 p-0 px-2 txt-s'>{{$registrations->count()}}</span></div>
   <div><input type="text" class='input-rounded' placeholder="Search" oninput="search(event)"><i data-feather='search' class="feather-small" style="position:relative; right:24; top:-2px"></i></div>
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
<div class="flexrow px-10 mt-5 mb-2 txt-b">

   <div class="flexcol col-mid-left hw-10">Form No.</div>
   <div class="flexcol col-mid-left hw-30">Name </div>
   <div class="flexcol col-mid-left hw-15">Marks </div>
   <div class="flexcol col-mid-left hw-20">Group </div>
   <div class="flexcol col-mid-left hw-10">Roll No.</div>
   <div class="flexcol col-mid-right hw-15">Adm. No </div>
</div>

@foreach($registrations as $registration)
<div class="flexrow px-10 mt-1 mb-1 tr">
   <div class="flexcol col-mid-left hw-10">{{$registration->id}} </div>
   <div class="flexcol col-mid-left hw-30"> {{$registration->name}} </div>
   <div class="flexcol col-mid-left hw-15">{{$registration->marks}} </div>
   <div class="flexcol col-mid-left hw-20">{{$registration->group->name}} </div>
   <div class="flexcol col-mid-left hw-10">{{$registration->classrollno}} </div>
   <div class="flexcol col-mid-right hw-15">{{$registration->admno}} </div>
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
            $(this).children().eq(3).prop('outerText').toLowerCase().includes(searchtext) ||
            $(this).children().eq(4).prop('outerText').toLowerCase().includes(searchtext) ||
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