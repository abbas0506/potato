@extends('layout')
@section('menu')
<x-sidebar__menu></x-sidebar__menu>
@endsection
@section('page')
<!-- page title -->
<div class="flexrow row-mid-left justify-content-between txt-m bg-light-grey px-10 py-2 auto-col">Preview & Print</div>
<!-- page content -->
<form action="{{url('preview')}}" method='post' target="_blank">
   @csrf
   <div class="flexrow mb-4 px-10 my-5">
      <div class="fancyselect w-100">
         <select name='printOption' onchange="showOrHideDates()">
            <option value='0'>Registration</option>
            <option value='1'>Fee collection</option>
            <option disabled>-------------------------</option>
            <option value='2'>Documents scrutiny</option>
            <option value='3'>Auto enrollment</option>
            <option value='4'>Section wise enrollment</option>
            <option value='5'>Student Detail</option>
            <option value='6'>Session summary</option>
         </select>
         <label for="Name">What to print?</label>
      </div>
   </div>
   <div class="flexrow mx-10 p-5 border justify-content-between" style='position:relative' id='datesection'>
      <div class="fancyinput hw-48">
         <input type="text" name='datefrom' id='datefrom' placeholder="Date from" value="{{date('d-m-Y')}}" pattern='[0-9]{2}-[0-9]{2}-[0-9]{4}' oninput="formatAsDate(event)">
         <label for="Name">From: dd-mm-yyyy</label>
      </div>
      <div class="fancyinput hw-48">
         <input type="text" name='dateto' id='dateto' placeholder="Date to" value="{{date('d-m-Y')}}" pattern='[0-9]{2}-[0-9]{2}-[0-9]{4}' oninput=" formatAsDate(event)">
         <label for="Name">To: dd-mm-yyyy</label>
      </div>
      <span style="position:absolute; right:5px; top:10px"><i data-feather='search' class="feather-small"></i></span>
      <span style="position:absolute; left:5px; top:-20px; background:white; padding:5px; color:darkslategrey">Select date range</span>
   </div>
   <div class="flexrow px-10 mt-5 row-bottom-right">
      <button type="submit" class="btn btn-success">Preview</button>
   </div>
</form>
@endsection

@section('script')
<script>
function showOrHideDates() {

   var selectedOption = $("[name='printOption']").val();
   if (selectedOption <= 1) {
      var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
      var yyyy = today.getFullYear();

      var date = dd + "-" + mm + "-" + yyyy;

      $('#datefrom').val(date);
      $('#dateto').val(date);
      $('#datesection').removeClass('hide');
   } else {
      $('#datesection').addClass('hide');
      $('#datefrom').val('');
      $('#dateto').val('');
   }

}
</script>
@endsection