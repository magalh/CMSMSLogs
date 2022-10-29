<?php
$lang['friendlyname'] = 'Yelp Rank';
$lang['admindescription'] = 'A module for retrieving Yelp data';
$lang['ask_uninstall'] = 'Are you sure you want to uninstall the YelpRank module?';
$lang['param_biz'] = 'id or alias of the business to look up. You can find the Yelp Business ID in the URL for the business page. The ID appears after www.yelp.com/biz/ in the address bar, and is generally composed of the name and location of the business separated by dashes. For example, the ID in the following URL is "yelp-san-francisco": www.yelp.com/biz/yelp-san-francisco';
$lang['admin_api_key'] = "Your Yelp API Key";
$lang['error_notfound'] = 'The Business specified could not be displayed';
$lang['error_api'] = 'Please provide your API key.';
$lang['error_biz'] = 'Please provide a Business id/alias.';
$lang['VALIDATION_ERROR'] = 'Please provide your Yelp API Key';
$lang['BUSINESS_NOT_FOUND'] = 'Business id incorrect. Please check again your input. Yelp can\' find it';
$lang['profile_detail'] = 'Business Profile';
$lang['name'] = 'Name';
$lang['tel'] = 'Telephone number';
$lang['description'] = 'Description';
$lang['admin_save'] = "Save";
$lang['error'] = 'Error';
$lang['submit'] = 'Submit';
$lang['cancel'] = 'Cancel';
$lang['delete'] = 'Delete';
$lang['prompt_email'] = 'Email Address';
$lang['reviews'] = 'Reviews';
$lang['type_YelpRank'] = 'YelpRank';
$lang['type_Detail'] = 'Detail';
$lang['type_Reviews'] = 'Reviews';

$lang['help_dir'] = 'Parameter to specify a directory, relative to uploads/images/Gallery/';
$lang['help_action'] = 'Override the default action. Use it in combination with the above parameters. Possible values are:
<ul>
<li>\'<strong>default</strong>\' - to display a set of random thumb-images (applies only to the images which are stored in the database, defaults to a number of 6 images). Use \'/*\' after the directoryname in the dir parameter to include images from subdirectories</li>
<li>\'<strong>reviews</strong>\' - to display a set of random thumb-images from the most recently added directory (applies only to the images which are stored in the database, defaults to a number of 6 images)</li>
</ul>
Note that images are only stored in the database when the specific gallery is visited in the admin or frontend.
';

$lang['help'] = '<h3>What does this do?</h3>
	<p>This CMSMS YelpRank plugin lets you connect to Yelp\'s API and get profile details or reviews for a specific business alias/id</p>
	<h3>Get started with the Yelp Fusion API:</h3>
	<h4>Authentication</h4>
	<p>Yelp Fusion API uses private API Keys to authenticate requests. To authenticate the call to an endpoint, there are only 2 steps:</p>
	<ul><li>Create an app to obtain your private API Key.</li>
	  <li>Paste your API Key into the "key" parameter</li>
</ul> 
For detailed instructions, refer to our <A href="https://www.yelp.com/developers/documentation/v3/authentication">authentication guide</A>.</p>

<h3>How do I use it?</h3>
	<p>Insert the tag <code>{YelpRank}</code>, together with the required parameters in your template (case sensitive) for example:</p>
<ul>
	<li>\'<strong>(default)</strong>\' - This endpoint returns detailed business content. Returns Template Smarty Variables.<br>
		<code>{YelpRank key=\'Your API Key\' biz=\'gary-danko-san-francisco\'}</code><br>
		<code>{$item->review_count} = 5296</code><br>
		Available Template Smarty Variables (Business): <a href="#" onclick="togglecollapse(\'variablesinfo\'); return false;"><img src="themes/OneEleven/images/icons/system/info.gif" class="systemicon" alt="Available Template Smarty Variables" title="Available Template Smarty Variables"></a><br>
		<div id="variablesinfo" style="display: none;">
        <pre>$item = {
   .id (string)
   .alias (string)
   .name (string)
   .image_url (string)
   .is_claimed (boolean)
   .is_closed (boolean)
   .url (string)
   .phone (string)
   .display_phone
   .review_count (integer)
   ->categories (array) = [
      [0] (object of type: stdClass) = {
         .alias (string)
         .title (string)
      }
   ]
   .rating (double)
   ->location (object of type: stdClass) = {
      .address1 (string)
      .address2 (string)
      .address3 (string)
      .city (string)
      .zip_code (string)
      .country (string)
      .state (string)
      ->display_address (array) = [
         .0 (string)
         .1 (string)
      ]
      .cross_streets (string)
   }
   ->coordinates (object of type: stdClass) = {
      .latitude (double)
      .longitude (double)
   }
   ->photos (array) = [
      .0 (string)
      .1 (string)
      .2 (string)
   ]
   ->hours (array) = [
      [0] (object of type: stdClass) = {
         ->open (array) = [
            [0] (object of type: stdClass) = {
               .is_overnight (boolean)
               .start (string)
               .end (string)
               .day (integer)
            }
            [1] (object of type: stdClass) = {
               .is_overnight (boolean)
               .start (string)
               .end (string)
               .day (integer)
            }
         ]
         .hours_type (string)
         .is_open_now (boolean)
      }
   ]
   ->transactions (array) = [
   ]
   ->messaging (object of type: stdClass) = {
      .url (string)
      .use_case_text (string)
   }
}
</pre>
		</div><br>
  </li>
	<li>\'<strong>reviews</strong>\' - This endpoint returns up to three review excerpts for a given business ordered by Yelp\'s default sort order.<br>
		<code>{YelpRank key=\'Your API Key\' biz=\'gary-danko-san-francisco\' <strong>action="reviews"</strong>}</code><br>
		<pre>
{foreach from=$items item=\'review\'}
&lt;ul&gt;
&lt;li&gt;Date: {$review-&gt;time_created}&lt;/li&gt;
&lt;li&gt;Rating: {$review-&gt;rating}&lt;/li&gt;
&lt;li&gt;Text: {$review-&gt;text}&lt;/li&gt;
&lt;/ul&gt;
{/foreach}
		</pre><br>
		Available Template Smarty Variables (Reviews): <a href="#" onclick="togglecollapse(\'variablesinfo2\'); return false;"><img src="themes/OneEleven/images/icons/system/info.gif" class="systemicon" alt="Available Template Smarty Variables" title="Available Template Smarty Variables"></a><br>
		<div id="variablesinfo2" style="display: none;">
 			 <pre>
$items (array) = [
      [0] (object of type: stdClass) = {
         .id (string)
         .url (string)
         .text (string)
         .rating (integer)
         .time_created (string)
         ->user (object of type: stdClass) = {
            .id (string)
            .profile_url (string)
            .image_url (string)
            .name (string)
         }
      }
      [1] (object of type: stdClass) = {
         .id (string)
         .url (string)
         .text (string)
         .rating (integer)
         .time_created (string)
         ->user (object of type: stdClass) = {
            .id (string)
            .profile_url (string)
            .image_url (string)
            .name (string)
         }
      }
      [2] (object of type: stdClass) = {
         .id (string)
         .url (string)
         .text (string)
         .rating (integer)
         .time_created (string)
         ->user (object of type: stdClass) = {
            .id (string)
            .profile_url (string)
            .image_url (string)
            .name (string)
         }
      }
   ]
   .total (integer)
   ->possible_languages (array) = [
      .0 (string)
   ]
}</pre>
		</div>
	  </li>
	  <li>\'<strong>field</strong>\' - Used to display a single value into your template: <br>
<code>{YelpRank key=\'Your API Key\' biz=\'gary-danko-san-francisco\' <strong>field=\'rating\'</strong>}</code> = 4.5
</li>
</ul>
<hr>
<h3>Feedback/Support</h3>
<p>This module does not include commercial support. However, there are a number of resources available to help you with it:</p>
<ul>
<li>For the latest version of this module or to file a Feature Request or Bug Report, please visit the Module Forge
<a href="http://dev.cmsmadesimple.org/projects/YelpRank" target="_blank">YelpRank Page</a>.</li>
<li>Additional discussion of this module may also be found in the <a href="https://forum.cmsmadesimple.org/viewtopic.php?f=7&t=83400">YelpRank forum topic</a>. You are warmly invited to open a new topic if you didn\'t find an answer to your question.</li>
<li>Lastly, if you enjoy this module, use it on a commercial website or would like to encourage future development, you might consider just a small donation. Any kind of feedback will be much appreciated.<br>
<a href="https://www.paypal.com/donate/?hosted_button_id=FWHABZUN3NC4N" target="_blank"><img src="https://raw.githubusercontent.com/aha999/DonateButtons/master/paypal-donate-icon-7.png" width="120" ></a><br>
	</li>
</ul>
<hr>
';
?>