@extends('layouts.student')

@section('content')
@php $url = request()->view ; @endphp
<div id="dynamicCalendarContent" >

</div>
<div id="main-loader" class="pageLoader" >
  <div class="loader-content"> <span class="loading-text">Loading</span> <img src="../../images/loading.gif"> </div>
</div>
@if($announcement)
<div id="studentannouncementsmodal" data-val="{{ $announcement != '' ? '1' : '0'}}"  class="modal fade in movemodalcontent samoplelayout-content" role="dialog" style="display: none;">
	<div class="modal-dialog">
   <div class="modal-content">
      <div class="modal-header">
         <h4 class="modal-title">Student Announcements</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="#" > 
            {{csrf_field()}}
      	   <div class="form-group">
      		   <textarea placeholder="Write Somehting" name="detailed_txt" class="main editorMce">
               @if($announcement!='' )
                  {{ $announcement->detailed_txt }}
               @endif   
            </textarea>
      		</div>
		      <div class="button-group">
               <button class="close-button" type="button" data-dismiss="modal">Close</button>
            </div>
	      </form>
      </div>
   </div>
</div>
</div>
@endif
@endsection

@push('js')
    <!--Script to Load the Calendars-->
	<script type="text/javascript">
	$(document).ready(function() {
		var currentUrl = '@php echo $url @endphp' ;
		if(currentUrl == 'week'){
		$("#dynamicCalendarContent").load("/student/dashboard/weekCalendar");
			$(".get-calendar").click(function(e){

			$("#dynamicCalendarContent").load("/student/dashboard/weekCalendar"+$(this).attr('href') ,function(){

			});
			e.preventDefault();
		});	
		}
		else if(currentUrl == 'day'){
			$("#dynamicCalendarContent").load("/student/dashboard/dayCalendar");
			$(".get-calendar").click(function(e){
			$("#dynamicCalendarContent").load("/student/dashboard/dayCalendar"+$(this).attr('href') ,function(){
				//$('.datepicker').datepicker({format: 'dd/mm/yyyy',});
			});

			e.preventDefault();
		});
		}
		else{
			$("#dynamicCalendarContent").load("/student/dashboard/showCalendar");
			$(".get-calendar").click(function(e){

			$("#dynamicCalendarContent").load("/student/dashboard/showCalendar"+$(this).attr('href') ,function(){
			});

			e.preventDefault();
		});
		}
   
	    
	});	 
	</script>
	<script type="text/javascript">
		$(window).load(function() {
			$(".pageLoader").hide();
		});
	</script>
	<script>
		$('.view-dropdown').on('click', function(event){
			event.stopPropagation();
		});
		$(document).ready(function(){
			if($('#studentannouncementsmodal').attr('data-val')==1){
				$('#studentannouncementsmodal').show();
			}
		});
		$(document).on('click','.close-button',function(){
			$('#studentannouncementsmodal').hide();
		});
	</script>	
<script>
	tinymce.init({
	selector: '.editorMce',
	height: 400,
	theme: 'modern',
	setup: function (editor) {                  
	editor.on('focus', function(e) {
	editor.selection.select(editor.getBody(), true);
	editor.selection.collapse(false);
	});                                             
	},
	  plugins: [
	    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
	    'searchreplace wordcount visualblocks visualchars code fullscreen',
	    'insertdatetime media nonbreaking save table contextmenu directionality',
	    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
	  ],
	  toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
	  toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
	  image_advtab: true,
	  templates: [
	    { title: 'Test template 1', content: 'Test 1' },
	    { title: 'Test template 2', content: 'Test 2' }
	  ],
	  content_css: [
	    
	   
	  ]
	});
</script>

@endpush