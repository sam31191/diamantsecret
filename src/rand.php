<?php 
include 'conf/config.php';

if ( isset($_POST['addItem']) ) {

    for ( $i = 0; $i < $_POST['total']; $i++ ) {

        $nameArray = array("Corine", "Sylvie", "Mona", "Danielle", "Charlotte", "Clara", "Sasha", "Bayley", "Dana", "Becky", "Nikki", "Brie", "Alexa", "Twitch", "Ash", "IQ", "Hibana", "Valkyrie", "Frost", "Mira", "Natalya", "Tamina");

        $clarityArray = array("FL", "IF", "VVS1", "VVS2", "VS1", "VS2", "SI1", "SI2", "SI3");

        $categoryArray = array(1, 2, 3, 4, 5);

        $_ENTRY['category'] = $categoryArray[array_rand($categoryArray)];
        $_ENTRY['company_id'] = $_POST['company_id'];

        $_ENTRY['discount'] = mt_rand(0, 50);
        $_ENTRY['product_price'] = mt_rand(100, 10000); 
        $_ENTRY['pieces_in_stock'] = mt_rand(10, 100); 
        $_ENTRY['days_for_shipment'] = mt_rand(10, 100); 
        $_ENTRY['no_of_stones'] = mt_rand(1, 20); 
        $_ENTRY['no_of_color_stones'] = mt_rand(1, 20); 
        $_ENTRY['diamond_shape'] = mt_rand(1, 17); 
        $_ENTRY['color_stone_shape'] = mt_rand(1, 17); 
        $_ENTRY['color'] = mt_rand(1, 3); 
        $_ENTRY['material'] = mt_rand(1, 8); 
        $_ENTRY['country_id'] = mt_rand(1, 25); 
        $_ENTRY['ring_subcategory'] = mt_rand(1, 5); 
        $_ENTRY['lab_grown'] = mt_rand(0, 1); 
        $_ENTRY['diamond_color'] = mt_rand(1, 8); 
        $_ENTRY['total_carat_weight'] = mt_rand(1, 8); 
        $_ENTRY['color_stone_carat'] = mt_rand(1, 8); 
        $_ENTRY['total_gold_weight'] = mt_rand(1, 8); 
        $_ENTRY['gold_quality'] = "Great"; 
        $_ENTRY['color_stone_type'] = "Great"; 
        $_ENTRY['height'] = mt_rand(1, 10); 
        $_ENTRY['width'] = mt_rand(1, 10); 
        $_ENTRY['length'] = mt_rand(1, 10); 
        $_ENTRY['ring_size'] = mt_rand(40, 100); 
        $_ENTRY['internal_id'] = "TEST_". mt_rand(100, 999); 
        $_ENTRY['description'] = "Boucles d'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant."; 
        $_ENTRY['description_french'] = "Boucles d'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant."; 


        $_ENTRY['clarity'] = $clarityArray[array_rand($clarityArray)];

        $_ENTRY['product_name'] = $nameArray[array_rand($nameArray)] . " " . $nameArray[array_rand($nameArray)]; 
        $_ENTRY['item_name'] = $nameArray[array_rand($nameArray)] . " " . $nameArray[array_rand($nameArray)]; 

        


        switch ($_ENTRY['category']) {
            case 1: {
                $table = "rings";
                $imageName = "ring";
                $images = "ring_4_0.jpg,ring_4_1.jpg,ring_4_2.jpg,ring_4_3.jpg,ring_4_4.jpg,ring_4_5.jpg";
                break;
            } case 2: {
                $table = "earrings";
                $imageName = "earring";
                $images = "earring_9_0.jpg,earring_9_1.jpg,earring_9_2.jpg,earring_9_3.jpg,earring_9_4.jpg,earring_9_5.jpg";
                break;
            } case 3: {
                $table = "pendants";
                $imageName = "pendant";
                break;
            } case 4: {
                $table = "necklaces";
                $imageName = "necklace";
                $images = "necklace_1_0.jpg,necklace_1_1.jpg,necklace_1_2.jpg,necklace_1_3.jpg,necklace_1_4.jpg,necklace_1_5.jpg";
                break;
            } case 5: {
                $table = "bracelets";
                $imageName = "bracelet";
                $images = "bracelet_1_0.jpg,bracelet_1_1.jpg,bracelet_1_2.jpg";
                break;
            } default: {
                $table = "na";
                $imageName = "na";
                $images = "";
                break;
            }
        }

        if ( $_ENTRY['discount'] > 0 ) {
            $discount = $_ENTRY['discount'];
        } else {
            $discount = 0;
        }

        $_ENTRY['product_price'] = str_replace(",",  ".",    $_ENTRY['product_price']);

        /* Filtering Variables */
        $_ENTRY['pieces_in_stock'] = intval($_ENTRY['pieces_in_stock']);
        $_ENTRY['days_for_shipment'] = intval($_ENTRY['days_for_shipment']);
        $_ENTRY['no_of_stones'] = intval($_ENTRY['no_of_stones']);
        $_ENTRY['no_of_color_stones'] = intval($_ENTRY['no_of_color_stones']);
        $_ENTRY['diamond_shape'] = intval($_ENTRY['diamond_shape']);
        $_ENTRY['color_stone_shape'] = intval($_ENTRY['color_stone_shape']);
        $_ENTRY['color'] = intval($_ENTRY['color']);
        $_ENTRY['material'] = intval($_ENTRY['material']);
        $_ENTRY['country_id'] = intval($_ENTRY['country_id']);
        $_ENTRY['ring_subcategory'] = intval($_ENTRY['ring_subcategory']);
        $_ENTRY['lab_grown'] = intval($_ENTRY['lab_grown']);
        $_ENTRY['diamond_color'] = intval($_ENTRY['diamond_color']);

        $_ENTRY['total_carat_weight'] = floatval($_ENTRY['total_carat_weight']);
        $_ENTRY['color_stone_carat'] = floatval($_ENTRY['color_stone_carat']);
        
        
        $uniqueKey = generateUniqueKey();
        
        while ( checkKey($uniqueKey, $pdo) ) {
            $uniqueKey = generateUniqueKey();
        }


        $checkInternalID = $pdo->prepare("SELECT * FROM `". $table ."` WHERE `internal_id` = :intID");
        $checkInternalID->execute(array(":intID" => $_ENTRY['internal_id']));

        if ( $checkInternalID->rowCount() == 0 ) {

            $addInfo = $pdo->prepare("INSERT INTO `". $table ."` 
                (`unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_gold_weight`, `total_carat_weight`, `color_stone_carat`, `no_of_stones`, `no_of_color_stones`, `diamond_shape`, `color_stone_shape`, `clarity`, `color`, `diamond_color`, `material`, `height`, `width`, `length`, `country_id`, `lab_grown`, `images`, `description`, `description_french`, `ring_subcategory`, `ring_size`, gold_quality, color_stone_type) 
                VALUES 
                (:unique_key, :company_id, :internal_id, :product_name, :pieces_in_stock, :days_for_shipment, :total_gold_weight, :total_carat_weight, :color_stone_carat, :no_of_stones, :no_of_color_stones, :diamond_shape, :color_stone_shape, :clarity, :color, :diamond_color, :material, :height, :width, :length, :country_id, :lab_grown, :images, :description, :description_french, :ring_subcategory, :ring_size, :gold_quality, :color_stone_type)");
            $addInfo->execute(array(
                ":unique_key" => $uniqueKey,
                ":company_id" => $_ENTRY['company_id'],
                ":internal_id" => $_ENTRY['internal_id'],
                ":product_name" => $_ENTRY['product_name'],
                ":pieces_in_stock" => $_ENTRY['pieces_in_stock'],
                ":days_for_shipment" => $_ENTRY['days_for_shipment'],
                ":total_carat_weight" => $_ENTRY['total_carat_weight'],
                ":no_of_stones" => $_ENTRY['no_of_stones'],
                ":diamond_shape" => $_ENTRY['diamond_shape'],
                ":clarity" => $_ENTRY['clarity'],
                ":color" => $_ENTRY['color'], ":diamond_color" => $_ENTRY['diamond_color'],
                ":material" => $_ENTRY['material'],
                ":height" => $_ENTRY['height'],
                ":width" => $_ENTRY['width'],
                ":length" => $_ENTRY['length'],
                ":country_id" => $_ENTRY['country_id'],
                ":images" => "",
                ":description" => $_ENTRY['description'], ":description_french" => $_ENTRY["description_french"],
                ":ring_subcategory" => $_ENTRY['ring_subcategory'],
                ":ring_size" => $_ENTRY['ring_size'],
                ":total_gold_weight" => $_ENTRY['total_gold_weight'], 
                ":color_stone_carat" => floatval($_ENTRY['color_stone_carat']), 
                ":no_of_color_stones" => $_ENTRY['no_of_color_stones'], 
                ":color_stone_shape" => intval($_ENTRY['color_stone_shape']), 
                ":gold_quality" => $_ENTRY['gold_quality'],
                ":color_stone_type" => $_ENTRY['color_stone_type'],
                ":lab_grown" => $_ENTRY['lab_grown']
            ));

            $updateItemImages = $pdo->prepare("UPDATE `". $table ."` SET `images` = :images WHERE `unique_key` = :unique_key");
            $updateItemImages->execute(array(":images" => $images, ":unique_key" => $uniqueKey));

            $addItem = $pdo->prepare("INSERT INTO `items` (`unique_key`, `item_name`, `item_value`, `discount`, `category`, `featured`, `date_added`, site_0, site_1, site_2, site_3, site_4, site_5, site_6, site_7) VALUES (:unique_key, :product_name, :product_price, :discount, :category, 0, NOW(), 1, 1, 1, 1, 1, 1, 1, 1)");
            $addItem->execute(array(
                ":unique_key" => $uniqueKey,
                ":product_name" => $_ENTRY['product_name'],
                ":product_price" => $_ENTRY['product_price'],
                ":discount" => $discount,
                ":category" => $_ENTRY['category']
            ));
        }
        
    }

    //header("Location: ". $_SERVER['HTTP_REFERER']);
    echo "<DONE> Added: ". $_POST['total'] . " Entries";
}


function generateUniqueKey($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function checkKey($key, $pdo) {
    $checkKey = $pdo->prepare("SELECT * FROM `items` WHERE `unique_key` = :key");
    $checkKey->execute(array(":key" => $key));
    if ( $checkKey->rowCount() > 0 ) {
        return true; // Key exists
    } else {
        return false;
    }
}
?>

<form method="post">
    <select name="company_id" required>
        <?php 
        $query = $pdo->prepare("SELECT * FROM company_id");
        $query->execute();

        foreach ( $query->fetchAll() as $company ) {
            echo "<option value='". $company['id'] ."'>". $company['company_name'] ."</option>";
        }
        ?>
    </select>
    <select name="total">
        <option value="5"><?php echo __("Add"); ?> 5</option>
        <option value="10"><?php echo __("Add"); ?> 10</option>
        <option value="25"><?php echo __("Add"); ?> 25</option>
    </select>
    <button type="submit" name="addItem"><?php echo __("Add"); ?></button>
</form>

<?php 
session_start();
echo var_dump($_SESSION);

$cartItems = explode(",", $_COOKIE[COOKIE_CART]);

                    foreach ( $cartItems as $item ) {
                        $itemInfo = parseCartItem($item);

                        echo var_dump($itemInfo);
                    }
?>