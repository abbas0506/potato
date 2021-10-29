<div>
   <!-- <div class="flexrow row-center"><img src="/images/student_logo.jpg" style='height:150px; width:150px'></div> -->
   <div id='menu-container'>
      <!-- <div class="flexrow row-mid-left txt-m mb-2 mt-5"><a href="#"><i data-feather='grid' class="feather-small mx-4"></i>Dashboard </a></div> -->
      <div class="flexrow row-mid-left txt-m mb-2 mt-5"><a href="{{route('registration.index')}}"><i data-feather='users' class="feather-small mx-4"></i>Registration </a></div>
      <!-- <div class="flexrow row-mid-left txt-m mb-2"><a href="{{route('fee.index')}}"><i data-feather='dollar-sign' class="feather-small mx-4"></i>Fee Collection</a></div> -->
      <div class="flexrow row-mid-left txt-m mb-2"><a href="{{url('viewAutoEnroll')}}"><i data-feather='activity' class="feather-xsmall mx-4"></i>Auto Enroll</a></div>
      <div class="flexrow row-mid-left txt-m mb-2"><a href='#collapse_section' data-toggle='collapse'><i data-feather='pie-chart' class="feather-xsmall mx-4"></i>Sections <i data-feather='chevron-right' class="feather-xsmall mx-2"></i></a></div>
      <div class="collapse pl-4 my-2" id='collapse_section' data-parent='#menu-container'>
         <div class="flexrow row-mid-left txt-s"><a href="{{url('viewAssignSection')}}"><i data-feather='plus' class="feather-xsmall mx-4"></i>Assign</a></div>
         <div class="flexrow row-mid-left txt-s"><a href="{{url('viewDetachSection')}}"><i data-feather='x' class="feather-xsmall mx-4"></i>Detach</a></div>
      </div>
      <div class="flexrow row-mid-left txt-m mb-2"><a href=''><i data-feather='bar-chart' class="feather-small mx-4"></i>Statistics</a></div>
      <div class="flexrow row-mid-left txt-m mb-2"><a href="{{url('print')}}"><i data-feather='printer' class="feather-small mx-4"></i>Print</a></div>

   </div>

</div>