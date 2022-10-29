<h3>Get started with the Yelp Fusion API:</h3>
<h4>Authentication</h4>
<p>Yelp Fusion API uses private API Keys to authenticate requests. To authenticate the call to an endpoint, there are only 2 steps:</p>
<ul>
	<li>Create an app to obtain your private API Key.</li>
	<li>Paste your API Key into the "API Key" box below</li>
</ul>
<p>For detailed instructions, refer to our <a href="https://www.yelp.com/developers/documentation/v3/authentication" target="_blank">authentication guide</a></p>
{form_start}
<div class="pageoverflow">
 <p class="pagetext">{$mod->Lang('admin_api_key')}:</p>
 <p class="pageinput">
<input type="text" name="{$actionid}yelp_api" value="{$yelp_api}" size="100" maxlength="255"/>
 </p>
</div>
<div class="pageoverflow">
 <p class="pageinput">
 <input type="submit" name="{$actionid}submit" value="{$mod->Lang('admin_save')}"/>
 </p>
</div>
{form_end}