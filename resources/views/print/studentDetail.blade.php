<html>

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="{{public_path('css/pdf.css') }}" rel="stylesheet">
   <style>
   @page {
      margin: 75px 25px;
   }
   </style>

</head>

<body>

   @foreach($sections as $section)
   <div class="w-100 txt-center" style='font-size:3.5rem; margin-top:auto; line-height: 400px'>Section {{$section->name}}</div>
   <div class='w-100 txt-center' style='font-size:2.6rem'>Session 2021-23</div>
   <div class='w-100 txt-center ' style='font-size:1.5rem; margin-top:auto; line-height: 50px'>GHSS Chak Bedi, Pakpattan</div>
   <div class='w-100 txt-center' style='font-size:1.5rem; margin-top:auto; line-height: 100px;'>No. of Students : {{$section->count()}}</div>
   <div class="w-100 txt-center txt-m mt-10">Printed on: {{date('d-m-Y')}}</div>
   <div class="page-break"></div>

   <!-- student detail page -->
   @foreach($section->registrations()->get() as $registration)

   <div class="w-100 txt-s txt-right mr-5">No. <span class="txt-u ml-2">{{$registration->id}}</span></div>
   <div class="w-100 txt-center txt-xl">Admission Form</div>
   <div class='w-100 txt-center txt-s'>Part 1, Session 2021-23</div>
   <div class='w-100 txt-center txt-xs'>GHSS Chak Bedi, Pakpattan</div>


   <table class="w-100 mt-5 mx-5 border">
      <tbody class="px-4">
         <tr>
            <!-- holds serail no, section etc -->
            <td class="ml-2">
               <table>
                  <tr>
                     <td class="txt-s mr-4">Admission No.</td>
                     <td class="txt-s txt-b">{{$registration->admno}}</td>
                  </tr>
                  <tr>
                     <td class="txt-s">Group</td>
                     <td class="txt-s txt-b">{{$registration->group->name}}</td>
                  </tr>
                  <tr>
                     <td class="txt-s">Section</td>
                     <td class="txt-s txt-b">{{$section->name}}</td>
                  </tr>
                  <tr>
                     <td class="txt-s">Roll No.</td>
                     <td class="txt-s txt-b">{{$registration->classrollno}}</td>
                  </tr>
               </table>
            </td>
            <!-- holds pic -->
            <td class="txt-right">
               <!-- <img src="{{asset('images/45.jpg')}}" alt=""> -->

            </td>
         </tr>
      </tbody>
   </table>
   <table class="w-100 mt-5 mx-5">
      <tbody>
         <!-- row  -->
         <tr class="w-50">
            <td class='mt-4 txt-xs'>Name </td>
            <td class='mt-4 txt-xs'>Religion </td>
         </tr>
         <tr>
            <td>{{$registration->name}}</td>
            <td>Islam</td>
         </tr>
         <!-- row  -->
         <tr>
            <td class='mt-3 txt-xs'>Date of birth </td>
            <td class='mt-3 txt-xs'>B From </td>
         </tr>
         <tr>
            <td>{{$registration->dob->format('d-m-Y')}}</td>
            <td>{{$registration->bform}}</td>
         </tr>
         <!-- row  -->
         <tr>
            <td class='mt-3 txt-xs'>Phone </td>
            <td class='mt-3 txt-xs'>Address </td>
         </tr>
         <tr>
            <td>{{$registration->phone}}</td>
            <td>{{$registration->address}}</td>
         </tr>
         <!-- row  -->
         <tr>
            <td class='mt-3 txt-xs'>Blood Group </td>
            <td class='mt-3 txt-xs'>Speciality </td>
         </tr>
         <tr>
            <td>{{$registration->bloodgroup}}</td>
            <td>{{$registration->speciality}}</td>
         </tr>
         <!-- dotted line ---- family info -->
         <tr>
            <td class="mt-3 border-bottom-dotted thin" colspan="2">
            </td>
         </tr>
         <!-- row  -->
         <tr>
            <td class='mt-3 txt-xs'>Father </td>
            <td class='mt-3 txt-xs'>Father CNIC </td>
         </tr>
         <tr>
            <td>{{$registration->fname}}</td>
            <td>{{$registration->fcnic}}</td>
         </tr>
         <!-- row  -->
         <tr>
            <td class='mt-3 txt-xs'>Mother </td>
            <td class='mt-3 txt-xs'>Mother CNIC </td>
         </tr>
         <tr>
            <td>{{$registration->mname}}</td>
            <td>{{$registration->mcnic}}</td>
         </tr>
         <!-- dotted line ---- family info -->
         <tr>
            <td class="mt-3 border-bottom-dotted" colspan="2">
            </td>
         </tr>
         <!-- row  -->
         <tr>
            <td class='mt-3 txt-xs'>Guardian ({{$registration->grelation}})</td>
            <td class='mt-3 txt-xs'>Guardian CNIC </td>
         </tr>
         <tr>
            <td>{{$registration->gname}}</td>
            <td>{{$registration->gcnic}}</td>
         </tr>
         <!-- row  -->
         <tr>
            <td class='mt-3 txt-xs'>Profession </td>
            <td class='mt-3 txt-xs'>Income </td>
         </tr>
         <tr>
            <td>{{$registration->profession}}</td>
            <td>{{$registration->income}}</td>
         </tr>
         <!-- dotted line ---- academic info -->
         <tr>
            <td class="mt-3 border-bottom-dotted" colspan="2">
            </td>
         </tr>
         <!-- row  -->
         <tr>
            <td class='mt-3 txt-xs'>BISE </td>
            <td class='mt-3 txt-xs'>Pass Year </td>
         </tr>
         <tr>
            <td>{{$registration->bise->name}}</td>
            <td>{{$registration->passyear}}</td>
         </tr>
         <!-- row  -->
         <tr>
            <td class='mt-3 txt-xs'>Roll No. </td>
            <td class='mt-3 txt-xs'>Marks </td>
         </tr>
         <tr>
            <td>{{$registration->rollno}}</td>
            <td>{{$registration->marks}} ({{round($registration->marks/11,2)}} %)</td>
         </tr>

         <!-- student signature  -->
         <tr>
            <td class='mt-5 txt-s txt-u txt-right' colspan="2">Student Signature </td>
         </tr>

      </tbody>
   </table>
   <div class="page-break"></div>
   @endforeach
   @endforeach
</body>

</html>