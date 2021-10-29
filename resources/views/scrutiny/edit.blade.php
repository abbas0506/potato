@extends('layout')
@section('menu')
<x-sidebar__menu></x-sidebar__menu>
@endsection
@section('page')
<!-- page title -->
<div class="flexrow row-mid-left txt-m txt-white bg-teal px-5 py-2">
   <div><i data-feather='layers' class="feather-small mx-2"></i>Data Verification & Fee Payment - Form No {{$registration->id}}</div>
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
<div class="flexrow px-10 mt-4 txt-m txt-b">{{$registration->name}}</div>
<div class="flexrow px-10 mb-1 mt-3">
   <div class='hw-20'>Phone</div>
   <div class='hw-80'>{{$registration->phone}}</div>
</div>
<div class="flexrow px-10 mb-1">
   <div class='hw-20'>Group</div>
   <div class='hw-80 txt-red txt-b'>{{$registration->group->name}}</div>
</div>
<div class="flexrow px-10 mb-1">
   <div class='hw-20'>DOB</div>
   <div class='hw-80'>{{$registration->dob->format('d-m-Y')}}</div>
</div>
<div class="flexrow px-10 mb-1">
   <div class='hw-20'>CNIC</div>
   <div class='hw-80'>{{$registration->bform}}</div>
</div>
<div class="flexrow px-10 mb-3">
   <div class='hw-20'>Matric</div>
   <div class='hw-80'>{{$registration->bise->name}}, {{$registration->rollno}}, {{$registration->marks}} ({{round($registration->marks/11,2)}} %)</div>
</div>
<form action="{{route('scrutiny.update', $registration->id)}}" method='post'>
   @csrf
   @method('PUT')
   <div class="flexrow mt-3 px-10 auto-col" style='font-size:1.15rem;'>
      <div class="flexcol hw-40">
         <div class='mb-1'><input type="checkbox" name='haspics' value='1' class='chk' @if($registration->haspics) checked @endif> &nbsp &nbsp Pics</div>
         <div class='mb-1'><input type="checkbox" name='hasgcnic' value='1' class='chk' @if($registration->hasgcnic) checked @endif> &nbsp &nbsp Guardian CNIC</div>
         <div class='mb-1'><input type="checkbox" name='hasbform' value='1' class='chk' @if($registration->hasbform) checked @endif> &nbsp &nbsp B Form</div>
         <div class='mb-1'><input type="checkbox" name='hasmatric' value='1' class='chk' @if($registration->hasmatric) checked @endif> &nbsp &nbsp Matric Result</div>
         @if($registration->isOtherBoard())
         <div class='mb-1'><input type="checkbox" name='hasnoc' class='chk' value='1' @if($registration->hasnoc) checked @endif> &nbsp &nbsp NOC</div>
         @endif
      </div>
      <div class="flexcol hw-60">
         <div class='mb-1'><input type="checkbox" name='isdobcorrect' value='1' class='chk' @if($registration->isdobcorrect) checked @endif> &nbsp &nbsp Date of birth correct? <span class='txt-s'>(optional)</span></div>
         <div class='mb-1'><input type="checkbox" name='isbformcorrect' value='1' class='chk' @if($registration->isbformcorrect) checked @endif> &nbsp &nbsp B Form correct? <span class='txt-s'>(optional)</span></div>
         <div class=''><input type="checkbox" name='ismarkscorrect' value='1' class='chk' @if($registration->ismarkscorrect) checked @endif> &nbsp &nbsp Matric marks correct? <span class='txt-s'>(optional)</span></div>
      </div>
   </div>
   <div class='flexrow row-mid-right hw-80'><button type="submit" class='btn btn-success'>Save</button></div>
</form>
@endsection