<!-- Addperiod Section Start Here -->
   
      <div class="modal-dialog">
         <!-- Modal content-->
         <form method="post" action="#" class="addteacher-form addperiodform">
         <div class="modal-content">
            <div class="modal-header addperiodheder">
               <div class="normalLesson pull-left">
                  <p> Grading Period</p>
               </div>
               <div class="actionright pull-right">
                  <input type="submit" class="actiondropbutton renew-button" value="Save">
                  <a class="closebutton" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i></a> 
               </div>
            </div>
            <div class="modal-body">
              
                  {{csrf_field()}}
                  <input type="hidden" name="class_id" value="" id="periodClassID">
                  <div class="form-group col-md-12">
                     <label>Period Name</label>
                     <input type="text" name="periodname" class="addteacherfield">
                  </div>
                  <div class="form-group col-md-12">
                     <label>Start Date</label>
                     <input class="addteacherfield datepicker" name="start_date" type="text">
                  </div>
                  <div class="form-group col-md-12">
                     <label>End Date</label>
                     <input class="addteacherfield datepicker" name="end_date" type="text">
                  </div>
              
            </div>
         </div>
          </form>
      </div>
      <script>
         $('.datepicker').datepicker({format: 'dd/mm/yyyy',autoclose:true});
      </script>