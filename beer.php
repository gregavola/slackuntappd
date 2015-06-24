<?php

require ("untappdPHP.php");

// Function for Vowels
function checkifvowel($string) {

	$v = strtolower($string[0]);

	$beer_name = explode(" ", $string);

	if (sizeof($beer_name) > 1 && strtolower($beer_name[0]) == "the")
	{
		return "";
	}
	else if ($v == "a" || $v == "e" || $v == "i" || $v == "o" || $v == "u")
	{
		return "an";
	}
	else
	{
		return "a";
	}
}

$client_id = "CLIENTIDHERE";
$client_secret = "CLIENTSECRETHERE";
$ut = new UntappdPHP($client_id, $client_secret, "");

header("Content-type: application/json");


$data = array();

if (isset($_POST)) {

	$event_json = json_decode(json_encode($_POST));

	if (sizeof($event_json) == 0) {
		$data["text"] = "Post is not empty, but has no results";

	} else {
		if (isset($event_json->text) && isset($event_json) && $event_json->trigger_word == "untappd") {
			$beer_name = explode("untappd", $event_json->text);

			if ( empty($beer_name['1'] ) ){
				$data["text"] = "You didn't search for anything! Please try again!";
				echo json_encode($data);
				exit;
				}

			$real_beer_name = trim($beer_name[1]);

			$result = $ut->get("/search/beer", array("q" => $real_beer_name));

			if ($result->meta->code == 200) {

				if ($result->response->beers->count == 0) {
					$data["text"] = "No results found for *".$real_beer_name."*";
				} else {
					$beer_id = $result->response->beers->items[0]->beer->bid;

					$data["beer_id"] = $beer_id;

					$result = $ut->get("/beer/info/".$beer_id);

					if ($result->meta->code == 200) {
						$beer = $result->response->beer;
						$data["parse"] = "full";
						$data["text"] = "*".$beer->beer_name . "* by *" . $beer->brewery->brewery_name . "* is ".checkifvowel($beer->beer_style)." ".$beer->beer_style ." at ".$beer->beer_abv."% with a rating of *" . round($beer->rating_score, 3) . "* - http://untappd.com/beer/".$beer->bid;
					} else {
						$data["text"] = $result->meta->code . " error on Beer Lookup - please try again! Error - ". $result->meta->error_detail;
					}
				}
			} else {
				$data["url"] = $url;
				$data["text"] = $result->meta->code . " error on Beer Search - please try again! Error - ". $result->meta->error_detail;
			}
		}
		else {
			$v = json_encode($_POST);
			$data["text"] = "Empty post response - " . $v;
		}
	}
} else {
	$data["text"] = "Post is empty";
}


echo json_encode($data);


?>
