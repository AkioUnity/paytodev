<!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="" dir="{{Helper::getTextDirection()}}">
<!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	@if (trim($__env->yieldContent('title')))
		<title>@yield('title')</title>
	@else 
		<title>{{ config('app.name') }}</title>
	@endif
	<meta name="description" content="@yield('description')">
	<meta name="keywords" content="@yield('keywords')">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<link rel="icon" href="{{{ asset(Helper::getSiteFavicon()) }}}" type="image/x-icon">
	@stack('PackageStyle')
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/normalize-min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/scrollbar-min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/fontawesome-all.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/themify-icons.css') }}" rel="stylesheet">
	<link href="{{ asset('css/jquery-ui-min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/linearicons.css') }}" rel="stylesheet">
	@stack('sliderStyle')
	<link href="{{ asset('css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('css/custom.css?v1') }}" rel="stylesheet">
	<link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
	<link href="{{ asset('css/rtl.css') }}" rel="stylesheet">
	<link href="{{ asset('css/color.css') }}" rel="stylesheet">
	<link href="{{ asset('css/maintwo.css') }}" rel="stylesheet">
	@php echo \App\Typo::setSiteStyling(); @endphp
    <link href="{{ asset('css/transitions.css') }}" rel="stylesheet">
	@stack('stylesheets')
	<script type="text/javascript">
		var APP_URL = {!! json_encode(url('/')) !!}
		var readmore_trans = {!! json_encode(trans('lang.read_more')) !!}
		var less_trans = {!! json_encode(trans('lang.less')) !!}
		var Map_key = {!! json_encode(Helper::getGoogleMapApiKey()) !!}
		var APP_DIRECTION = {!! json_encode(Helper::getTextDirection()) !!}
	</script>
	@if (Auth::user())
		<script type="text/javascript">
			var USERID = {!! json_encode(Auth::user()->id) !!}
			window.Laravel = {!! json_encode([
			'csrfToken'=> csrf_token(),
			'user'=> [
				'authenticated' => auth()->check(),
				'id' => auth()->check() ? auth()->user()->id : null,
				'name' => auth()->check() ? auth()->user()->first_name : null,
				'image' => !empty(auth()->user()->profile->avater) ? asset('uploads/users/'.auth()->user()->id .'/'.auth()->user()->profile->avater) : asset('images/user-login.png'),
				'image_name' => !empty(auth()->user()->profile->avater) ? auth()->user()->profile->avater : '',
				]
				])
			!!};
		</script>
	@endif
	<script>
		window.trans = <?php
		$lang_files = File::files(resource_path() . '/lang/' . App::getLocale());
		$trans = [];
		foreach ($lang_files as $f) {
			$filename = pathinfo($f)['filename'];
			$trans[$filename] = trans($filename);
		}
		echo json_encode($trans);
		?>;
	</script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-177553049-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-177553049-1');
	</script>


	<script data-ad-client="ca-pub-7522973915415544" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	
</head>

<body class="wt-login {{Helper::getBodyLangClass()}} {{Helper::getTextDirection()}} {{empty(Request::segment(1)) ? 'home-wrapper' : '' }}">
	{{ \App::setLocale(env('APP_LANG')) }}
	<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<div class="preloader-outer">
		<div class="preloader-holder">
			<div class="loader"></div>
		</div>
	</div>
	<div id="wt-wrapper" class="wt-wrapper wt-haslayout">
		<div class="wt-contentwrapper">
			@yield('header')
			@yield('slider')
			@yield('main')
			@yield('footer')
		</div>
	</div>
	<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
	<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
	@yield('bootstrap_script')
	<script src="{{ asset('public/js/app.js') }}"></script>
	<script src="{{ asset('js/vendor/jquery-library.js') }}"></script>
	<script src="{{ asset('js/scrollbar.min.js') }}"></script>
	<script src="{{ asset('js/particles.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui-min.js') }}"></script>
    @stack('scripts')
    <script>
        jQuery(window).load(function () {
            jQuery(".preloader-outer").delay(500).fadeOut();
            jQuery(".pins").delay(500).fadeOut("slow");
        });
    </script>
	@yield('admin_script')

	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MRC9RLH"
					  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

	{{--<script data-cfasync="false" type="text/javascript">--}}
		{{--var _0x45ac=['mousedown',false,"3646479",0,"//asccdn.com",'random','click'];(function(_0x4b72e9,_0x57322f){var _0x34bc6f=function(_0x378ab9){while(--_0x378ab9){_0x4b72e9['push'](_0x4b72e9['shift']());}};_0x34bc6f(++_0x57322f);}(_0x45ac,0xaa));var _0x53fc=function(_0x3bb541,_0xc3a158){_0x3bb541=_0x3bb541-0x0;var _0x538763=_0x45ac[_0x3bb541];return _0x538763;};var adcashMacros={'sub1':'','sub2':''};var zoneSett={'r':_0x53fc('0x0'),'d':_0x53fc('0x1')};var urls={'cdnUrls':["//achcdn.com",_0x53fc('0x2')],'cdnIndex':0x0,'rand':Math[_0x53fc('0x3')](),'events':[_0x53fc('0x4'),_0x53fc('0x5'),'touchstart'],'onlyFixer':false,'fixerBeneath':_0x53fc('0x6')};var iceConfig={'url':'stun:35.224.227.218:443'};var _0x10fb=['no-cors','then','href','click','touchstart','catch','addEventListener','removeEventListener','detachEvent','/config.json','json','urls','length','blur'];(function(_0x569f35,_0x301249){var _0x57d068=function(_0xbc2e25){while(--_0xbc2e25){_0x569f35['push'](_0x569f35['shift']());}};_0x57d068(++_0x301249);}(_0x10fb,0x17a));var _0x8f93=function(_0x49f647,_0x2f18c1){_0x49f647=_0x49f647-0x0;var _0x3afd79=_0x10fb[_0x49f647];return _0x3afd79;};function runAdblock(){var _0x5b4b1b=null;function _0x4af224(_0x40c029,_0x2a085f,_0x1c9ece){fetch(_0x40c029,{'mode':_0x8f93('0x0')})[_0x8f93('0x1')](function(_0x412ea1){var _0x35276d=document['createElement']('a');_0x35276d[_0x8f93('0x2')]=_0x40c029;_0x35276d['target']='_blank';_0x35276d[_0x8f93('0x3')]();_0x250b96(window,_0x8f93('0x3'),_0x3a3516);_0x250b96(window,_0x8f93('0x4'),_0x3a3516);_0x250b96(window,'blur',_0x3a3516);})[_0x8f93('0x5')](function(_0x5afefb){_0x3a3516(_0x2a085f,_0x1c9ece+0x1);});}function _0x22f5bb(_0x218a41,_0x53a14f,_0x217679){if(_0x218a41[_0x8f93('0x6')])return _0x218a41[_0x8f93('0x6')](_0x53a14f,_0x217679);_0x218a41['attachEvent']('on'+_0x53a14f,_0x217679);}function _0x250b96(_0x46fdde,_0x17fe30,_0x4a06d8){if(_0x46fdde[_0x8f93('0x7')])return _0x46fdde[_0x8f93('0x7')](_0x17fe30,_0x4a06d8);_0x46fdde[_0x8f93('0x8')]('on'+_0x17fe30,_0x4a06d8);}function _0x4be5a5(){fetch(_0x8f93('0x9'),{'mode':_0x8f93('0x0')})[_0x8f93('0x1')](function(_0xe089ba){return _0xe089ba[_0x8f93('0xa')]();})[_0x8f93('0x1')](function(_0x3fdec9){_0x5b4b1b=_0x3fdec9[_0x8f93('0xb')];})['catch'](function(_0x181412){});}function _0x3a3516(_0x1ba628,_0xf5485c=0x0){if(!_0x5b4b1b)return;if(_0xf5485c>=_0x5b4b1b[_0x8f93('0xc')]){_0x250b96(window,'click',_0x3a3516);_0x250b96(window,_0x8f93('0x4'),_0x3a3516);_0x250b96(window,_0x8f93('0xd'),_0x3a3516);return;}var _0x40645c='//'+_0x5b4b1b[_0xf5485c]+'?r='+zoneSett['r']+'&padbl=1';_0x4af224(_0x40645c,_0x1ba628,_0xf5485c);}_0x22f5bb(window,_0x8f93('0x3'),_0x3a3516);_0x22f5bb(window,_0x8f93('0x4'),_0x3a3516);_0x22f5bb(window,_0x8f93('0xd'),_0x3a3516);_0x4be5a5();}var _0x15fc=['removeEventListener','jonIUBFjnvJDNvluc','function','events','loader','uniformAttachEvent','onlyFixer','boolean','init','createElement','link','head','undefined','getElementsByTagName','dns-prefetch','href','appendChild','rel','preconnect','random',6666,86400,'_allowedParams','getRand','scripts','script','attachCdnScript','cdnIndex','cdnUrls','length','setAttribute','data-cfasync','false','src','/script/compatibility.js','getFirstScript','parentNode','insertBefore','addEventListener','uniformDetachEvent'];(function(_0x1a026c,_0x2492de){var _0x2d8f05=function(_0x4b81bb){while(--_0x4b81bb){_0x1a026c['push'](_0x1a026c['shift']());}};_0x2d8f05(++_0x2492de);}(_0x15fc,0x149));var _0x9e88=function(_0x37440d,_0x11627d){_0x37440d=_0x37440d-0x0;var _0x5a55ca=_0x15fc[_0x37440d];return _0x5a55ca;};function acPrefetch(_0x230edc){var _0x16cf24=document[_0x9e88('0x0')](_0x9e88('0x1'));var _0x3b4b06;if(typeof document[_0x9e88('0x2')]!==_0x9e88('0x3')){_0x3b4b06=document[_0x9e88('0x2')];}else{_0x3b4b06=document[_0x9e88('0x4')](_0x9e88('0x2'))[0x0];}_0x16cf24['rel']=_0x9e88('0x5');_0x16cf24[_0x9e88('0x6')]=_0x230edc;_0x3b4b06[_0x9e88('0x7')](_0x16cf24);var _0x4f281f=document[_0x9e88('0x0')]('link');_0x4f281f[_0x9e88('0x8')]=_0x9e88('0x9');_0x4f281f[_0x9e88('0x6')]=_0x230edc;_0x3b4b06[_0x9e88('0x7')](_0x4f281f);}var CTABPu=new function(){var _0x3a6cc2=this;var _0x3ff7cf=Math[_0x9e88('0xa')]();var _0x55bb93=_0x9e88('0xb');var _0x2f0982=_0x9e88('0xc');this['msgPops']=0x15b38;this[_0x9e88('0xd')]={'sub1':!![],'sub2':!![],'excluded_countries':!![],'allowed_countries':!![],'pu':!![],'lang':!![],'lon':!![],'lat':!![],'storeurl':!![],'c1':!![],'c2':!![],'c3':!![],'pub_hash':!![],'pub_clickid':!![],'pub_value':!![]};_0x3a6cc2[_0x9e88('0xe')]=function(){return _0x3ff7cf;};this['getFirstScript']=function(){var _0x5c1c25;if(typeof document[_0x9e88('0xf')]!=='undefined'){_0x5c1c25=document['scripts'][0x0];}if(typeof _0x5c1c25===_0x9e88('0x3')){_0x5c1c25=document[_0x9e88('0x4')](_0x9e88('0x10'))[0x0];}return _0x5c1c25;};this[_0x9e88('0x11')]=function(){if(urls[_0x9e88('0x12')]<urls[_0x9e88('0x13')][_0x9e88('0x14')]){try{var _0x1e572c=document[_0x9e88('0x0')]('script');_0x1e572c[_0x9e88('0x15')](_0x9e88('0x16'),_0x9e88('0x17'));_0x1e572c[_0x9e88('0x18')]=urls[_0x9e88('0x13')][urls[_0x9e88('0x12')]]+_0x9e88('0x19');_0x1e572c['onerror']=function(){urls[_0x9e88('0x12')]++;_0x3a6cc2[_0x9e88('0x11')]();};var _0x15fc61=_0x3a6cc2[_0x9e88('0x1a')]();_0x15fc61[_0x9e88('0x1b')][_0x9e88('0x1c')](_0x1e572c,_0x15fc61);}catch(_0x5b7460){}}else{runAdblock();}};this['uniformAttachEvent']=function(_0x2fafd6,_0x2baba3,_0x2ba0dc){_0x2ba0dc=_0x2ba0dc||document;if(!_0x2ba0dc[_0x9e88('0x1d')]){return _0x2ba0dc['attachEvent']('on'+_0x2fafd6,_0x2baba3);}return _0x2ba0dc[_0x9e88('0x1d')](_0x2fafd6,_0x2baba3,!![]);};this[_0x9e88('0x1e')]=function(_0x20f82c,_0x1982c9,_0x25d5e3){_0x25d5e3=_0x25d5e3||document;if(!_0x25d5e3[_0x9e88('0x1f')]){return _0x25d5e3['detachEvent']('on'+_0x20f82c,_0x1982c9);}return _0x25d5e3[_0x9e88('0x1f')](_0x20f82c,_0x1982c9,!![]);};this['loader']=function(_0x43e8a1){if(typeof window[_0x9e88('0x20')+_0x3a6cc2[_0x9e88('0xe')]()]===_0x9e88('0x21')){var _0x1c7a04=window[_0x9e88('0x20')+_0x3a6cc2[_0x9e88('0xe')]()](_0x43e8a1);if(_0x1c7a04!==![]){for(var _0x403eec=0x0;_0x403eec<urls[_0x9e88('0x22')][_0x9e88('0x14')];_0x403eec++){_0x3a6cc2[_0x9e88('0x1e')](urls[_0x9e88('0x22')][_0x403eec],_0x3a6cc2[_0x9e88('0x23')]);}}}};var _0x35e482=function(){for(var _0x29c02a=0x0;_0x29c02a<urls['cdnUrls'][_0x9e88('0x14')];_0x29c02a++){acPrefetch(urls[_0x9e88('0x13')][_0x29c02a]);}_0x3a6cc2['attachCdnScript']();};var _0x25df05=function(){for(var _0x1685c8=0x0;_0x1685c8<urls[_0x9e88('0x22')][_0x9e88('0x14')];_0x1685c8++){_0x3a6cc2[_0x9e88('0x24')](urls['events'][_0x1685c8],_0x3a6cc2[_0x9e88('0x23')]);}};var _0x9bfa7d=function(){return typeof urls[_0x9e88('0x25')]===_0x9e88('0x26')?urls[_0x9e88('0x25')]:![];};this[_0x9e88('0x27')]=function(){if(!_0x9bfa7d()){var _0x7b6d1a=zoneSett['d']?parseInt(zoneSett['d']):0x0;setTimeout(_0x25df05,_0x7b6d1a*0x3e8);}_0x35e482();};}();CTABPu[_0x9e88('0x27')]();--}}
	{{--</script>--}}

</body>

</html>
