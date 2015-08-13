<?php /*
Plugin Name:WP Inquiry Form
Plugin URI: http://www.vivacityinfotech.net
Description: Simple WP Inquiry form for your blog posts or pages.
Author: vivacityinfotech		
Authero URI: http://www.vivacityinfotech.net
Version: 1.2
Requires at least: 4.0 or later
		
*/
/*  
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.*/

ob_start();
error_reporting(0);

add_filter('plugin_row_meta', 'RegisterPluginLinks_form',10, 2);
function RegisterPluginLinks_form($links, $file) {
	if ( strpos( $file, 'wp-inquery_form.php' ) !== false ) {
		$links[] = '<a href="#">FAQ</a>';
		$links[] = '<a href="mailto:support@vivacityinfotech.com">Support</a>';
		$links[] = '<a href="http://bit.ly/1icl56K">Donate</a>';
	}
	return $links;
	}
//menu show in dashborad
function wif_init_admin_actions() {
			add_menu_page("wp-main_form", "WP Inquiry form",'manage_options', "wp-main_form", "wif_admin_form_settings",'dashicons-admin-generic' );
		}

add_action('admin_menu', 'wif_init_admin_actions');
  
  // settings update function
  function wif_admin_form_settings() {
  ?>	
  <div id="wif_wrapper">
  <div class="main_left postbox">  
<?php  echo "<h1>" .  'WP Inquiry Form Settings' . "</h1>";   
 if($_POST['hidden_value'] == 'Y') {  
        //Form data sent  
        if( $_POST['show_from']){
       
        update_option('show_from', $_POST['show_from']);

        }else{
         update_option('show_from','no');     
        }
        	if($_REQUEST['select_custom_post_type'] !='')
	{
		 	$getva = implode(',',$_REQUEST['select_custom_post_type']);
 		   update_option('select_custom_post_type', $getva);
		 }
	 
           if( $_POST['req_heading']){
       
        update_option('req_heading', $_POST['req_heading']);

        }else{
         update_option('req_heading','Request Form for this Post');     
        }
         
  
        if( $_POST['req_Email_name']){
        update_option('req_Email_name', $_POST['req_Email_name']);  
        
        }else{
         update_option('req_Email_name','Your Email');     
        } 
  
       if( $_POST['req_name']){
        update_option('req_name', $_POST['req_name']);  
        
        }else{
         update_option('req_name','Your Name');     
        } 
         if( $_POST['req_address']){
        update_option('req_address', $_POST['req_address']);  
        
        }else{
         update_option('req_name','Your Address');     
        } 
  
        if( $_POST['req_message_name']){
        update_option('req_message_name', $_POST['req_message_name']);  
        
        }else{
         update_option('req_message_name','Request Message');     
        } 
        
         if( $_POST['to_email']){
        update_option('to_email', $_POST['to_email']);  
        
        }else{
         update_option('to_email',get_option('admin_email'));     
        } 
        
          if( $_POST['suceess_message']){
        update_option('suceess_message', $_POST['suceess_message']);  
        
        }else{
         update_option('suceess_message','Thank you for your Request. We will contact with you shortly.');     
        } 
        
        if( $_POST['captcha_error']){
        update_option('captcha_error', $_POST['captcha_error']);  
        
        }else{
         update_option('captcha_error','Error: please fill the correct value.');     
        } 
         if( $_POST['email_error']){
        update_option('email_error', $_POST['email_error']);  
        
        }else{
         update_option('email_error','Error: please enter a valid email address.');     
        } 
        
         if( $_POST['name_error']){
        update_option('name_error', $_POST['name_error']);  
        
        }else{
         update_option('name_error','Error: please enter your name.');     
        } 
        
         if( $_POST['stylesheet_request']){
        update_option('stylesheet_request', $_POST['stylesheet_request']);  
        
        }else{
         update_option('stylesheet_request','
div#main_form{ /*inquiry form wrapper div*/
padding:10px;
}
div#main_form label {
    display: block;
    font-size: 13px;
    font-weight: bold;
    margin: 5px 10px;
}
div#main_form input.form_text {
    display: block;
    height: 35px;
    margin: 0 10px 0px;
    width: 400px;
background:white;
}
div#main_form textarea { 
    height: 140px;
    margin-left: 10px;
    width: 400px;
background:white;
}
div#main_form input.submit_button {
    display: block;
    height: 50px;
    margin: 10px;
    width: 200px;
}

div#main_form span.req { 
    color: #268da3;
    font-size: 20px;
}

.form_label{display: inline-block; width: 60px;}');     
        } 
 }?>
 <!-- Plug in Settings form -->


    <form name="my_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>"> 
           <p><span class="form_label">Show Form in Content:</span>
           <?php   $show_from = get_option('show_from');?>
            <input type="radio" <?php if( $show_from =='yes'){?> checked=checked <?php } ?> name="show_from" id="show_from"  value="yes">Yes 
           <input type="radio" <?php if( $show_from =='no'){?> checked=checked <?php } ?> name="show_from" id="show_from" value="no">No
            </p>
             <p><span class="form_label">Select Post Type:</span> 
<?php
$args = array(
   'public'   => true,
   '_builtin' => false
);
$output = 'names'; // names or objects, note names is the default
$operator = 'and'; // 'and' or 'or'
$post_types = get_post_types( $args, $output, $operator ); 
 $k=0;
    $getdata = get_option('select_custom_post_type');
    $exdata =explode(',', $getdata );
   $total =count($exdata);
   ?>
  <input type="checkbox" value="post" <?php    for($a=0;$a<=$total;$a++)
  {
  	 if($exdata[$a]== post){  ?> 
  	 checked="checked" 
  	 <?php }} ?>
  	 name="select_custom_post_type[]"><?php  _e( "post", "" );?>
  <input type="checkbox" value="page" <?php    for($a=0;$a<=$total;$a++)
  {
  	 if($exdata[$a]== page){  ?> 
  	 checked="checked" 
  	 <?php }} ?> name="select_custom_post_type[]"><?php  _e( "page", "" );?>
<?php foreach ( $post_types as $post_type ) {
$con='';
$con.='<input type="checkbox"';
 
   for($a=0;$a<=$total;$a++)
  {
  	 if($exdata[$a]== $post_type){  
 	 $con.='checked="checked"';
 	 
 	   } }
 	 $con.=' name="select_custom_post_type[]" value="'.$post_type.'" />'.$post_type.'';
  echo $con;  
$k++;
}

?>  

            </p>     
       <?php    echo "<strong>" .  'Email To Settings' . "</strong>"; ?>  
        <p><input type="text" name="to_email" value="<?php if(get_option('to_email')){ echo get_option('to_email'); }else{ echo get_option('admin_email');}?>" /></p>    
         
         <legend class="form_field">
         <?php    echo "<strong>" . 'Form Feilds'. "</strong>"; ?>
        <p><span class="form_label">Email:</span> &nbsp;<input type="text" name="req_Email_name" value="<?php if(get_option('req_Email_name')){ echo get_option('req_Email_name'); }else{ echo 'Your Email';}?>"/></p>  
        <p><span class="form_label">Name:</span> &nbsp;<input type="text" name="req_name" value="<?php if(get_option('req_name')){ echo get_option('req_name'); }else{ echo 'Your Name';}?>"/> </p>  
        <p><span class="form_label">Address:</span> &nbsp;<input type="text" name="req_address" value="<?php if(get_option('req_address')){ echo get_option('req_address'); }else{ echo 'Your Address';}?>"/> </p> 
        <p><span class="form_label">Message:</span> &nbsp;<input type="text" name="req_message_name" value="<?php if(get_option('req_message_name')){ echo get_option('req_message_name'); }else{ echo 'Your Inquiry Message';}?>" /></p>  
     </legend>  
        
         
         
        <?php    echo "<strong>" . 'Error Messages Settings' . "</strong>"; ?>  
         <p><span class="form_label">Form Successful Message:</span> <input type="text" name="suceess_message" value="<?php if(get_option('suceess_message')){ echo get_option('suceess_message'); }else{ echo 'Thank you for your Inquiry. We will contact you shortly to answer your questions.';}?>"/></p>  
         <p><span class="form_label">Captcha Error:</span> <input type="text" name="captcha_error" value="<?php if(get_option('captcha_error')){ echo get_option('captcha_error'); }else{ echo 'Error: please fill the correct value.';}?>"/></p>
         <p><span class="form_label">Error Email Message:</span> <input type="text" name="email_error" value="<?php if(get_option('email_error')){ echo get_option('email_error'); }else{ echo 'Error: please enter a valid email address.';}?>"/></p>
         <p><span class="form_label">Error Name Message:</span> <input type="text" name="name_error" value="<?php if(get_option('name_error')){ echo get_option('name_error'); }else{ echo 'Error: please enter your name.';}?>"/></p>
        
         <input type="hidden" name="hidden_value" value="Y"> 
         <p class="submit">  
        <input type="submit" name="Submit" value="Update Option" />  
        </p> 
        
         
    </form>  
  
    </div>
    <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_IN/all.js#xfbml=1&appId=533043140136429";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script> 
    
 <div class="right">
	<center>
<div class="bottom">
		    <h3 id="download-comments-wvpd" class="title"><?php _e( 'Download Free Plugins', 'wvpd' ); ?></h3>
		     
     <div id="downloadtbl-comments-wvpd" class="togglediv">  
	<h3 class="company">
<p> Vivacity InfoTech Pvt. Ltd. is an ISO 9001:2008 Certified Company is a Global IT Services company with expertise in outsourced product development and custom software development with focusing on software development, IT consulting, customized development.We have 200+ satisfied clients worldwide.</p>	
<?php _e( 'Our Top 5 Latest Plugins', 'wvpd' ); ?>:
</h3>
<ul class="">
<li><a target="_blank" href="https://wordpress.org/plugins/woocommerce-social-buttons/">Woocommerce Social Buttons</a></li>
<li><a target="_blank" href="https://wordpress.org/plugins/vi-random-posts-widget/">Vi Random Post Widget</a></li>
<li><a target="_blank" href="http://wordpress.org/plugins/wp-infinite-scroll-posts/">WP EasyScroll Posts</a></li>
<li><a target="_blank" href="https://wordpress.org/plugins/buddypress-social-icons/">BuddyPress Social Icons</a></li>
<li><a target="_blank" href="http://wordpress.org/plugins/wp-fb-share-like-button/">WP Facebook Like Button</a></li>
</ul>
  </div> 
</div>		
<div class="bottom">
		    <h3 id="donatehere-comments-wvpd" class="title"><?php _e( 'Donate Here', 'wvpd' ); ?></h3>
     <div id="donateheretbl-comments-wvpd" class="togglediv">  
     <p><?php _e( 'If you want to donate , please click on below image.', 'wvpd' ); ?></p>
	<a href="http://bit.ly/1icl56K" target="_blank"><img class="donate" src="<?php echo plugins_url( 'images/paypal.gif' , __FILE__ ); ?>" width="150" height="50" title="<?php _e( 'Donate Here', 'wvpd' ); ?>"></a>		
  </div> 
</div>	
<div class="bottom">
		    <h3 id="donatehere-comments-wvpd" class="title"><?php _e( 'Woocommerce Frontend Plugin', 'wvpd' ); ?></h3>
     <div id="donateheretbl-comments-wvpd" class="togglediv">  
     <p><?php _e( 'If you want to purchase , please click on below image.', 'wvpd' ); ?></p>
	<a href="http://bit.ly/1HZGRBg" target="_blank"><img class="donate" src="<?php echo plugins_url( 'images/woo_frontend_banner.png' , __FILE__ ); ?>" width="336" height="280" title="<?php _e( 'Donate Here', 'wvpd' ); ?>"></a>		
  </div> 
</div>
<div class="bottom">
		    <h3 id="donatehere-comments-wvpd" class="title"><?php _e( 'Blue Frog Template', 'wvpd' ); ?></h3>
     <div id="donateheretbl-comments-wvpd" class="togglediv">  
     <p><?php _e( 'If you want to purchase , please click on below image.', 'wvpd' ); ?></p>
	<a href="http://bit.ly/1Gwp4Vv" target="_blank"><img class="donate" src="<?php echo plugins_url( 'images/blue_frog_banner.png' , __FILE__ ); ?>" width="336" height="280" title="<?php _e( 'Donate Here', 'wvpd' ); ?>"></a>		
  </div> 
</div>
	</center>
</div>   
</div> 
<?php 	
}                        

//style included    
 function wif_style_css() {
 	
 	 wp_enqueue_style( 'main_css',plugins_url( 'css/stylesheet.css' , __FILE__ ) );
	wp_enqueue_script( 'slider_cript.min',plugins_url( 'js/script.min.js' , __FILE__ ) , array( 'jquery' ), 0.1, true );
		wp_enqueue_script( 'script',plugins_url( 'js/script.js' , __FILE__ ) , array( 'jquery' ), 0.1, true );
		wp_enqueue_script( 'admin',plugins_url( 'js/admin.js' , __FILE__ ) , array( 'jquery' ), 0.1, true );

 	}    
add_action('wp_enqueue_scripts', 'wif_style_css');  
add_action('admin_enqueue_scripts', 'wif_style_css');         
   
     
 function wif_get_requestform() {
 	
 		
 	
 	
$link_request = get_permalink();

$title=get_the_title();

if(get_option('req_Email_name')){
    $email_tag=get_option('req_Email_name');
}else{
    $email_tag='Your Email';
}

if(get_option('req_name')){
    $name_tag=get_option('req_name');
}else{
    $name_tag='Your Name';
}

if(get_option('req_address')){
    $address_tag=get_option('req_address');
}else{
    $address_tag='Your Address';
}
if(get_option('req_message_name')){
    $request_message=get_option('req_message_name');
}else{
    $request_message='Inquiry Message';
}

if(get_option('suceess_message')){
    $suceess_message=get_option('suceess_message');
}else{
    $suceess_message='Thank you for your Inquiry. We will contact you shortly to answer your questions.';
}

if(get_option('stylesheet_request')){
    $style_css=get_option('stylesheet_request');
}else{
    $style_css='div#main_form{
padding:10px;
 background-color: #FFFFFF;
}
div#main_form label {
    display: block;
    font-size: 13px;
    font-weight: bold;
    margin: 5px 10px;
}
div#main_form input.form_text {
    display: block;
    height: 35px;
    margin: 0 10px 0px;
    width: 400px;
background:white;
}
div#main_form textarea {
    height: 140px;
    margin-left: 10px;
    width: 400px;
background:white;
}
div#main_form input.submit_button {
    display: block;
    height: 50px;
    margin: 10px;
    width: 200px;
}

div#main_form span.req {
    color: #268da3;
    font-size: 20px;
}';
}


if(@$_GET['suc']==1){
    if(get_option('suceess_message')){ $req_message_success= '<p style="color: green; font-weight:bold">'.get_option('suceess_message').'</p>'; }else{ $req_message_success= $suceess_message;};
  
}
else{
    $req_message_success='';
}

$rand_no_1=$_SESSION['no1'];
$rand_no_2=$_SESSION['no2'];
$oparator_no=$_SESSION['operator_no'];
$operator=$_SESSION['operator'];

if($rand_no_2>$rand_no_1){
    $temp=$rand_no_1;
    $rand_no_1=$rand_no_2;
    $rand_no_2=$temp;
}
 $cap_val=str_pad($rand_no_1,2,'0',STR_PAD_LEFT).str_pad($rand_no_2,2,'0',STR_PAD_LEFT).$oparator_no;

$form = <<<EOT

<style type="text/css">
 {$style_css}

</style>

<div id="main_form">
<div id="send-msg"></div>

	{$req_message_success}
     
   <form id="myform"  name="my_form"  action="" method="post" enctype="multipart/form-data" style="text-align: left">
  
   <div><label for="name">{$name_tag}<span class="req">*</span></label><input type="text" name="name" id="viva_name" value="" size="22" class="form_text" /> </div>
   <div><label for="address">{$address_tag}</label><textarea name="address" id="viva_address" cols="100%" rows="10"></textarea></div>
   <div><label for="email">{$email_tag}<span class="req">*</span></label><input type="text" name="email" id="viva_email" value="" size="22" class="form_text" /></div>
   <input type="hidden" name="val" id="val" value="{$cap_val}" />
   <div><label for="message">{$request_message}</label><textarea name="message" id="viva_message" cols="100%" rows="10">type your message here...</textarea></div>

   <div><label for="captcha">Fill the Correct value<span class="req">*</span></label>
  <div id="cap_genrate"> {$rand_no_1}{$operator}{$rand_no_2}= <input type="text" name="cap" id="cap" size="4" /></div>
   
  <input name="send" type="submit" id="send" value="Request" onclick="return wif_validationform()" class="submit_button"/></div>
   
   <input type="hidden" name="my_form_submitted" value="1">
   
   </form>
   
</div>

EOT;
return  $form;
}
 
  function filter_requestform() {
 	$custom = get_option('select_custom_post_type');
				$exdata =explode(',', $custom );	
		  $totallenhth = count($exdata);
 
for($i=0;$i <= $totallenhth;$i++)
 		{ 
 	 
 			if(get_post_type($post->ID)  ==  $exdata[$i] )  {	
 		
 	
 	
$link_request = get_permalink();

$title=get_the_title();

if(get_option('req_Email_name')){
    $email_tag=get_option('req_Email_name');
}else{
    $email_tag='Your Email';
}

if(get_option('req_name')){
    $name_tag=get_option('req_name');
}else{
    $name_tag='Your Name';
}

if(get_option('req_address')){
    $address_tag=get_option('req_address');
}else{
    $address_tag='Your Address';
}
if(get_option('req_message_name')){
    $request_message=get_option('req_message_name');
}else{
    $request_message='Inquiry Message';
}

if(get_option('suceess_message')){
    $suceess_message=get_option('suceess_message');
}else{
    $suceess_message='Thank you for your Inquiry. We will contact you shortly to answer your questions.';
}

if(get_option('stylesheet_request')){
    $style_css=get_option('stylesheet_request');
}else{
    $style_css='div#main_form{
padding:10px;
 background-color: #FFFFFF;
}
div#main_form label {
    display: block;
    font-size: 13px;
    font-weight: bold;
    margin: 5px 10px;

}
div#main_form input.form_text {
    display: block;
    height: 35px;
    margin: 0 10px 0px;
    width: 400px;
background:white;
}
div#main_form textarea {
    height: 140px;
    margin-left: 10px;
    width: 400px;
background:white;
}
div#main_form input.submit_button {
    display: block;
    height: 50px;
    margin: 10px;
    width: 200px;
}

div#main_form span.req {
    color: #268da3;
    font-size: 20px;
}';
}


if($_GET['suc']==1){
    if(get_option('suceess_message')){ $req_message_success= '<p style="color: green; font-weight:bold">'.get_option('suceess_message').'</p>'; }else{ $req_message_success= $suceess_message;};
  
}
else{
    $req_message_success='';
}

$rand_no_1=$_SESSION['no1'];
$rand_no_2=$_SESSION['no2'];
$oparator_no=$_SESSION['operator_no'];
$operator=$_SESSION['operator'];

if($rand_no_2>$rand_no_1){
    $temp=$rand_no_1;
    $rand_no_1=$rand_no_2;
    $rand_no_2=$temp;
}
 $cap_val=str_pad($rand_no_1,2,'0',STR_PAD_LEFT).str_pad($rand_no_2,2,'0',STR_PAD_LEFT).$oparator_no;
  $form = <<<EOT
<br>
<style type="text/css">
 {$style_css}

</style>

<div id="main_form" style="display:none">
<div class='button b-close'><a href="javascript:void(0)">x <a/></div>
<div class="fomr_title">Request  For Contact Form :</div>
<div id="send-msg"></div>

	{$req_message_success}
 
   <form id="myform" id="popupdiv" name="my_form"  action="" method="post" enctype="multipart/form-data" style="text-align: left">
  
   <div><label for="name">{$name_tag}<span class="req">*</span></label><input type="text" name="name" id="viva_name" value="" size="22" class="form_text" /> </div>
   <div><label for="address">{$address_tag}</label><textarea name="address" id="viva_address" cols="100%" rows="10"></textarea></div>
   <div><label for="email">{$email_tag}<span class="req">*</span></label><input type="text" name="email" id="viva_email" value="" size="22" class="form_text" /></div>
   <input type="hidden" name="val" id="val" value="{$cap_val}" />
   <div><label for="message">{$request_message}</label><textarea name="message" id="viva_message" cols="100%" rows="10">type your message here...</textarea></div>

   <div><label for="captcha">Fill the Correct value<span class="req">*</span></label>
  <div id="cap_genrate"> {$rand_no_1}{$operator}{$rand_no_2}= <input type="text" name="cap" id="cap" size="4" /></div>
   
  <input name="send" type="submit" id="send" value="Request" onclick="return wif_validationform()" class="submit_button"/></div>
   
   <input type="hidden" name="my_form_submitted" value="1">
   
   </form>
  
</div>
<div class="form_popup"><a href="javascript:void(0)" id="pop" class="popup_but">Request for contact</a></div>
EOT;
$content =get_the_content();
return  $content.$form;
}
else {
			 
			  $newdata = get_the_content();
			}
}
}
 
//shortcode for form
add_shortcode('request_message', 'wif_get_requestform');
 $show_from = get_option('show_from');
 if( $show_from=='yes')
 {
 	
add_filter( 'the_content', 'filter_requestform',10);
}
 
function wif_request_procced() {
 


if(get_option('to_email')){
    $email_to=get_option('to_email');
}else{
    $email_to=get_option('admin_email');
}

if(get_option('captcha_error')){
    $cap_error=get_option('captcha_error');
}else{
    $cap_error='Error: please fill the correct value.';
}
if(get_option('email_error')){
    $email_error=get_option('email_error');
}else{
    $email_error='Error: please enter a valid email address.';
}
if(get_option('name_error')){
    $name_err=get_option('name_error');
}else{
    $name_err='Error: please enter your name.';
}



$_SESSION['no1']=rand(0, 10);
$_SESSION['no2']=rand(0, 10);
$_SESSION['operator_no']=time()%3;
$_SESSION['operator']=wif_set_captcha($_SESSION['operator_no']);

if ( isset($_POST['my_form_submitted']) ) {
 $product=( isset($_POST['product']) )  ? trim(strip_tags($_POST['product'])) : null;
 $name  = ( isset($_POST['name']) )  ? trim(strip_tags($_POST['name'])) : null;
 $email   = ( isset($_POST['email']) )   ? trim(strip_tags($_POST['email'])) : null;
  $address   = ( isset($_POST['address']) )   ? trim(strip_tags($_POST['address'])) : null;
 
 $message = ( isset($_POST['message']) ) ? trim(strip_tags($_POST['message'])) : null;
 $cap = ( isset($_POST['cap']) ) ? (int)trim(strip_tags($_POST['cap'])) : null;

 $val=(string)$_POST['val'];
 $result=(int)wif_create_captcha($val);
 

 if ( $name == '' ) wp_die($name_err);
 if ( !is_email($email) ) wp_die($email_error);
 
 if ( ($cap != $result) ) wp_die($cap_error);
 
$to=$email_to;
$from=$email;
$subject="A Request Received ";


$body='<p> <strong>Subject Name</strong> :'.$product.'</p>
       <p> <strong>Name</strong> :'.$name.'</p>
       <p> Email</strong> :'.$email.'</p>
       <p> Address</strong> :'.$address.'</p>
       <p> <strong>Message</strong> :'.$message.'</p>';



if ( !wif_email_send($body,$from,$to,$subject) ) wp_die('email not sent');

$_SESSION['my_form_success'] = 1;

 
 header('Location: ' . $_SERVER['HTTP_REFERER'].'?suc=1');
 exit();

} 
else{
    wif_get_requestform();
}
}

add_action('init', 'wif_request_procced');

function wif_request_script() { ?>

<script type="text/javascript">

 function wif_validateMail(email) {

   var regExpEmail = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   
   return(regExpEmail.test(email));
}

function wif_validationform(){
	
	var err1,err2;
    var email=document.my_form.viva_email.value;
    var name=document.my_form.viva_name.value;
    
    var loadDiv=document.getElementById('send-msg');



    if ((name.length==0) || (name==null)) {
		 jQuery('#viva_name').css('background','orange');
		err1=1;
	 }else{
            err1=0;
             jQuery('#viva_name').css('background','white');
         }


	if(!wif_validateMail(email)){
		jQuery('#viva_email').css('background','orange');
	          err2=1;
       }
           else{ err2=0;
           jQuery('#viva_email').css('background','white');
       }




	 if((err1==0) && (err2==0)){
         return true;

         }
         else{

             return false;

         }

}
</script>

<?php }

add_action('wp_head', 'wif_request_script');
// email send function

function wif_email_send($HTML,$from,$to,$subject) {
$headers = "From: $from\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$boundary = uniqid("HTMLEMAIL");
$headers .= "Content-Type: multipart/alternative;".
                "boundary = $boundary\r\n\r\n";
$headers .= "This is a MIME encoded message.\r\n\r\n";
$headers .= "--$boundary\r\n".
                "Content-Type: text/plain; charset=ISO-8859-1\r\n".
                "Content-Transfer-Encoding: base64\r\n\r\n";
$headers .= chunk_split(base64_encode(strip_tags($HTML)));
$headers .= "--$boundary\r\n".
                "Content-Type: text/html; charset=ISO-8859-1\r\n".
                "Content-Transfer-Encoding: base64\r\n\r\n";
$headers .= chunk_split(base64_encode($HTML));
if( mail($to,$subject,"",$headers))
   return true;
   else
   return false;
}
// create captcha function
function wif_create_captcha($cap_String){
		
     $rand1=(int)substr($cap_String,0,2);
     
     $rand2=(int)substr($cap_String,2,2);
     
    $op=(int)substr($cap_String,4,1);

    switch ($op)
{
case 0:
    $result=$rand1+$rand2;

  break;
case 1:
   $result=$rand1-$rand2;
  break;
case 2:
  $result=$rand2*$rand1;
  break;
}
return $result;

}

function wif_set_captcha($op){

    switch ($op)
{
case 0:
   return '+';

  break;
case 1:
  return '-';
  break;
case 2:
 return 'x';
  break;


default:
return '+';
}
}
          
