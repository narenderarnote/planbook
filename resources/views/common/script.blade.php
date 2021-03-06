<script type="text/javascript" src="/js/jquery.min.js"></script> 
<script type="text/javascript" src="/js/bootstrap.min.js" ></script> 
<script type="text/javascript" src="/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/js/jquery-ui.js"></script>
<script type="text/javascript" src="/js/jquery.ui.touch-punch.js"></script> 
<!-- datepicker js -->
<script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- time picker js -->
<script src="{{ asset('/plugins/jonthornton-timepicker/jquery.timepicker.min.js') }}"></script>

<!-- Editor js -->
<script src="{{ asset('/plugins/tinymce/js/tinymce/tinymce.js') }}"></script>
<!--Data Table-->
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script> 
@stack('before-main-js')
<script>
$(document).ready(function(){
	
$('.selectedClassYear li a').on('click',function(e){ 
	lselected = $(this).text();
	
    var background   = $(this).css('background-color');
    $(this).parents('.dropdown').find('.btn').html(lselected +' <span class="caret"></span>');
   }); 

});

</script>
@stack('js')