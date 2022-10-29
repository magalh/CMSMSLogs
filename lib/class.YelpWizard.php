<?php
class YelpWizard
{

	private $_data = array('biz'=>null,'yelp_key'=>null);
	
	public function get_business()
	{
		$url = YelpRank::API_HOST . YelpRank::BUSINESS_PATH . urlencode($this->biz);
		return $this->request($url);
	}
	
	public function get_reviews()
	{
		$url = YelpRank::API_HOST . YelpRank::BUSINESS_PATH . urlencode($this->biz). YelpRank::REVIEWS_PATH;
		return $this->request($url);
	}

	public function request($url)
	{
		try {
			
			$curl = curl_init();
			if (FALSE === $curl)
				throw new Exception('Failed to initialize');

			curl_setopt_array($curl, array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,  // Capture response.
				CURLOPT_ENCODING => "",  // Accept gzip/deflate/whatever.
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
				CURLOPT_HTTPHEADER => array(
					"authorization: Bearer " . $this->yelp_key,
					"cache-control: no-cache",
				),
			));

			$response = curl_exec($curl);

			if (FALSE === $response)
				throw new \LogicException(curl_error($curl), curl_errno($curl));
				$http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			if (200 != $http_status)
				throw new \LogicException($response, $http_status);
				curl_close($curl);
			} 
			catch (LogicException $e) {
				$error = 1;	
				$message = $e->getMessage();
			}

		return $response;
	}
	
	

	
	
}
?>