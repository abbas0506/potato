@extends('layout')
@section('menu')
<x-sidebar__menu></x-sidebar__menu>
@endsection
@section('page')
<!-- page title -->
<div class="flexrow row-mid-left txt-m txt-green txt-b bg-light-grey px-10 py-2">Edit Profile - Form No {{$registration->id}}</div>
<!-- show group options -->

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

<div class="flexrow auto-col justify-content-between px-10 mt-5 mb-5">
   <div class="flexcol col-mid-left hw-48">
      @foreach($groups as $group)
      <div class="flexcol">
         <div class="flexrow row-mid-left">
            <div class="txt-m mr-4"><input type="checkbox" name='_groupid' value='{{$group->id}}' onclick="checkOnlyOneGroup(this)" @if($group->id==$registration->group_id) checked @endif></div>
            <div class="txt-m">{{$group->name}}</div>
         </div>
      </div>
      @endforeach
   </div>
   <div class="flexcol col-center hw-48">
      @if($registration->image)
      <img src="/images/{{$registration->image}}" alt="" class="box-150">
      @else
      <img src="/images/default_user.png" alt="" class="box-150">
      @endif
      <form action="{{route('uploadimage',$registration)}}" id='frm_uploadimage' method="POST" enctype="multipart/form-data">
         @csrf
         @method('PUT')
         <div class="flexcol mt-2">
            <input type="file" name="image" class="mb-1">
            <button type="submit" class="btn btn-success hw-100">Upload</button>
         </div>
      </form>
   </div>
</div>


<form action="{{route('registration.update',$registration)}}" method='post'>
   @csrf
   @method('PUT')
   <!-- data fields -->
   <input type="text" name='group_id' value='{{$registration->group_id}}' hidden>
   <div class="flexrow justify-content-between px-10 mb-4 auto-col ">
      <div class="flexcol col-center hw-48">
         <div class="fancyinput w-100">
            <input type="text" name='name' placeholder="Student name" value='{{$registration->name}}' required>
            <label for="Name">Name</label>
         </div>
      </div>
      <div class="flexcol col-center hw-48">
         <div class="fancyinput w-100">
            <input type="text" name='phone' placeholder="Personal phone" value="{{$registration->phone}}" pattern='0[0-9]{3}-[0-9]{7}' oninput="formatAsPhone(event)" required>
            <label for="Name">Phone</label>
         </div>
      </div>
   </div>
   <div class="flexrow justify-content-between px-10 mb-4 auto-col ">
      <div class="flexcol col-center hw-48">
         <div class="fancyinput w-100">
            <input type="text" name='dob' placeholder="Date of Birth" value="{{date_format($registration->dob,'d-m-Y')}}" pattern='[0-9]{2}-[0-9]{2}-[0-9]{4}' oninput="formatAsDate(event)" required>
            <label for="Name">Date of Birth (dd-mm-yyyy)</label>
         </div>
      </div>
      <div class="flexcol col-center hw-48">
         <div class="fancyinput w-100">
            <input type="text" name='bform' placeholder="B Form" value="{{$registration->bform}}" pattern='[0-9]{5}-[0-9]{7}-[0-9]' oninput='formatAsCnic(event)' required>
            <label for="Name">B Form</label>
         </div>
      </div>

   </div>
   <div class="flexrow justify-content-between mb-4 px-10 auto-col">
      <div class="flexcol col-center hw-48">
         <div class="fancyselect w-100">
            <select name='bise_id'>
               @foreach($bises as $bise)
               <option value='{{$bise->id}}' @if($bise->id==$registration->bise_id) selected @endif>{{$bise->name}}</option>
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
               <option value='{{$yr}}' @if($yr==$registration->passyear) selected @endif>{{$yr}}</option>
               @endfor
            </select>
            <label for="Name">Passing Year</label>
         </div>
      </div>
   </div>
   <div class="flexrow justify-content-between mb-4 px-10 auto-col">
      <div class="flexcol hw-48">
         <div class="fancyinput w-100">
            <input type="text" name='rollno' placeholder="Roll No" value="{{$registration->rollno}}" pattern='[0-9]{1,8}' required>
            <label for="Name">Roll No</label>
         </div>
      </div>
      <div class="flexcol hw-48">
         <div class="fancyinput w-100">
            <input type="number" name='marks' placeholder="Marks" value="{{$registration->marks}}" min='1' max='1100' required>
            <label for="Name">Marks</label>
         </div>
      </div>
   </div>

   <div class="flexrow justify-content-between px-10 mb-4 auto-col ">
      <div class="flexcol col-center hw-48">
         <div class="fancyselect w-100">
            <select name='bloodgroup'>
               @php
               $bloodgroups=array('-','A+','B+','O+','O-','A-','B-','AB+','AB-');
               @endphp

               @foreach($bloodgroups as $bloodgroup)
               <option value="{{$bloodgroup}}" @if($bloodgroup==$registration->bloodgroup) selected @endif>{{$bloodgroup}}</option>
               @endforeach
            </select>
            <label for="Name">Blood</label>
         </div>
      </div>
      <div class="flexcol col-center hw-48">
         <div class="fancyselect w-100">
            <select name='speciality'>
               @php
               $specialties=array('-','Hafiz e Quran','Qari e Quran','Naat Khwan', 'Speaker','Debator','Writer', 'Calligrapher', 'Sportsman', 'Singer','Actor');
               @endphp

               @foreach($specialties as $specialty)
               <option value='{{$specialty}}' @if($specialty==$registration->speciality) selected @endif>{{$specialty}}</option>
               @endforeach
            </select>
            <label for="Name">Speicality</label>
         </div>
      </div>
   </div>
   <div class="flexrow justify-content-between px-10 mb-4 auto-col ">
      <div class="flexcol col-center hw-100">
         <div class="fancyinput w-100">
            <input type="text" name='address' placeholder="Address" value="{{$registration->address}}">
            <label for="Name">Address</label>
         </div>
      </div>
   </div>
   <div class="flexrow justify-content-between px-10 mb-4 auto-col ">
      <div class="flexcol col-center hw-48">
         <div class="fancyselect w-100">
            <select name='distance'>

               @for($i=1; $i<=30; $i++) <option value="{{$i}}" @if($i==$registration->distance) selected @endif>{{$i}}</option>
                  @endfor
            </select>
            <label for="Name">Home Distance (km)</label>
         </div>
      </div>
      <div class="flexcol col-center hw-48">
         <div class="fancyselect w-100">
            <select name='preschool_id'>
               @foreach($preschools as $preschool)
               <option value='{{$preschool->id}}' @if($preschool->id==$registration->preschool_id) selected @endif>{{$preschool->name}}</option>
               @endforeach
               <option>Not in list, add new</option>
            </select>
            <label for="Name">Previous School</label>
         </div>
      </div>
   </div>


   <!-- separator line -->
   <div class="border border-bottom border-info my-4 mx-10"></div>
   <!-- family info -->
   <div class="flexrow justify-content-between px-10 mb-4 mt-4 auto-col ">
      <div class="flexcol col-center hw-48">
         <div class="fancyinput w-100">
            <input type="text" name='fname' placeholder="Father name" value="{{$registration->fname}}">
            <label for="Name">Father</label>
         </div>
      </div>
      <div class="flexcol col-center hw-48">
         <div class="fancyinput w-100">
            <input type="text" name='fcnic' placeholder="Father CNIC" value="{{$registration->fcnic}}" pattern='[0-9]{5}-[0-9]{7}-[0-9]' oninput='formatAsCnic(event)'>
            <label for="Name">Father CNIC</label>
         </div>
      </div>
   </div>
   <div class="flexrow justify-content-between px-10 mb-4 auto-col ">
      <div class="flexcol col-center hw-48">
         <div class="fancyinput w-100">
            <input type="text" name='mname' placeholder="Mother name" value="{{$registration->mname}}">
            <label for="Name">Mother</label>
         </div>
      </div>
      <div class="flexcol col-center hw-48">
         <div class="fancyinput w-100">
            <input type="text" name='mcnic' placeholder="Mother CNIC" value="{{$registration->mcnic}}" pattern='[0-9]{5}-[0-9]{7}-[0-9]' oninput='formatAsCnic(event)'>
            <label for="Name">Mother CNIC</label>
         </div>
      </div>
   </div>

   <!-- select guardian option -->
   <div class="flexrow justify-content-between auto-col px-10 mb-4">
      <div class="flexcol col-mid-left txt-m text-info">Who is guardian?</div>
      @php
      $grelations=array('Father','Mother','Any other');
      @endphp

      @foreach($grelations as $grelation)
      <div class="flexcol col-mid-left">
         <div class="flexrow">

            <div class="txt-m mr-4">
               @if(!$registration->grelation && $grelation=='Father')
               <input type="checkbox" name='grelation' value='{{$grelation}}' onclick="checkOnlyOneGrelation(this)" checked>
               @else
               <input type="checkbox" name='grelation' value='{{$grelation}}' onclick="checkOnlyOneGrelation(this)" @if($grelation==$registration->grelation) checked @endif>
               @endif

            </div>
            <div class="txt-m">{{$grelation}}</div>
         </div>
      </div>
      @endforeach
   </div>
   <div class="flexrow justify-content-between px-10 mb-4 auto-col @if($registration->grelation!='Any other') hide @endif" id='grelationRow'>
      <div class="flexcol col-center hw-48">
         <div class="fancyinput w-100">
            <input type="text" name='gname' placeholder="Guardian name" value="{{$registration->gname}}">
            <label for="Name">Guardian</label>
         </div>
      </div>
      <div class="flexcol col-center hw-48">
         <div class="fancyinput w-100">
            <input type="text" name='gcnic' placeholder="Guardian CNIC" value="{{$registration->gcnic}}" pattern='[0-9]{5}-[0-9]{7}-[0-9]' oninput='formatAsCnic(event)'>
            <label for="Name">Guardian CNIC</label>
         </div>
      </div>
   </div>
   <div class="flexrow justify-content-between px-10 mb-4 auto-col ">
      <div class="flexcol col-center hw-48">
         <div class="fancyselect w-100">
            @php
            $professions=array('-','Teaching','Medicine','Agriculture','Business','Public Services','Private Services');
            @endphp
            <select name='profession'>
               @foreach($professions as $profession)
               <option value="{{$profession}}" @if($profession==$registration->profession) selected @endif>{{$profession}}</option>
               @endforeach
            </select>
            <label for="Name">Profession</label>
         </div>
      </div>
      <div class="flexcol col-center hw-48">
         <div class="fancyinput w-100">
            <input type="text" name='income' placeholder="Monthly income" value="{{$registration->income}}">
            <label for="Name">Income</label>
         </div>
      </div>
   </div>

   <div class="text-right px-10 mt-2">
      <button type="submit" class="btn btn-success">Update</button>
   </div>
</form>
@endsection
@section('script')
<script lang="javascript">
function checkOnlyOneGroup(checkbox) {
   var checkboxes = document.getElementsByName('_groupid')
   checkboxes.forEach((item) => {
      if (item !== checkbox) item.checked = false
   })
   checkbox.checked = true;
   $("[name='group_id'").val(checkbox.value);
}

function checkOnlyOneGrelation(checkbox) {
   var checkboxes = document.getElementsByName('grelation')
   checkboxes.forEach((item) => {
      if (item !== checkbox) {
         item.checked = false
      }
   })
   checkbox.checked = true;
   if (checkbox.value == 'Any other')
      $('#grelationRow').removeClass('hide');
   else
      $('#grelationRow').addClass('hide');
}

function upload() {
   $('#form_uploadimage').submit();
}
</script>
@endsection