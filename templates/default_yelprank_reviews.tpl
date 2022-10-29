{if !empty($error) }
	<div class="alert alert-danger">{$message}</div>
{else}
<div class="YelpRankReviews">
	{foreach from=$items item=entry}
	<ul>
		<li>Date: {$entry->time_created|date_format:'%Y-%m-%d'}</li>
		<li>Rating: {$entry->rating}</li>
		<li>Text: {$entry->text}</li>
	</ul>
	{/foreach}
</div>
{/if}