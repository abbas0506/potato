@extends('layout')
@section('menu')
<x-sidebar__menu></x-sidebar__menu>
@endsection
@section('page')
<!-- page title -->
<div class="flexrow row-mid-left txt-m text-light bg-teal vh-10 px-10">Auto Enroll</div>

@if ($errors->any())
<div class="alert alert-danger mx-10 mt-5">
   <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
   </ul>
</div>
<br />
@endif
<!-- data form -->
<form action="{{url('postAutoEnroll')}}" method='post'>
   @csrf
   <!-- show group options -->
   <div class="flexcol col-center auto-col vh-60 hw-100 px-10 mt-5 mb-5">
      <div class="mb-2 txt-center text-justify txt-b">
         <i data-feather='help-circle' class="feather-small mr-1"></i>
         By clicking on following button, admission nos. and class roll nos. will be auto assigned to each and every student who has paid fee. It should be perfromed after the completion of registration process. Do you really understand the process and want to proceed.
      </div>
      <div class="flexrow hw-50 justify-content-between row-center mt-4">
         <div class="fancyinput">
            <input type="number" name='startvalue' placeholder="Start value" required>
            <label for="Name">Start Value</label>
         </div>
         <div class=""><button type="submit" class="btn btn-danger">Yes, auto enroll</button></div>
      </div>
   </div>
</form>
@endsection