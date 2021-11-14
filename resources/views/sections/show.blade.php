@extends('layout')
@section('menu')
<x-sidebar__menu></x-sidebar__menu>
@endsection
@php
$registrations=$section->registrations()->orderBy('classrollno')->get();
@endphp
@section('page')
<!-- page title -->
<div class="flexrow row-mid-left txt-m bg-teal px-5 py-2 txt-white auto-col">
   <div class="mr-5">
      <span class='text-light'>Section: {{$section->name}}</span>
      <span class='bage badge-pill badge-success ml-2 p-0 px-2 txt-s'>{{$registrations->count()}}</span>
   </div>
   <div class="mx-3 txt-s"><i data-feather='thermometer' class="feather-small mx-1"></i>{{$registrations->where('group_id',1)->count()}}</div>
   <div class="mx-3 txt-s"><i data-feather='tool' class="feather-small mx-1"></i>{{$registrations->where('group_id',2)->count()}}</div>
   <div class="mx-3 txt-s"><i data-feather='monitor' class="feather-small mx-1"></i>{{$registrations->where('group_id',3)->count()}}</div>
   <div class="mx-3 txt-s"><i data-feather='music' class="feather-small mx-1"></i>{{$registrations->where('group_id',4)->count()}}</div>
   <div class="ml-5"><i data-feather='clock' class="feather-small mx-1"></i><span class="txt-s">{{now()->format('d-m-Y')}}</span>
   </div>
</div>

<div class="flexrow border-bottom py-3 px-5 mb-2">
   <input type="text" class='input-rounded' placeholder="Search" oninput="search(event)"><i data-feather='search' class="feather-small" style="position:relative; right:24; top:4px"></i>
   <div class="flexcol border-0 circular-25 centered bg-orange"><a href="{{url('viewAssignSection',$section)}}" class="text-light"><i data-feather='user-plus' class="feather-xsmall mx-1" style="position:relative; margin-left:5px; top:-2px"></i></a></div>
   <div class="ml-2">Assign Student</div>
   <div class="flexcol border-0 circular-25 centered bg-success text-light ml-5" onclick="autoAssignRollNos('{{$section->id}}')"><i data-feather='refresh-ccw' class="feather-xsmall mx-1" style="position:relative; margin-left:5px;"></i></div>
   <div class="ml-2">Refresh Class Roll Nos</div>

   <div class="flexcol border-0 circular-25 centered bg-primary text-light ml-5">
      <a href="{{url('printSection',$section)}}" class="text-light" target="_blank"><i data-feather='printer' class="feather-xsmall mx-1" style="position:relative; margin-left:5px; top:-2px"></i></a>
   </div>
   <div class="ml-2">Print</div>
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
<!-- page content -->
<div class="flexrow pl-2 mx-5 mb-2 txt-b txt-grey">
   <div class="flexcol col-mid-left hw-10">Roll # </div>
   <div class="flexcol col-mid-left hw-40">Name </div>
   <div class="flexcol col-mid-left hw-15">Form </div>
   <div class="flexcol col-mid-left hw-15">Group </div>
   <div class="flexcol col-center hw-10">Marks </div>
   <div class="flexcol col-center hw-10"> <i data-feather='more-horizontal' class="feather-small mx-4"></i></div>
</div>

@foreach($registrations as $registration)
<div class="flexrow pl-2 mx-5 my-1 tr">
   <div class="flexcol col-mid-left hw-10">{{$registration->classrollno}} </div>
   <div class="flexcol col-mid-left hw-40"> <a href="{{route('registration.show',$registration)}}">{{$registration->name}}</a> </div>
   <div class="flexcol col-mid-left hw-15">{{$registration->id}} </div>
   <div class="flexcol col-mid-left hw-15">{{$registration->group->name}} </div>
   <div class="flexcol col-center hw-10">{{$registration->marks}} </div>
   <div class="flexcol col-center hw-10">
      <div class="flexrow justify-content-between">
         <div><button class="bg-transparent p-0 border-0" onclick="detachMe('{{$registration->id}}')"><i data-feather='x' class="feather-xsmall mx-1 txt-red"></i></button></div>
         <div><i data-feather='arrow-right' class="feather-xsmall mx-1 txt-green" onclick="showMoveSectionModal('{{$registration->id}}')"></i></div>
      </div>

   </div>
</div>

@endforeach
@endsection

@section('modal')
<!----------------------------------------------------------------------------
									section move modal
	------------------------------------------------------------------------------>

<div class="modal fade" id="moveSectionModal" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
            <h4 class="modal-title">Move to</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>

         <!-- modal body -->
         <div class="modal-body">
            <div class="container">
               <form action="{{url('postMoveSection')}}" method="POST">
                  @csrf
                  @method('POST')
                  <input type="text" id='_id' name='_id' hidden>
                  <div class="fancyselect auto-expand mb-2">
                     <select id="section_id" name='section_id'>
                        @foreach($sections as $section)
                        <option value="{{$section->id}}">{{$section->name}}</option>
                        @endforeach
                     </select>
                     <label for="">Section</label>
                  </div>
                  <div class="text-right mb-2">
                     <button type='submit' class="btn btn-success">Move</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

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
            $(this).children().eq(3).prop('outerText').toLowerCase().includes(searchtext)
         )) {
         $(this).addClass('hide');
      } else {
         $(this).removeClass('hide');
      }


   });
}

function detachMe(id) {
   var token = $("meta[name='csrf-token']").attr("content");
   //show sweet alert and confirm submission
   Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, detach '
   }).then((result) => { //if confirmed    
      if (result.value) {
         $.ajax({
            type: 'POST',
            url: "{{route('postDetachSection')}}",
            data: {
               "id": id,
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

function showMoveSectionModal(id) {
   $('#_id').val(id);
   $('#moveSectionModal').modal();
}

function postMoveSection() {
   var token = $("meta[name='csrf-token']").attr("content");
   var id = $('#_id').val();
   var section_id = $('#section_id').val();

   $.ajax({
      type: 'POST',
      url: "{{route('postMoveSection')}}",
      data: {
         "id": id,
         "section_id": section_id,
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

function autoAssignRollNos(id) {
   var token = $("meta[name='csrf-token']").attr("content");
   //show sweet alert and confirm submission
   Swal.fire({
      title: 'Refresh class roll nos.?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, refresh '
   }).then((result) => { //if confirmed    
      if (result.value) {
         $.ajax({
            type: 'POST',
            url: "{{route('autoAssignRollNos')}}",
            data: {
               "section_id": id,
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
</script>
@endsection