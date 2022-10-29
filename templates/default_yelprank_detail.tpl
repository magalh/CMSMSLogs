{if !empty($error) }
	<div class="alert alert-danger">{$message}</div>
{/if}

{if $item->id}
<div class="yelprank_container">
	<h1 class="css-1se8maq">{$item->name}</h1>
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