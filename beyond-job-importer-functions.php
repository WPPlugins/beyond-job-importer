<?php
if (!function_exists('beyond_job_importer_formate_date')):
function beyond_job_importer_formate_date($raw_date,$format='%d %b %Y  %I:%M %p')
{
 if ( ($raw_date == '0000-00-00 00:00:00') || ($raw_date == '') ) 
  return false;
 $year = (int)substr($raw_date, 0, 4);
 $month = (int)substr($raw_date, 5, 2);
 $day = (int)substr($raw_date, 8, 2);
 $hour = (int)substr($raw_date, 11, 2);
 $minute = (int)substr($raw_date, 14, 2);
 $second = (int)substr($raw_date, 17, 2);
 return strftime($format, mktime($hour,$minute,$second,$month,$day,$year));
}
endif;
///////////
if (!function_exists('beyond_job_importer_draw_pull_down_menu')):
function beyond_job_importer_draw_pull_down_menu($name, $values, $default = '', $parameters = '', $required = false) 
{
 $field = '<select name="' . htmlspecialchars($name) . '"';
 if ($parameters!='') 
  $field .= ' ' . $parameters;
 $field .= '>';
 for ($i=0, $n=sizeof($values); $i<$n; $i++) 
 {
  $field .= '<option value="' . htmlspecialchars($values[$i]['id']) . '"';
  if(is_array($default))
  {
   if(in_array($values[$i]['id'],$default))
   {
    $field .= ' SELECTED';
   }
  }
  else
  {
   if($default==$values[$i]['id'])
   {
    $field .= ' SELECTED';
   }
  }
  $field .= '>' . htmlspecialchars(utf8_encode($values[$i]['text']),ENT_QUOTES) . '</option>';
 }
 $field .= '</select>';
 if ($required == true) $field .= '&nbsp;<span class="inputRequirement">*</span>';;
  return $field;
}
endif;
/////////////
if (!function_exists('beyond_job_importer_job_type_drop_down')):
function beyond_job_importer_job_type_drop_down($name='job_type',$parameters='',$selected="",$header="",$header_value="")
{
 $required_list = array();
 if($header!='')
 $required_list[0] =array('id'=>$header_value,'text'=>$header);
 $required_list[] =array('id'=>'139','text'=>'Full-time');
 $required_list[] =array('id'=>'141','text'=>'Part-time');
 $required_list[] =array('id'=>'2106','text'=>'Internship');
 $required_list[] =array('id'=>'140','text'=>'Temporary');
 $required_list[] =array('id'=>'142','text'=>'1099 Contractor');
 $required_list[] =array('id'=>'143','text'=>'W-2 Contractor');
 return beyond_job_importer_draw_pull_down_menu($name, $required_list, $selected,$parameters);
}
endif;
///////////
if (!function_exists('beyond_job_importer_industry_drop_down')):
function beyond_job_importer_industry_drop_down($name='industry',$parameters='',$selected="",$header="",$header_value="")
{
 $required_list = array();
 if($header!='')
 $required_list[0] =array('id'=>$header_value,'text'=>$header);
 $required_list[] =array('id'=>'7','text'=>'Accounting & Finance');
 $required_list[] =array('id'=>'21','text'=>'Arts, Entertainment & Gaming');
 $required_list[] =array('id'=>'8','text'=>'Clerical & Administrative');
 $required_list[] =array('id'=>'796','text'=>'Community & Social Services');
 $required_list[] =array('id'=>'9','text'=>'Construction & Extraction');
 $required_list[] =array('id'=>'180','text'=>'Customer Service');
 $required_list[] =array('id'=>'24','text'=>'Education, Training, & Library');
 $required_list[] =array('id'=>'25','text'=>'Engineering & Architecture');
 $required_list[] =array('id'=>'797','text'=>'Farming, Fishing, & Forestry');
 $required_list[] =array('id'=>'10','text'=>'Healthcare & Medical');
 $required_list[] =array('id'=>'11','text'=>'Human Resources');
 $required_list[] =array('id'=>'23','text'=>'Information Technology');
 $required_list[] =array('id'=>'798','text'=>'Installation, Maintenance, & Repair');
 $required_list[] =array('id'=>'16','text'=>'Insurance');
 $required_list[] =array('id'=>'27','text'=>'Legal Services');
 $required_list[] =array('id'=>'28','text'=>'Management & Business');
 $required_list[] =array('id'=>'15','text'=>'Manufacturing & Production');
 $required_list[] =array('id'=>'14','text'=>'Marketing & Advertising');
 $required_list[] =array('id'=>'22','text'=>'Media & Communication');
 $required_list[] =array('id'=>'30','text'=>'Merchandising, Purchasing & Retail');
 $required_list[] =array('id'=>'194','text'=>'Military & Government');
 $required_list[] =array('id'=>'31','text'=>'Personal & Home Services');
 $required_list[] =array('id'=>'20','text'=>'Public Relations');
 $required_list[] =array('id'=>'17','text'=>'Public Utilities & Services');
 $required_list[] =array('id'=>'18','text'=>'Real Estate & Building Maintenance');
 $required_list[] =array('id'=>'13','text'=>'Research');
 $required_list[] =array('id'=>'26','text'=>'Sales & Sales Management');
 $required_list[] =array('id'=>'32','text'=>'Science & Biotech');
 $required_list[] =array('id'=>'795','text'=>'Sports & Fitness');
 $required_list[] =array('id'=>'29','text'=>'Transportation & Logistics');
 return beyond_job_importer_draw_pull_down_menu($name, $required_list, $selected,$parameters);
}
endif;
///////////
if (!function_exists('beyond_job_importer_country_drop_down')):
function beyond_job_importer_country_drop_down($name='country',$parameters='',$selected="",$header="",$header_value="")
{
 $country_list = array();
 if($header!='')
 $country_list[0] =array('id'=>$header_value,'text'=>$header);
 $country_list1 =beyond_job_importer_country_list();
 $country_list=array_merge($country_list,$country_list1);
 return beyond_job_importer_draw_pull_down_menu($name, $country_list, $selected,$parameters);
}
endif;
////////
if (!function_exists('beyond_job_importer_country_list')):
function beyond_job_importer_country_list()
{
 $country_list = array();
 $country_list[]=array('id'=>'us','text'=>'United States');
 $country_list[]=array('id'=>'ar','text'=>'Argentina');
 $country_list[]=array('id'=>'at','text'=>'Austria');
 $country_list[]=array('id'=>'au','text'=>'Australia');
 $country_list[]=array('id'=>'be','text'=>'Belgium');
 $country_list[]=array('id'=>'br','text'=>'Brazil');
 $country_list[]=array('id'=>'ca','text'=>'Canada');
 $country_list[]=array('id'=>'fr','text'=>'France');
 $country_list[]=array('id'=>'de','text'=>'Germany');
 $country_list[]=array('id'=>'in','text'=>'India');
 $country_list[]=array('id'=>'ie','text'=>'Ireland');
 $country_list[]=array('id'=>'it','text'=>'Italy');
 $country_list[]=array('id'=>'mx','text'=>'Mexico');
 $country_list[]=array('id'=>'nl','text'=>'Netherlands');
 $country_list[]=array('id'=>'pt','text'=>'Portugal');
 $country_list[]=array('id'=>'ru','text'=>'Russia');
 $country_list[]=array('id'=>'za','text'=>'South Africa');
 $country_list[]=array('id'=>'sp','text'=>'Spain');
 $country_list[]=array('id'=>'se','text'=>'Sweden');
 $country_list[]=array('id'=>'ch','text'=>'Switzerland');
 $country_list[]=array('id'=>'uk','text'=>'United Kingdom');
 return $country_list;
}
endif;
/////////////////
if (!function_exists('beyond_job_importer_get_category_list')) :
function beyond_job_importer_get_category_list($parent=0,$level=0)
{
 $args = array(
	'type'                     => 'post',
	'child_of'                 => 0,
	'parent'                   => $parent,
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 0,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'category',
	'pad_counts'               => false );
 $list_set =array();
 $categories = get_categories( $args );
 foreach($categories as $category)
 {
  $list_set[]=array('id'=>$category->term_id,'text'=>$category->name,'level'=>$level);
  $list= beyond_job_importer_get_category_list( $category->term_id ,($level+1));
  if(is_array($list) && count($list)>0)
  $list_set =array_merge($list_set,$list);
 }
 return $list_set;
}
endif;
///////////
if (!function_exists('beyond_job_importer_get_category_drop_down')):
function beyond_job_importer_get_category_drop_down($name='category',$parameters='',$selected="",$header="",$header_value="",$hierarchical=true)
{
 $cat_list =array();
 if($header!='')
 $cat_list[0] =array('id'=>$header_value,'text'=>$header);
 $cat_list= array_merge($cat_list,beyond_job_importer_get_category_list());
 if($hierarchical)
 foreach($cat_list as $key =>$value)
 {
  $cat_list[$key]['text_pad'] = str_repeat(' - ',$value['level']);
 }
 return beyond_job_importer_draw_pull_down_menu($name, $cat_list, $selected,$parameters);
}
endif;
////////
if (!function_exists('beyondCategoryDropDown')):
function beyondCategoryDropDown($location='US',$name='category',$parameters='',$selected="",$header="",$header_value="")
{
 $cat_list =array();
 if($header!='')
 $cat_list[0] =array('id'=>$header_value,'text'=>$header);
 $cat_list= array_merge($cat_list,getBeyondCategory($location));
 if($hierarchical)
 foreach($cat_list as $key =>$value)
 {
  $cat_list[$key]['text_pad'] = str_repeat(' - ',$value['level']);
 }
 return beyond_job_importer_draw_pull_down_menu($name, $cat_list, $selected,$parameters);
}
endif;
/////////////////////////////////////////
if (!function_exists('beyond_job_importer_next_runtime')):
function beyond_job_importer_next_runtime($occurrence,$occurrence_type,$start_date)
{
 $end_date   = current_time('mysql');
 $occurrence = (int) $occurrence;
 $year    = substr($start_date,0,4);
 $month   = substr($start_date,5,2);
 $day     = substr($start_date,8,2);
 $hour    = substr($start_date,11,2);
 $minutes = substr($start_date,14,2);
 $seconds = substr($start_date,17,2);
 if(!checkdate ( (int)$month, (int) $day, (int) $year))
 $start_date ='0000-00-00 00:00:00';
 switch($occurrence_type)
 {
  case "hour":
   if($start_date=="" ||$start_date=='0000-00-00 00:00:00')
    $end_date=date("Y-m-d H:i:s",mktime(date('H')+$occurrence,date('i'),date('s'),date('m'),date('d'),date('Y')));
   else
    $end_date=date("Y-m-d H:i:s",mktime($hour+$occurrence,$minutes,$seconds,$month,$day,$year));
   break;
  case "day":
   if($start_date=="" ||$start_date=='0000-00-00 00:00:00')
    $end_date=date("Y-m-d H:i:s",mktime(date('H'),date('i'),date('s'),date('m'),date('d')+$occurrence,date('Y')));
   else
    $end_date=date("Y-m-d H:i:s",mktime($hour,$minutes,$seconds,$month,$day+$occurrence,$year));
   break;
  case "week":
   if($start_date=="" ||$start_date=='0000-00-00 00:00:00')
    $end_date=date("Y-m-d H:i:s",mktime(date('H'),date('i'),date('s'),date('m'),date('d')+($occurrence*7),date('Y')));
   else
    $end_date=date("Y-m-d H:i:s",mktime($hour,$minutes,$seconds,$month,$day+($occurrence*7),$year));
   break;
 }
 return $end_date;
}
endif;
////////
if (!function_exists('beyond_job_importer_feed_import')):
function beyond_job_importer_feed_import($feed_ids='',$current_time='')
{
 global $wpdb;
 $beyond_job_importer_dbtable = $wpdb->base_prefix . "beyond_job_importer";	
 $add_whereClause='';
 $blog_id = get_current_blog_id();
 $add_whereClause=" and  y.blog_id = '".$blog_id."' ";

 if($feed_ids!='')
 $add_whereClause=" and  y.feed_id in (".$feed_ids.") ";

 if($current_time!='')
 $add_whereClause=" and  y.next_activate <= '".$wpdb->escape($current_time)."'";
 
 $query = "select y.* from ".$beyond_job_importer_dbtable."  as y  where y.status='active' $add_whereClause   order by y.feed_id";
 $records = $wpdb->get_results($query,'ARRAY_A');
 foreach ($records as $row)
 {
  $affiliate_id     = wp_filter_nohtml_kses($row['affiliate_id']);
  $feed_keyword     = wp_filter_nohtml_kses($row['feed_keyword']);
  $feed_country     = wp_filter_nohtml_kses($row['feed_country']);
  $data             = json_decode($row['feed_parameter']); 
  $feed_state       = wp_filter_nohtml_kses($data->state);
  $feed_job_type    = wp_filter_nohtml_kses($data->job_type);
  $feed_category    = wp_filter_nohtml_kses($data->category);

  $max_feed         = wp_filter_nohtml_kses($row['max_feed']);
  $wp_category      = wp_filter_nohtml_kses($row['wp_category']);
  $occurrence       = wp_filter_nohtml_kses($row['occurrence']);
  $occurrence_type  = wp_filter_nohtml_kses($row['occurrence_type']);
  $publish_status   = wp_filter_nohtml_kses($row['publish_status']);
  $display_template = stripslashes($row['template_format']);
  $feed_id          = wp_filter_nohtml_kses($row['feed_id']);
  $import_items     = wp_filter_nohtml_kses($row['import_items']);
  $import_count     = 0;
  $page=1;  
  $feed_parameter  = array('affiliate_id'=>$affiliate_id,'feed_keyword'=>$feed_keyword,'feed_country'=>$feed_country,'feed_state'=>$feed_state,'feed_job_type'=>$feed_job_type,'feed_category'=>$feed_category,'page'=>1,'max_item'=>$max_feed);
  $api_url         = beyondApiUrl($feed_parameter);
  $content         = beyondJobImporterReadFeeds($api_url);

  $total_records = count($content);
  if($total_records >0 && is_array($content))
  for($i=0;$i<$total_records && $import_count<$max_feed ;$i++)
  {
   $error          = false;
   $item_title     = wp_filter_nohtml_kses($content[$i]['title']);
   $item_url       = wp_filter_nohtml_kses($content[$i]['url']);
   
   $item_job_city  = wp_filter_nohtml_kses($content[$i]['city']);
   $item_job_state = wp_filter_nohtml_kses($content[$i]['state']);
   $item_location  = wp_filter_nohtml_kses($content[$i]['location']);
   $item_job_post_code = wp_filter_nohtml_kses($content[$i]['post_code']);

   $item_company   = wp_filter_nohtml_kses($content[$i]['company']);
   
   $item_description = stripslashes($content[$i]['description']);

   if(strlen($item_title)<=0)
   {
    $error=true;
   }
   elseif($result1=$wpdb->get_var($wpdb->prepare("select post_title FROM $wpdb->posts 	WHERE post_title = '%s'",$item_title)))
   {
    $error=true;
   }  
   if(!$error)
   {
    $sql_data_array=array();
    $sql_data_array=array(
                          'post_title'    => $item_title,
                          'post_content'  => $item_description,
                          'post_author'   => 1,
                          'post_status' => $publish_status,
                         );
    ////////////////////////////////////////////
   
    
    $template_format=$display_template;
    if($template_format!='')
    {
	 $template_format = nl2br($template_format);
     
     
     if($item_company!='')
      $template_format = str_replace("{job_company}",'<span class="feed_company">'.$item_company.'</span>' ,$template_format);
     else
      $template_format = str_replace("{job_company}",'' ,$template_format);


	 if($item_location!='')
      $template_format = str_replace("{job_location}",'<span class="feed_location">'.$item_location.'</span>' ,$template_format);
     else
      $template_format = str_replace("{job_location}",'' ,$template_format);

	 if($item_description!='')	 
  	  $template_format = str_replace("{job_description}",$item_description ,$template_format);
	 else
      $template_format = str_replace("{job_description}",'' ,$template_format);

     if($item_url!='')
     {
      $template_format = str_replace("{job_detail_url}","<span class='feed_url'>".$item_url."</span>" ,$template_format); 
      $template_format = str_replace("{job_detail_link}","<span class='feed_url_link'><a href='".$item_url."' target='_blank'>".$item_url."</a></span>" ,$template_format); 
      $template_format = str_replace("{job_detail_more_link}","<span class='feed_url'><a href='".$item_url."' target='_blank'>More >></a></span>" ,$template_format); 
     }
    }
    else
    $template_format =$item_description;
    //echo $template_format ;die();
    $sql_data_array['post_content'] = $template_format;
    ///////////////////////////////////////////
    $now=current_time('mysql');
    $sql_data_array['post_date']=$now;
    $sql_data_array['post_date_gmt']=current_time('mysql',1);
    if($post_ID = wp_insert_post($sql_data_array))
    {
	 wp_set_post_terms( $post_ID, $wp_category, 'category');
     update_post_meta($post_ID,'source','beyond');	
 	 if($item_location!='')
     update_post_meta($post_ID,'job_location',$item_location);	
	 $import_count=$import_count+1;
     $import_items=$import_items+1;
    }
   }
  }
  $next_activate = beyond_job_importer_next_runtime($occurrence,$occurrence_type,current_time('mysql'));
  $query="update ".$beyond_job_importer_dbtable." set  last_import='".$import_count."',import_items='".$import_items."',last_active='".current_time('mysql')."',next_activate='".$next_activate."'  where feed_id='".$feed_id."'"; 
  $results = $wpdb->query($query);
 }
}
endif;
///////
if (!function_exists('beyondJobImporterReadFeeds')):
function beyondJobImporterReadFeeds($url)
{
 $beyond_content=array();
 if (function_exists('curl_init') )
 {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Konqueror/4.0; Microsoft Windows) KHTML/4.0.80 (like Gecko)");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_URL,$url);
  curl_setopt($ch, CURLOPT_TIMEOUT, 60);
  $data = curl_exec($ch);
  $info = curl_getinfo($ch);
  curl_close($ch);
  if($info['http_code']==200)
  if($data)
  {
   $parsed_xml = simplexml_load_string($data);
   $i=0;
   if($parsed_xml->Item)
   foreach($parsed_xml->Item as $current)
   {
     $job_title    =  wp_filter_nohtml_kses($current->Title); 
     $job_company  =  wp_filter_nohtml_kses($current->CompanyName); 
     $job_location =  wp_filter_nohtml_kses($current->Location); 
     $job_url      =  wp_filter_nohtml_kses($current->ApplyURL); 
     $job_description = wp_filter_nohtml_kses($current->ShortDescription); 

     
     $beyond_content[$i]=array(
                        'title'      => $job_title,
                        'company'    => $job_company,
                        'post_code'  => $job_postal,
                        'location'   => $job_location,
                        'description'=> $job_description,
                        'url'        => $job_url,
                       );
     $i++;
    }
   }
  }
 return $beyond_content;
}
endif;

if (!function_exists('beyondApiUrl')) :
function beyondApiUrl($parameters=array())
{
 $affiliate_id   = wp_filter_nohtml_kses($parameters['affiliate_id']);
 $feed_keyword   = wp_filter_nohtml_kses($parameters['feed_keyword']);
 $feed_country   = wp_filter_nohtml_kses($parameters['feed_country']);
 $feed_state     = wp_filter_nohtml_kses($parameters['feed_state']);
 $feed_category  = wp_filter_nohtml_kses($parameters['feed_category']);
 $feed_job_type  = wp_filter_nohtml_kses($parameters['feed_job_type']);
 $max_item       = wp_filter_nohtml_kses($parameters['max_item']);

 $page=1;
 $api_url ='http://www.beyond.com/common/services/job/search/default.asp?';
 $url_parameter=array();
 $b_query=array();
 $url_parameter['aff'] = $affiliate_id;
 $url_parameter['kw'] = $feed_keyword;
 $url_parameter['mx']=$max_item;


 if($page>0 )
 $url_parameter['pn']=$page;
 else
 $url_parameter['pn']=1;

 $url_parameter['ct']=$feed_country;

 if($feed_state!='')
 $url_parameter['st']=trim($feed_state);

 if($feed_job_type!='')
 $url_parameter['et']=trim($feed_job_type);

 if($feed_category!='')
 $url_parameter['il']=trim($feed_category);

 
 foreach ($url_parameter as $name=>$value) 
 {
  $name = str_replace("%7E", "~", rawurlencode($name));
  $value = str_replace("%7E", "~", rawurlencode($value));
  $b_query[] = $name."=".$value;
 }
 $url_parameter= implode("&", $b_query); 
 $api_url  = $api_url.$url_parameter;
 return $api_url; 
}
endif;
?>