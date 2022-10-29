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

<h2>YelpRank Reviews template help</h2>

<h3>Available Variables</h3>
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
   ]</pre>