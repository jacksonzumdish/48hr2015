<!DOCTYPE html>
<html id="presentation">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width">
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r71/three.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>

		<script src="level.js"></script>
		<script src="controller.js"></script>
		<script src="jsfx.js"></script>
		<script src="sound.js"></script>
		<script src="soundloops.js"></script>
		
		<script src="CopyShader.js"></script>
		<script src="rgbshift.js"></script>
		<script src="EffectComposer.js"></script>
		<script src="MaskPass.js"></script>
		<script src="RenderPass.js"></script>
		<script src="ShaderPass.js"></script>

		<style type="text/css">
			body {
				font-family: "Futura", sans;
				margin: 0;
				padding: 0;
			}
			.logo {
				position:fixed;
				height:100%;
				top:0;
				z-index: 500;
			}
			#gamepadPrompt {
				position: fixed;
				top:0;
				left:0;
				font-size: 30px;
				color:#fff;
				visibility: hidden;
			}
			#gamepadDisplay {
				position: fixed;
				top:20px;
				left:0;
				font-size: 30px;
				color:#fff;
				visibility: hidden;
			}
			#locationDisplay {
				position: fixed;
				top:50px;
				left:0;
				font-size: 30px;
				color:#f00;
				visibility: hidden;
			}
			#instruction_fly {
				width:300px;
				position: absolute;
				left:50%;
				margin-left: -150px;
				top:50%;
				margin-top: 150px;
			}
			#instruction_collapse {
				width:500px;
				position: absolute;
				left:50%;
				margin-left: -250px;
				top:50%;
				margin-top: 150px;
			}
			#oliverlardner {
				width:200px;
				position: absolute;
				right:50px;
				bottom:50px;
			}
		</style>
		
	</head>
	<body id="fullscreen">

	<div id="gamepadPrompt"></div>
	<div id="gamepadDisplay"></div>
	<div id="locationDisplay">0</div>

	<svg version="1.1" id="instruction_fly" class="instructions" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 348 154.4" style="enable-background:new 0 0 348 154.4;" xml:space="preserve">
	<style type="text/css">
		.st4{fill:none;stroke:#000000;stroke-width:4;stroke-miterlimit:10;}
	</style>
	<g id="XMLID_1_">
		<path id="XMLID_3_" d="M266,54.4h-21v14.5h20.3v8.6H245v28.7h-9.1V45.9H266V54.4z"/>
		<path id="XMLID_6_" d="M285.7,45.9v51.8h17.7v8.6h-26.8V45.9H285.7z"/>
		<path id="XMLID_10_" d="M319.1,80.1l-19.7-34.3h10.5L323.7,70l13.8-24.1H348l-19.8,34.3v26.1h-9.1V80.1z"/>
	</g>
	<circle id="XMLID_9_" class="st4" cx="77.2" cy="77.2" r="75.2"/>
	<line id="XMLID_8_" class="st4" x1="31" y1="31" x2="123.4" y2="123.4"/>
	<line id="XMLID_5_" class="st4" x1="123.4" y1="31" x2="31" y2="123.4"/>
	</svg>



	<svg version="1.1" id="instruction_collapse" class="instructions" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 619.8 154.4" style="enable-background:new 0 0 619.8 154.4;" xml:space="preserve">
	<style type="text/css">
		.st0{fill:none;stroke:#FFFFFF;stroke-width:4;stroke-miterlimit:10;}
		.st1{fill:#FFFFFF;}
	</style>
	<circle id="XMLID_6_" class="st0" cx="77.2" cy="77.2" r="75.2"/>
	<circle id="XMLID_7_" class="st0" cx="77.2" cy="77.2" r="53"/>
	<g id="XMLID_2_">
		<path id="XMLID_3_" class="st1" d="M280.5,49.1v10.8c-5.3-4.4-10.7-6.6-16.3-6.6c-6.2,0-11.4,2.2-15.7,6.7
			c-4.3,4.4-6.4,9.8-6.4,16.2c0,6.3,2.1,11.7,6.4,16c4.3,4.3,9.5,6.5,15.7,6.5c3.2,0,5.9-0.5,8.2-1.6c1.2-0.5,2.5-1.2,3.9-2.1
			c1.3-0.9,2.8-2,4.2-3.2v11c-5.2,2.9-10.7,4.4-16.4,4.4c-8.6,0-16-3-22.1-9c-6.1-6.1-9.1-13.4-9.1-22c0-7.7,2.5-14.5,7.6-20.5
			c6.2-7.4,14.3-11.1,24.3-11.1C270.2,44.7,275.4,46.2,280.5,49.1z"/>
		<path id="XMLID_5_" class="st1" d="M288.6,75.8c0-8.5,3.1-15.8,9.3-21.9c6.2-6.1,13.6-9.1,22.3-9.1c8.6,0,16,3.1,22.1,9.2
			c6.2,6.1,9.3,13.5,9.3,22.1c0,8.7-3.1,16-9.3,22.1c-6.2,6.1-13.7,9.1-22.5,9.1c-7.8,0-14.8-2.7-21-8.1
			C292,93.2,288.6,85.4,288.6,75.8z M297.8,75.9c0,6.7,2.2,12.1,6.7,16.4c4.5,4.3,9.6,6.4,15.4,6.4c6.3,0,11.7-2.2,16-6.6
			c4.3-4.4,6.5-9.8,6.5-16.2c0-6.4-2.1-11.8-6.4-16.2c-4.3-4.4-9.6-6.6-15.9-6.6c-6.3,0-11.6,2.2-15.9,6.6
			C299.9,64.2,297.8,69.5,297.8,75.9z"/>
		<path id="XMLID_10_" class="st1" d="M372.2,45.9v51.8h17.7v8.6h-26.8V45.9H372.2z"/>
		<path id="XMLID_12_" class="st1" d="M407.6,45.9v51.8h17.7v8.6h-26.8V45.9H407.6z"/>
		<path id="XMLID_14_" class="st1" d="M472.8,91.5H447l-6.7,14.6h-9.8l29.8-64.1l28.8,64.1h-10L472.8,91.5z M469.1,83l-8.9-20.5
			L450.8,83H469.1z"/>
		<path id="XMLID_17_" class="st1" d="M505.7,81.7v24.5h-9.1V45.9h10.3c5.1,0,8.9,0.4,11.4,1.1c2.6,0.7,4.9,2,6.9,4
			c3.5,3.4,5.2,7.7,5.2,12.8c0,5.5-1.8,9.9-5.5,13.1c-3.7,3.2-8.7,4.8-15,4.8H505.7z M505.7,73.3h3.4c8.4,0,12.5-3.2,12.5-9.6
			c0-6.2-4.3-9.3-12.9-9.3h-3V73.3z"/>
		<path id="XMLID_20_" class="st1" d="M573.9,54.9l-7.4,4.4c-1.4-2.4-2.7-4-3.9-4.7c-1.3-0.8-3-1.2-5-1.2c-2.5,0-4.6,0.7-6.3,2.1
			c-1.7,1.4-2.5,3.2-2.5,5.3c0,2.9,2.2,5.3,6.6,7.1l6,2.5c4.9,2,8.5,4.4,10.7,7.2s3.4,6.3,3.4,10.5c0,5.5-1.8,10.1-5.5,13.8
			c-3.7,3.6-8.3,5.5-13.9,5.5c-5.2,0-9.6-1.5-13-4.6c-3.4-3.1-5.5-7.5-6.3-13.1l9.2-2c0.4,3.5,1.1,6,2.2,7.3c1.9,2.6,4.6,3.9,8.2,3.9
			c2.8,0,5.2-1,7.1-2.9c1.9-1.9,2.8-4.3,2.8-7.2c0-1.2-0.2-2.2-0.5-3.2c-0.3-1-0.8-1.9-1.5-2.7c-0.7-0.8-1.6-1.6-2.7-2.3
			c-1.1-0.7-2.4-1.4-3.9-2.1l-5.8-2.4c-8.3-3.5-12.4-8.6-12.4-15.3c0-4.5,1.7-8.3,5.2-11.4c3.5-3.1,7.8-4.6,12.9-4.6
			C564.6,44.7,570,48.1,573.9,54.9z"/>
		<path id="XMLID_22_" class="st1" d="M619.8,54.4h-24.2v14.5h23.5v8.6h-23.5v20.2h24.2v8.6h-33.3V45.9h33.3V54.4z"/>
	</g>
	</svg>


	<!-- Generator: Adobe Illustrator 19.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
	<svg version="1.1" id="oliverlardner" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		 viewBox="0 0 200.9 17.1" style="enable-background:new 0 0 200.9 17.1;" xml:space="preserve">
	<g id="OLIVEXMLID_5_">
		<path id="OLIVEXMLID_6_" d="M15.6,8.9c0,2.2-0.8,4-2.3,5.6s-3.4,2.3-5.5,2.3s-4-0.8-5.5-2.3C0.8,13,0,11.1,0,8.9c0-1.2,0.2-2.3,0.7-3.3
			c0.5-1.1,1.2-2,2.1-2.7c1.5-1.2,3.1-1.8,4.9-1.8c1.2,0,2.3,0.2,3.3,0.7c1.4,0.6,2.5,1.6,3.3,2.9C15.2,6,15.6,7.4,15.6,8.9z
			 M7.8,2.2c-1.8,0-3.3,0.7-4.6,2C1.9,5.5,1.3,7.1,1.3,8.9c0,1.9,0.6,3.4,1.9,4.8c1.3,1.3,2.8,2,4.6,2c1.8,0,3.3-0.7,4.6-2
			c1.3-1.3,1.9-2.9,1.9-4.8c0-1-0.3-2-0.8-3.1c-0.5-1-1.2-1.8-2-2.4C10.5,2.7,9.2,2.2,7.8,2.2z M10.8,5v2l-0.2-0.2
			C9.8,6.1,9,5.8,8.2,5.8c-0.9,0-1.6,0.3-2.2,0.9C5.3,7.3,5,8.1,5,9s0.3,1.6,0.9,2.2c0.6,0.6,1.4,0.9,2.2,0.9c0.8,0,1.6-0.3,2.4-1
			l0.2-0.2v2c-0.9,0.5-1.8,0.7-2.7,0.7c-1.3,0-2.5-0.5-3.4-1.4s-1.4-2-1.4-3.3c0-1.3,0.5-2.4,1.4-3.3s2.1-1.4,3.5-1.4
			C9.1,4.3,9.9,4.5,10.8,5L10.8,5z"/>
		<path id="OLIVEXMLID_10_" d="M21.4,14.4H27v2.1H16.9l5.2-6.3c0.5-0.6,0.9-1.2,1.3-1.6s0.6-0.8,0.8-1.2c0.4-0.6,0.6-1.2,0.6-1.7
			c0-0.7-0.2-1.3-0.7-1.8s-1.1-0.7-1.8-0.7c-1.5,0-2.4,0.9-2.6,2.7h-2.3c0.4-3.2,2-4.8,4.8-4.8c1.4,0,2.5,0.4,3.5,1.3
			c0.9,0.9,1.4,2,1.4,3.2c0,0.8-0.2,1.6-0.7,2.4c-0.2,0.4-0.5,0.9-1,1.5s-1,1.2-1.6,2L21.4,14.4z"/>
		<path id="OLIVEXMLID_12_" d="M29.6,8.9c0-2.4,0.6-4.3,1.7-5.8c1-1.3,2.2-1.9,3.6-1.9s2.6,0.6,3.6,1.9c1.1,1.4,1.7,3.4,1.7,5.8
			c0,2.5-0.6,4.4-1.7,5.8c-1,1.3-2.2,1.9-3.6,1.9s-2.6-0.6-3.7-1.9C30.1,13.4,29.6,11.4,29.6,8.9z M31.8,8.9c0,1.7,0.3,3.1,0.9,4.2
			c0.6,1.1,1.3,1.6,2.2,1.6c0.9,0,1.6-0.5,2.2-1.6C37.7,12,38,10.6,38,8.9s-0.3-3-0.9-4.1c-0.6-1.1-1.3-1.6-2.2-1.6
			c-0.9,0-1.6,0.5-2.2,1.6C32.1,5.9,31.8,7.3,31.8,8.9z"/>
		<path id="OLIVEXMLID_15_" d="M45,3.5h-2.6l1.2-2.1h3.6v15.1H45V3.5z"/>
		<path id="OLIVEXMLID_17_" d="M60.8,3.5h-4.6L55.4,6c0.1,0,0.2,0,0.3,0s0.2,0,0.3,0c1.5,0,2.7,0.5,3.6,1.5c0.9,1,1.4,2.2,1.4,3.8
			c0,1.6-0.5,2.9-1.6,3.9s-2.4,1.5-4,1.5c-2,0-3.6-0.9-4.7-2.8l1.7-1.5c0.5,0.8,1,1.4,1.4,1.7c0.5,0.3,1.1,0.5,1.8,0.5
			c0.9,0,1.7-0.3,2.3-1c0.6-0.7,0.9-1.5,0.9-2.4c0-1-0.3-1.8-0.9-2.4C57.3,8.3,56.5,8,55.6,8c-1,0-1.9,0.4-2.6,1.3h-0.8l2.4-7.9h6.2
			V3.5z"/>
		<path id="OLIVEXMLID_19_" d="M69.9,8.9c0-2.1,0.8-3.9,2.3-5.5c1.5-1.5,3.4-2.3,5.6-2.3c2.1,0,4,0.8,5.5,2.3C84.9,5,85.6,6.8,85.6,9
			c0,2.2-0.8,4-2.3,5.5c-1.6,1.5-3.4,2.3-5.6,2.3c-1.9,0-3.7-0.7-5.2-2C70.7,13.3,69.9,11.3,69.9,8.9z M72.2,8.9c0,1.7,0.6,3,1.7,4.1
			c1.1,1.1,2.4,1.6,3.9,1.6c1.6,0,2.9-0.5,4-1.6c1.1-1.1,1.6-2.5,1.6-4c0-1.6-0.5-3-1.6-4c-1.1-1.1-2.4-1.6-4-1.6
			c-1.6,0-2.9,0.5-4,1.6C72.7,6,72.2,7.3,72.2,8.9z"/>
		<path id="OLIVEXMLID_22_" d="M90.3,0v16.5h-2.2V0H90.3z"/>
		<path id="OLIVEXMLID_24_" d="M92.7,3c0-0.4,0.1-0.7,0.4-1s0.6-0.4,1-0.4c0.4,0,0.7,0.1,1,0.4c0.3,0.3,0.4,0.6,0.4,1s-0.1,0.7-0.4,1
			c-0.3,0.3-0.6,0.4-1,0.4s-0.7-0.1-1-0.4S92.7,3.4,92.7,3z M95.3,7v9.5h-2.2V7H95.3z"/>
		<path id="OLIVEXMLID_27_" d="M99.2,7l2.5,5.3l2.5-5.3h2.5l-4.9,10.2L96.8,7H99.2z"/>
		<path id="OLIVEXMLID_29_" d="M116.4,12.3h-6.8c0.1,0.8,0.3,1.4,0.8,1.9c0.4,0.5,1,0.7,1.7,0.7c0.5,0,1-0.1,1.4-0.4
			c0.4-0.3,0.8-0.7,1.2-1.4l1.9,1c-0.3,0.5-0.6,0.9-0.9,1.3s-0.7,0.6-1,0.9s-0.8,0.4-1.2,0.5s-0.9,0.2-1.4,0.2
			c-1.4,0-2.6-0.5-3.4-1.4c-0.9-0.9-1.3-2.1-1.3-3.7c0-1.5,0.4-2.7,1.2-3.7c0.8-0.9,2-1.4,3.3-1.4c1.4,0,2.5,0.4,3.3,1.3
			c0.8,0.9,1.2,2.1,1.2,3.7L116.4,12.3z M114.2,10.5c-0.3-1.2-1-1.8-2.2-1.8c-0.3,0-0.5,0-0.8,0.1s-0.4,0.2-0.6,0.4s-0.4,0.3-0.5,0.6
			s-0.2,0.5-0.3,0.7H114.2z"/>
		<path id="OLIVEXMLID_32_" d="M118.8,7h2.2v0.8c0.4-0.4,0.8-0.7,1.1-0.9c0.3-0.2,0.7-0.2,1.1-0.2c0.6,0,1.2,0.2,1.8,0.6l-1,2
			c-0.4-0.3-0.8-0.4-1.2-0.4c-1.2,0-1.8,0.9-1.8,2.7v4.9h-2.2V7z"/>
		<path id="OLIVEXMLID_34_" d="M135.2,1.4v12.9h4.4v2.1h-6.7V1.4H135.2z"/>
		<path id="OLIVEXMLID_36_" d="M148.3,7h2.2v9.5h-2.2v-1c-0.9,0.8-1.9,1.3-2.9,1.3c-1.3,0-2.4-0.5-3.3-1.4c-0.9-1-1.3-2.2-1.3-3.6
			c0-1.4,0.4-2.6,1.3-3.6s1.9-1.4,3.2-1.4c1.1,0,2.1,0.5,3,1.4V7z M143.1,11.7c0,0.9,0.2,1.7,0.7,2.2c0.5,0.6,1.1,0.9,1.9,0.9
			c0.8,0,1.5-0.3,2-0.8c0.5-0.6,0.8-1.3,0.8-2.2s-0.3-1.6-0.8-2.2c-0.5-0.6-1.2-0.8-2-0.8c-0.8,0-1.4,0.3-1.9,0.9
			C143.4,10.1,143.1,10.9,143.1,11.7z"/>
		<path id="OLIVEXMLID_39_" d="M153.3,7h2.2v0.8c0.4-0.4,0.8-0.7,1.1-0.9c0.3-0.2,0.7-0.2,1.1-0.2c0.6,0,1.2,0.2,1.8,0.6l-1,2
			c-0.4-0.3-0.8-0.4-1.2-0.4c-1.2,0-1.8,0.9-1.8,2.7v4.9h-2.2V7z"/>
		<path id="OLIVEXMLID_41_" d="M167.7,0h2.2v16.5h-2.2v-1c-0.9,0.8-1.8,1.3-2.9,1.3c-1.3,0-2.4-0.5-3.2-1.4c-0.9-1-1.3-2.2-1.3-3.6
			c0-1.4,0.4-2.6,1.3-3.6c0.8-1,1.9-1.4,3.2-1.4c1.1,0,2.1,0.5,3,1.4V0z M162.5,11.7c0,0.9,0.2,1.7,0.7,2.2c0.5,0.6,1.1,0.9,1.9,0.9
			c0.8,0,1.5-0.3,2-0.8c0.5-0.6,0.8-1.3,0.8-2.2s-0.3-1.6-0.8-2.2c-0.5-0.6-1.2-0.8-2-0.8c-0.8,0-1.4,0.3-1.9,0.9
			C162.7,10.1,162.5,10.9,162.5,11.7z"/>
		<path id="OLIVEXMLID_44_" d="M172.7,7h2.2v0.9c0.8-0.8,1.6-1.1,2.6-1.1c1.1,0,2,0.3,2.6,1c0.5,0.6,0.8,1.6,0.8,2.9v5.8h-2.2v-5.3
			c0-0.9-0.1-1.6-0.4-1.9c-0.3-0.4-0.7-0.5-1.4-0.5c-0.7,0-1.2,0.2-1.6,0.7c-0.3,0.5-0.4,1.3-0.4,2.5v4.6h-2.2V7z"/>
		<path id="OLIVEXMLID_46_" d="M192.3,12.3h-6.8c0.1,0.8,0.3,1.4,0.8,1.9c0.4,0.5,1,0.7,1.7,0.7c0.5,0,1-0.1,1.4-0.4
			c0.4-0.3,0.8-0.7,1.2-1.4l1.9,1c-0.3,0.5-0.6,0.9-0.9,1.3s-0.7,0.6-1,0.9s-0.8,0.4-1.2,0.5s-0.9,0.2-1.4,0.2
			c-1.4,0-2.6-0.5-3.4-1.4c-0.9-0.9-1.3-2.1-1.3-3.7c0-1.5,0.4-2.7,1.2-3.7c0.8-0.9,2-1.4,3.3-1.4c1.4,0,2.5,0.4,3.3,1.3
			c0.8,0.9,1.2,2.1,1.2,3.7L192.3,12.3z M190,10.5c-0.3-1.2-1-1.8-2.2-1.8c-0.3,0-0.5,0-0.8,0.1s-0.4,0.2-0.6,0.4s-0.4,0.3-0.5,0.6
			s-0.2,0.5-0.3,0.7H190z"/>
		<path id="OLIVEXMLID_49_" d="M194.7,7h2.2v0.8c0.4-0.4,0.8-0.7,1.1-0.9c0.3-0.2,0.7-0.2,1.1-0.2c0.6,0,1.2,0.2,1.8,0.6l-1,2
			c-0.4-0.3-0.8-0.4-1.2-0.4c-1.2,0-1.8,0.9-1.8,2.7v4.9h-2.2V7z"/>
	</g>
	</svg>



		
	<script>
	



	var container;
	var camera, scene, renderer, composer, rgbShiftEffect, particles, geometry, materials = [],
	  parameters, i, h, color, size, cube;
	var mouseX = 0,
	  mouseY = 0;

	var windowHalfX = window.innerWidth / 2;
	var windowHalfY = window.innerHeight / 2;

	var birdModelGroup, meshWingLeft, meshWingRight, meshTail, meshTailGroup, crownModelGroup;

	init();
	animate();

	function init() {

	  container = document.createElement('div');
	  document.body.appendChild(container);

	  camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 1, 10000);
	  camera.position.z = 1000;

	  scene = new THREE.Scene();
	  scene.fog = new THREE.FogExp2(0x040404, 0.0002);

	  	// demo
	  	
	  	/*
	  	for(var i=0; i<100; i++) {
	  		var mySize = Math.random()*100;
			var geometry = new THREE.BoxGeometry( Math.random()*100, Math.random()*200, Math.random()*100 );
			var material = new THREE.MeshBasicMaterial( {color: 0x000000} );
			var cube = new THREE.Mesh( geometry, material );
			cube.position.x = 500 - Math.random()*1000;
			cube.position.y = 500 - Math.random()*1000;
			cube.position.z = 3000 - Math.random()*7000;
			scene.add( cube );
			TweenMax.to(cube.position, 1, {z:"+=3000", repeat:-1, ease:Linear.easeNone});
		}
		*/
		

	  		// bird
	  		birdModelGroup = new THREE.Object3D();//create an empty container
			//group.add( mesh );//add a mesh with geometry to it
			//scene.add( group );//when done, add the group to the scene

	  		// wing left
		  	var geom = new THREE.Geometry();
			var v1 = new THREE.Vector3(0,300,0);
			var v2 = new THREE.Vector3(300,100,0);
			var v3 = new THREE.Vector3(200,0,0);
			console.log(geom.vertices)
			geom.vertices.push( v1 );
			geom.vertices.push( v2 );
			geom.vertices.push( v3 );
			geom.faces.push( new THREE.Face3( 0, 1, 2 ) );
			geom.computeFaceNormals();
			meshWingLeft = new THREE.Mesh( geom, new THREE.MeshBasicMaterial( {color: 0x000000, side: THREE.DoubleSide} ) );
			meshWingLeft.position.x = -300;
			meshWingLeft.rotation.x = 3.14159;
			meshWingLeft.position.y = 300;
			birdModelGroup.add(meshWingLeft);

			// wing right
			var geom = new THREE.Geometry();
			var v1 = new THREE.Vector3(0,300,0);
			var v2 = new THREE.Vector3(300,100,0);
			var v3 = new THREE.Vector3(200,0,0);
			console.log(geom.vertices)
			geom.vertices.push( v1 );
			geom.vertices.push( v2 );
			geom.vertices.push( v3 );
			geom.faces.push( new THREE.Face3( 0, 1, 2 ) );
			geom.computeFaceNormals();
			meshWingRight = new THREE.Mesh( geom, new THREE.MeshBasicMaterial( {color: 0x000000, side: THREE.DoubleSide} ) );
			meshWingRight.position.x = 300;
			meshWingRight.rotation.x = 3.14159;
			meshWingRight.rotation.y = 3.14159;
			meshWingRight.position.y = 300;
			birdModelGroup.add(meshWingRight);

			// tail
			var geom = new THREE.Geometry();
			var v1 = new THREE.Vector3(0,0,0);
			var v2 = new THREE.Vector3(100,200,0);
			var v3 = new THREE.Vector3(200,0,0);
			console.log(geom.vertices)
			geom.vertices.push( v1 );
			geom.vertices.push( v2 );
			geom.vertices.push( v3 );
			geom.faces.push( new THREE.Face3( 0, 1, 2 ) );
			geom.computeFaceNormals();
			meshTail = new THREE.Mesh( geom, new THREE.MeshBasicMaterial( {color: 0x000000, side: THREE.DoubleSide} ) );
			meshTail.position.x = -100;
			meshTail.position.y = -50;
			meshTailGroup = new THREE.Object3D();
			meshTailGroup.add(meshTail);
			birdModelGroup.add(meshTailGroup);

			scene.add(birdModelGroup);

			//TweenMax.to(birdModelGroup.rotation, 1, { x: -1.5 });
			//TweenMax.to(meshWingRight.scale, 1, { x:0.1, repeat:-1, yoyo:true, ease:Cubic.easeInOut});
			//TweenMax.to(birdModelGroup.scale, 10, { y: 2, x: 2, ease: Linear.easeNone });


			// crown
			crownModelGroup = new THREE.Object3D();//create an empty container

			// reflective material
			var dataURL_col = "images/gold.png";
			var urls_col = [
			  dataURL_col, dataURL_col,
			  dataURL_col, dataURL_col,
			  dataURL_col, dataURL_col
			];
			var textureCube_col = THREE.ImageUtils.loadTextureCube(urls_col, THREE.CubeRefractionMapping);
			var material_col = new THREE.MeshBasicMaterial({
			  color: 0xffffff,
			  envMap: textureCube_col,
			  side: THREE.DoubleSide,
			  refractionRatio: 0.4
			});


			// crown shards
			var geom = new THREE.Geometry();
			var v1 = new THREE.Vector3(0,0,0);
			var v2 = new THREE.Vector3(100,310,0);
			var v3 = new THREE.Vector3(200,0,0);
			geom.vertices.push( v1 );
			geom.vertices.push( v2 );
			geom.vertices.push( v3 );
			geom.faces.push( new THREE.Face3( 0, 1, 2 ) );
			geom.computeFaceNormals();
			var meshShard = new THREE.Mesh( geom, material_col );
			meshShard.position.x = -75;
			meshShard.position.z = -100;
			crownModelGroup.add(meshShard);

			// back
			var geom = new THREE.Geometry();
			var v1 = new THREE.Vector3(0,0,0);
			var v2 = new THREE.Vector3(100,200,0);
			var v3 = new THREE.Vector3(200,0,0);
			geom.vertices.push( v1 );
			geom.vertices.push( v2 );
			geom.vertices.push( v3 );
			geom.faces.push( new THREE.Face3( 0, 1, 2 ) );
			geom.computeFaceNormals();
			var meshShard = new THREE.Mesh( geom, material_col );
			meshShard.position.x = -75;
			meshShard.position.z = 100;
			crownModelGroup.add(meshShard);

			// sides
			var geom = new THREE.Geometry();
			var v1 = new THREE.Vector3(0,0,0);
			var v2 = new THREE.Vector3(100,200,0);
			var v3 = new THREE.Vector3(200,0,0);
			geom.vertices.push( v1 );
			geom.vertices.push( v2 );
			geom.vertices.push( v3 );
			geom.faces.push( new THREE.Face3( 0, 1, 2 ) );
			geom.computeFaceNormals();
			var meshShard = new THREE.Mesh( geom, material_col );
			meshShard.position.x = -75;
			meshShard.position.z = 100;
			meshShard.rotation.y = 1.5708;
			crownModelGroup.add(meshShard);

			var geom = new THREE.Geometry();
			var v1 = new THREE.Vector3(0,0,0);
			var v2 = new THREE.Vector3(100,200,0);
			var v3 = new THREE.Vector3(200,0,0);
			geom.vertices.push( v1 );
			geom.vertices.push( v2 );
			geom.vertices.push( v3 );
			geom.faces.push( new THREE.Face3( 0, 1, 2 ) );
			geom.computeFaceNormals();
			var meshShard = new THREE.Mesh( geom, material_col );
			meshShard.position.x = 125;
			meshShard.position.z = 100;
			meshShard.rotation.y = 1.5708;
			crownModelGroup.add(meshShard);

			var cubeHolder = new THREE.Object3D();//create an empty container
			var geometry = new THREE.BoxGeometry( 30, 30, 30 );
			var cube = new THREE.Mesh( geometry, material_col );
			cube.rotation.z = 0.785398;
			cube.rotation.x = 0.785398;
			cubeHolder.add( cube );
			cubeHolder.position.y = 330;
			cubeHolder.position.x = 25;
			cubeHolder.position.z = -100;
			crownModelGroup.add( cubeHolder );

			scene.add(crownModelGroup);

			TweenMax.to(crownModelGroup.rotation, 30, { y: 6.28319, repeat:-1, ease:Linear.easeNone });
			TweenMax.to(cubeHolder.rotation, 6, { y: 6.28319, repeat:-1, ease:Linear.easeNone });

			TweenMax.to(crownModelGroup.scale, 0, { x: 1, y: 1, z: 1 });
			TweenMax.to(crownModelGroup.position, 0, { y: 0, z: -10000 });

			//TweenMax.to(meshWingLeft.scale, 2, { y: 8, ease: Bounce.easeOut, yoyo:true, repeat:1, delay: 2 });
			//TweenMax.to( $('.logo'), 0, { left: "+=100%", ease: Linear.easeNone });
			//TweenMax.to( $('.logo'), 10, { left: "-=0", ease: Linear.easeNone });


	  renderer = new THREE.WebGLRenderer();
	  renderer.setClearColor( 0xffffff, 1);
	  renderer.setPixelRatio(window.devicePixelRatio);
	  renderer.setSize(window.innerWidth, window.innerHeight);
	  container.appendChild(renderer.domElement);


	  // postprocessing

		composer = new THREE.EffectComposer( renderer );
		composer.addPass( new THREE.RenderPass( scene, camera ) );

		rgbShiftEffect = new THREE.ShaderPass( THREE.RGBShiftShader );
		rgbShiftEffect.uniforms[ 'amount' ].value = 0.001;
		rgbShiftEffect.enabled;
		composer.addPass( rgbShiftEffect );

		var effect = new THREE.ShaderPass( THREE.CopyShader);
		effect.renderToScreen = true;
		composer.addPass( effect );



	  window.addEventListener('resize', onWindowResize, false);

	}

	function onWindowResize() {

	  windowHalfX = window.innerWidth / 2;
	  windowHalfY = window.innerHeight / 2;

	  camera.aspect = window.innerWidth / window.innerHeight;
	  camera.updateProjectionMatrix();

	  renderer.setSize(window.innerWidth, window.innerHeight);

	}

	//

	function animate() {
		// animate with TweenMax tick instead
		TweenMax.ticker.addEventListener("tick", render);
	}
	function render() {
	  camera.lookAt(scene.position);

	  //composer.render();
	  renderer.render(scene, camera);
	}





	var e = document.getElementById("fullscreen");
    e.onclick = function() {
      if (RunPrefixMethod(document, "FullScreen") || RunPrefixMethod(document, "IsFullScreen")) {
        RunPrefixMethod(document, "CancelFullScreen");
      }
      else {
        RunPrefixMethod(document.getElementById("presentation"), "RequestFullScreen");
      }
    }

    var pfx = ["webkit", "moz", "ms", "o", ""];
    function RunPrefixMethod(obj, method) {
      var p = 0, m, t;
      while (p < pfx.length && !obj[m]) {
        m = method;
        if (pfx[p] == "") {
          m = m.substr(0,1).toLowerCase() + m.substr(1);
        }
        m = pfx[p] + m;
        t = typeof obj[m];
        if (t != "undefined") {
          pfx = [pfx[p]];
          return (t == "function" ? obj[m]() : obj[m]);
        }
        p++;
      }
  	}


	
	</script>
	</body>
</html>
