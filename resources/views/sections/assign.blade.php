@extends('layout')
@section('menu')
<x-sidebar__menu></x-sidebar__menu>
@endsection
@section('page')
<!-- page title -->
<div class="flexrow row-mid-left justify-content-between txt-m bg-light-grey px-10 py-2 auto-col">
   <div>Students' Pool <span class='bage badge-pill badge-success ml-2 p-0 px-2 txt-s'>{{$registrations->count()}}</span></div>
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
<div class="flexrow hw-100 justify-content-between row-mid-left px-10 my-4 auto-col">
   <div class="auto-expand hw-60 txt-xs text-justify">
      <i data-feather='help-circle' class="feather-small" style="position:relative; top:-2px"></i>
      Students' pool contains those student who are still waiting for any section. Check single/multiple students from pool and click on assign section button
   </div>
   <div class="fancyselect auto-expand hw-15">
      <select name="" id="section_id">
         @foreach($sections as $section)
         <option value="{{$section->id}}">{{$section->name}}</option>
         @endforeach
      </select>
      <label for="">Section</label>
   </div>
   <div style="position:relative" class="hw-20 auto-expand">
      <button type='button' class="btn btn-success hw-100" onclick="assignSection()">Assign Section</button>
      <div class="flexrow row-center txt-s border rounded-circle box-20 txt-green" id='chkCount' style="position: absolute; right:-10px; top:8px; background-color:orange">0</div>
   </div>

</div>

<div class="flexrow mx-10 px-2 mb-2 txt-b bg-info ">
   <div class="flexcol col-mid-left hw-10">Roll # </div>
   <div class="flexcol col-mid-left hw-60">Name </div>
   <div class="flexcol col-mid-left hw-20">Group </div>
   <div class="flexcol col-mid-right hw-10"> <input type="checkbox" id='chkAll' onclick="chkAll()"></div>
</div>

@foreach($registrations as $registration)
<div class="flexrow mx-10 px-2 my-1 tr">
   <div class="flexcol col-mid-left hw-10">{{$registration->classrollno}} </div>
   <div class="flexcol col-mid-left hw-60"> {{$registration->name}} </div>
   <div class="flexcol col-mid-left hw-20">{{$registration->group->name}} </div>
   <div class="flexcol col-mid-right hw-10"> <input type="checkbox" name='chk' value='{{$registration->id}}' onclick="updateChkCount()"></div>
</div>

@endforeach

@endsection
@section('script')
<script lang="javascript">
function assignSection() {

   var token = $("meta[name='csrf-token']").attr("content");

   var section_id = $('#section_id').val();
   var ids_array = [];
   var chks = document.getElementsByName('chk');
   chks.forEach((chk) => {
      if (chk.checked) ids_array.push(chk.value);
   })

   if (ids_array.length == 0) {
      Toast.fire({
         icon: 'warning',
         title: "Nothing to save",
      });
   } else {
      //show sweet alert and confirm submission
      Swal.fire({
         title: 'Are you sure?',
         text: "You won't be able to revert this!",
         type: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, assign section '
      }).then((result) => { //if confirmed    
         if (result.value) {
            $.ajax({
               type: 'POST',
               url: "postAssignSection",
               data: {
                  "section_id": section_id,
                  "ids_array": ids_array,
                  "_token": token,

               },
               success: function(response) {
                  //
                  Toast.fire({
                     icon: 'success',
                     title: response.msg,
                  });
                  //refresh content after deletion
                  location.reload();
               },
               error: function(XMLHttpRequest, textStatus, errorThrown) {
                  Toast.fire({
                     icon: 'warning',
                     title: errorThrown
                  });
               }
            }); //ajax end
         }
      })

   }

}

function updateChkCount() {
   var chkArray = [];
   var chks = document.getElementsByName('chk');
   chks.forEach((chk) => {
      if (chk.checked) chkArray.push(chk.value);
   })

   document.getElementById("chkCount").innerHTML = chkArray.length;
}

function chkAll() {
   $('.tr').each(function() {
      if (!$(this).hasClass('hide'))
         $(this).children().find('input[type=checkbox]').prop('checked', $('#chkAll').is(':checked'));
      updateChkCount()
   });
}

function search(event) {
   var searchtext = event.target.value.toLowerCase();
   var str = 0;
   $('.tr').each(function() {
      if (!(
            $(this).children().eq(0).prop('outerText').toLowerCase().includes(searchtext) ||
            $(this).children().eq(1).prop('outerText').toLowerCase().includes(searchtext) ||
            $(this).children().eq(2).prop('outerText').toLowerCase().includes(searchtext)
         )) {
         $(this).addClass('hide');
      } else {
         $(this).removeClass('hide');
      }


   });
}
</script>
@endsection