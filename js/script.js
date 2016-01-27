$(document).ready(function (e) {

	var jssor_1_SlideshowTransitions = [{$Duration:5000,$Opacity:5}];            
	var jssor_1_options = {
		$AutoPlay: true,
		$SlideshowOptions: {
			$Class: $JssorSlideshowRunner$,
			$Transitions: jssor_1_SlideshowTransitions,
			$TransitionsOrder: 1
		},
		$ArrowNavigatorOptions: {
			$Class: $JssorArrowNavigator$
		},
		$BulletNavigatorOptions: {
			$Class: $JssorBulletNavigator$
		}
	};
            
	var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
            
	//responsive code begin
	//you can remove responsive code if you don't want the slider scales while window resizes
	function ScaleSlider() {
		var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
		if (refSize) {
			refSize = Math.min(refSize, 4000);
			jssor_1_slider.$ScaleWidth(refSize);
		}
		else {
			window.setTimeout(ScaleSlider, 30);
		}
	}
	ScaleSlider();
	$(window).bind("load", ScaleSlider);
	$(window).bind("resize", ScaleSlider);
	$(window).bind("orientationchange", ScaleSlider);
	//responsive code end
	
});
