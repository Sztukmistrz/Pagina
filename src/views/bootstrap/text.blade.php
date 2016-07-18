@extends($layout)



@section('content')


<div class="col-xs-4 col-sm-3 col-md-3 col-lg-3">
	<div class="panel panel-default">
	  <div class="panel-heading">
	{!! SEOL::Link($routeName,['class'=>"title"])!!}
	  </div>

			<div class="list-group">
			{!!$pagesMenu!!}
			</div>


	</div>
</div>




<div class="col-xs-8 col-sm-9 col-md-9 col-lg-9">
	@if(isset($texts['main_text']) && $texts['main_text'])
	@foreach ($texts['main_text'] as $record)
	<div class="well">
			
			
			<h1>{{$record['title']}}</h1>
			{!!$record['text']!!}
			</div>
			

		@endforeach
	@endif


	@if(isset($texts['text']) && $texts['text'])
	@foreach ($texts['text'] as $record)
	<div class="well">
	{{$layout}}
	<h1>{{$record['title']}}</h1>
	{!!$record['text']!!}
	</div>
	@endforeach
	@endif

	@if(isset($texts['help']) && $texts['help'])
	@foreach ($texts['help'] as $record)
	<div class="well">
	<h5>{{$record['title']}}</h5>
	<small>{!!$record['text']!!}</small>
	</div>
	@endforeach
	@endif
</div>









@endsection





