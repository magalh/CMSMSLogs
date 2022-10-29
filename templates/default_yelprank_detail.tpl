{if !empty($error) }
	<div class="alert alert-danger">{$message}</div>
{/if}

{if $item->id}
<div class="yelprank_container">
	<h2>{$item->name}</h2>
	<div class="flex-container">
		<div class="flex">
			<span class="star-rating-sprite star-rating-sprite-{$item->star_css} mr16"></span>
		</div>
		<div class="flex flex-grow1">
			<span class="type--bold icon--sm">{$item->review_count}</span> <span>{$mod->Lang('reviews')}</span>
		</div>
	</div>
</div>
{cms_stylesheet name="YelpRank"}
{/if}