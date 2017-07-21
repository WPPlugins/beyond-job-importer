<?php
/*
***************************************************
**********# Name  : Shambhu Prasad Patnaik #*******
***************************************************
*/

if (!function_exists('beyond_job_importer_help')):
function beyond_job_importer_help()
{
 echo'<link rel="stylesheet" type="text/css" href="'.plugins_url('stylesheet.css', __FILE__).'">';

 echo '<div class="wrap">';
	 ?>
   <div>
	 
   <p class="intro">Beyond Job Importer Plugin Import job using Beyond API according to your given parameter.</p>
	 
	 <ol id="ul_beyond_help">
	  <li><h3 class="beyond_heading">Install Beyond Job Importer WordPress Plugin</h3>
	  <ul class="beyond_help_square">
	   <li>Upload the Beyond Job Importer WordPress Plugin folder to the /wp-content/plugins/ directory</li>
	   <li>Activate the Beyond Job Importer WordPress Plugin through the 'Plugins' menu in WordPress</li>
	   <li>Go <b>Beyond Importer</b> in admin menu and add new importer search parameter click save button</li>
	   <li>In importer list click <b>Featch Now</b> link.</li>
	  </ul>
	 </li>
	 <li><h3 class="beyond_heading">Plugin Help File</h3>
	 After installing Beyond Job Importer WordPress Plugin, click on - <b>Add New</b>. The products are imported from Beyond Database to WordPress Blog.
	  <ul class="beyond_help_lower-alpha">
	   <li><h4 class="beyond_heading1">Beyond Job Importer Settings</h4>
	    <ul>
	     <li>
	      <ul class="beyond_help_square">
		   <li><strong>Campaign Name</strong><br>Run multiple campaigns like &ldquo;PHP&rdquo;,&ldquo;IT&ldquo; etc with multiple Beyond Accounts and fetch products from Beyond.this is only for differnciate importer.</li>
		   <li><strong>Affiliate ID</strong><br>Your Affiliate ID from beyond.com.Don't you have such a key?. Don't you have such a key? <a href="http://about.beyond.com/affiliate" target="_blank" class="blue"><u>Request one here</u></a>.</li>
		   <li><strong>Keyword<br></strong>Import this keyword base</li>
		   <li><strong>Country<br></strong>Import this country jobs</li>
		   <li><strong>State<br></strong>Import this state jobs</li>
		   <li><strong>Industry List<br></strong>Import this category jobs</li>
		   <li><strong>Job Type<br></strong>Import this employee type jobs</li>
		   <li><strong>Max Items to Import<br></strong>Maximum value is 25; we recommend that you set the Max Item Import parameter to 10</li>
		   <li><strong>Feed Status<br></strong>The products will be auto fetched if the feed status is active</li>
		  </ul>
         </li>
	    </ul>
	   </li>
	   <li>
	    <h4 class="beyond_heading1">WordPress Settings</h4>
	    <ul>
	     <li>
		  <ul class="beyond_help_square">
		   <li><strong>New Post Status </strong><br>The products can be directly published in the blog or stored in draft section for approval at a later stage</li>
		   <li><strong>Category Name</strong><br>List of Categories from WordPress Blog. The Beyond job imported from above settings will be inserted in that category</li>
		   <li><strong>Run Every</strong><br>Built in cron feature that automatically fetches products from Beyond site that can be set to run after specific periods like day, week etc<br></li>
		   <li><strong>Display Template</strong><br>List of fields that will be displayed in the product description page like job_company job_location, job_description etc.</li>
		  </ul>
	  	 </li>
	    </ul>
	   </li>
	  </ul>
	 </li>
	</ol>
   </div>
   <?php
echo'
 <div>
   <h3 class="beyond_heading"><a id="template_macro"></a></a>Display Template Macro</h3>
 <table border="0" width="97%" cellspacing="1" cellpadding="2" class="middle_table1">
   <tr>
     <td valign="top">
       <table border="0" width="100%" cellspacing="1" cellpadding="4" class="middle_table2">
        <tr class="dataTableHeadingRow">
         <td class="dataTableHeadingContent"  align="center">Name</td>
         <td class="dataTableHeadingContent"   align="center">Description</td>
        </tr>
        <tr class="dataTableRow1">
         <td class="dataTableContent" valign="top">{job_company}</td>
         <td class="dataTableContent"  valign="top">Job source company name display.</td>
        </tr>
        <tr class="dataTableRow2">
         <td class="dataTableContent"  valign="top">{job_description}</td>
         <td class="dataTableContent"  valign="top" >Job description display.</td>
        </tr>
        <tr class="dataTableRow1">
         <td class="dataTableContent"  valign="top">{job_location}</td>
         <td class="dataTableContent"  valign="top">Job location display like Austin,TX  </td>
        </tr>
        <tr class="dataTableRow2">
         <td class="dataTableContent"  valign="top">{job_detail_url}</td>
         <td class="dataTableContent"  valign="top">Job detail url from Beyond like <i>http://socialcms.wordpress.com/</i> </td>
        </tr>
        <tr class="dataTableRow1">
         <td class="dataTableContent"  valign="top">{job_detail_url_link}</td>
         <td class="dataTableContent"  valign="top">Job detail url with link from Beyond like <a href="http://socialcms.wordpress.com/" target="_blank">http://socialcms.wordpress.com/</a></td>
        </tr>
        <tr class="dataTableRow2">
         <td class="dataTableContent"  valign="top">{job_detail_url_more_link}</td>
         <td class="dataTableContent"  valign="top">Job detail url link from Beyond like <a href="http://socialcms.wordpress.com/" target="_blank">More >></a></td>
        </tr>
       </table>
      </td>
     </tr>
    </table>';?>
	<br>
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

	<div>More Detail - <a href="http://socialcms.wordpress.com/" target="_blank">http://socialcms.wordpress.com</a></div>
	<div>In case of any clarifications, pl. contact us at - <a href="http://profiles.wordpress.org/shambhu-patnaik/" target="_blank">http://profiles.wordpress.org/shambhu-patnaik/</a></div>
	<br>
	<div><b>Thanks a Lot</b></div>
	<br>
	<br>
    <div align="center">********************</div>
</div>
<?php
}
endif;
?>