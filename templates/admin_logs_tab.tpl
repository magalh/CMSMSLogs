{if !empty($error) }
	<div class="warning">{$message}</div>
{else}
  {if !empty($logs)}
    <table class="pagetable cms_sortable tablesorter">
    <thead>
    <tr>
    <th>{$mod->Lang('date')}</th>
    <th>{$mod->Lang('type')}</th>
    <th>{$mod->Lang('message')}</th>
    <th>{$mod->Lang('file')}</th>
    <th>{$mod->Lang('line')}</th>
    <th class="pageicon">{* edit icon *}</th>
    </tr>
    </thead>
    <tbody>
    {foreach $logs as $log}
    <tr>
    <td>{$log["dateTime"]|date_format:'%x'}</td>
    <td>{$log["type"]}</td>
    <td>{$log["message"]}</td>
    <td>{$log["file"]}</td>
    <td>{$log["line"]}</td>
    <td>{admin_icon icon='edit.gif'}</td>
    </tr>
    {/foreach}
    </tbody>
    </table>
  {/if}
{/if}