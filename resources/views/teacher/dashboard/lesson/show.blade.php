
@php 
   $filtered = $classes->where('start_date', '<=' , $content['date'])->where('end_date', '>=', $content['date'])->where('user_id', '=' , Auth::user()->id )->all();
@endphp
@if(!empty($filtered))
<div class="cell-main-data">
   @foreach($filtered as $filters)
   
      @php
         $url = empty($filters->classlesson);
		 $DayName = $content['date'] ;
		 $ts = strtotime($DayName);
		 $daysName = date("Y-m-d", $ts); 
		 $dateToPass = date("l Y-m-d",$ts);
		 $dbDate = date("Y-m-d",$ts);
		 $weekDay = date('l', strtotime($content['date']) );
		 
		 $hasClass = !collect(json_decode($filters->class_schedule))
				->where("text", $weekDay)
				->where("is_class" , "1")
				->isEmpty();
				$classID = $filters['id'];
				$sqlDate = date('Y-m-d', strtotime($daysName));
				$lessonsData = $monthView->getLessons($classID,$sqlDate,Auth::user()->id);
				$viewList = $monthView->getViewList();
				$check_data  = array();
	            $check_class = array();
	            if($viewList!=''){
		            $data   = json_decode($viewList->view_items);
		            $class  = json_decode($viewList->view_class);
		            foreach($data as $key=>$value){
		               $check_data[] =  $value;
		            }
		            foreach($class as $class_val){
		              $check_class[] =  $class_val;
		            }
		        }    
			@endphp
	  
		@if($hasClass)
			<div class="mainClass {{ $filters['class_name'] }}" style="border-color: {{ $filters['class_color'] }}">			
				<div class="languagearts week-tabcontentinner" style="background-color:{{ $filters['class_color'] }}; color:#fff; border-color: {{ $filters['class_color'] }};">
				@forelse($lessonsData as $lData)		
				 {!! $filters['class_name'] !!} {!!$lData['lesson_start_time']!!}  {!!$lData['lesson_end_time']!!}
				  @empty 
				  {!! $filters['class_name'] !!}
				  @endforelse
					<span class="week-icons">
						<ul>
							<li class="dropdown"><img src="/images/move-icon.png" class="move-icon" > </li>
							<li class="dropdown"> <img src="/images/downarrow2.png" class="downarrow-icon downarrowtoggle">
								<div class="lesondropdown">
									<div class="lessondropdown-header"> Lesson Actions 
										<span class="cross-icon copydropcrossicons"> 
											<i class="fa fa-close" aria-hidden="true"></i>
										</span>
									</div>
									<div class="lesondropdown-body lessondrop-bodymain">
										<ul>
											<li class="editBtn" id="editBtn" targetID = "{{ $filters['id'] }}" targetDay = "{{ $weekDay }}"  targetDate="{{ $dateToPass  }}"> <i class="fa fa-pencil" aria-hidden="true"></i>Edit Lesson</li>
											<li data-toggle="modal" id="moveBtn" targetID = "{{ $filters['id'] }}" targetClass = "{{ $filters['class_name'] }}"  targetDate="{{ $dateToPass  }}"> <i class="fa fa-arrows" aria-hidden="true"></i> Move Lesson</li>
											<li class="copy-field"> <i class="fa fa-copy" aria-hidden="true"></i> Copy
												<div class="dropdown copy-dropdown">
													<button class="btn btn-copy dropdown-toggle" type="button" data-toggle="dropdown"> All
														<div class="caret-button"><span class="caret"></span></div>
													</button>
													<ul class="dropdown-menu copydropdown-inner">
													   <li>All Selection</li>
													   <li>
														  <input type="checkbox">
														  Lesson </li>
													   <li>
														  <input type="checkbox">
														  Homework </li>
													   <li>
														  <input type="checkbox">
														  Notes </li>
													   <li>
														  <input type="checkbox">
														  Standards </li>
													   <li>
														  <input type="checkbox">
														  Attachments </li>
													   <li>Done</li>
													</ul>
												</div>
											</li>
											<li data-toggle="modal" data-target="#pastemodal"> <i class="fa fa-paste" aria-hidden="true"></i> Paste</li>
											<li> 
												<i class="fa fa-arrow-right" aria-hidden="true"></i> 
												<span class="weekBump" token="{{ csrf_token() }}" targetID = "{{ $filters['id'] }}" targetDate="{{ $dbDate  }}">Bump</span>
												<div class="copy-incrementfunction">
													<input type="button" class="decrementBtn" value="-" >
													<input type="text" value="1" class="copydropdown-value">
													<input type="button" class="incrementBtn" value="+" >
												</div>
											</li>
											<li>
												<i class="fa fa-arrow-left" aria-hidden="true"></i> 
												<span class="weekBack" token="{{ csrf_token() }}" targetID = "{{ $filters['id'] }}" targetDate="{{ $dbDate  }}">Back</span>
												<div class="copy-incrementfunction">
													<input type="button" class="decrementBtn" value="-" >
													<input type="text" value="1" class="copydropdown-value">
													<input type="button" class="incrementBtn" value="+" >
												</div>
											</li>
											<li> 
												<i class="fa fa-forward" aria-hidden="true"></i>
												<span class="weekExtend" token="{{ csrf_token() }}" targetID = "{{ $filters['id'] }}" targetDate="{{ $dbDate  }}">Extend Lesson</span>
												<div class="copy-incrementfunction">
													<input type="button" class="decrementBtn" value="-" >
													<input type="text" value="1" class="copydropdown-value">
													<input type="button" class="incrementBtn" value="+" >
												</div>
											</li>
											<li>
												<i class="fa fa-forward" aria-hidden="true"></i>
												<span class="weekStandardsExtend" token="{{ csrf_token() }}" targetID = "{{ $filters['id'] }}" targetDate="{{ $dbDate  }}"> Extend Standards</span>
												<div class="copy-incrementfunction">
													<input type="button" class="decrementBtn" value="-" >
													<input type="text" value="1" class="copydropdown-value">
													<input type="button" class="incrementBtn" value="+" >
												</div>
											</li>
										  <li class="deleteLessons" data-toggle="modal" token="{{ csrf_token() }}" targetID = "{{ $filters['id'] }}" targetDate="{{ $dbDate  }}" ><i class="fa fa fa-trash" aria-hidden="true"></i> Delete Lessons</li>
										  <li data-toggle="modal" data-target="#movemodal"><i class="fa fa-calendar" aria-hidden="true"></i> No Class Day</li>
										</ul>
									</div>
								</div>
							</li>
						</ul>
					</span> 
				</div>
				@if($viewList!='')
				<div class="appendText">
					@php
					$classID = $filters['id'];
					$sqlDate = date('Y-m-d', strtotime($daysName));
					$lessonsData = $monthView->getLessons($classID,$sqlDate,Auth::user()->id);
					$assignmentData = $monthView->getAssignments($classID,$sqlDate,Auth::user()->id);
					$assessmentData = $monthView->getAssessments($classID,$sqlDate,Auth::user()->id);
					$eventsData     = $monthView->getEvents($sqlDate,Auth::user()->id);
					@endphp
					
					@forelse($lessonsData as $lData)
						@php 
							$groups = array();
							$attach = $lData['attachments'];
							$groups = explode(',',$attach);
						@endphp
						@if($lData['lesson_title'])
						<div class="t-heading lesson_title" style="border-bottom: 1px solid {{ $filters['class_color'] }};">
							@if($lData['unit'])
								<span class="lesson_main edit_unit unit_id {{ $check_data[0] == 'N' ? 'hide' : '' || $check_data[2] == 'N' ? 'hide' : ''}}" style="background: {{ $filters['class_color'] }};" data-unit-id="{{$lData['unit']}}"> 
									<a href="javascript:;">
										{{ $monthView->units($lData['unit'])}}
									</a>  
								</span>
							@endif	
							<span class="lesson_main lesson_title {{ $check_data[1] == 'N' ? 'hide' : '' || $check_data[2] == 'N' ? 'hide' : '' }}">{{ $lData['lesson_title'] }}</span>
						</div>
						@endif
						
						@if($lData['lesson_text'])	
						<div class="t-cel lesson_main lesson_text {{ $check_data[2] == 'N' ? 'hide' : ''}}" style="border-bottom: 1px solid {{ $filters['class_color'] }}">{!! $lData['lesson_text'] !!}</div>
						@endif
						@if($lData['objective'])
						<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}"><h5>Objective / Essential Question</h5>{!! $lData['objective'] !!}</div>
						@endif

						@if($lData['direct'])
						<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}"><h5>Direct Instruction</h5>{!! $lData['direct'] !!}</div>
						@endif

						@if($lData['independent'])
						<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}"><h5>Independent Practice</h5>{!! $lData['independent'] !!}</div>
						@endif
						@if($lData['guided'])
						<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}"><h5>Guided Practice</h5>{!! $lData['guided'] !!}</div>
						@endif
						@if($lData['differentation'])	
						<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}"><h5>Differentiation / Accommodations</h5>{!! $lData['differentation'] !!}</div>
						@endif
						@if($lData['homework'])	
						<div class="t-cel lesson_main lesson_homework {{ $check_data[3] == 'N' ? 'hide' : '' || $check_data[2] == 'N' ? 'hide' : '' }}" style="border-bottom: 1px solid {{ $filters['class_color'] }}">@if($plan=='detailed')<h5>Homework / Evidence of Learning</h5> @else <h5>Homework</h5> @endif {!! $lData['homework'] !!}</div>
						@endif
						@if($lData['instructional'])	
						<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}"><h5>Instructional Strategies</h5>{!! $lData['instructional'] !!}</div>
						@endif
						@if($lData['notes'])	
						<div class="t-cel lesson_main lesson_notes {{ $check_data[4] == 'N' ? 'hide' : '' || $check_data[2] == 'N' ? 'hide' : '' }}" style="border-bottom: 1px solid {{ $filters['class_color'] }}">@if($plan=='detailed')<h5>Notes / Reflection</h5>@else <h5>Notes</h5> @endif {!! $lData['notes'] !!}</div>
						@endif
						@if($lData['material'])	
						<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}"><h5>Materials / Resources / Technology</h5>{!! $lData['material'] !!}</div>
						@endif
						@if($groups)	
						<div class="t-cel lesson_main lesson_attachments {{ $check_data[7] == 'N' ? 'hide' : '' || $check_data[2] == 'N' ? 'hide' : ''}}" style="border-bottom: 1px solid {{ $filters['class_color'] }}">
							@forelse($groups as $group)
								@if($group)
									<a target="_blank" href="../../uploads/myfiles/{{ $group }}">{{ $group }}</a><br/>
								@endif
							@empty
							
							@endforelse
						</div>
						@endif
						@empty
						
					
					@endforelse
					@php $assititle=''; @endphp
					@forelse($assignmentData as $assignment)
						@php $assititle = $assignment['title'];  @endphp
					@empty
					
					@endforelse
					<div class="t-heading lesson_assignment {{ $assititle == '' ? 'hide' : '' || $check_data[8] == 'N' ? 'hide' : '' }}" style="border-bottom: 1px solid {{ $filters['class_color'] }}">
							<h5>Assignment</h5>
						@forelse($assignmentData as $assignment)
							@if($assignment['title'])
							
								<span class="edit_assignment" data-assignment-id="{{$assignment['id']}}">
									<a href="javascript:;">{{ $assignment['title'] }}</a>
								</span>
							
							@endif
						@empty

						@endforelse
					</div>
					@php $asstitle=''; @endphp
					@forelse($assessmentData as $assessment)
						@php $asstitle = $assessment['title'];  @endphp
					@empty
					
					@endforelse
					<div class="t-heading lesson_assessment {{ $asstitle == '' ? 'hide' : '' || $check_data[9] == 'N' ? 'hide' : '' }}"><h5>Assessment</h5>
						@forelse($assessmentData as $assessment)
							@if($assessment['title'])
							
								<span class="edit_assessment" data-assessment-id="{{$assessment['id']}}">
									<a href="javascript:;">{{ $assessment['title'] }}</a>
								</span>
							
							@endif
						@empty
						@endforelse
					</div>
				</div>
				@else
					<div class="appendText">
					@php
					$classID = $filters['id'];
					$sqlDate = date('Y-m-d', strtotime($daysName));
					$lessonsData = $monthView->getLessons($classID,$sqlDate,Auth::user()->id);
					$assignmentData = $monthView->getAssignments($classID,$sqlDate,Auth::user()->id);
					$assessmentData = $monthView->getAssessments($classID,$sqlDate,Auth::user()->id);
					$eventsData     = $monthView->getEvents($sqlDate,Auth::user()->id);
					@endphp
					
					@forelse($lessonsData as $lData)
						@php 
							$groups = array();
							$attach = $lData['attachments'];
							$groups = explode(',',$attach);
						@endphp
						@if($lData['lesson_title'])
						<div class="t-heading lesson_title" style="border-bottom: 1px solid {{ $filters['class_color'] }};">
							@if($lData['unit'])
								<span class="lesson_main edit_unit unit_id" style="background: {{ $filters['class_color'] }};" data-unit-id="{{$lData['unit']}}"> 
									<a href="javascript:;">
										{{ $monthView->units($lData['unit'])}}
									</a>  
								</span>
							@endif	
							<span class="lesson_main lesson_title">{{ $lData['lesson_title'] }}</span>
						</div>
						@endif
						
						@if($lData['lesson_text'])	
						<div class="t-cel lesson_main lesson_text" style="border-bottom: 1px solid {{ $filters['class_color'] }}">{!! $lData['lesson_text'] !!}</div>
						@endif
						@if($lData['objective'])
						<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}"><h5>Objective / Essential Question</h5>{!! $lData['objective'] !!}</div>
						@endif

						@if($lData['direct'])
						<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}"><h5>Direct Instruction</h5>{!! $lData['direct'] !!}</div>
						@endif

						@if($lData['independent'])
						<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}"><h5>Independent Practice</h5>{!! $lData['independent'] !!}</div>
						@endif
						@if($lData['guided'])
						<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}"><h5>Guided Practice</h5>{!! $lData['guided'] !!}</div>
						@endif
						@if($lData['differentation'])	
						<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}"><h5>Differentiation / Accommodations</h5>{!! $lData['differentation'] !!}</div>
						@endif
						@if($lData['homework'])	
						<div class="t-cel lesson_main lesson_homework" style="border-bottom: 1px solid {{ $filters['class_color'] }}">@if($plan=='detailed')<h5>Homework / Evidence of Learning</h5> @else <h5>Homework</h5> @endif {!! $lData['homework'] !!}</div>
						@endif
						@if($lData['instructional'])	
						<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}"><h5>Instructional Strategies</h5>{!! $lData['instructional'] !!}</div>
						@endif
						@if($lData['notes'])	
						<div class="t-cel lesson_main lesson_notes" style="border-bottom: 1px solid {{ $filters['class_color'] }}">@if($plan=='detailed')<h5>Notes / Reflection</h5>@else <h5>Notes</h5> @endif {!! $lData['notes'] !!}</div>
						@endif
						@if($lData['material'])	
						<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}"><h5>Materials / Resources / Technology</h5>{!! $lData['material'] !!}</div>
						@endif
						@if($groups)	
						<div class="t-cel lesson_main lesson_attachments" style="border-bottom: 1px solid {{ $filters['class_color'] }}">
							@forelse($groups as $group)
								@if($group)
									<a target="_blank" href="../../uploads/myfiles/{{ $group }}">{{ $group }}</a><br/>
								@endif
							@empty
							
							@endforelse
						</div>
						@endif
						@empty
						
					
					@endforelse
					@php $assititle=''; @endphp
					@forelse($assignmentData as $assignment)
						@php $assititle = $assignment['title'];  @endphp
					@empty
					
					@endforelse
					<div class="t-heading lesson_assignment {{ $assititle == '' ? 'hide' : '' }}" style="border-bottom: 1px solid {{ $filters['class_color'] }}">
							<h5>Assignment</h5>
						@forelse($assignmentData as $assignment)
							@if($assignment['title'])
							
								<span class="edit_assignment" data-assignment-id="{{$assignment['id']}}">
									<a href="javascript:;">{{ $assignment['title'] }}</a>
								</span>
							
							@endif
						@empty

						@endforelse
					</div>
					@php $asstitle=''; @endphp
					@forelse($assessmentData as $assessment)
						@php $asstitle = $assessment['title'];  @endphp
					@empty
					
					@endforelse
					<div class="t-heading lesson_assessment {{ $asstitle == '' ? 'hide' : '' }}"><h5>Assessment</h5>
						@forelse($assessmentData as $assessment)
							@if($assessment['title'])
							
								<span class="edit_assessment" data-assessment-id="{{$assessment['id']}}">
									<a href="javascript:;">{{ $assessment['title'] }}</a>
								</span>
							
							@endif
						@empty
						@endforelse
					</div>
				</div>	
				@endif
				
			</div> 
			@forelse($eventsData as $event)
			<div class="languagearts week-tabcontentinner week-tabbottom" style="background-color:#c3d9ff; color:#0000ff;">
				{{$event['event_title']}}
				<span class="week-icons hover-weekicons">
			        <ul>
			            <li class="dropdown"> <img src="/images/downarrow2.png" class="downarrow-icon downarrowtoggle" aria-expanded="false">
			              	<div class="lesondropdown event-dropdown" style="display: none;">
				              	<ul class="daycontentdropdown weekcontentdropdown">
					                <div class="lessondropdown-header"> Actions <span class="cross-icon copydropcrossicons"> <i class="fa fa-close" aria-hidden="true"></i></span></div>
					                <div class="weekdropdownbody">
					                  <ul>
					                    <li class="edit_events" data-event-id="{{$event['id']}}"> <i class="fa fa-pencil" aria-hidden="true"></i> Edit</li>
					                    <li {{$event['id']}}> <i class="fa fa fa-trash" aria-hidden="true"></i> Delete</li>
					                  </ul>
					                </div>
					            </ul>
				            </div>   
			            </li>
			        </ul> 
		          </span> 
		    </div> 
		    @empty
		    
		    @endforelse
		@endif
   @endforeach

</div>

@endif
<script>
	$("body").on('click','.listtab-content .downarrow-icon',function(){
		$(".calendar-view .calendar-data li .cell-main-data").removeClass('overflow-v');
		$(this).parents(".calendar-view .calendar-data li .cell-main-data").addClass("overflow-v");
			
	});

	$(".lessondropdown-header .cross-icon i").click(function(e) {
		$(this).parents(".calendar-view .calendar-data li .cell-main-data").removeClass("overflow-v");
	 });
	/* $(".lesondropdown").on("click", function(event){
		event.stopPropagation();
	});  

	  $(document).on("click", function (e) {
       $(".calendar-view .calendar-data li .cell-main-data").removeClass('overflow-v');

    });*/
</script>