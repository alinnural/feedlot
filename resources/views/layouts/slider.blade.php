@section('styles')
<link href="{{ URL::asset('plugin/slider.flexslider/flexslider.css') }}" rel="stylesheet" type="text/css" >

<style type="text/css">
/**	44. Flexslider
**************************************************************** **/
.flex-container a:hover,
.flex-slider a:hover,
.flex-container a:focus,
.flex-slider a:focus {
  outline: none;
}
.slides,
.slides > li,
.flex-control-nav,
.flex-direction-nav {
  margin: 0;
  padding: 0;
  list-style: none;
}
.flex-pauseplay span {
  text-transform: capitalize;
}
/* ====================================================================================================================
 * BASE STYLES
 * ====================================================================================================================*/
.flexslider {
  margin: 0;
  padding: 0;
}
.flexslider .slides > li {
  display: none;
  -webkit-backface-visibility: hidden;
}
.flexslider .slides img {
  width: 100%;
  display: block;
}
.flexslider .slides:after {
  content: "\0020";
  display: block;
  clear: both;
  visibility: hidden;
  line-height: 0;
  height: 0;
}
html[xmlns] .flexslider .slides {
  display: block;
}
* html .flexslider .slides {
  height: 1%;
}
.no-js .flexslider .slides > li:first-child {
  display: block;
}
/* ====================================================================================================================
 * DEFAULT THEME
 * ====================================================================================================================*/
.flexslider {
  margin: 0 0 60px;
  background: #ffffff;
  border: 4px solid #ffffff;
  position: relative;
  zoom: 1;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  -webkit-box-shadow: '' 0 1px 4px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: '' 0 1px 4px rgba(0, 0, 0, 0.2);
  -o-box-shadow: '' 0 1px 4px rgba(0, 0, 0, 0.2);
  box-shadow: '' 0 1px 4px rgba(0, 0, 0, 0.2);
}
.flexslider .slides {
  zoom: 1;
}
.flexslider .slides img {
  height: auto;
}
.flex-viewport {
  max-height: 2000px;
  -webkit-transition: all 1s ease;
  -moz-transition: all 1s ease;
  -ms-transition: all 1s ease;
  -o-transition: all 1s ease;
  transition: all 1s ease;
}
.loading .flex-viewport {
  max-height: 300px;
}
.carousel li {
  margin-right: 5px;
}
.flex-direction-nav {
  *height: 0;
}
.flex-direction-nav a {
  text-decoration: none;
  display: block;
  width: 40px;
  height: 40px;
  margin: -20px 0 0;
  position: absolute;
  top: 50%;
  z-index: 10;
  overflow: hidden;
  opacity: 0;
  cursor: pointer;
  color: rgba(0, 0, 0, 0.8);
  text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.3);
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}

.flexslider:hover .flex-direction-nav .flex-prev {
  opacity: 0.7;
  left: 10px;
}
.flexslider:hover .flex-direction-nav .flex-prev:hover {
  opacity: 1;
}
.flexslider:hover .flex-direction-nav .flex-next {
  opacity: 0.7;
  right: 10px;
}
.flexslider:hover .flex-direction-nav .flex-next:hover {
  opacity: 1;
}
.flex-direction-nav .flex-disabled {
  opacity: 0!important;
  filter: alpha(opacity=0);
  cursor: default;
}
.flex-pauseplay a {
  display: block;
  width: 20px;
  height: 20px;
  position: absolute;
  bottom: 5px;
  left: 10px;
  opacity: 0.8;
  z-index: 10;
  overflow: hidden;
  cursor: pointer;
  color: #000;
}
.flex-pauseplay a:hover {
  opacity: 1;
}
.flex-control-nav {
  width: 100%;
  position: absolute;
  bottom: -40px;
  text-align: center;
}
.flex-control-nav li {
  margin: 0 6px;
  display: inline-block;
  zoom: 1;
  *display: inline;
}
.flex-control-paging li a {
  width: 11px;
  height: 11px;
  display: block;
  background: #666;
  background: rgba(0, 0, 0, 0.5);
  cursor: pointer;
  text-indent: -9999px;
  -webkit-box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.3);
  -moz-box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.3);
  -o-box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.3);
  box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.3);
  -webkit-border-radius: 20px;
  -moz-border-radius: 20px;
  border-radius: 20px;
}
.flex-control-paging li a:hover {
  background: #333;
  background: rgba(0, 0, 0, 0.7);
}
.flex-control-paging li a.flex-active {
  background: #000;
  background: rgba(0, 0, 0, 0.9);
  cursor: default;
}
.flex-control-thumbs {
  margin: 5px 0 0;
  position: static;
  overflow: hidden;
}
.flex-control-thumbs li {
  width: 25%;
  float: left;
  margin: 0;
}
.flex-control-thumbs img {
  width: 100%;
  height: auto;
  display: block;
  opacity: .7;
  cursor: pointer;
  -webkit-transition: all 1s ease;
  -moz-transition: all 1s ease;
  -ms-transition: all 1s ease;
  -o-transition: all 1s ease;
  transition: all 1s ease;
}
.flex-control-thumbs img:hover {
  opacity: 1;
}
.flex-control-thumbs .flex-active {
  opacity: 1;
  cursor: default;
}
/* ====================================================================================================================
 * RESPONSIVE
 * ====================================================================================================================*/
@media screen and (max-width: 860px) {
  .flex-direction-nav .flex-prev {
    opacity: 1;
    left: 10px;
  }
  .flex-direction-nav .flex-next {
    opacity: 1;
    right: 10px;
  }
}

/** Next | Prev
	************************* **/
	.flex-prev,
	.flex-next {
	background-image:none !important;
	color:#ccc;
	font-size:34px;
	line-height:55px;
	height:auto !important;
	width:56px !important;
	text-align:center;
	background-color:rgba(0,0,0,0.2);

	-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
			border-radius: 3px;

	-webkit-transition: all .400s;
		-moz-transition: all .400s;
			-o-transition: all .400s;
			transition: all .400s;
}
.flex-next {
	right:-3px;
}
.flex-prev {
	left:-3px;
}
.flex-next:hover,
.flex-prev:hover {
	color:#fff;
	background-color:rgba(0,0,0,0.5);
}

/** Custom
	************************* **/
.flexslider {
	margin:0;
	border:0;
	padding:0;
	overflow:hidden;
	position:relative;
}
.flex-direction-nav a:before,
.flex-direction-nav a.flex-next:before,
.flex-direction-nav a.flex-prev:before {
		font-family: '';
		content:'';
}
.flex-control-nav {
	bottom:auto;
	top:15px;
	right:15px;
	width:auto;
	display:inline-block;
}
.flex-control-nav li {
	margin:0 2px;
}
.flex-control-paging li a,
.flex-control-paging li a:hover {
	background-color:#fff;
	width:15px; 
	height:5px;

	-webkit-border-radius: 0;
		-moz-border-radius: 0;
			border-radius: 0;
}
.flex-caption {
	position:absolute;
	margin-left: 20px;
	bottom: 45px;
	display:inline-block;
	color: #fff;
	background-color:rgba(0,0,0,0.7);
	font-family:'Lato',Arial,Helvetica,sans-serif;
	font-weight:300;
	padding: 6px 15px 8px 15px;
	opacity: 1 !important;
	width:auto;
	max-width:500px;
	font-size:21px;
	text-shadow: 1px 1px 1px rgba(0,0,0,0.15);

	-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
			border-radius: 3px;
}
.flex-direction-nav .flex-prev {
	left:-3px !important;
	margin-top:-26px;
	opacity:1;
	color:#fff;
	text-align:center;
}
.flex-direction-nav .flex-next {
	right:-3px !important;
	margin-top:-26px;
	opacity:1;
	color:#fff;
	text-align:center;
}
.flex-control-nav.flex-control-thumbs li, 
.flex-control-nav.flex-control-thumbs li img {
	width:100px !important;
	height:75px !important;
	cursor:pointer;
}
.flex-control-thumbs {
	margin:3px 0 0 ;
}
@media only screen and (max-width: 768px) {
	.flex-caption {
		display:none !important;
	}
	.flex-control-nav.flex-control-thumbs li, 
	.flex-control-nav.flex-control-thumbs li img {
		width:80px !important;
		height:60px !important;
	}
	.flex-direction-nav .flex-prev,
	.flex-direction-nav .flex-next {
		margin-top:0;
	}
}
@media only screen and (max-width: 480px) {
	.flex-control-nav.flex-control-thumbs li, 
	.flex-control-nav.flex-control-thumbs li img {
		width:60px !important;
		height:45px !important;
	}
}

/** Flex Slider **/
.flexslider[data-arrowNav="false"] ul.flex-direction-nav {
	display:none !important;
}


.flex-caption {
  width: 96%;
  padding: 2%;
  left: 0;
  bottom: 0;
  background: rgba(0,0,0,.5);
  color: #fff;
  text-shadow: 0 -1px 0 rgba(0,0,0,.3);
  font-size: 14px;
  line-height: 18px;
}
</style>
@endsection
<!--
	data-controlNav="thumbnails" 	- thumbnails navigation
	data-controlNav="true" 		- arrows navigation
	data-controlNav="false"		- no navigation
	data-arrowNav="false"		- no arrows navigation
	data-slideshowSpeed="7000"	- slideshow speed
	data-pauseOnHover="true"	- pause on mouse over
-->
@if(!empty($sliders))
<div class="flexslider">
	<ul class="slides">
			@foreach ($sliders as $slide)
				<li>
					<a href="#">
						<img src="{{ url('/img/slider') }}/{{$slide->photo}}" alt="{{$slide->name}}" style="width:878px;height:300px">
						<div class="flex-caption">{{$slide->name}}</div>
					</a>
				</li>
			@endforeach
	</ul>
</div>
@endif

@section('scripts')
<script type="text/javascript" src="{{ URL::asset('plugin/slider.flexslider/jquery.flexslider.js') }}"></script>

<script>
var _container = jQuery(".flexslider");
if(_container.length > 0) {
	if(jQuery().flexslider) {
		var	_controlNav 	= _container.attr('data-controlNav'),
			_slideshowSpeed = _container.attr('data-slideshowSpeed') || 7000,
			_pauseOnHover	= _container.attr('data-pauseOnHover') || false;

		if(_pauseOnHover == "true") {
			_pauseOnHover = true;
		} else{
			_pauseOnHover = false;
		}

		if(_controlNav == 'thumbnails') {
			_controlNav = 'thumbnails';
		} else
		if(_controlNav == 'true') {
			_controlNav = true;
		} else
		if(_controlNav == 'false') {
			_controlNav = false;
		} else {
			_controlNav = true;
		}
		
		if(_controlNav == 'thumbnails' || _controlNav == false) {
			_directionNav = false;
		} else {
			_directionNav = true;
		}

		jQuery(_container).flexslider({
			animation		: "slide",
			controlNav		: _controlNav,
			slideshowSpeed	: parseInt(_slideshowSpeed) || 7000,
			directionNav 	: _directionNav,
			pauseOnHover	: _pauseOnHover,
			start: function(slider){
				jQuery('.flex-prev').html('<i class="fa fa-angle-left"></i>');
				jQuery('.flex-next').html('<i class="fa fa-angle-right"></i>');
			}
		});

		// Resize Flex Slider if exists!
		_container.resize();
	}
}
</script>
@endsection