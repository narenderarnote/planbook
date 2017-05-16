
@php 
   $filtered = $classes->where('start_date', '<=' , $content['date'])->where('end_date', '>=', $content['date'])->all();
@endphp
@if(!empty($filtered))
<div class="cell-main-data">
   @foreach($filtered as $filter)
   <div class="lesson">
      @php
         $url = empty($filter->classlesson)
      @endphp
      <div class="lesson-heading"  style="background-color:{{ $filter['class_color'] }}; color:#fff;" >
         <span class="lesson-name">{{ $filter['class_name'] }}</span>
         <span class="lesson-timing"> <!-- 7:45am-8:00am --> </span>

      </div>
   </div>
   @endforeach
</div>
@endif