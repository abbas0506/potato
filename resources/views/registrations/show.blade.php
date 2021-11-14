@extends('layout')
@section('menu')
<x-sidebar__menu></x-sidebar__menu>
@endsection
@section('page')
<!-- page title -->
<div class="flexrow row-mid-left txt-green txt-b txt-m bg-teal px-10 py-2">Student Profile - Form No. {{$registration->id}}</div>
<!-- select an option -->
<div class="flexrow justify-content-between auto-col px-10 mt-5 mb-5">
   <div class="flexcol col-mid-left">
      <div class="txt-xs">Group</div>
      <div class="txt-m">{{$registration->group->name}}</div>
   </div>
   <div class="flexcol col-mid-left hw-48">
      @if($registration->image)
      <img src="/images/{{$registration->image}}" alt="" class="box-150">
      @else
      <img src="/images/default_user.png" alt="" class="box-150">
      @endif
   </div>
</div>
<!-- data fields -->
<div class="flexrow justify-content-between px-10 mb-4 auto-col ">
   <div class="flexcol hw-48">
      <div class="txt-xs">Name</div>
      <div class="txt-m">{{$registration->name}}</div>
   </div>
   <div class="flexcol hw-48">
      <div class="txt-xs">Phone</div>
      <div class="txt-m">{{$registration->phone}}</div>
   </div>
</div>
<div class="flexrow justify-content-between px-10 mb-4 auto-col ">
   <div class="flexcol hw-48">
      <div class="txt-xs">Date of birth</div>
      <div class="txt-m">{{date_format($registration->dob,'d-m-Y')}}</div>
   </div>
   <div class="flexcol hw-48">
      <div class="txt-xs">Bay Form</div>
      <div class="txt-m">{{$registration->bform}}</div>
   </div>
</div>

<div class="flexrow justify-content-between px-10 mb-4 auto-col ">
   <div class="flexcol hw-48">
      <div class="txt-xs">BISE</div>
      <div class="txt-m">{{$registration->bise->name}}</div>
   </div>
   <div class="flexcol hw-48">
      <div class="txt-xs">Passing Year</div>
      <div class="txt-m">{{$registration->passyear}}</div>
   </div>
</div>
<div class="flexrow justify-content-between px-10 mb-4 auto-col ">
   <div class="flexcol hw-48">
      <div class="txt-xs">Roll No</div>
      <div class="txt-m">{{$registration->rollno}}</div>
   </div>
   <div class="flexcol hw-48">
      <div class="txt-xs">Marks (matric)</div>
      <div class="txt-m">{{$registration->marks}} /1100, ({{round($registration->marks/11,1)}} %) </div>
   </div>
</div>
<div class="flexrow justify-content-between px-10 mb-4 auto-col ">
   <div class="flexcol hw-48">
      <div class="txt-xs">Blood Group</div>
      <div class="txt-m">{{$registration->blood}}</div>
   </div>
   <div class="flexcol hw-48">
      <div class="txt-xs">Speciality</div>
      <div class="txt-m">{{$registration->speciality}}</div>
   </div>
</div>
<div class="flexrow justify-content-between px-10 mb-4 auto-col ">
   <div class="flexcol hw-100">
      <div class="txt-xs">Address</div>
      <div class="txt-m">{{$registration->address}}</div>
   </div>

</div>
<div class="flexrow justify-content-between px-10 mb-4 auto-col ">
   <div class="flexcol hw-48">
      <div class="txt-xs">Home Distance</div>
      <div class="txt-m">{{$registration->distance}}</div>
   </div>
   <div class="flexcol hw-48">
      <div class="txt-xs">Previous School</div>
      <div class="txt-m">@if($registration->preschool){{$registration->preschool->name}}@endif</div>
   </div>
</div>

<!-- separator line -->
<div class="border border-bottom border-info my-4 mx-10"></div>
<!-- family info -->
<div class="flexrow justify-content-between px-10 mb-4 auto-col ">
   <div class="flexcol hw-48">
      <div class="txt-xs">Father</div>
      <div class="txt-m">{{$registration->fname}}</div>
   </div>
   <div class="flexcol hw-48">
      <div class="txt-xs">Father CNIC</div>
      <div class="txt-m">{{$registration->fcnic}}</div>
   </div>
</div>
<div class="flexrow justify-content-between px-10 mb-4 auto-col ">
   <div class="flexcol hw-48">
      <div class="txt-xs">Mother</div>
      <div class="txt-m">{{$registration->mname}}</div>
   </div>
   <div class="flexcol hw-48">
      <div class="txt-xs">Mother CNIC</div>
      <div class="txt-m">{{$registration->mcnic}}</div>
   </div>
</div>

<!-- guardina info -->
<div class="flexrow justify-content-between px-10 mb-4 auto-col ">
   <div class="flexcol hw-48">
      <div class="txt-xs">Who is guardian? (relation)</div>
      <div class="txt-m">{{$registration->grelation}}</div>
   </div>
</div>
<div class="flexrow justify-content-between px-10 mb-4 auto-col ">
   <div class="flexcol hw-48">
      <div class="txt-xs">Guardian</div>
      <div class="txt-m">{{$registration->gname}}</div>
   </div>
   <div class="flexcol hw-48">
      <div class="txt-xs">Guardian CNIC</div>
      <div class="txt-m">{{$registration->gcnic}}</div>
   </div>
</div>
<div class="flexrow justify-content-between px-10 mb-4 auto-col ">
   <div class="flexcol hw-48">
      <div class="txt-xs">Profession</div>
      <div class="txt-m">{{$registration->profession}}</div>
   </div>
   <div class="flexcol hw-48">
      <div class="txt-xs">Monthly income</div>
      <div class="txt-m">{{$registration->income}}</div>
   </div>
</div>
@endsection