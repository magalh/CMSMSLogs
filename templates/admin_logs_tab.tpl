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
    </tr>
    </thead>
    <tbody>
    {foreach $logs as $log}
    <tr class="{cycle values='row1,row2'}">
    <td>{$log->created|date_format:'%x'}</td>
    <td>{$mod->getLineIcon($log->type)}</td>
    <td>{$log->description}</td>
    <td>{$log->file}</td>
    <td>{$log->line}</td>
    </tr>
    {/foreach}
    </tbody>
    </table>
  {/if}
{/if}