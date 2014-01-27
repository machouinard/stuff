<?php
/**
 * Sharethis helper for CodeIgniter.
 *
 * @subpackage 	helpler
 * @author		Shin Okada
 *
 * @param 	string 	$sharethis_pub_key    Key from sharethis. Find it in your sharethis dashboard.
 * @param	string 	$horver         Horizontal or vertical. Default is vertical
 * @param	string 	$facebook       Facebook button
 * @return  string	$sharethis	The string containing the HTML code and JS for the sharethis button.
 */

function sharethis($list)
{   $CI =& get_instance();
    // sharethis public key
    //$sharethis_pub_key = $CI->preference->item('sharethis_pub_key'); // I pull it from DB settings
    // for demo
    $sharethis_pub_key ='601b39decdca0442f129d7b0f201e164';
    // sharethis direction
    //$direction = $CI->preference->item('sharethis_direction'); // I pull it from DB settings
    // for demo
    $direction ='hor';
    if($direction=='vertical'){
        $br = '<br />';
    }  else {
        $br ='';
    }
    // sharethis services
    //$services = $CI->preference->item('sharethis_services'); // Again I pull this from DB
    // for demo
    $services = $list;
    $services_array = explode(',', $services);
    // sharethis size
    //$size = $CI->preference->item('sharethis_size');
    $size = 'large';
    if($size=='large'){
        $size = '_large';
    }  else {
        $size ='';
    }
    $sharethis ='


</div><div id="sthoverbuttonsMain" class="sthoverbuttonsMain-l">
<div class="sthoverbuttons-label">

</div><div class="sthoverbuttons-chicklets">';
    foreach($services_array as $service){
        $service = trim($service);
        $sharethis .="\n<span  class='st_".$service.$size."' ></span>".$br ;
    }
    $sharethis .= '<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher:\''.$sharethis_pub_key.'\'});</script></div>';


	return $sharethis;
}



?>
