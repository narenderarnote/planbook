@extends('layouts.teacher')

@section('content')
  <div id="main-loader" class="pageLoader" style="display:none">
    <div class="loader-content"> <span class="loading-text">Loading</span> <img src="/images/loading.gif"> </div>
  </div>
  <div class="events-section">
  <div class="copy-header"> Select class, then drag and drop students to add or remove from class</div>
  <div class="list-contentbutton gradebutons">
    <div class="btn-group">
      <button type="button" id ="classBtn" data-id='' class="btn languagebuton list-contentmainbuton  dropdown-toggle classBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Select Class<span class="caret"></span> </button>
      <ul class="dropdown-menu language-dropdown">
      @forelse($classes as $class)
        <li class="classSelected"><a href="#" class="language-dropbutons languagebuton" style="background-color:{{ $class->class_color }}; color: #fff;" data-id = "{{$class->id}}">{{$class->class_name}}</a></li>
      @empty
      @endforelse  
      </ul>
    </div>
    <div class="btn-group">
      <button type="button" class="btn unitsbutton list-contentmainbuton"  data-toggle="modal" data-target="#assignstudents"> Assign all students to class</button>
    </div>
    <div class="btn-group">
      <button type="button" class="btn unitsbutton list-contentmainbuton" data-toggle="modal" data-target="#removestudents">Remove all students from class</button>
    </div>
  </div>
  <div class="student-added"><span class="tstudent student-addedbutton">T</span> Students added by Teacher<br>
    <span class="sstudent student-addedbutton">S</span> Students assigned by School </div>
  <div class="list-contentbutton gradebutons pull-right">
    <div class="btn-group studentlevel-button">
      <button type="button" class="btn unitsbutton list-contentmainbuton dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> All Levels<span class="caret"></span> </button>
      <ul class="dropdown-menu language-dropdown">
        <li class=""><a href="#" class="language-dropbutons unitdropbuton">All levels </a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Pre-K </a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Kindergarten </a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Grade 1</a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Grade 2 </a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Grade 3</a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Grade 4</a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Grade 5</a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Grade 6</a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Grade 7 </a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Grade 8</a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Grade 9</a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Grade 10</a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Grade 11</a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Grade 12</a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Inactive</a></li>
      </ul>
    </div>
  </div>
  <div class="assign-studentlistssection">
    <div class="col-md-6">
      <div class="studentsin-class">
        <div class="studentsclass-header">Students in Class</div>
        <div class="studentsclass-body" id="studentsinClass"></div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="studentsin-class">
        <div class="studentsclass-header">Students not in Class</div>
        <div class="studentsclass-body" id="notstudentsinClass"></div>
      </div>
    </div>
  </div>
</div>
<!--assign students popup start-->
<div id="assignstudents" class="modal fade movemodalcontent assignstudentscontent" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Assign all students to class</h4>
      </div>
      <div class="modal-body">
        <p>This will assign all of your students to your Language Arts class. Would you like to continue?</p>
        <div class="button-group">
          <a href="javascript:;" data-id='' class="renew-button" id="assignAll"> Continue</a>
          <button class="close-button" data-dismiss="modal"> Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!--remove students popup start-->
<div id="removestudents" class="modal fade movemodalcontent assignstudentscontent" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Remove all students from class</h4>
      </div>
      <div class="modal-body">
        <p>This will remove all of your students from your Language Arts class. Would you like to continue?</p>
        <div class="button-group">
          <button class="renew-button"  data-dismiss="modal"> Continue</button>
          <button class="close-button" data-dismiss="modal"> Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
  
@push('js')
  <script>
      $("document").ready(function() {
        $('.classSelected:first-child a').trigger('click');
      });
     $('.classSelected a').on('click',function(){
        var classVar = $(this).text();
        var classId  = $(this).data('id'); 
        var background = $(this).css('background-color');
        $('#assignAll').attr('data-id',classId);
        $('.classBtn').html(classVar +' <span class="caret"></span>');
        $('.classBtn').attr('data-id',classId);
        $('.classBtn').css({'background-color':background,'border-color':background, 'color':'#fff'});
         $.ajax({
            type:'get',
            url: BASE_URL +'/teacher/assignstudents/getStudents/'+classId,
            dataType: 'json',

            beforeSend: function () {
              //obj.html('Sending... <i class="fa fa-send"></i>');
            },
            complete: function () {
              //obj.html('Sent <i class="fa fa-send"></i>');
            },

            success: function (response) {
              $("#studentsinClass").html("");
              $("#notstudentsinClass").html("");
              var students = response.inclass;
              for(var i in students){
                $('#studentsinClass').append('<span class="student-results"><span class="tStudent">T</span>'+students[i]['name']+','+students[i]['last_name']+'</span>'); 
               console.log(students[i]);
              }
              var studentsN = response.notInClass;
              for(var i in studentsN){
                $('#notstudentsinClass').append('<span class="student-results"><span class="tStudent">T</span>'+studentsN[i]['name']+','+studentsN[i]['last_name']+'</span>'); 
               
              }
              draganddrop();
            },
            error: function(data){
              console.log("data");
              //console.log(data);
            }

         });
      });

     $('#assignAll').on('click',function(e){
        var classID = $(this).attr('data-id');
        $.ajax({
            type:'post',
            url: BASE_URL +'/teacher/assignstudents/assignAllStudents/'+classID,
            dataType: 'json',
            data: {
              "_token": "{{ csrf_token() }}",
              },  

            beforeSend: function () {
               $('#assignstudents').modal('hide');
            },
            complete: function () {
              //obj.html('Sent <i class="fa fa-send"></i>');
            },

            success: function (response) {
              // console.log(response);
             
              $("#studentsinClass").html("");
              $("#notstudentsinClass").html("");
              var students = response.inclass;
              for(var i in students){
                $('#studentsinClass').append('<span class="student-results"><span class="tStudent">T</span>'+students[i]['name']+','+students[i]['last_name']+'</span>'); 
               
              }
              draganddrop();
            },
            error: function(data){
              console.log(data);
            }

         });
        e.preventDefault();
      });
  </script> 
  <!--Drag and Drop assign classes-->
  <script>
  function draganddrop(){
    $( ".student-results", '#studentsinClass' ).draggable({
          cancel: "a.ui-icon", // clicking an icon won't initiate dragging
          revert: "invalid", // when not dropped, the item will revert back to its initial position
          //containment: "document",
          helper: "clone",
          cursor: "move"      
      });
      //http://jsfiddle.net/GRDww/40/
      // let the transfer be droppable, accepting the gallery items
      $('#notstudentsinClass').droppable({
          //accept: "#studentsinClass > .student-results",
          activeClass: "ui-state-highlight",
          drop: function( event, ui ) {
              deleteImage( ui.draggable );
          }
    });
  }   
  </script>
  <!--Drag and Drop assign classes-->
@endpush  