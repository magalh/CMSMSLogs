<h3>Overall Settings</h3>
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
{*get_template_vars*}