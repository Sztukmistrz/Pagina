{{-- BASE LAYOUT FRONTEND --}}
<!DOCTYPE html>
<html lang="{{Config::get('app.locale')}}"  {!! $microdata['service_WebSite_HTML'] !!} >
<head>

@include('seo::all')

@include('layouter::layouts.frontend.parts.css-top')

<!-- extra-css -->
@stack('extra-css')
<!-- extra-css -->

</head>
<body {!! $microdata['service_WebPage_HTML'] !!} >

<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- extra-modals -->
@stack('extra-modals')
<!-- extra-modals -->
<main>

<div class="container">
@include('layouter::layouts.frontend.parts.header')
@include('flash::message')
</div>

@include('layouter::layouts.frontend.parts.menu-main')

<div class="container">
<div class="row">
{{-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ --}}
@if (isset($renderTexts['text']))
	{!!$renderTexts['text']!!}
@endif



@if (isset($renderTexts['help']))
	{!!$renderTexts['help']!!}
@endif
{{-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ --}}
</div>
</div>

@include('layouter::layouts.frontend.parts.footer')

</main>

@include('layouter::layouts.frontend.parts.scripts-bottom')

<!-- extra-scripts -->
@stack('extra-scripts')
<!-- extra-scripts -->

@include('layouter::layouts.frontend.parts.scripts-google')

</body>
</html>