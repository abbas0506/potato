@extends('layout')
@section('menu')
<x-sidebar__menu></x-sidebar__menu>
@endsection
@section('page')
<!-- page title -->
<div class="flexrow row-mid-left txt-m text-light bg-teal py-2 px-10">New Registration <i data-feather='user-plus' class="feather-small mx-2" style="position:relative; margin-left:5px; top:-2px"></i></div>

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
<form action="{{route('registration.store')}}" method='post' onsubmit="return validate()">
   @csrf
   <!-- show group options -->
   <div class="flexrow auto-col px-10 my-4">
      @foreach($groups as $group)
      <div class="flexcol">
         <div class="flexrow row-mid-left mr-5">
            <div class="txt-m mr-2"><input type="checkbox" name='group_id' id="group_id" value='{{$group->id}}' onclick="onlyOne(this)" @if($group->id==1) checked @endif ></div>
            <div class="txt-m">{{$group->name}}</div>
         </div>
      </div>
      @endforeach

   </div>
   <!-- data fields -->
   <div class="flexrow justify-content-between px-10 mb-4 auto-col ">
      <div class="flexcol col-center hw-48">
         <div class="fancyinput w-100">
            <input type="text" name='name' placeholder="Student name" required>
            <label for="Name">Name</label>
         </div>
      </div>
      <div class="flexcol col-center hw-48">
         <div class="fancyinput w-100">
            <input type="text" name='dob' id='dob' placeholder="Date of Birth" pattern='[0-9]{2}-[0-9]{2}-[0-9]{4}' oninput="formatAsDate(event)" required>
            <label for="Name">Date of Birth (dd-mm-yyyy)</label>
         </div>
      </div>
   </div>

   <div class="flexrow justify-content-between px-10 mb-4 auto-col ">
      <div class="flexcol col-center hw-48">
         <div class="fancyinput w-100">
            <input type="text" name='bform' id='bform' placeholder="B Form" pattern='[0-9]{5}-[0-9]{7}-[0-9]' oninput='formatAsCnic(event)' required>
            <label for="Name">B Form</label>
         </div>
      </div>
      <div class="flexcol col-center hw-48">
         <div class="fancyinput w-100">
            <input type="text" name='phone' id='phone' placeholder="Phone" pattern='0[0-9]{3}-[0-9]{7}' oninput="formatAsPhone(event)" required>
            <label for="Name">Phone</label>
         </div>
      </div>
   </div>
   <div class="flexrow justify-content-between mb-4 px-10 auto-col">
      <div class="flexcol col-center hw-48">
         <div class="fancyselect w-100">
            <select name='bise_id'>
               @foreach($bises as $bise)
               <option value='{{$bise->id}}'>{{$bise->name}}</option>
               @endforeach

               <option>Not in list, add new</option>
            </select>
            <label for="Name">BISE</label>
         </div>
      </div>
      <div class="flexcol hw-48">
         <div class="fancyselect w-100">
            @php
            $currentyear=date('Y');
            @endphp
            <select name='passyear'>
               @for($yr=$currentyear; $yr>=$currentyear-2; $yr--)
               <option value='{{$yr}}'>{{$yr}}</option>
               @endfor
            </select>
            <label for="Name">Passing Year</label>
         </div>
      </div>
   </div>
   <div class="flexrow justify-content-between mb-4 px-10 auto-col">
      <div class="flexcol hw-48">
         <div class="fancyinput w-100">
            <input type="text" name='rollno' placeholder="Roll No" pattern='[0-9]{1,8}' required>
            <label for="Name">Roll No</label>
         </div>
      </div>
      <div class="flexcol hw-48">
         <div class="fancyinput w-100">
            <input type="number" name='marks' id='marks' placeholder="Marks" min='1' max='1100' required>
            <label for="Name">Marks</label>
         </div>
      </div>
      <input type="text" name='concession' id='_concession' value="0" hidden>
   </div>
   <div class="text-right px-10 mt-2">
      <button type="submit" class="btn btn-success">Create</button>
   </div>
</form>

@endsection
@section('script')
<script lang="javascript">
function onlyOne(checkbox) {
   var checkboxes = document.getElementsByName('group_id')
   checkboxes.forEach((item) => {
      if (item !== checkbox) item.checked = false
   })
}

function validate() {
   var group_id = '';
   var marks = $('#marks').val();
   //calculate concession if applied

   var chks = document.getElementsByName('group_id');
   chks.forEach((chk) => {
      if (chk.checked) group_id = chk.value;
   })

   if (group_id == '') { //no group selected
      Toast.fire({
         icon: 'warning',
         title: 'Please select a group!'
      });
      return false;
   } else {
      // event.preventDefault()
      if (marks >= 1050) {
         if (group_id < 4) $('#_concession').val(3100);
         if (group_id == 4) $('#_concession').val(3000);

      } else if (marks >= 1000) {
         if (group_id < 4) $('#_concession').val(1550);
         if (group_id == 4) $('#_concession').val(1500);
      }

      if (group_id <= 2 && marks < 660 || group_id <= 3 && marks < 600 || group_id == 4 && marks < 495) {
         return confirm('Marks are less then criteria. Add it anyway')

      }

   }

}
</script>
@endsection