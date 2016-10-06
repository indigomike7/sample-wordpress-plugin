<?php
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require( '../../../wp-load.php' );
wp();
get_currentuserinfo();
if(isset($_POST['html_content']))
{
//	echo str_replace("+"," ",str_replace("\\\"","",$_POST['html_content']));
//echo rawurldecode($_POST['html_content']);

	if(isset($_POST['post']))
	{
		$post  = get_post($_POST['post']);
//			echo print_r($post);
//			echo $_POST['title'].$_POST['meta_keyword'];
		drlam_seo_check_edit($post,rawurldecode($_POST['html_content']),$_POST['title'],$_POST['meta_keyword'],$_POST['categories'],$_POST['page_title'],$_POST['slug'],$_POST['meta_description']);

	}
	else
	{
		drlam_seo_check_edit($post=null,rawurldecode($_POST['html_content']),$_POST['title'],$_POST['meta_keyword'],$_POST['categories'],$_POST['page_title'],$_POST['slug'],$_POST['meta_description']);
	}
//	echo "<br/>".urldecode($_POST['html_content']);
}
else
{
	echo "No Action";
}
function drlam_seo_check_edit_ajax($html,$title,$meta_keyword,$categories)
{

?>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<?php
	$h1_title=$title;
	$content = $html;

		$meta_title=$title;
	/* TITLE */
//	drlam_ajax_title_count($meta_title);
//	drlam_ajax_title_contain_keyword($meta_title,$id);
//	drlam_ajax_title_contain_power_word($meta_title);
	/*EOF TITLE*/

	/* META DESC */
//	drlam_meta_desc_count($id);
//	drlam_meta_desc_contain_keyword($id);
	/*EOF META DESC */

	/* SLUG/URL */
//	drlam_slug_contain_keyword($id);
//	drlam_slug_no_space($id);
	/* EOF SLUG/URL */
	
	/* H1 */
//	echo $h1_title."<br/>dsds";
	drlam_ajax_h1_contain_keyword($h1_title,$meta_keyword);
	/* EOF H1 */

	/* Paragraph Contain Keyword */
	drlam_ajax_paragraph_contain_keyword($content,$meta_keyword);
	/* EOF PARAGRAPH */

	/* H2 Contain Keyword */
	drlam_ajax_h2_contain_keyword($content,$meta_keyword);
	/* EOF H2 */

	/* A HREF */
	drlam_ajax_links($content,$meta_keyword);
	/* EOF A HREF */

	/* IMAGES */
	drlam_ajax_images($content,$meta_keyword);
	/* EOF IMAGES */

	/* SOCMED IMAGES */
	drlam_ajax_sm_images($content);
	/* EOF SOCMED IMAGES */

	/* SLIDE SHOW IMAGES */
	drlam_ajax_ss_images($content,$meta_keyword);
	/* EOF SLIDE SHOW IMAGES */

	/* SLIDE SHOW IMAGES */
	drlam_ajax_has_categories($categories);
	/* EOF SLIDE SHOW IMAGES */
}
function drlam_ajax_title_count($title)
{
	echo $title."xxx".strlen($title);
	/* DISPLAY CHARACTER COUNT ERROR */
	if(strlen($title)<65)
	{
		echo '<div class="alert alert-danger">Count of Characters in Title < 65 !</div>';
	}
	elseif(strlen($title)>71)
	{
		echo '<div class="alert alert-danger">Count of Characters in Title > 71 !</div>';
	}
	else
	{
		echo '<div class="alert alert-success">Count of Characters in Title Passed </div>';
	}

}
function drlam_ajax_title_contain_keyword($title,$id)
{
	global $wpdb;
	$title=strtolower($title);
	$stat=false;
	$data = $wpdb->get_results( "SELECT * FROM wp_postmeta where post_id = '".$id."' and meta_key='_yoast_wpseo_metakeywords'" );
//	echo print_r($data);
	$mk=$data[0]->meta_value;
//	echo $mk;
	$mk_arr=explode(",", $mk);
//	echo print_r($mk_arr);
	foreach($mk_arr as $key=>$value)
	{
		$each_mk=strtolower($value);
//		echo $each_mk.$title;
		$pos = strpos($title, $each_mk);
		if($pos!==false)
		{
			$stat = true;
		}
	}
	if($stat==false)
	{
		echo '<div class="alert alert-danger">Title Tag does not contain meta keyword! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Title Tag contains meta keyword </div>';
	}
}
function drlam_ajax_title_contain_power_word($title)
{
	global $wpdb;
	$power_word="";
	$title=strtolower($title);
	$stat=false;
	$data = $wpdb->get_results( "SELECT * FROM drlam_power_keyword" );
	if(count($data)>0)
	{
		foreach($data as $key=>$value)
		{
			$pos = strpos($title, strtolower($value->keyword));
//			echo $value->keyword."<br/>";
			if($pos!==false)
			{
				$stat = true;
				$power_word = $value->keyword;
			}
		}
		if($stat==false)
		{
			echo '<div class="alert alert-danger">Title does not contain Power Word! </div>';
		}
		else
		{
			echo '<div class="alert alert-success">Title contains Power Word :"'.$power_word.'"</div>';
		}
	}
	else
	{
		echo '<div class="alert alert-danger">No Power Word defined in database! </div>';
	}
}
function drlam_ajax_meta_desc_count($id)
{
	/* DISPLAY CHARACTER COUNT ERROR */
	global $wpdb;
	$data = $wpdb->get_results( "SELECT * FROM wp_postmeta where post_id = '".$id."' and meta_key='_yoast_wpseo_metadesc'" );
	$md=strtolower($data[0]->meta_value);
	if(strlen($md)>=165)
	{
		echo '<div class="alert alert-danger">Count of Characters in Meta Description >= 165 !</div>';
	}
	else
	{
		echo '<div class="alert alert-success">Count of Characters in Meta Description Passed </div>';
	}
}
function drlam_ajax_meta_desc_contain_keyword($id)
{
	global $wpdb;
	$stat=false;
	$found="";
	$data = $wpdb->get_results( "SELECT * FROM wp_postmeta where post_id = '".$id."' and meta_key='_yoast_wpseo_metadesc'" );
	$md=strtolower($data[0]->meta_value);
	$data = $wpdb->get_results( "SELECT * FROM wp_postmeta where post_id = '".$id."' and meta_key='_yoast_wpseo_metakeywords'" );
	$mk=strtolower($data[0]->meta_value);
	$mk_arr=explode(",", $mk);
	foreach($mk_arr as $key=>$value)
	{
		$each_mk=strtolower($value);
		$pos = strpos($md, $each_mk);
		if($pos!==false)
		{
			$stat = true;
			$found = $each_mk;
		}
	}
	if($stat==false)
	{
		echo '<div class="alert alert-danger">Meta Description does not contain meta keyword! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Meta Description contains meta keyword <br/>Meta Description : "'.$md.'"<br/>Keyword : "'.$found.'"<br/></div>';
	}
}
function drlam_ajax_slug_contain_keyword($id)
{
	global $wpdb;
	$data = $wpdb->get_results( "SELECT * FROM wp_posts where id = '".$id."'" );
	$slug=str_replace("-"," ", strtolower($data[0]->post_name));
//	echo print_r($data);
	$stat=false;
	$data = $wpdb->get_results( "SELECT * FROM wp_postmeta where post_id = '".$id."' and meta_key='_yoast_wpseo_metakeywords'" );
	$mk=strtolower($data[0]->meta_value);
	$mk_arr=explode(",", $mk);
	foreach($mk_arr as $key=>$value)
	{
		$each_mk=strtolower($value);
		$pos = strpos($slug, $each_mk);
		if($pos!==false)
		{
			$stat = true;
			$found = $each_mk;
		}
	}
	if($stat==false)
	{
		echo '<div class="alert alert-danger">Slug/URL does not contain meta keyword! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Slug/URL contains meta keyword <br/>Slug : "'.$slug.'"<br/>Keyword : "'.$found.'"<br/></div>';
	}

}
function drlam_ajax_slug_no_space($id)
{
	global $wpdb;
	$data = $wpdb->get_results( "SELECT * FROM wp_posts where id = '".$id."'" );
	$slug=strtolower($data[0]->post_name);
	$stat=false;
	$pos = strpos($slug, " ");
	if($pos!==false)
	{
		$stat = true;
	}
	if($stat==true)
	{
		echo '<div class="alert alert-danger">Slug/URL contain space! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Slug/URL does not contain space</div>';
	}

}
function drlam_ajax_h1_contain_keyword($title,$keyword)
{
	$mk_arr=explode(",", $keyword);
//	echo print_r($mk_arr);
	foreach($mk_arr as $key=>$value)
	{
		$each_mk=strtolower($value);
//		echo $each_mk.$title;
		$pos = strpos(strtolower($title), $each_mk);
		if($pos!==false)
		{
			$stat = true;
		}
	}
	if($stat==false)
	{
		echo '<div class="alert alert-danger">Title / H1 does not contain meta keyword! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Title / H1 contains meta keyword </div>';
	}
}

function drlam_ajax_paragraph_contain_keyword($content,$meta_keyword)
{
//	echo $content;
	$c_arr=explode("\n", $content);
	$mk_arr=explode(",", $meta_keyword);
	$stat=false;
	$i=1;
	foreach($c_arr as $key=>$value)
	{
//		echo $value." test 2 <br/>";
		$stat_h2=false;

		if($value!="" && strpos($value, "article-img-right")!==false)
		{
			if($i==1)
			{
				foreach($mk_arr as $key=>$value)
				{
					$each_mk=strtolower($value);
					$pos = strpos(strtolower($value), $each_mk);
					if($pos!==false)
					{
						$stat = true;
					}
				}
				$pos = strpos($title, $each_mk);

			}
			$i++;
		}
	}
	if($stat==false)
	{
		echo '<div class="alert alert-danger">First Paragraph does not contain meta keyword! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">First Paragraph contains meta keyword </div>';
	}
//	echo print_r($c_arr);
}
function drlam_ajax_h2_contain_keyword($content,$meta_keyword)
{
	$mk_arr=explode(",", $meta_keyword);
	$x = new DOMDocument;
	$internalErrors = libxml_use_internal_errors(true);
	$x->loadHTML($content);
	libxml_use_internal_errors($internalErrors);
    foreach($x->getElementsByTagName('h2') as $title) 
	{
		$h2_content=$title->nodeValue;
		foreach($mk_arr as $key=>$value)
		{
			$each_mk=strtolower($value);
			$pos = strpos(strtolower($h2_content), $each_mk);
			if($pos!==false)
			{
				$stat = true;
			}
		}

	}
	if($stat==false)
	{
		echo '<div class="alert alert-danger">Meta Keyword does not appears in H2! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Meta Keyword appears at least once in H2 </div>';
	}
//	echo print_r($c_arr);

}
function drlam_ajax_links($content,$meta_keyword)
{
	global $wpdb;
	/* STATUS */
	$mk_arr=explode(",", $meta_keyword);
	$stat_contain_target_keyword=true;
	$stat_contain_article_keyword=true;
	$stat_contain_strong_property=true;
	$stat_3_6_words=true;

	$stat_1st_internal_contain_target_keyword=false;
	$stat_1st_internal_contain_article_keyword=false;
	$stat_1st_internal_contain_strong_property=false;
	$stat_1st_internal_3_6_words=false;
	$stat_2nd_internal_contain_target_keyword=false;
	$stat_2nd_internal_contain_article_keyword=false;
	$stat_2nd_internal_contain_strong_property=false;
	$stat_2nd_internal_3_6_words=false;
	$stat_3rd_internal_contain_target_keyword=false;
	$stat_3rd_internal_contain_article_keyword=false;
	$stat_3rd_internal_contain_strong_property=false;
	$stat_3rd_internal_3_6_words=false;

	$stat_ext_contain_article_keyword=false;
	$stat_ext_3_6_words=false;
	$stat_ext_link_target=false;
	$stat_ext_nofollow=false;
	$stat_ext_2nd_half=false;

	$corelink=array("articles/adrenal_fatigue.asp"
	,"blog/75-signs-symptoms-and-alerts-of-adrenal-fatigue-syndrome-2/1970/"
	,"articles/adrenalexhaustion.asp"
	,"protocol/diet/adrenal_fatigue_diet.asp"
	,"articles/adrenalfatiguevshypothyroidism.asp"
	,"blog/adrenal-fatigue-versus-hypothyroidism-2/3643/"
	,"blog/catabolic-state-and-adrenal-fatigue-syndrome/"
	,"blog/neuroendometabolic-symptoms-of-stress/15285/"
	);

	$extlink=array("draxe.com"
	,"mercola.com"
	,"adrenalfatigue.org"
	,"adrenalfatiguesolution.com"
	,"hormone.org"
	,"womentowomen.com"
	,"webmd.com"
	,"fda.gov"
	,"naturalnews.com"
	,"elanaspantry.com"
	,"thespunkycoconut.com"
	,"marksdailyapple.com"
	,"primaltoad.com"
	,"livingthenourishedlife.com"
	,"nourishedkitchen.com"
	,"thehealthyadvocate.com"
	,"tropicaltraditions.com"
	);
//	$mk_arr=explode(",", $mk);
	$x = new DOMDocument;
	$internalErrors = libxml_use_internal_errors(true);
	$x->loadHTML($content);
	libxml_use_internal_errors($internalErrors);
	$count_a = 0;
	$count_ext = 0;
    foreach($x->getElementsByTagName('a') as $a) 
	{
		$href=$a->getAttribute("href");
		$link_title=$a->getAttribute("title");
		$link_target=$a->getAttribute("target");
		$anchor_text=$a->nodeValue;
		$rel=$a->getAttribute("rel");
		$core_loop_stat=false;
		$ext_loop_stat=false;
		
		foreach($corelink as $key=>$value)
		{
			if(strpos(strtolower($href), $value)!==false)
			{
				//echo $value;
				$core_loop_stat=true;
				/* GET STATUS ARTICLE KEYWORD */
				foreach($mk_arr as $key3=>$value3)
				{
					$each_mk=strtolower($value3);
					$pos = strpos(strtolower($link_title), $each_mk);
					if($pos!==false)
					{
					}
					else
					{
						$stat_contain_article_keyword = false;
					}
				}
				/* EOF GET STATUS ARTICLE KEYWORD */

				/* GET STATUS STRONG */
//				echo htmlentities($anchor_text);
				$z = new DOMDocument;
				$internalErrors = libxml_use_internal_errors(true);
				$z->loadHTML($a->c14n());
				libxml_use_internal_errors($internalErrors);
				foreach($z->getElementsByTagName('strong') as $strong)
				{
//					$stat_contain_strong_property=true;
					$anchor_after_strong=$strong->nodeValue;
//					$words=explode(" ", $anchor_after_strong);
					$words = preg_split('/\s+/', $anchor_after_strong);
//					echo "i".count($words).$anchor_after_strong."<br/>";
					if(count($words)>=3 and count($words)<=6)
					{

					}
					else
					{
						$stat_3_6_words=false;
					}
//					echo "<br/>".$anchor_after_strong."<br/>";
				}
				/* EOF GET STATUS STRONG */
				
				$count_a++;

				/*GET STATUS TARGET KEYWORD*/
				$y = new DOMDocument;
				$internalErrors = libxml_use_internal_errors(true);
				$y->loadHTMLfile("https://www.drlam.com/".$value);
				libxml_use_internal_errors($internalErrors);
				foreach($y->getElementsByTagName('meta') as $meta)
				{
					$meta_name=$meta->getAttribute("name");
					if($meta_name=="keywords")
					{
						$target_keyword=$meta->getAttribute("content");
//						echo "<br/>".$target_keyword."<br/>";
						$tk_arr=explode(",", $target_keyword);
						foreach($tk_arr as $key2=>$value2)
						{
							if(strpos(strtolower($link_title), strtolower($value2))!==false)
							{
							}
							else
							{
								$stat_contain_target_keyword=false;
							}

						}


					}
				}
				
			}

		}
		if($core_loop_stat==false)
		{
				foreach($extlink as $key4=>$value4)
				{
					if(strpos(strtolower($href), $value4)!==false && $count_ext<=1)
					{

						$ext_loop_stat=true;
						/* GET STATUS ARTICLE KEYWORD */
						foreach($mk_arr as $key5=>$value5)
						{
							$each_mk=strtolower($value5);
							$pos = strpos(strtolower($link_title), $each_mk);
							if($pos!==false)
							{
								$stat_ext_contain_article_keyword = true;
							}
						}
						/* EOF GET STATUS ARTICLE KEYWORD */

						/* GET STATUS STRONG */
		//				echo htmlentities($anchor_text);
						//$z = new DOMDocument;
					//	$internalErrors = libxml_use_internal_errors(true);
					//	$z->loadHTML($x->c14n());
					//	libxml_use_internal_errors($internalErrors);
					//	foreach($z->getElementsByTagName('strong') as $strong)
					//	{
					//		$anchor_after_strong=$strong->nodeValue;
							$words = preg_split('/\s+/', $anchor_text);
//							$words=explode(" ", $anchor_text);
							if(count($words)>=3 and count($words)<=6)
							{
								$stat_ext_3_6_words=true;
							}
		//					echo "<br/>".$anchor_after_strong."<br/>";
//						}
						/* EOF GET STATUS STRONG */
						
						$count_ext++;

						if($link_target<>"" || $link_target<>null)
						{
							$stat_ext_link_target=true;
						}
						if($rel=="nofollow")
						{
							$stat_ext_nofollow=true;
						}
						

					}
					$pos=strpos(strtolower($content), strtolower($value4));
					if($pos!==false)
					{
						$len = strlen($content);
//						echo $len." ".$pos."<br/>";
						if(round($len/$pos)==1)
						{
							$stat_ext_2nd_half=true;
						}
					}
				}
		}
				//echo $href;

				if($core_loop_stat==false && $ext_loop_stat==false)
				{
					$count_internal++;
						foreach($mk_arr as $key6=>$value6)
						{
							$each_mk=strtolower($value6);
							$pos = strpos(strtolower($link_title), $each_mk);
							if($pos!==false)
							{
								if($count_internal==1)
									$stat_1st_internal_contain_article_keyword = true;
								elseif($count_internal==2)
									$stat_2nd_internal_contain_article_keyword = true;
								else
									$stat_3rd_internal_contain_article_keyword = true;
							}
						}
						/* EOF GET STATUS ARTICLE KEYWORD */

						/* GET STATUS STRONG */
		//				echo htmlentities($anchor_text);
						$z = new DOMDocument;
						$internalErrors = libxml_use_internal_errors(true);
						$z->loadHTML($a->c14n());
						libxml_use_internal_errors($internalErrors);
						foreach($z->getElementsByTagName('strong') as $strong)
						{
							if($count_internal==1)
								$stat_1st_internal_contain_strong_property=true;
							elseif($count_internal==2)
								$stat_2nd_internal_contain_strong_property=true;
							else
								$stat_3rd_internal_contain_strong_property=true;
//							$stat_internal_contain_strong_property=true;
							$anchor_after_strong=$strong->nodeValue;
//							$words=explode(" ", $anchor_after_strong);
							$words = preg_split('/\s+/', $anchor_after_strong);
							if(count($words)>=3 and count($words)<=6)
							{
								//$stat_internal_3_6_words=true;
								if($count_internal==1)
									$stat_1st_internal_3_6_words=true;
								elseif($count_internal==2)
									$stat_2nd_internal_3_6_words=true;
								else
									$stat_3rd_internal_3_6_words=true;
							}
		//					echo "<br/>".$anchor_after_strong."<br/>";
						}
						/* EOF GET STATUS STRONG */
						

						/*GET STATUS TARGET KEYWORD*/
						$y = new DOMDocument;
						$internalErrors = libxml_use_internal_errors(true);
						$href2=str_replace("../","",$href);
						$y->loadHTMLfile("https://www.drlam.com/".$href2);
						libxml_use_internal_errors($internalErrors);
						foreach($y->getElementsByTagName('meta') as $meta)
						{
							$meta_name=$meta->getAttribute("name");
							if($meta_name=="keywords")
							{
								$target_keyword=$meta->getAttribute("content");
		//						echo "<br/>".$target_keyword."<br/>";
								$tk_arr=explode(",", $target_keyword);
								foreach($tk_arr as $key2=>$value2)
								{
									if(strpos(strtolower($link_title), strtolower($value2))!==false)
									{
										if($count_internal==1)
											$stat_1st_internal_contain_target_keyword=true;
										elseif($count_internal==2)
											$stat_2nd_internal_contain_target_keyword=true;
										else
											$stat_3rd_internal_contain_target_keyword=true;
										//$stat_internal_contain_target_keyword=true;
									}

								}


							}
						}
				



			}

	}
/*	if($count_a==1)
	{
		echo '<div class="alert alert-success">Core Link appears at least once in Content </div>';
	}
	else
	{
		echo '<div class="alert alert-danger">Content does not contain at least one core link or Content has more than one core link! </div>';
	}
	*/
	if($stat_contain_target_keyword==false)
	{
		echo '<div class="alert alert-danger">One of the Core Links found does not contain Target Keyword! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Core Links found contains Target Keyword </div>';
	}
	if($stat_contain_article_keyword==false)
	{
		echo '<div class="alert alert-danger">One of the Core Links found does not contain Article Keyword! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Core Links found contains Article Keyword </div>';
	}
	if($stat_contain_strong_property==false)
	{
		echo '<div class="alert alert-danger">One of the Core Links Anchor Text does not contain strong property! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Core Links Anchor Text contains strong property</div>';
	}
	if($stat_3_6_words==false)
	{
		echo '<div class="alert alert-danger">One of the Core Links found Words count is not 3 - 6 Words! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Core Links found Words count is 3 - 6 Words</div>';
	}

	if($count_internal<=0)
	{
		echo '<div class="alert alert-danger">Content does not contain at least one Internal link! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Internal Link appears at least once in Content </div>';
	}
	if($stat_1st_internal_contain_target_keyword==false)
	{
		echo '<div class="alert alert-danger">First Internal Link found does not contain Target Keyword! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">First Internal Link found contains Target Keyword </div>';
	}
	if($stat_1st_internal_contain_article_keyword==false)
	{
		echo '<div class="alert alert-danger">First Internal Link  found does not contain Article Keyword! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">First Internal Link found contains Article Keyword </div>';
	}
	if($stat_1st_internal_contain_strong_property==false)
	{
		echo '<div class="alert alert-danger">First Internal Link  Anchor Text does not contain strong property! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">First Internal Link Anchor Text contains strong property</div>';
	}
	if($stat_1st_internal_3_6_words==false)
	{
		echo '<div class="alert alert-danger">First Internal Link found Words count is not 3 - 6 Words! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">First Internal Link found Words count is 3 - 6 Words</div>';
	}
	if($stat_2nd_internal_contain_target_keyword==false)
	{
		echo '<div class="alert alert-danger">Second Internal Link found does not contain Target Keyword! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Second Internal Link found contains Target Keyword </div>';
	}
	if($stat_2nd_internal_contain_article_keyword==false)
	{
		echo '<div class="alert alert-danger">Second Internal Link  found does not contain Article Keyword! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Second Internal Link found contains Article Keyword </div>';
	}
	if($stat_2nd_internal_contain_strong_property==false)
	{
		echo '<div class="alert alert-danger">Second Internal Link  Anchor Text does not contain strong property! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Second Internal Link Anchor Text contains strong property</div>';
	}
	if($stat_2nd_internal_3_6_words==false)
	{
		echo '<div class="alert alert-danger">Second Internal Link found Words count is not 3 - 6 Words! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Second Internal Link found Words count is 3 - 6 Words</div>';
	}
	if($stat_3rd_internal_contain_target_keyword==false)
	{
		echo '<div class="alert alert-danger">Third Internal Link found does not contain Target Keyword! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Third Internal Link found contains Target Keyword </div>';
	}
	if($stat_3rd_internal_contain_article_keyword==false)
	{
		echo '<div class="alert alert-danger">Third Internal Link  found does not contain Article Keyword! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Third Internal Link found contains Article Keyword </div>';
	}
	if($stat_3rd_internal_contain_strong_property==false)
	{
		echo '<div class="alert alert-danger">Third Internal Link  Anchor Text does not contain strong property! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Third Internal Link Anchor Text contains strong property</div>';
	}
	if($stat_3rd_internal_3_6_words==false)
	{
		echo '<div class="alert alert-danger">Third Internal Link found Words count is not 3 - 6 Words! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Third Internal Link found Words count is 3 - 6 Words</div>';
	}


	if($stat_ext_contain_article_keyword==false)
	{
		echo '<div class="alert alert-danger">First External Links Found does not contain Article Keyword! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">First External Links found contain article Keyword </div>';
	}
	if($stat_ext_3_6_words==false)
	{
		echo '<div class="alert alert-danger">First External Link found Words count is not 3 - 6 Words! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">First External Link found Words count is 3 - 6 Words</div>';
	}
	if($stat_ext_link_target==false)
	{
		echo '<div class="alert alert-danger">First External Link found Words does not contain target="_blank"! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">First External Link found Words contain target="_blank"</div>';
	}
	if($stat_ext_nofollow==false)
	{
		echo '<div class="alert alert-danger">First External Link found Words does not contain rel="nofollow"! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">First External Link found Words contain rel="nofollow"</div>';
	}
	if($stat_ext_2nd_half==false)
	{
		echo '<div class="alert alert-danger">First External Link found is not in 2nd Half of the content! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">First External Link found  is in 2nd Half of the content</div>';
	}

}
function remote_file_size_ajax($url){
# Get all header information
$data = get_headers($url, true);
# Look up validity
if (isset($data['Content-Length']))
    # Return file size
    return (int) $data['Content-Length'];
}
function drlam_ajax_images($content,$meta_keyword)
{
	global $wpdb;
	/* STATUS */
	$stat_alt_contain_article_keyword=array();
	$stat_title_contain_article_keyword=array();
	$stat_filename_contain_article_keyword=array();
	$stat_filetype_jpg=true;
	$stat_filesize=true;
	$stat_dimension=true;
	$stat_aligned=true;
	$stat_not_link=false;
	$stat_every_500_words=true;
	$stat_ss_dimension=true;

	$stat_filename=true;
	$stat_alt=true;
	$stat_title=true;
	$content2=preg_replace("/<!--(.*?)-->/is","",$content);
	//echo $content2."ii<br/>";
	$content3=strip_tags($content2,"<img>");
	//echo $content3."yy<br/>";

	$content_arr=preg_split("/<img (.*?)>/",$content3);
	//echo print_r($content_arr);
	foreach($content_arr as $key=>$value)
	{
		$words=preg_split("/[\s,]+/", $value);
//		echo count($words)."<br/>";
		if(count($words)>500)
		{
			$stat_every_500_words=false;
		}
	}

	$mk_arr=explode(",", $meta_keyword);
	$x = new DOMDocument;
	$internalErrors = libxml_use_internal_errors(true);
	$x->loadHTML($content2);
	libxml_use_internal_errors($internalErrors);
	$count_a = 0;
	$count_ext = 0;
	$i=0;
	$count_image = 0;
    foreach($x->getElementsByTagName('img') as $img) 
	{
		$count_image++;
	}
    foreach($x->getElementsByTagName('img') as $img) 
	{
		$title=$img->getAttribute("title");
		$alt=$img->getAttribute("alt");
		$src=$img->getAttribute("src");

//		echo $title." ".$alt." ".$src." <br/> ";
		$stat_title_contain_article_keyword[$i]["status"] = false;
		$stat_alt_contain_article_keyword[$i]["status"] = false;
		$stat_filename_contain_article_keyword[$i]["status"] = false;
		$src2=str_replace("-"," ",$src);
		if($i<$count_image)
		{
			foreach($mk_arr as $key=>$value)
			{
				$each_mk=strtolower($value);
				$pos = strpos(strtolower($title), $each_mk);
				if($pos!==false)
				{
	//				echo "x";
					$stat_title_contain_article_keyword[$i]["status"] = true;
				}
			}
			foreach($mk_arr as $key=>$value)
			{
				$each_mk=strtolower($value);
				$pos = strpos(strtolower($alt), $each_mk);
				if($pos!==false)
				{
	//				echo "y";
					$stat_alt_contain_article_keyword[$i]["status"] = true;
				}
			}
			foreach($mk_arr as $key=>$value)
			{
				$each_mk=strtolower($value);
				$pos = strpos(strtolower($src2), $each_mk);
				if($pos!==false)
				{
	//				echo "z";
					$stat_filename_contain_article_keyword[$i]["status"] = true;
				}
			}
		}
		$i++;

		$src3=str_replace("../","",$src);
		$src4="https://www.drlam.com/".$src3;
//		echo $src4;
//		$finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension

//		echo finfo_file($finfo, $src4) . "\n";
		$files =getimagesize($src4); 

		 if( $files['mime']<>"image/jpeg")
			 $stat_filetype_jpg = false;

		// echo print_r(files);
//		 echo $files[0];
//		 echo $files['mime'];
		 if( $files[0]<>500 && $files[1]<>333 && $i<>($count_image))
			 $stat_dimension = false;
		 if( $files[0]<>682 && $files[1]<>376 && $i==($count_image))
			 $stat_ss_dimension = false;

//		echo remote_file_size_ajax($src4)."<br/>";
		if(remote_file_size_ajax($src4)>102400)
			$stat_filesize=false;

//		echo mime_content_type($src4);

	}
//	echo print_r($stat_filename_contain_article_keyword);
//	echo print_r($stat_alt_contain_article_keyword);
//	echo print_r($stat_title_contain_article_keyword);
	foreach($stat_filename_contain_article_keyword as $key=>$value)
	{
		if($value['status']==false)
		{
			$stat_filename=false;
		}
	}
	foreach($stat_title_contain_article_keyword as $key=>$value)
	{
//		echo $value['status'];
		if($value['status']==false)
		{
			$stat_title=false;
		}
	}
	foreach($stat_alt_contain_article_keyword as $key=>$value)
	{
		if($value['status']==false)
		{
			$stat_alt=false;
		}
	}
	if($stat_every_500_words==false)
	{
		echo '<div class="alert alert-danger">Each Image is not in every not more than 500 words! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Each Image is in every not more than 500 words</div>';
	}
	if($stat_title==false)
	{
		echo '<div class="alert alert-danger">Each Image Title does not contain Meta Keyword! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Each Image Title contain Meta Keyword</div>';
	}
	if($stat_alt==false)
	{
		echo '<div class="alert alert-danger">Each Image Alt does not contain Meta Keyword! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Each Image Alt contain Meta Keyword</div>';
	}
	if($stat_filename==false)
	{
		echo '<div class="alert alert-danger">Each Image Filename does not contain Meta Keyword! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Each Image Filename contain Meta Keyword</div>';
	}
	if($stat_filetype_jpg==false)
	{
		echo '<div class="alert alert-danger">One of the image file type is not JPG! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Each Image file type is JPG</div>';
	}
	if($stat_dimension==false)
	{
		echo '<div class="alert alert-danger">One of the image file dimension is not 500 x 333! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Each Image file dimension is 500 x 333</div>';
	}
	if($stat_filesize==false)
	{
		echo '<div class="alert alert-danger">One of the image file size is more than 100KB! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Each Image file size is less or equal to 100 KB</div>';
	}
	if($stat_ss_dimension==false)
	{
		echo '<div class="alert alert-danger">Slide Show image file is not tagged at the bottom of the article.<br/>Slide Show image file dimension is not 628 x 376! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Slide Show image file tagged at the bottom of the article.<br/>Slide Show Image file dimension is 628 x 376</div>';
	}

}
function drlam_ajax_ss_images($content,$meta_keyword)
{
	global $wpdb;
	/* STATUS */
	$stat_alt_contain_article_keyword=array();
	$stat_title_contain_article_keyword=array();
	$stat_filename_contain_article_keyword=array();
	$stat_filetype_jpg=true;
	$stat_filesize=true;
	$stat_dimension=true;
	$stat_aligned=true;
	$stat_not_link=false;
	$stat_every_500_words=true;
	$stat_ss_dimension=true;

	$stat_filename=true;
	$stat_alt=true;
	$stat_title=true;
	$content2=preg_replace("/<!--(.*?)-->/is","",$content);
	//echo $content2."ii<br/>";
	$content3=strip_tags($content2,"<img>");
	//echo $content3."yy<br/>";

	$content_arr=preg_split("/<img (.*?)>/",$content3);
	//echo print_r($content_arr);
	foreach($content_arr as $key=>$value)
	{
		$words=preg_split("/[\s,]+/", $value);
//		echo count($words)."<br/>";
		if(count($words)>500)
		{
			$stat_every_500_words=false;
		}
	}

	$mk_arr=explode(",", $meta_keyword);
	$x = new DOMDocument;
	$internalErrors = libxml_use_internal_errors(true);
	$x->loadHTML($content2);
	libxml_use_internal_errors($internalErrors);
	$count_a = 0;
	$count_ext = 0;
	$i=0;
	$count_image = 0;
    foreach($x->getElementsByTagName('img') as $img) 
	{
		$count_image++;
	}
    foreach($x->getElementsByTagName('img') as $img) 
	{
		$title=$img->getAttribute("title");
		$alt=$img->getAttribute("alt");
		$src=$img->getAttribute("src");

		$stat_title_contain_article_keyword[0]["status"] = false;
		$stat_alt_contain_article_keyword[0]["status"] = false;
		$stat_filename_contain_article_keyword[0]["status"] = false;
		$src2=str_replace("-"," ",$src);
		if($i==($count_image-1))
		{
//			echo $title." ".$alt." ".$src." <br/> ";
			foreach($mk_arr as $key=>$value)
			{
				$each_mk=strtolower($value);
				$pos = strpos(strtolower($title), $each_mk);
				if($pos!==false)
				{
//					echo "x";
					$stat_title_contain_article_keyword[0]["status"] = true;
				}
			}
			foreach($mk_arr as $key=>$value)
			{
				$each_mk=strtolower($value);
				$pos = strpos(strtolower($alt), $each_mk);
				if($pos!==false)
				{
//					echo "y";
					$stat_alt_contain_article_keyword[0]["status"] = true;
				}
			}
			foreach($mk_arr as $key=>$value)
			{
				$each_mk=strtolower($value);
				$pos = strpos(strtolower($src2), $each_mk);
				if($pos!==false)
				{
//					echo "z";
					$stat_filename_contain_article_keyword[0]["status"] = true;
				}
			}
		}
		$i++;

	}

	foreach($stat_filename_contain_article_keyword as $key=>$value)
	{
		if($value['status']==false)
		{
			$stat_filename=false;
		}
	}
	foreach($stat_title_contain_article_keyword as $key=>$value)
	{
//		echo $value['status']."nnn";
		if($value['status']==false)
		{
			$stat_title=false;
		}
	}
	foreach($stat_alt_contain_article_keyword as $key=>$value)
	{
		if($value['status']==false)
		{
			$stat_alt=false;
		}
	}
	if($stat_title==false)
	{
		echo '<div class="alert alert-danger">Slide Show Image Title does not contain Meta Keyword! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Slide Show Image Title contain Meta Keyword</div>';
	}
	if($stat_alt==false)
	{
		echo '<div class="alert alert-danger">Slide Show Image Alt does not contain Meta Keyword! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Slide Show Image Alt contain Meta Keyword</div>';
	}

}
function drlam_ajax_sm_images($content)
{
	global $wpdb;

	$stat_top=false;
	$stat_pin_dimension=true;
	$stat_fb_dimension=true;
	$content2=preg_replace('/<!-- socmed(.*?)-->/is','$1',$content);
	$content2_arr=preg_split('/<!-- socmed(.*?)-->/is',$content);
//	$content_html=str_replace('<!-- socmed',"",$content2_arr[0]);
//	$content_html=str_replace('-->',"",$content2_arr[0]);

//	echo count($content2_arr);
	if(count($content2_arr)==2)
		$stat_top=true;
	$x = new DOMDocument;
	$internalErrors = libxml_use_internal_errors(true);
	$x->loadHTML($content2);
	libxml_use_internal_errors($internalErrors);
	$count_a = 0;
	$count_ext = 0;
	$i=0;
	$count_image = 0;
    foreach($x->getElementsByTagName('img') as $img) 
	{
		if($i<2)
		{
			$src=$img->getAttribute("src");
			$src2=str_replace("../","",$src);
			$src3="https://www.drlam.com/".$src2;
			if(strpos(strtolower($src), "pin-")!==false)
			{
				$files =getimagesize($src3); 


				 if( $files[0]<>700 && $files[1]<>1050)
					 $stat_pin_dimension = false;
			}
			if(strpos(strtolower($src), "fb-")!==false)
			{
				$files =getimagesize($src3); 


				 if( $files[0]<>1200 && $files[1]<>628)
					 $stat_fb_dimension = false;
			}
		}
		$i++;
	}
	if($stat_top==false)
	{
		echo '<div class="alert alert-danger">Social Media Image is not in the top of content! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Social Media Image is in the top of content</div>';
	}
	if($stat_pin_dimension==false)
	{
		echo '<div class="alert alert-danger">Pinterest Image dimension is not 700 x 1050! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Pinterest Image dimension is 700 x 1050</div>';
	}
	if($stat_top==false)
	{
		echo '<div class="alert alert-danger">Facebook Image dimension is not 1200 x 628!</div>';
	}
	else
	{
		echo '<div class="alert alert-success">Facebook Image dimension is 1200 x 628</div>';
	}
}
function drlam_ajax_has_categories($categories)
{
	if(count($categories)<=0)
	{
		echo '<div class="alert alert-danger">Post does not have categories yet!</div>';
	}
	else
	{
		echo '<div class="alert alert-success">Post has categories</div>';
	}
}
?>
