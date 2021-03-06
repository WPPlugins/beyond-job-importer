<?php
/*
Plugin Name: Beyond Job Importer
Plugin URI: http://wordpress.org/extend/plugins/beyond-job-importer/
Description: Beyond Job Importer Plugin Import job from Beyond api according to your given parameter.,post in relevant category,makes autoblogging
Version: 1.0
Author: Shambhu Prasad Patnaik
Author URI:http://socialcms.wordpress.com/
*/
set_time_limit(0);
include_once('beyond-job-importer-functions.php');
include_once('beyond-job-importer-help.php');
if (!function_exists('beyond_job_importer_add_menus')) :
function beyond_job_importer_add_menus()
{
 add_menu_page('Beyond Importer', 'Beyond Importer', 8, __FILE__, 'beyond_job_importer_list');
 add_submenu_page(__FILE__, 'Add Imporder', 'Add Imporder', 8, 'beyond_job_importer','beyond_job_importer');
 add_submenu_page(__FILE__, 'Help', 'Help', 8, 'beyond_job_importer_help','beyond_job_importer_help');
}
endif;

add_action('admin_menu', 'beyond_job_importer_add_menus');

if (!function_exists('beyond_job_importer_list')) :
function beyond_job_importer_list()
{
 global $wpdb;
 $beyond_job_importer_dbtable = $wpdb->base_prefix . "beyond_job_importer";	
 $blog_id = get_current_blog_id();
 $filds_name='feed_id,feed_title,last_active,last_import,import_items,next_activate,status';
 $records = $wpdb->get_results("SELECT $filds_name FROM " . $beyond_job_importer_dbtable." where blog_id ='".$blog_id."'");
 $myCsseUrl = plugins_url('stylesheet.css', __FILE__);
 echo'<link rel="stylesheet" type="text/css" href="'.$myCsseUrl.'">';

 if($beyond_job_importer_message = get_option('beyond_job_importer_message'))
 {
  echo' <div class="updated"><p>'.$beyond_job_importer_message.'</p></div>';
  update_option('beyond_job_importer_message','');
 }
 	
 echo'<div>
      <div class="wrap" >
       <h2>Beyond Job Importer <a href="'.admin_url('admin.php?page=beyond_job_importer').'" class="add-new-h2">Add New</a></h2></div>
		     <p class="intro">Beyond Job Importer Plugin Import job from Beyond according to your given parameter.</p>

       <div align="right" class="sca_current_time">Current Time: <b>'.beyond_job_importer_formate_date(current_time('mysql')).'</b></div>
      <table border="0" width="97%" cellspacing="1" cellpadding="2" class="middle_table1">
       <tr>
        <td valign="top"><table border="0" width="100%" cellspacing="1" cellpadding="4" class="middle_table2">
          <tr class="dataTableHeadingRow">
           <td class="dataTableHeadingContent" valign="top" rowspan="2" align="center"><nobr>Campaign Name</nobr></td>
           <td class="dataTableHeadingContent" rowspan="2" align="center">Last Active</td>
           <td class="dataTableHeadingContent" colspan="2" align="center"><nobr>Import Items</nobr></td>
           <td class="dataTableHeadingContent" rowspan="2" align="center">Run After</td>
           <td class="dataTableHeadingContent" rowspan="2" align="center">Fetch</td>
           <td class="dataTableHeadingContent" rowspan="2" align="center">Status</td>
           <td class="dataTableHeadingContent" align="center"rowspan="2" >Action&nbsp;</td>
          </tr>
          <tr class="dataTableHeadingRow1">
           <td class="dataTableHeadingContent" align="center"><nobr>Last</nobr></td>
           <td class="dataTableHeadingContent" align="center"><nobr>Total</nobr></td>
          </tr>';
       $i=0;
 foreach ($records as $record)
 {
   if ($record->status == 'active') 
   {
    $status='<a href="admin.php?page=beyond_job_importer&feed_id='.$record->feed_id.'&action1=feed_inactive' . '">Inactivate</a>';
   } 
   else 
   {
    $status='<a href="admin.php?page=beyond_job_importer&feed_id='.$record->feed_id.'&action1=feed_active' . '">Activate</a>';
   }
    $delete='<a href="admin.php?page=beyond_job_importer&feed_id='.$record->feed_id.'&action1=feed_delete'.'" onclick="return confirm(\'Are you sure you want to delete?\')">Delete</a>';

   if($i%2==0)
    $row_class='class="dataTableRow1"';
   else
    $row_class='class="dataTableRow2"';
  if($record->last_active=='0000-00-00 00:00:00')
  $record->last_active='';  
  if($record->next_activate=='0000-00-00 00:00:00')
  $record->next_activate='';  
  echo'<tr '.$row_class.'>
           <td valign="top" class="dataTableContent">&nbsp;<a href="admin.php?page=beyond_job_importer&feed_id='.$record->feed_id.'&action1=edit' . '">'.$record->feed_title.'</a></td>
           <td valign="top" class="dataTableContent">&nbsp;'.beyond_job_importer_formate_date($record->last_active).'</td>
           <td valign="top" class="dataTableContent">&nbsp;<font color="#FF0000">'.$record->last_import.'</font></td>
           <td valign="top" class="dataTableContent">&nbsp;<font color="#FF0000">'.$record->import_items.'</font> <a href="admin.php?page=beyond_job_importer&feed_id='.$record->feed_id.'&action1=set_zero" title="set to zero"><img src="'.plugins_url('reset.gif',__FILE__).'" align="top" alt="set to zero"></a></td>
           <td valign="top" class="dataTableContent">&nbsp;'.beyond_job_importer_formate_date($record->next_activate).'</td>
           <td valign="top" class="dataTableContent">&nbsp;<a href="admin.php?page=beyond_job_importer&feed_id='.$record->feed_id.'&action1=fetch_now">Fetch Now</a></td>
           <td valign="top" class="dataTableContent">&nbsp;'.$status.'</td>
           <td valign="top" class="dataTableContent" align="center">&nbsp;'.$delete.'</td>
          </tr>';
           $i++;
 }
 echo'</table></td>
       </tr>
      </table>
		<div><h3 class="beyond_heading">Other Related Plugin</h3>
		<ul class="beyond_help_square">
		 <li><a href="http://wordpress.org/plugins/indeed-job-importer/" target="_blank">Indeed Job Importer</a></li>
		 <li><a href="http://wordpress.org/plugins/juju-job-importer/" target="_blank">Juju Job Importer</a></li>
		 <li><a href="http://wordpress.org/plugins/beyond-job-importer/" target="_blank">Beyond Job Importer</a></li>
		 <li><a href="http://socialcms.wordpress.com/contact-us/" target="_blank">Pro Indeed Job Importer (premium version)</a></li>
		 <li><a href="http://socialcms.wordpress.com/2014/03/15/wp-job-manager-indeed-job-importer/" target="_blank">WP Job Manager Indeed Job Importer</a></li>
		 <li><a href="http://socialcms.wordpress.com/2014/01/21/careerbuilder-job-importer/" target="_blank">CareerBuilder Job Importer</a></li>
		 <li><a href="http://socialcms.wordpress.com/contact-us/" target="_blank">CareerJet Job Importer</a></li>
		 <li><a href="http://socialcms.wordpress.com/contact-us/" target="_blank">SimplyHired Job Importer</a></li>
		 <li><a href="http://socialcms.wordpress.com/category/job-board-2/" target="_blank">Job Board</a></li>
		<ul>
	</div>   
	   </div>';

}
endif;

add_action('beyond_job_importer_hook','beyond_job_importer_checkhook');
register_deactivation_hook(__FILE__, 'beyond_job_importer_deactivate');
register_activation_hook(__FILE__, 'beyond_job_importer_activate');
function beyond_job_importer_checkhook()
{
 $now=current_time('mysql');
 beyond_job_importer_feed_import('',$now);
}
function beyond_job_importer()
{
 global $wpdb;
 $beyond_job_importer_dbtable = $wpdb->base_prefix . "beyond_job_importer";	
 $action ='';
 if(isset($_GET['action1']))
 $action = wp_filter_nohtml_kses($_GET['action1']);
 $error_message='';
 $error=false;			

 if ($action!="") 
 {
  switch ($action) 
  {
   case 'feed_active':
    $feed_id = wp_filter_nohtml_kses($_GET['feed_id']);
    $query="update ".$beyond_job_importer_dbtable." set  status='active' where feed_id='".$feed_id."'"; 
    $results = $wpdb->query($query);
    update_option('beyond_job_importer_message','Successfully activated');
	echo "<meta http-equiv='refresh' content='0;url=".admin_url('admin.php?page=beyond-job-importer/beyond-job-importer.php')."' />"; 
    die();
    break;
   case 'feed_inactive':
    $feed_id = wp_filter_nohtml_kses($_GET['feed_id']);
    $query="update ".$beyond_job_importer_dbtable." set  status='inactive' where feed_id='".$feed_id."'"; 
    $results = $wpdb->query($query);
    update_option('beyond_job_importer_message','Successfully inactivated.');
    echo "<meta http-equiv='refresh' content='0;url=".admin_url('admin.php?page=beyond-job-importer/beyond-job-importer.php')."' />"; 
    die();
    break;
   case 'feed_delete':
    $feed_id = wp_filter_nohtml_kses($_GET['feed_id']);
    $query="delete from ".$beyond_job_importer_dbtable."  where feed_id='".$feed_id."'"; 
    if($results = $wpdb->query($query))
    update_option('beyond_job_importer_message','Successfully Deleted.');
    echo "<meta http-equiv='refresh' content='0;url=".admin_url('admin.php?page=beyond-job-importer/beyond-job-importer.php')."' />"; 
    die();
    break;
   case 'fetch_now':
    $feed_id = wp_filter_nohtml_kses($_GET['feed_id']);
    beyond_job_importer_feed_import($feed_id);
    echo "<meta http-equiv='refresh' content='0;url=".admin_url('admin.php?page=beyond-job-importer/beyond-job-importer.php')."' />"; 
    die('');
    break;
   case 'set_zero':
    $feed_id = wp_filter_nohtml_kses($_GET['feed_id']);
    $query="update ".$beyond_job_importer_dbtable." set  import_items=0 where feed_id='".$feed_id."'"; 
    if($results = $wpdb->query($query))
    update_option('beyond_job_importer_message','Successfully set count to zero.');
    echo "<meta http-equiv='refresh' content='0;url=".admin_url('admin.php?page=beyond-job-importer/beyond-job-importer.php')."' />"; 
    die('');
    break;

   case 'save':
   case 'update':
    $campaign_name   = wp_filter_nohtml_kses($_POST['TR_campaign_name']);
    $affiliate_id    = wp_filter_nohtml_kses($_POST['TR_AffiliateID']);
    $keyword         = wp_filter_nohtml_kses($_POST['keyword']);
    $feed_country    = wp_filter_nohtml_kses($_POST['feed_country']);
    $feed_state      = wp_filter_nohtml_kses($_POST['feed_state']);
    $feed_category   = wp_filter_nohtml_kses($_POST['feed_category']);
    $feed_job_type   = wp_filter_nohtml_kses($_POST['feed_job_type']);
    $max_feed        = wp_filter_nohtml_kses($_POST['IR_max_item']);
    $feed_status     = wp_filter_nohtml_kses($_POST['feed_status']);
    $publish_status  = wp_filter_nohtml_kses($_POST['publish_status']);
    $wp_category     = wp_filter_nohtml_kses($_POST['category']);
    $run_every       = wp_filter_nohtml_kses($_POST['IR_run_every']);
    $occurrence_type = wp_filter_nohtml_kses($_POST['occurrence_type']);
    $display_template= stripslashes_deep($_POST['display_template']);
    $feed_parameter  = array('state'=>$feed_state,'category'=>$feed_category,'job_type'=>$feed_job_type);
    $data            = json_encode($feed_parameter);

    $error=false;			
    if($campaign_name=='')
    {
     $error_message[] ='Please enter Campaign Name.';
     $error=true;
    }
    if($affiliate_id=='')
    {
     $error_message[] ='Please enter DeveloperKey.';
     $error=true;
    }   
    if($max_feed<=0)
    {
     $error_message[] ='Max Item  must be greater then zero.';
     $error=true;
    }
    if($max_feed>25)
    {
     $error_message[] ='Max Item  cannot be greater then 25.';
     $error=true;
    }    
    if($action=='save')
    {
     $query = "select feed_id from " . $beyond_job_importer_dbtable . " WHERE feed_title  = '".$wpdb->escape($campaign_name)."'";
     if($result = $wpdb->get_row($query))
     {
      $error_message[] ='This camapign name already exit.Enter different name.';
      $error=true;
     }
    }
    else
    {
     $feed_id = wp_filter_nohtml_kses($_GET['feed_id']);
     $query = "select feed_id from " . $beyond_job_importer_dbtable . " WHERE feed_title  = '".$wpdb->escape($campaign_name)."' and feed_id!='".$wpdb->escape($feed_id)."'";
     if($result = $wpdb->get_row($query))
     {
      $error_message[] ='This camapign name already exit.Enter different name.';
      $error=true;
     }
	}    
    if(!$error)
    {
     if($action=='save')
     {
      $blog_id = get_current_blog_id();
	  $query="INSERT INTO ".$beyond_job_importer_dbtable." (`feed_title`,`blog_id`,`affiliate_id`,`feed_country`,`feed_parameter`,`feed_keyword`,`max_feed`,`status`,`publish_status`,`occurrence`,`occurrence_type`,`wp_category`,`template_format`,`next_activate`,`inserted`)   VALUES ('".$wpdb->escape($campaign_name)."','".$wpdb->escape($blog_id)."','".$wpdb->escape($affiliate_id)."','".$wpdb->escape($feed_country)."','".$wpdb->escape($data)."','".$wpdb->escape($keyword)."','".$wpdb->escape($max_feed)."','".$wpdb->escape($feed_status)."','".$wpdb->escape($publish_status)."','".$wpdb->escape($run_every)."','".$wpdb->escape($occurrence_type)."','".$wpdb->escape($wp_category)."','".$wpdb->escape($display_template)."',now(),now())";	  
	  $result=$wpdb->query($query);
      if($result)
      {
       update_option('beyond_job_importer_message','Successfully Added.');
      }
      echo "<meta http-equiv='refresh' content='0;url=".admin_url('admin.php?page=beyond-job-importer/beyond-job-importer.php')."' />"; 
      die('');
     }
     else
     {
      $feed_id = wp_filter_nohtml_kses($_GET['feed_id']);
      $query = "select last_active from " . $beyond_job_importer_dbtable . " WHERE feed_id  = '".$wpdb->escape($feed_id)."'";
      $result = $wpdb->get_row($query);	
      {
       $last_active     = $result->last_active;
       if($last_active!='0000-00-00 00:00:00')
       $next_activate =  beyond_job_importer_next_runtime($run_every ,$occurrence_type,$last_active);
       $query_update="update  ".$beyond_job_importer_dbtable."  set `feed_title`='".$wpdb->escape($campaign_name)."',`affiliate_id`='".$wpdb->escape($affiliate_id)."',`feed_country`='".$wpdb->escape($feed_country)."',`feed_parameter`='".$wpdb->escape($data)."',`feed_keyword` ='".$wpdb->escape($keyword)."',`max_feed`='".$wpdb->escape($max_feed)."',`status`='".$wpdb->escape($feed_status)."',`publish_status`='".$wpdb->escape($publish_status)."',`occurrence`='".$wpdb->escape($run_every)."',`occurrence_type`='".$wpdb->escape($occurrence_type)."',`wp_category`='".$wpdb->escape($wp_category)."',`template_format`='".$wpdb->escape($display_template)."',`updated`=now() where feed_id='".$wpdb->escape($feed_id)."'";
	   
       $result=$wpdb->query($query_update);
       if($result)
       {
        update_option('beyond_job_importer_message','Successfully Updated.');
       }
       echo "<meta http-equiv='refresh' content='0;url=".admin_url('admin.php?page=beyond-job-importer/beyond-job-importer.php')."' />"; 
       die(''); 
      }
     }

    }    
    break;
  }
 }
{
 $feed_run_array=array();
 $feed_run_array[]=array('id'=>'hour','text'=>'Hours');
 $feed_run_array[]=array('id'=>'day','text'=>'Days');
 $feed_run_array[]=array('id'=>'week','text'=>'Weeks');
 

 $feed_status_array=array();
 $feed_status_array[]=array('id'=>'active','text'=>'active');
 $feed_status_array[]=array('id'=>'inactive','text'=>'inactive');

 $publish_status_array=array();
 $publish_status_array[]=array('id'=>'publish','text'=>'published');
 $publish_status_array[]=array('id'=>'draft','text'=>'draft');
 if($action=='edit')
 {
  $feed_id = wp_filter_nohtml_kses($_GET['feed_id']);
  $form_action=admin_url('admin.php?page=beyond_job_importer&action1=update&feed_id='.$feed_id);
  $form_button='<input type="submit" value="Update">';
  $query = "select * from " . $beyond_job_importer_dbtable . " WHERE feed_id  = '".$wpdb->escape($feed_id)."'";
  $result = $wpdb->get_row($query);	
  $campaign_name   = wp_filter_nohtml_kses($result->feed_title);
  $affiliate_id    = wp_filter_nohtml_kses($result->affiliate_id);
  $keyword         = wp_filter_nohtml_kses($result->feed_keyword);
  $feed_country    = wp_filter_nohtml_kses($result->feed_country);
  $data            = json_decode($result->feed_parameter);
  $feed_state      = wp_filter_nohtml_kses($data->state);
  $feed_job_type   = wp_filter_nohtml_kses($data->job_type);
  $feed_category   = wp_filter_nohtml_kses($data->category);
  $max_feed        = wp_filter_nohtml_kses($result->max_feed);
  $feed_status     = wp_filter_nohtml_kses($result->status);
  $publish_status  = wp_filter_nohtml_kses($result->publish_status);
  $wp_category     = wp_filter_nohtml_kses($result->wp_category);
  $run_every       = wp_filter_nohtml_kses($result->occurrence);
  $occurrence_type = wp_filter_nohtml_kses($result->occurrence_type);
  $display_template= stripslashes_deep($result->template_format);
 }
 elseif($error)
 {
  if($action=='update')
  {
   $feed_id = wp_filter_nohtml_kses($_GET['feed_id']);
   $form_action=admin_url('admin.php?page=beyond_job_importer&action1=update&feed_id='.$feed_id);
   $form_button='<input type="submit" value="Update">';
  }
  else
  {
   $form_button='<input type="submit" value="Save">';
   $form_action=admin_url('admin.php?page=beyond_job_importer&action1=save');
  }
 }
 else
 {
  $form_button='<input type="submit" value="Save">';
  $advance_tab_class='class="inactive_tab"';
  $feed_country     = 'US';
  $max_feed        = 20;
  $run_every       = 1;
  $occurrence_type = 'day';
  $campaign_name ='';
  $affiliate_id ='';
  $keyword ='';
  $feed_state ='';
  $feed_job_type ='';
  $feed_category ='';
  $feed_status ='active';
  $publish_status ='active';
  $wp_category  ='';
  $display_template='{job_company}'. "\n".' Location : {job_location} {job_country}'."\n".'{job_description}'."\n\n".'{job_detail_more_link}';
  $form_action=admin_url('admin.php?page=beyond_job_importer&action1=save');
 }

 $myCsseUrl = plugins_url('stylesheet.css', __FILE__);
 $javascript_url = plugins_url('b_common.js', __FILE__);
 echo'<link rel="stylesheet" type="text/css" href="'.$myCsseUrl.'">';
 echo'<script src="'.$javascript_url.'"></script>';
 ?>

 <?


 echo '<div>
    <div class="wrap">
	<h2>Beyond Job Importer</h2></div>
 '.
 ((is_array($error_message)&& count($error_message)>0)?' <div class="error"><p>'.implode("<br>",$error_message).'</p></div>':'').'
 <table border="0" cellspacing="3" cellpadding="2" >
	  <tr>
        <td  colspan="3" ><div class="tab1">Beyond Settings</div></td>
       </tr>
       <tr><form method="post" action="'.$form_action.'" onsubmit="return bImporterValidateForm(this)">
        <td width="135" >Campaign Name</td>
        <td colspan="2"><input name="TR_campaign_name" type="text" value="'.$campaign_name.'" class="beyondImporterInput">&nbsp;<span class="inputRequirement">*</span></td>
       </tr>
       <tr>
        <td valign="top"><nobr>Affiliate ID</nobr></td>
        <td valign="top" colspan="2"><nobr><input type="text" name="TR_AffiliateID" value="'.$affiliate_id.'" class="beyondImporterInput">&nbsp;<span class="inputRequirement">*</span></nobr><div><span style="color:#444444;font-size:11px;">Get <b>Affiliate ID</b> from beyond.com. Don\'t you have such a key? <a href="http://about.beyond.com/affiliate" target="_blank" class="blue"><u>Request one here</u></a>.</span></div></td>
       </tr>       
       <tr>
        <td>Keyword</td>
        <td colspan="2"><input type="text" name="keyword" value="'.$keyword.'" class="beyondImporterInput"></td>
       </tr>
       <tr>
        <td><nobr>Country</nobr></td>
        <td colspan="2" >'.beyond_job_importer_country_drop_down('feed_country', 'id="beyondCountry"', $feed_country,'').'</td>
       </tr>
	   <tr>
        <td valign="top">State</td>
        <td colspan="2"><input type="text" name="feed_state" value="'.$feed_state.'" class="beyondImporterInput" ><br><span style="color:#444444;font-size:11px;"><a href="http://www.beyond.com/common/services/documentation/default.asp?p=st" target="_blank">View Possible Inputs</a></span></td>
       </tr>               
       <tr>
        <td><nobr>Category</nobr></td>
        <td colspan="2" >'.beyond_job_importer_industry_drop_down('feed_category', 'id="beyondCategory"', $feed_category,' ','').'</td>
       </tr>
       <tr>
        <td><nobr>Job Type</nobr></td>
        <td colspan="2" >'.beyond_job_importer_job_type_drop_down('feed_job_type', 'id="beyondJobType"', $feed_job_type,' ').'</td>
       </tr>
       <tr>
        <td valign="top">Max Item Import</td>
        <td valign="top"><input type="text" name="IR_max_item" value="'.$max_feed.'" size="2"><br><span style="color:#444444;font-size:11px;">Maximum value is 25; we recommend that you set the Max Item Import parameter to 10.</span></td>
       </tr>
       <tr>
        <td>Feed Status</td>
        <td colspan="2" >'.beyond_job_importer_draw_pull_down_menu('feed_status', $feed_status_array, $feed_status).'</td>
       </tr>                        
       <tr>
        <td  colspan="3" ><div class="tab1">WordPress Settings</div></td>
       </tr>
       <tr>
        <td>New Post Status</td>
        <td colspan="2" >'.beyond_job_importer_draw_pull_down_menu('publish_status',$publish_status_array,$publish_status).'</td>
       </tr>                
       <tr>
        <td>Category Name</td>
        <td colspan="2"  >'.beyond_job_importer_get_category_drop_down('category','',$wp_category).'</td>
       </tr>
       <tr>
        <td>Run Every</td>
        <td colspan="2"  ><input name="IR_run_every" value="'.$run_every.'" size="2" type="text"> '.beyond_job_importer_draw_pull_down_menu('occurrence_type', $feed_run_array, $occurrence_type,'').'</td>
       </tr>      
       <tr>
        <td  valign="top"><nobr>Display Template</nobr></td>
        <td colspan="2"  ><textarea name="display_template" wrap="1" cols="60" rows="5">'.stripslashes($display_template).'</textarea><div> <span style="color:#444444;font-size:11px;"><b>Template Macro : </b> {job_company},{job_location},{job_description},{job_detail_url},{job_detail_link},{job_detail_more_link} <a href="admin.php?page=beyond_job_importer_help#template_macro">More</a></span></div></td>
       </tr>      
       <tr>
        <td  colspan="3"  align="center">'.$form_button.'</td>
       </tr></form>
      </table></div>';
}
}
function beyond_job_importer_activate()
{
 global $wpdb;
 $beyond_job_importer_dbtable = $wpdb->base_prefix . "beyond_job_importer";	
 if ($wpdb->get_var("SHOW TABLES LIKE '" . $beyond_job_importer_dbtable . "'") != $beyond_job_importer_dbtable)
 {
  $sql ="CREATE TABLE IF NOT EXISTS `".$beyond_job_importer_dbtable."` (
        `feed_id` smallint(5) NOT NULL auto_increment,
        `blog_id` smallint(5) NOT NULL ,
        `feed_title` varchar(64) NOT NULL,
        `affiliate_id` varchar(100) NOT NULL,
        `feed_country` varchar(2) NOT NULL,
        `feed_keyword` varchar(155)  NULL,
        `feed_parameter` text,
        `max_feed` smallint(6) NOT NULL,
        `wp_category` smallint(6) NOT NULL,
        `publish_status` enum('publish','draft') NOT NULL,
        `occurrence` smallint(6) NOT NULL,
        `occurrence_type` enum('day','hour','week') NOT NULL,
        `template_format` text NOT NULL,
        `status` enum('active','inactive') NOT NULL,
        `last_active` datetime NOT NULL,
        `next_activate` datetime NOT NULL,
        `last_import` smallint(2) NOT NULL,
        `import_items` int(9) NOT NULL,
        `updated` datetime NOT NULL,
        `inserted` datetime NOT NULL,
        PRIMARY KEY  (`feed_id`)
        )  AUTO_INCREMENT=1;";		
  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  dbDelta( $sql );
 }
 wp_schedule_event( time(), 'hourly', "beyond_job_importer_hook");
}
function beyond_job_importer_deactivate()
{
  wp_clear_scheduled_hook("beyond_job_importer_hook");	
  global $wpdb;
  $beyond_job_importer_dbtable = $wpdb->base_prefix . "beyond_job_importer";	
  $query='drop table '.$beyond_job_importer_dbtable;
  $results = $wpdb->query($query);
}
?>