<?php
try {
	// include the file for the database connection
	require_once('functions.php');
	// get database connection
	$dbConn = getConnection();

	// echo what getJSONOffer returns
	echo getJSONOffer($dbConn);
} catch (Exception $e) {
	echo "Error " . $e->getMessage();
}

function getJSONOffer($dbConn)
{
	header("Content-Type: application/json; charset=UTF-8");

	try {
		$sql = "select toyName, catDesc, toyPrice from NTL_special_offers inner join NTL_category on NTL_special_offers.catID = NTL_category.catID order by rand() limit 1";
		$rsOffer = $dbConn->query($sql);;
		$offer = $rsOffer->fetchObject();
		return json_encode($offer);
	} catch (Exception $e) {
		throw new Exception("problem: " . $e->getMessage());
	}
}
