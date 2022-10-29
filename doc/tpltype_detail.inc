<style type="text/css">
	ul.helptext {
	  list-style-type: disc;
	  margin-left: 1em;
	  margin-bottom: 1em;
	}
	code { 
    	background: hsl(220, 80%, 90%); 
		}

pre {
	font-size: 12px;
    white-space: pre-wrap;
	min-width: 50%
}
</style>

<h2>YelpRank Detail template help</h2>

<h3>Available Variables</h3>
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