
@extends($layout)


@section('content')
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

@endsection