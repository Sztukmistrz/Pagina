

<div class="pro help-block shadow1">
@foreach ($pageHelpTexts as $key => $record)
	<p class="title">{{$record['title']}} <span class="show_more_help" data-target="#content_of_help_{{$key}}"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
</span> </p> 
	<div id="content_of_help_{{$key}}" class="content_of_help" style="display:none">
	<p>{!!$record['text']!!}</p>
	</div>
@endforeach
</div>