<?php
//echo $content;
?>

<div class="calendar-view container-fluid month-view">
   <div class="container-fluid">
      <div class="view-title">
         <div class="header-title"> May 2017</div>
      </div>
      <div class="weeks-d">
         <ul class="p-0 m-0 text-center">
            <li>Sun</li>
            <li>Mon</li>
            <li>Tue</li>
            <li>Wed</li>
            <li>Thu</li>
            <li>Fri</li>
            <li>Sat</li>
         </ul>
      </div>
      <div class="calendar-data">
         <ul class="p-0 m-0">
            <li>
               <div class="dates text-right">29</div>
            </li>
            <li>
               <div class="dates text-right">30</div>
            </li>
            <li>
               <div class="dates text-right">1</div>
               <div class="cell-main-data">
                  <div class="lesson lesson-first">
                     <div class="lesson-heading" style="background-color:green; color:#fff;" > <span class="lesson-name">Lasson</span><span class="lesson-timing"> 7:45am-8:00am </span> </div>
                     <div class="sub-lesson">
                        <div class="lesson-title"> lesson title</div>
                        <div class="sub-lesson-content">Lorem ipsum dolor sit amet, consectetur </div>
                     </div>
                     <div class="sub-lesson">
                        <div class="lesson-title"> lesson title</div>
                        <div class="sub-lesson-content">Lorem ipsum dolor sit amet, consectetur </div>
                     </div>
                     <div class="sub-lesson">
                        <div class="lesson-title"> lesson title</div>
                        <div class="sub-lesson-content">Lorem ipsum dolor sit amet, consectetur </div>
                     </div>
                  </div>
                  <div class="lesson lesson-second">
                     <div class="lesson-heading"  style="background-color:green; color:#fff;" > <span class="lesson-name">Lasson</span><span class="lesson-timing"> 9:45am-11:00am </span> </div>
                     <div class="sub-lesson">
                        <div class="lesson-title"> lesson title</div>
                        <div class="sub-lesson-content">Lorem ipsum dolor sit amet, consectetur </div>
                     </div>
                     <div class="sub-lesson">
                        <div class="lesson-title"> lesson title</div>
                        <div class="sub-lesson-content">Lorem ipsum dolor sit amet, consectetur </div>
                     </div>
                     <div class="sub-lesson">
                        <div class="lesson-title"> lesson title</div>
                        <div class="sub-lesson-content">Lorem ipsum dolor sit amet, consectetur </div>
                     </div>
                  </div>
                  <div class="lesson listing-content lesson-third">
                     <div class="sub-lesson">
                        <div class="lesson-title"> lesson title</div>
                        <ul class="p-0 m-0  text-left">
                           <li>Lorem ipsum dolor sit amet, consectetur </li>
                           <li>Lorem ipsum dolor sit amet, consectetur </li>
                           <li>Lorem ipsum dolor sit amet, consectetur </li>
                           <li>Lorem ipsum dolor sit amet, consectetur </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </li>
            <li>
               <div class="dates text-right">2</div>
            </li>
            <li>
               <div class="dates text-right">3</div>
            </li>
            <li>
               <div class="dates text-right">4</div>
            </li>
            <li>
               <div class="dates text-right">5</div>
            </li>
            <li>
               <div class="dates text-right">6</div>
            </li>
            <li>
               <div class="dates text-right">7</div>
            </li>
            <li>
               <div class="dates text-right">8</div>
            </li>
            <li>
               <div class="dates text-right">9</div>
            </li>
            <li>
               <div class="dates text-right">10</div>
            </li>
            <li>
               <div class="dates text-right">11</div>
            </li>
            <li>
               <div class="dates text-right">12</div>
            </li>
            <li>
               <div class="dates text-right">13</div>
            </li>
            <li>
               <div class="dates text-right">14</div>
            </li>
            <li>
               <div class="dates text-right">15</div>
            </li>
            <li>
               <div class="dates text-right">16</div>
            </li>
            <li>
               <div class="dates text-right">17</div>
            </li>
            <li>
               <div class="dates text-right">18</div>
            </li>
            <li>
               <div class="dates text-right">19</div>
            </li>
            <li>
               <div class="dates text-right">20</div>
            </li>
            <li>
               <div class="dates text-right">21</div>
            </li>
            <li>
               <div class="dates text-right">22</div>
            </li>
            <li>
               <div class="dates text-right">23</div>
            </li>
            <li>
               <div class="dates text-right">24</div>
            </li>
            <li>
               <div class="dates text-right">25</div>
            </li>
            <li>
               <div class="dates text-right">26</div>
            </li>
            <li>
               <div class="dates text-right">27</div>
            </li>
            <li>
               <div class="dates text-right">28</div>
            </li>
            <li>
               <div class="dates text-right">29</div>
            </li>
            <li>
               <div class="dates text-right">30</div>
            </li>
            <li>
               <div class="dates text-right">31</div>
            </li>
            <li>
               <div class="dates text-right">1</div>
            </li>
            <li>
               <div class="dates text-right">2</div>
            </li>
         </ul>
      </div>
   </div>
</div>

<!--popup-->
<div class="d-render-popoup t-data-popup" id="dynamicRenderDiv" style="">
<div class="popup-content">
   <div class="popup-header">
      <div class="row">
         <div class="col-sm-6 header-title">Lesson</div>
         <div class="col-sm-6 header-action-btn text-right">
            <button type="button" id="save_class_data_button" class="btn btn-primary"><span class="">Action</span></button>
            <button type="button" id="save_class_data_button" class="btn btn-primary"><span class="">Save</span></button>
            <a href="#" class="d-popoup-close btn px-3 text-white"><i class="fa fa-2x fa-times" aria-hidden="true"></i><span class="sr-only">Close</span></a> </div>
      </div>
   </div>
   <div class="popup-body">
      <form id="" method="post" class="form-horizontal lesson-form">
         <div class="row">
            <div class="col-sm-4 col-one col-cmn">
               <div class="row">
                  <label class="control-label col-sm-4 text-right">Class</label>
                  <div class="form-group col-sm-8 ">
                     <div class="lesson-class sp-t text-primary">Test</div>
                  </div>
               </div>
               <div class="row">
                  <label class="control-label col-sm-4 text-right">Date</label>
                  <div class="form-group col-sm-8 ">
                     <div class="lesson-time sp-t  text-primary">Friday 05/12/2017</div>
                  </div>
               </div>
            </div>
            <div class="col-sm-4 col-two col-cmn">
               <div class="row">
                  <label class="control-label col-sm-5 text-right">Start Time</label>
                  <div class="form-group col-sm-7 ">
                     <input type="time" class="form-control" />
                  </div>
               </div>
               <div class="row">
                  <label class="control-label col-sm-5 text-right">End Time</label>
                  <div class="form-group col-sm-7 ">
                     <input type="time" class="form-control" />
                  </div>
               </div>
            </div>
            <div class="col-sm-4 col-three col-cmn">
               <div class="row">
                  <label class="control-label col-sm-5 text-right"> Unit</label>
                  <div class="form-group col-sm-7 pr-0">
                     <select id=""  class="form-control">
                        <option value="">Select Unit</option>
                     </select>
                  </div>
               </div>
               <div class="row">
                  <div class="checkbox col-sm-12 text-right">
                     <label>
                        <input type="checkbox">
                        Lock lesson to date</label>
                  </div>
               </div>
            </div>
         </div>
         <div class="row lesson-title">
            <label class="control-label col-sm-4 text-left"> Title</label>
            <div class="form-group col-sm-8">
               <input type="text" class="form-control"/>
            </div>
         </div>
         <div class="clearfix"></div>
         <div class="tabnav">
            <ul class="nav nav-tabs">
               <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
               <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
               <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
               <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
            </ul>
            <div class="tab-content">
               <div id="home" class="tab-pane fade in active">
                  <h3>HOME</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
               </div>
               <div id="menu1" class="tab-pane fade">
                  <h3>Menu 1</h3>
                  <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
               </div>
               <div id="menu2" class="tab-pane fade">
                  <h3>Menu 2</h3>
                  <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
               </div>
               <div id="menu3" class="tab-pane fade">
                  <h3>Menu 3</h3>
                  <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
         <div class="pt-3 attaches">
            <label class="control-label text-bold">Attachments</label>
            <div class="btn-group btn-btn">
               <button type="button" id="" class="btn btn-primary" data-toggle="modal" data-target="#lesson-attaches"> <i class="fa fa-paperclip" aria-hidden="true"></i> </button>
               <button type="button" id="" class="btn btn-primary"><img src="../../images/google-drive.png" ></button>
            </div>
         </div>
      </form>
   </div>
</div>
<div class="modal signup-modals lesson-attach-m fade in" id="lesson-attaches" role="dialog">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header text-center">
            <h4 class="modal-title">My Files</h4>
         </div>
         <div class="modal-body">
            <div class="modal-form">
               <input type=""  placeholder="Search File(s)"  class="full-section"/>
               <div class="file-4-search">
                  <div class="search-files-box p-2">Files names searches</div>
                  <div class="icon-dw p-2"><a href="#"><i class="fa fa-download" aria-hidden="true"></i></a></div>
               </div>
            </div>
            <div style="height:150px;"></div>
         </div>
         <div class="modal-footer  btn-group">
            <button type="" class="btn btn-primary">Apply</button>
            <button type="" class="btn btn-primary">Select All</button>
            <button type="" class="btn btn-primary">Clear All</button>
            <div class="attaches-pop">
               <input type="file" />
               <button type="" class="btn br-0 btn-primary">Upload New File</button>
            </div>
            <button type="" class="btn btn-primary">Cancel</button>
         </div>
      </div>
   </div>
</div>
