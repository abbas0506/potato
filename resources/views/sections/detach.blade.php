@extends('layout')
@section('menu')
<x-sidebar__menu></x-sidebar__menu>
@endsection
@section('page')
<!-- page title -->
<div class="flexrow row-mid-left justify-content-between txt-m bg-light-grey px-10 py-2 auto-col">
   <div>Sections Enrollment <span class='bage badge-pill badge-success ml-2 p-0 px-2 txt-s'>{{$registrations->count()}}</span></div>
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
   <div class="auto-expand txt-xs text-justify">
      <i data-feather='help-circle' class="feather-small" style="position:relative; top:-2px"></i>
      You can detach or move only one student at a time. Click on <i data-feather='x' class="feather-xsmall mx-1 txt-red"></i> to detach & <i data-feather='arrow-right' class="feather-xsmall mx-1 txt-green"></i> to move student to another section
   </div>
</div>

<div class="flexrow mx-10 px-2 mb-2 txt-b bg-info">
   <div class="flexcol col-mid-left hw-10">Roll # </div>
   <div class="flexcol col-mid-left hw-40">Name </div>
   <div class="flexcol col-mid-left hw-20">Group </div>
   <div class="flexcol col-mid-left hw-20">Section </div>
   <div class="flexcol col-center hw-10">...</div>
</div>

@foreach($registrations as $registration)
<div class="flexrow mx-10 px-2 my-1 tr">
   <div class="flexcol col-mid-left hw-10">{{$registration->classrollno}} </div>
   <div class="flexcol col-mid-left hw-40"> {{$registration->name}} </div>
   <div class="flexcol col-mid-left hw-20">{{$registration->group->name}} </div>
   <div class="flexcol col-mid-left hw-20">{{$registration->section->name}} </div>
   <div class="flexcol col-mid-right hw-10">
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
            url: "postDetachSection",
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
      url: "postMoveSection",
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