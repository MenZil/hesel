<?php
//
// +----------------------------------------------------------------------+
// | 							Menzil Team                      	      |
// +----------------------------------------------------------------------+
// | 					  file: theme_options.php				   	      |
// +----------------------------------------------------------------------+
// |					 Copyright (c) 2013-2014    			          |
// +----------------------------------------------------------------------+
// | 		     Author: Menzil Team <http://Www.Menzil.Cn>   	          |
// +----------------------------------------------------------------------+
// | 													          	      |
// | 	   	  这下面是主题设置函数,可修改$options 数组的内容					  |
// | 		即可增加新的主题设置选项,如果你不会增加,请忽做任何更改	 		 	  |
// | 													          	      |
// +----------------------------------------------------------------------+
//
$themename = "MenZil 1.0";
$shortname = "swt";
$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
//Stylesheets Reader
$alt_stylesheets = array();
if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }
    }
}

$number_entries = array("سانىنى تاللاڭ" => "", "10" => "10", "12" => "12", "14" => "14", "16" => "16", "18" => "18", "20" => "20" );
$slider_num = array("سانىنى تاللاڭ" => "", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9", "10" => "10");
$other_num = array("سانىنى تاللاڭ" => "", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9", "10" => "10", "11" => "11", "12" => "12", "13" => "13", "14" => "14", "15" => "15", "16" => "16", "17" => "17", "18" => "18", "19" => "19", "20" => "20");			
$options = array ( 
array( "name" => $themename."ئۇسلۇب تەڭشەكلىرى",
       "type" => "title"),
	//首页设置   
    array( "name" => "باشبەت",
           "type" => "section"),
    array( "type" => "open"),	array(	"name" => "بېكەت تۇغى",			"desc" => "بېكەت تۇغى رەسىم ئادرىسىنى كىرگۈزۈڭ",            "id" => $shortname."_logo",            "type" => "text",            "std" => ""),  	

			
	
//页脚(Footer)设置开始

    array( "type" => "close"),
);
// 定义管理面板
function mytheme_add_admin() {
global $themename, $shortname, $options;
if ( $_GET['page'] == basename(__FILE__) ) {
	if ( 'save' == $_REQUEST['action'] ) {
		foreach ($options as $value) {
		update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
foreach ($options as $value) {
	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
	header("Location: admin.php?page=theme_options.php&saved=true");
die;
}
else if( 'reset' == $_REQUEST['action'] ) {
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
	header("Location: admin.php?page=theme_options.php&reset=true");
die;
}
} 
add_theme_page($themename." ئۇسلۇب تەڭشەكلىرى", "ئۇسلۇب تاللاشلىرى", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}

function mytheme_add_init() {
$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("functions", $file_dir."/includes/options/options.css", false, "1.0", "all");
wp_enqueue_script("rm_script", $file_dir."/includes/options/rm_script.js", false, "1.0");
}
function mytheme_admin() { 
global $themename, $shortname, $options;
$i=0; 
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' تەڭشەكلەر ساقلاندى</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' قايتىدىن تەڭشەلدى</strong></p></div>';
?>
<div class="wrap rm_wrap">

<h2><?php echo $themename; ?>ئۇسلۇب تاللاشلىرى</h2>
<p>نۆۋەتتىكى ئۇسلۇب: <?php echo $themename;?> مەخسۇس | ئاپتۇر：<a href="http://Menzil.Cn" target="_blank">ھاجى</a> | <a href="http://Menzil.Cn" target="_blank">يېىڭى نەشىرى</a> | <a href="http://Menzil.Cn" target="_blank">مەسىلە بايقالدى</a></p>
<div class="rm_opts">
<form method="post">
  <?php foreach ($options as $value) { switch ( $value['type'] ) { case "open": ?>
  <?php break; case "close": ?>
</div>

</div>


<?php break; case "title": ?>
<?php break; case 'text': ?>

<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" size="25" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
	<small><?php echo $value['desc']; ?></small>
	<small><?php echo $value['section']; ?></small>
	<div class="clearfix"></div>
</div>

<?php break; case 'textarea': ?>

<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" style = "width:100%"><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
	<small><?php echo $value['desc']; ?></small>
	<small><?php echo $value['section']; ?></small>
 	 <div class="clearfix"></div> 
</div>
  
<?php break; case 'select': ?>



<div class="rm_input rm_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>	
	<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
		 <?php foreach ($value['options'] as $key => $option) { ?>
      <option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?> value="<?php echo $option ?>"><?php echo $key; ?></option>
      <?php } ?>
	</select>
	<small><?php echo $value['desc']; ?></small>
	<small><?php echo $value['section']; ?></small>
	<div class="clearfix"></div>
</div>

<?php break; case "checkbox": ?>

<div class="rm_input rm_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>	
	<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
	<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
	<small><?php echo $value['desc']; ?></small>
	<small><?php echo $value['section']; ?></small>
	<div class="clearfix"></div>
</div>

<?php break; case "section": $i++ ?>

<div class="rm_section">
	<div class="rm_title">
		<h3><img src="<?php bloginfo('template_directory')?>/includes/options/clear.png" class="inactive" alt="""><?php echo $value['name']; ?></h3>
		<span class="submit"><input type="submit" class="button-primary" name="save<?php echo $i; ?>" value="ساقلاش" /></span>
		<div class="clearfix"></div>
	</div>
<div class="rm_options">
<?php break;
}
}
?>
<?php
function show_id() {
	global $wpdb;
	$request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms ";
	$request .= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
	$request .= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
	$request .= " ORDER BY term_id asc";
	$categorys = $wpdb->get_results($request);
	foreach ($categorys as $category) { 
		$output = '<ol>'.$category->name."&nbsp;［<font color=#0196e3>".$category->term_id.'</font>］</ol>';
		echo $output;
	}
}
?>
<span class="show_id">
    <h4>ماس سەھىپە ID لىرى</h4>
    <?php show_id();?>
</span>
<input type="hidden" name="action" value="save" />
</form>
<form method="post">
	<p class="submit">
		<input type="submit" class="button-primary" name="reset" value="سۈكۈتتىكى ھالەتكە قايتۇرۇش" />
		<input type="hidden" name="action" value="reset" />
		ئەسكەرتىش: دەسلەپكى ھالىتىگە قايتىدۇ. قايتىدىن تەڭشەيسىز！
	</p>
</form>
</div>
<?php }?>
<?php
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');

?>
