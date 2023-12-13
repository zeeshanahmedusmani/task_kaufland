<?php
$conn = mysqli_connect("localhost", "root", "", "kaufland_db");

$affectedRow = 0;

$xml = simplexml_load_file("feed.xml") 
	or die("Error: Cannot create object");

foreach ($xml->children() as $row) {

	$entityId = (string)$row->entity_id;
	$categoryName = (string)$row->CategoryName; 
	$sku = (string)$row->sku;
	$name = (string)$row->name;
	$description = (string)$row->description;
	$shortDesc = (string)$row->shortdesc;
	$price = (string)$row->price;
	$link = (string)$row->link;
	$image = (string)$row->image;
	$brand = (string)$row->Brand;
	$rating = (string)$row->Rating;
	$caffeineType = (string)$row->CaffeineType;
	$count = (string)$row->Count;
	$flavored = (string)$row->Flavored;
	$seasonal = (string)$row->Seasonal;
	$inStock = (string)$row->Instock;
	$facebook = (string)$row->Facebook;
	$isKCup = (string)$row->IsKCup;

	$sql = "INSERT INTO xml_feed(entity_id, category_name, sku, name, description, shortdesc, price, link, image, brand, rating, caffeine_type, count, flavored, seasonal, instock, facebook, is_kcup, status) VALUES (\"$entityId\", \"$categoryName\", \"$sku\", \"$name\", \"$description\", \"$shortDesc\", \"$price\", \"$link\", \"$image\", \"$brand\", \"$rating\", \"$caffeineType\", \"$count\", \"$flavored\", \"$seasonal\", \"$inStock\", \"$facebook\", \"$isKCup\", 1)";


	// echo $sql;
	// exit;
	
	$result = mysqli_query($conn, $sql);
	
	if (! empty($result)) {
		$affectedRow ++;
	} else {
		$error_message = mysqli_error($conn) . "\n";
	}

}
	// exit;
?>
<?php
if ($affectedRow > 0) {
	$message = $affectedRow." records inserted";
} else {
	$message = "No records inserted";
}

?>

<h2><?php echo $message; ?></h2>

<?php if (! empty($error_message)) { ?>
	<h4><?php echo nl2br($error_message); ?></h4>
<?php } ?>
