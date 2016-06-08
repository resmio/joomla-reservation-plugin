<?php
// no direct access
defined( '_JEXEC' ) or die( 'Access Deny' );

class PlgContentResmio extends JPlugin 
{

	function onContentPrepare($context, &$article, &$params, $limit){

		$resmioID = $this->params->get('resmio-id');
		$buttonColor = $this->params->get('button-color');
		$color = substr($buttonColor, 1);
		$buttonTextColor = $this->params->get('button-text-color');

		$percent = 0.5;

		$new_color = '#';
	
		// convert to decimal and change luminosity
		for ($i = 0; $i < 3; $i++) {
			$dec = hexdec( substr( $color, $i*2, 2 ) );
			$dec = min( max( 0, $dec * $percent ), 255 ); 
			$new_color .= str_pad( dechex( $dec ) , 2, 0, STR_PAD_LEFT );
		}		

		$resmioButton = '<script data-resmio-button='.$resmioID.'>
  							(function(d, s) {
 								var js, rjs = d.getElementsByTagName(s)[0];
 								js = d.createElement(s);
 								js.src = "//static.resmio.com/static/de/button.js";
 								js.async = true;
   								rjs.parentNode.insertBefore(js, rjs); }(document, "script")
  							);
						</script>
						<style type="text/css">
							.resmio-button .btn {
								color: '.$buttonTextColor.';
 								background-color: #000000;
  								background-image: linear-gradient(top,'.$buttonColor.','.$new_color.');
  								background-image: -webkit-linear-gradient(top,'.$buttonColor.','.$new_color.');
  								background-image: -o-linear-gradient(top,'.$buttonColor.','.$new_color.');
  								background-image: -moz-linear-gradient(top,'.$buttonColor.','.$new_color.');
  								background-image: -ms-linear-gradient(top,'.$buttonColor.','.$new_color.');
  								border-style: 1px solid #633613;
  								border-color: #000000;
							}
							.resmio-button .btn:hover, .resmio-button .btn:focus {
								color: '.$buttonTextColor.';
   								background-color: '.$new_color.';
   								background-image: linear-gradient(top,'.$buttonColor.','.$new_color.');
  								background-image: -webkit-linear-gradient(top,'.$buttonColor.','.$new_color.');
  								background-image: -o-linear-gradient(top,'.$buttonColor.','.$new_color.');
  								background-image: -moz-linear-gradient(top,'.$buttonColor.','.$new_color.');
  								background-image: -ms-linear-gradient(top,'.$buttonColor.','.$new_color.');
   								border-style: 1px solid #49260a;
   								border-color: #000000;
							}
						</style>
						';


		$resmioWidget = '<div id="resmio-'.$this->params->get('resmio-id').'"></div>
						<script>(function(d, s) {
 							var js, rjs = d.getElementsByTagName(s)[0];
 							js = d.createElement(s);
 							js.src = "//static.resmio.com/static/de/widget.js#id='.$this->params->get('resmio-id').'&width=275px&height=400px";
 							rjs.parentNode.insertBefore(js, rjs);
							}(document, "script"));
							</script>';

    	preg_match_all('/\[\s*(\S+?)\s*\]/is', $article->text, $matches);
    	$i = 0;
    	foreach($matches[0] as $match){
    		$shortcode = $matches[1][$i];
    		if($shortcode == 'resmio-button')
    		{
    			$article->text = str_replace($match, $resmioButton, $article->text);
    		}
    		elseif($shortcode == 'resmio-widget')
    		{
    			$article->text = str_replace($match, $resmioWidget, $article->text);
    		}

    		$i++;
    		
    	}	
	}
}