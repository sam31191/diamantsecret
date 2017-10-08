<?php


    // /*  MySQL Configuration */
    // $host = "localhost";
    // $dbname = "diam_prince";
    // $user = "root";
    // $pass = "";
    

    // /* Mail Configuration */
    // $mailHost = 'mail.diamantsecret.com';
    // $mailPort = 26;
    // $mailSMTPAuth = true;
    // $mailUsername = "contact@diamantsecret.com";
    // $mailPassword = "contact@123";
    // $mailSenderEmail = "contact@diamantsecret.com";
    // $mailSenderName = "Diamant Secret";
    // $__ADMINMAIL__ = "ryan.bhanwra@gmail.com";
    // $__ADMINNAME__ = "Admin";
    // $__MAINDOMAIN__ = "http://localhost/git/diam_prince/diamantsecret/src/";
    // $__SITE = "diamant_secret";
    #$__MAINDOMAIN__ = "http://www.diamantsecret.com/";
    /*  MySQL Configuration */
    
    $host = "localhost";
    $dbname = "diamantsecret";
    $dbname = "db_diamantsecret_v6";
    $user = "root";
    $pass = "";

    /* Mail Configuration */
    $mailHost = 'mail.diamantsecret.com';
    $mailPort = 26;
    $mailSMTPAuth = true;
    $mailUsername = "contact@diamantsecret.com";
    $mailPassword = "contact@123";
    $mailSenderEmail = "contact@diamantsecret.com";
    $mailSenderName = "Diamant Secret";
    $__ADMINMAIL__ = "contact@diamantsecret.com";
    $__ADMINNAME__ = "Admin";
    $__MAINDOMAIN__ = "http://localhost/diamantsecret/src/";
    $__SITE = "diamant_secret";
    $lang = 'fr';
    if (isset($_REQUEST['lang']) && ($_REQUEST['lang'] == 'fr' || $_REQUEST['lang'] == 'en')) {
        $lang = $_REQUEST['lang'];
		
    }
    
    /* Test site options */
    $testSite = false;
    $__TESTSITEPREFIX__ = "[Test Site] ";
    $__TESTSITEDOMAIN__ = "http://localhost/git/diamweb/src/testsite/";

    if ( $testSite ) {
        $__MAINDOMAIN__ = $__TESTSITEDOMAIN__;
    }

    define('DOMAIN', $__MAINDOMAIN__);
    
    define('DATE_FORMAT', "F jS, Y");
    define('DATETIME_FORMAT', "h:iA F jS, Y");
    define('SQL_FORMAT', 'Y-m-d H:i:s');

    /* PAYPAL */
    define('PAYPAL_CLIENT_ID', 'Ab0rLmYMWXxrf0Ggqvp47_-QY0NrGKPXGBoKcq_rVi4dCHxdRnVuHL0FH306MeqQVGALx3t0xtAiMjZi');
    define('PAYPAL_CLIENT_SECRET', 'ENJ_bs_tEZVSyYxaIXaGIEphWwV9gNVjWu2g9m8mQfzmFtLjLOw7yt2VjfUtlCMSr8Pm-U-byhvsTaDt');

    /* Diamond Search Params */
    define("DIAMOND_SEARCH_THEME", "gold");
    define("DIAMOND_SEARCH_URL", "http://198.57.197.106/~arhaandiam/testsite/diamond-search");
    define("DIAMOND_SEARCH_API", "47030ee0-2bf5-11e7-b396-17bd839c5425");

    /* COOKIES */
    define("COOKIE_CART", "TEMP_CART");




$product_images = array(
                        'diamant-certificate1.jpg',
						'diamant-certificate2.jpg',
						'diamant-packing.jpg'
						);

    
    /* Other changes */
    // - Update $rootPath in __php__.php file
    $__IMPORT_IMAGE_RES__ = array(
        "LARGE" => 1600,
        "MED" => 600,
        "SMALL" => 200
    );

    $__MAX_MEMORY_LIMIT__ = '1024M';
    $__CRONJOB_DELETE_DAYS__ = 10;

    try{
        $pdo = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET sql_mode=""'));
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] ) {
            if ( !isset($_SESSION['_ref']) || $_SESSION['_ref'] !== $__SITE ) {
                unset($_SESSION);
                session_destroy();
            }   
        } 

        $checkVersion = $pdo->prepare("SELECT * FROM `version` WHERE `id` = 1");
        $checkVersion->execute();



        if ( $checkVersion->rowCount() > 0 ) {
            $version = $checkVersion->fetch(PDO::FETCH_ASSOC);

            include ('version.php');

            if ( $version['sql_version'] == $__SQLVERSION__ ) {
                #continue
            } else {
                echo var_dump("INVALID DATABASE VERSION.", "Found: " . $version['sql_version'] , "Expected: $__SQLVERSION__");
                die();
            }
        }
    }
    catch (PDOException $e){
        echo '<strong>MySQL Error:</strong> ' . $e->getMessage();
        die();
    }

    #Public Panel Vars Only. Use $_SESSION in Admin
    if ( isset($_SESSION['username']) ) {
        $_USERNAME = $_SESSION['username'];
    }
    if ( isset($_SESSION['loginAs']) ) {
        $_USERNAME = $_SESSION['loginAs'];
    }
    
    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    function pconsole($data) {
        if(is_array($data) || is_object($data))
        {
            echo("<script>console.log('PHP: ".json_encode($data)."');</script>");
        } else {
            echo("<script>console.log('PHP: ".$data."');</script>");
        }
    }

    function getMaterial($mID, $pdo) {
        $getMaterial = $pdo->prepare("SELECT * FROM `materials` WHERE `id` = :id");
        $getMaterial->execute(array(":id" => $mID));

        if ( $getMaterial->rowCount() > 0 ) {
            $material = $getMaterial->fetch(PDO::FETCH_ASSOC);
            return $material['category'];
            //echo $material['category'];
        } else {
            return "-";
        }
    }
    function getDiamondShape($dsID, $pdo) {
        $getMaterial = $pdo->prepare("SELECT * FROM `diamond_shape` WHERE `id` = :id");
        $getMaterial->execute(array(":id" => $dsID));

        if ( $getMaterial->rowCount() > 0 ) {
            $material = $getMaterial->fetch(PDO::FETCH_ASSOC);
            return $material['category'];
            //echo $material['category'];
        } else {
            return "-";
        }
    }

    function getCountry($dsID, $pdo) {
        $getMaterial = $pdo->prepare("SELECT * FROM `country_vat` WHERE `id` = :id");
        $getMaterial->execute(array(":id" => $dsID));

        if ( $getMaterial->rowCount() > 0 ) {
            $material = $getMaterial->fetch(PDO::FETCH_ASSOC);
            return $material['country_name'];
            //echo $material['category'];
        } else {
            return "-";
        }
    }

    function getCompany($dsID, $pdo) {
        $getMaterial = $pdo->prepare("SELECT * FROM `company_id` WHERE `id` = :id");
        $getMaterial->execute(array(":id" => $dsID));

        if ( $getMaterial->rowCount() > 0 ) {
            $material = $getMaterial->fetch(PDO::FETCH_ASSOC);
            return $material['company_name'];
            //echo $material['category'];
        } else {
            return "-";
        }
    }

    function getCompanyCode($dsID, $pdo) {
        $getMaterial = $pdo->prepare("SELECT * FROM `company_id` WHERE `id` = :id");
        $getMaterial->execute(array(":id" => $dsID));

        if ( $getMaterial->rowCount() > 0 ) {
            $material = $getMaterial->fetch(PDO::FETCH_ASSOC);
            return $material['company_code'];
            //echo $material['category'];
        } else {
            return "-";
        }
    }

    function getCompanyID($dsID, $pdo) {
        $getMaterial = $pdo->prepare("SELECT * FROM `company_id` WHERE `company_code` = :company_code");
        $getMaterial->execute(array(":company_code" => $dsID));

        if ( $getMaterial->rowCount() > 0 ) {
            $material = $getMaterial->fetch(PDO::FETCH_ASSOC);
            return $material['id'];
            //echo $material['category'];
        } else {
            return 0;
        }
    }

    function getCategory($dsID, $pdo) {
        $getMaterial = $pdo->prepare("SELECT * FROM `categories` WHERE `id` = :id");
        $getMaterial->execute(array(":id" => $dsID));

        if ( $getMaterial->rowCount() > 0 ) {
            $material = $getMaterial->fetch(PDO::FETCH_ASSOC);
            return $material['category'];
            //echo $material['category'];
        } else {
            return "-";
        }
    }
    function getRingCategory($dsID, $pdo) {
        $getMaterial = $pdo->prepare("SELECT * FROM `ring_subcategory` WHERE `id` = :id");
        $getMaterial->execute(array(":id" => $dsID));

        if ( $getMaterial->rowCount() > 0 ) {
            $material = $getMaterial->fetch(PDO::FETCH_ASSOC);
            return $material['category'];
            //echo $material['category'];
        } else {
            return "-";
        }
    }
    function getSiteidsValue( $site_ids) {
        
        $siteIdsArr = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0);
       
        if(empty($site_ids)){
            $siteIdsArr = array(0=>1,1=>1,2=>1,3=>1,4=>1,5=>1,6=>1,7=>1);
        }
        else{
            $siteIds =array();
            $siteIds = explode(',', rtrim($site_ids,','));
            foreach ($siteIds as $id) {
                $siteIdsArr[$id] = 1;
            }
        }
        return $siteIdsArr; 
    }
    function updateImportSiteIds( $pdo, $uniqueKey, $site_ids ) {

        $col_val = '';
        foreach ($site_ids as $key => $value) {
            $col_val .="site_".$key.' = '.$value.', ';
        }
        $update_item1 = $pdo->prepare('UPDATE items SET '.rtrim($col_val,', ').'  WHERE unique_key = "'.$uniqueKey.'"');
        $update_item1->execute();
    }

    function updateImportZipItem( $pdo, $uniqueKey, $values, $zip, $timeToken, $domain, $imgRes ) {
        //return json_encode($values);

        $company_id = getCompanyID($values['A'], $pdo);

        $updateItem = $pdo->prepare("UPDATE `items` SET `item_name` = :product_name, `item_value` = :product_price, `discount` = :discount, `category` = :category, family=:family, images_delta = :images_delta WHERE `unique_key` = :unique_key");
        $updateItem->execute(array(
            ":unique_key" => $uniqueKey,
            ":product_name" => $values['D'],
            ":product_price" => $values['E'],
            ":discount" => $values['F'],
            ":category" => $values['B'],
            ":family" => $values['AF'],
            ":images_delta" => $values['AB']

        ));

        /* VAR TYPE CHECK */
        if ( !is_integer($values['G']) ) {
            $values['G'] = intval($values['G']);
        }
        if ( !is_integer($values['H']) ) {
            $values['H'] = intval($values['H']);
        }
        if ( !is_integer($values['L']) ) {
            $values['L'] = intval($values['L']);
        }
        if ( !is_integer($values['M']) ) {
            $values['M'] = intval($values['M']);
        }
        if ( !is_integer($values['N']) ) {
            $values['N'] = intval($values['N']);
        }
        if ( !is_integer($values['O']) ) {
            $values['O'] = intval($values['O']);
        }
        if ( !is_integer($values['Q']) ) {
            $values['Q'] = intval($values['Q']);
        }
        if ( !is_integer($values['R']) ) {
            $values['R'] = intval($values['R']);
        }
        if ( !is_integer($values['W']) ) {
            $values['W'] = intval($values['W']);
        }
        if ( !is_integer($values['X']) ) {
            $values['X'] = intval($values['X']);
        }
        if ( !is_integer($values['Y']) ) {
            $values['Y'] = intval($values['Y']);
        }

        switch ($values['B']) {
            case 1: {
                $updateInfo = $pdo->prepare("UPDATE `rings` SET `company_id` = :company_id, `internal_id` = :internal_id, `product_name` = :product_name, `pieces_in_stock` = :pieces_in_stock, `days_for_shipment` = :days_for_shipment, `total_carat_weight` = :total_carat_weight, `no_of_stones` = :no_of_stones, `diamond_shape` = :diamond_shape, `clarity` = :clarity, `color` = :color, `diamond_color` = :diamond_color, `material` = :material, `height` = :height, `width` = :width, `length` = :length, `country_id` = :country_id, `description` = :description, `description_french` = :description_french, `ring_subcategory` = :ring_subcategory, `ring_size` = :ring_size, `total_gold_weight` = :total_gold_weight, `color_stone_carat` = :color_stone_carat, `no_of_color_stones` = :no_of_color_stones, `color_stone_shape` = :color_stone_shape, `lab_grown` = :lab_grown, `gold_quality` = :gold_quality, `color_stone_type` = :color_stone_type WHERE `unique_key` = :unique_key");
                $updateInfo->execute(array(
                    ":unique_key" => $uniqueKey,
                    ":company_id" => $company_id,
                    ":internal_id" => $values['C'],
                    ":product_name" => $values['D'],
                    ":pieces_in_stock" => $values['G'],
                    ":days_for_shipment" => $values['H'],
                    ":total_gold_weight" => $values['I'],
                    ":total_carat_weight" => $values['J'],
                    ":color_stone_carat" => $values['K'],
                    ":no_of_stones" => $values['L'],
                    ":no_of_color_stones" => $values['M'],
                    ":diamond_shape" => $values['N'],
                    ":color_stone_shape" => $values['O'],
                    ":clarity" => $values['P'],
                    ":color" => $values['Q'],
                    ":material" => $values['R'],
                    ":gold_quality" => $values['S'],
                    ":color_stone_type" => $values['T'],
                    ":height" => $values['U'],
                    ":width" => $values['V'],
                    ":length" => $values['W'],
                    ":ring_size" => $values['X'],
                    ":country_id" => $values['Y'],
                    ":ring_subcategory" => $values['Z'],
                    ":lab_grown" => $values['AA'],
                    ":description" => $values['AC'],
                    ":description_french" => $values['AD'],
                    ":diamond_color" => $values['AE']
                ));


                $getitemID = $pdo->prepare("SELECT `id`, `images` FROM `rings` WHERE `unique_key` = :unique_key");
                $getitemID->execute(array(":unique_key" => $uniqueKey));
                $item = $getitemID->fetch(PDO::FETCH_ASSOC);
                $itemID = $item['id'];
                $itemImages = $item['images'];

                break;
            } case 2: {
                $updateInfo = $pdo->prepare("UPDATE `earrings` SET `company_id` = :company_id, `internal_id` = :internal_id, `product_name` = :product_name, `pieces_in_stock` = :pieces_in_stock, `days_for_shipment` = :days_for_shipment, `total_carat_weight` = :total_carat_weight, `no_of_stones` = :no_of_stones, `diamond_shape` = :diamond_shape, `clarity` = :clarity, `color` = :color, `diamond_color` = :diamond_color, `material` = :material, `height` = :height, `width` = :width, `length` = :length, `country_id` = :country_id, `description` = :description, `description_french` = :description_french, `ring_subcategory` = :ring_subcategory, `ring_size` = :ring_size, `total_gold_weight` = :total_gold_weight, `color_stone_carat` = :color_stone_carat, `no_of_color_stones` = :no_of_color_stones, `color_stone_shape` = :color_stone_shape, `lab_grown` = :lab_grown, `gold_quality` = :gold_quality, `color_stone_type` = :color_stone_type WHERE `unique_key` = :unique_key");
                $updateInfo->execute(array(
                    ":unique_key" => $uniqueKey,
                    ":company_id" => $company_id,
                    ":internal_id" => $values['C'],
                    ":product_name" => $values['D'],
                    ":pieces_in_stock" => $values['G'],
                    ":days_for_shipment" => $values['H'],
                    ":total_gold_weight" => $values['I'],
                    ":total_carat_weight" => $values['J'],
                    ":color_stone_carat" => $values['K'],
                    ":no_of_stones" => $values['L'],
                    ":no_of_color_stones" => $values['M'],
                    ":diamond_shape" => $values['N'],
                    ":color_stone_shape" => $values['O'],
                    ":clarity" => $values['P'],
                    ":color" => $values['Q'],
                    ":material" => $values['R'],
                    ":gold_quality" => $values['S'],
                    ":color_stone_type" => $values['T'],
                    ":height" => $values['U'],
                    ":width" => $values['V'],
                    ":length" => $values['W'],
                    ":ring_size" => $values['X'],
                    ":country_id" => $values['Y'],
                    ":ring_subcategory" => $values['Z'],
                    ":lab_grown" => $values['AA'],
                    ":description" => $values['AC'],
                    ":description_french" => $values['AD'],
                    ":diamond_color" => $values['AE']

                ));

                
                $getitemID = $pdo->prepare("SELECT `id`, `images` FROM `earrings` WHERE `unique_key` = :unique_key");
                $getitemID->execute(array(":unique_key" => $uniqueKey));
                $item = $getitemID->fetch(PDO::FETCH_ASSOC);
                $itemID = $item['id'];
                $itemImages = $item['images'];

                break;
            } case 3: {
                $updateInfo = $pdo->prepare("UPDATE `pendants` SET `company_id` = :company_id, `internal_id` = :internal_id, `product_name` = :product_name, `pieces_in_stock` = :pieces_in_stock, `days_for_shipment` = :days_for_shipment, `total_carat_weight` = :total_carat_weight, `no_of_stones` = :no_of_stones, `diamond_shape` = :diamond_shape, `clarity` = :clarity, `color` = :color, `diamond_color` = :diamond_color, `material` = :material, `height` = :height, `width` = :width, `length` = :length, `country_id` = :country_id, `description` = :description, `description_french` = :description_french, `ring_subcategory` = :ring_subcategory, `ring_size` = :ring_size, `total_gold_weight` = :total_gold_weight, `color_stone_carat` = :color_stone_carat, `no_of_color_stones` = :no_of_color_stones, `color_stone_shape` = :color_stone_shape, `lab_grown` = :lab_grown, `gold_quality` = :gold_quality, `color_stone_type` = :color_stone_type WHERE `unique_key` = :unique_key");
                $updateInfo->execute(array(
                    ":unique_key" => $uniqueKey,
                    ":company_id" => $company_id,
                    ":internal_id" => $values['C'],
                    ":product_name" => $values['D'],
                    ":pieces_in_stock" => $values['G'],
                    ":days_for_shipment" => $values['H'],
                    ":total_gold_weight" => $values['I'],
                    ":total_carat_weight" => $values['J'],
                    ":color_stone_carat" => $values['K'],
                    ":no_of_stones" => $values['L'],
                    ":no_of_color_stones" => $values['M'],
                    ":diamond_shape" => $values['N'],
                    ":color_stone_shape" => $values['O'],
                    ":clarity" => $values['P'],
                    ":color" => $values['Q'],
                    ":material" => $values['R'],
                    ":gold_quality" => $values['S'],
                    ":color_stone_type" => $values['T'],
                    ":height" => $values['U'],
                    ":width" => $values['V'],
                    ":length" => $values['W'],
                    ":ring_size" => $values['X'],
                    ":country_id" => $values['Y'],
                    ":ring_subcategory" => $values['Z'],
                    ":lab_grown" => $values['AA'],
                    ":description" => $values['AC'],
                    ":description_french" => $values['AD'],
                    ":diamond_color" => $values['AE']

                ));

                
                $getitemID = $pdo->prepare("SELECT `id`, `images` FROM `pendants` WHERE `unique_key` = :unique_key");
                $getitemID->execute(array(":unique_key" => $uniqueKey));
                $item = $getitemID->fetch(PDO::FETCH_ASSOC);
                $itemID = $item['id'];
                $itemImages = $item['images'];

                break;
            } case 4: {
                $updateInfo = $pdo->prepare("UPDATE `necklaces` SET `company_id` = :company_id, `internal_id` = :internal_id, `product_name` = :product_name, `pieces_in_stock` = :pieces_in_stock, `days_for_shipment` = :days_for_shipment, `total_carat_weight` = :total_carat_weight, `no_of_stones` = :no_of_stones, `diamond_shape` = :diamond_shape, `clarity` = :clarity, `color` = :color, `diamond_color` = :diamond_color, `material` = :material, `height` = :height, `width` = :width, `length` = :length, `country_id` = :country_id, `description` = :description, `description_french` = :description_french, `ring_subcategory` = :ring_subcategory, `ring_size` = :ring_size, `total_gold_weight` = :total_gold_weight, `color_stone_carat` = :color_stone_carat, `no_of_color_stones` = :no_of_color_stones, `color_stone_shape` = :color_stone_shape, `lab_grown` = :lab_grown, `gold_quality` = :gold_quality, `color_stone_type` = :color_stone_type WHERE `unique_key` = :unique_key");
                $updateInfo->execute(array(
                    ":unique_key" => $uniqueKey,
                    ":company_id" => $company_id,
                    ":internal_id" => $values['C'],
                    ":product_name" => $values['D'],
                    ":pieces_in_stock" => $values['G'],
                    ":days_for_shipment" => $values['H'],
                    ":total_gold_weight" => $values['I'],
                    ":total_carat_weight" => $values['J'],
                    ":color_stone_carat" => $values['K'],
                    ":no_of_stones" => $values['L'],
                    ":no_of_color_stones" => $values['M'],
                    ":diamond_shape" => $values['N'],
                    ":color_stone_shape" => $values['O'],
                    ":clarity" => $values['P'],
                    ":color" => $values['Q'],
                    ":material" => $values['R'],
                    ":gold_quality" => $values['S'],
                    ":color_stone_type" => $values['T'],
                    ":height" => $values['U'],
                    ":width" => $values['V'],
                    ":length" => $values['W'],
                    ":ring_size" => $values['X'],
                    ":country_id" => $values['Y'],
                    ":ring_subcategory" => $values['Z'],
                    ":lab_grown" => $values['AA'],
                    ":description" => $values['AC'],
                    ":description_french" => $values['AD'],
                    ":diamond_color" => $values['AE']

                ));

                
                $getitemID = $pdo->prepare("SELECT `id`, `images` FROM `necklaces` WHERE `unique_key` = :unique_key");
                $getitemID->execute(array(":unique_key" => $uniqueKey));
                $item = $getitemID->fetch(PDO::FETCH_ASSOC);
                $itemID = $item['id'];
                $itemImages = $item['images'];

                break;
            } case 5: {
                $updateInfo = $pdo->prepare("UPDATE `bracelets` SET `company_id` = :company_id, `internal_id` = :internal_id, `product_name` = :product_name, `pieces_in_stock` = :pieces_in_stock, `days_for_shipment` = :days_for_shipment, `total_carat_weight` = :total_carat_weight, `no_of_stones` = :no_of_stones, `diamond_shape` = :diamond_shape, `clarity` = :clarity, `color` = :color, `diamond_color` = :diamond_color, `material` = :material, `height` = :height, `width` = :width, `length` = :length, `country_id` = :country_id, `description` = :description, `description_french` = :description_french, `ring_subcategory` = :ring_subcategory, `ring_size` = :ring_size, `total_gold_weight` = :total_gold_weight, `color_stone_carat` = :color_stone_carat, `no_of_color_stones` = :no_of_color_stones, `color_stone_shape` = :color_stone_shape, `lab_grown` = :lab_grown, `gold_quality` = :gold_quality, `color_stone_type` = :color_stone_type WHERE `unique_key` = :unique_key");
                $updateInfo->execute(array(
                    ":unique_key" => $uniqueKey,
                    ":company_id" => $company_id,
                    ":internal_id" => $values['C'],
                    ":product_name" => $values['D'],
                    ":pieces_in_stock" => $values['G'],
                    ":days_for_shipment" => $values['H'],
                    ":total_gold_weight" => $values['I'],
                    ":total_carat_weight" => $values['J'],
                    ":color_stone_carat" => $values['K'],
                    ":no_of_stones" => $values['L'],
                    ":no_of_color_stones" => $values['M'],
                    ":diamond_shape" => $values['N'],
                    ":color_stone_shape" => $values['O'],
                    ":clarity" => $values['P'],
                    ":color" => $values['Q'],
                    ":material" => $values['R'],
                    ":gold_quality" => $values['S'],
                    ":color_stone_type" => $values['T'],
                    ":height" => $values['U'],
                    ":width" => $values['V'],
                    ":length" => $values['W'],
                    ":ring_size" => $values['X'],
                    ":country_id" => $values['Y'],
                    ":ring_subcategory" => $values['Z'],
                    ":lab_grown" => $values['AA'],
                    ":description" => $values['AC'],
                    ":description_french" => $values['AD'],
                    ":diamond_color" => $values['AE']

                ));

                
                $getitemID = $pdo->prepare("SELECT `id`, `images` FROM `bracelets` WHERE `unique_key` = :unique_key");
                $getitemID->execute(array(":unique_key" => $uniqueKey));
                $item = $getitemID->fetch(PDO::FETCH_ASSOC);
                $itemID = $item['id'];
                $itemImages = $item['images'];

                break;
            } default : {
                return "Invalid Item";
            }
        } 

        $imageFolder = "../images/";

        if ( is_dir($imageFolder) ) {

        } else if ( is_dir("../" . $imageFolder) ) {
            $imageFolder = "../" . $imageFolder;
        } else if ( is_dir("../../" . $imageFolder) ) {
            $imageFolder = "../../" . $imageFolder;
        }  else if ( is_dir("../../../" . $imageFolder) ) {
            $imageFolder = "../../../" . $imageFolder;
        }  else if ( is_dir("../../../../" . $imageFolder) ) {
            $imageFolder = "../../../../" . $imageFolder;
        } 

        switch ($values['B']) {
            case 1: {
                $imgName = "ring";
                break;
            } case 2: {
                $imgName = "earring";
                break;
            } case 3: {
                $imgName = "pendant";
                break;
            } case 4: {
                $imgName = "necklace";
                break;
            } case 5: {
                $imgName = "bracelet";
                break;
            } default: {
                return "Invalid Item";
            }
        }

        $intError = "";
        $images = "";

        #Deleting Old
        foreach ( explode(",", $itemImages) as $image ) {
            if ( !empty($image) ) {
                if ( is_file($imageFolder . 'images/' . $image) ) {
                    unlink($imageFolder . 'images/' . $image);
                }
                if ( is_file($imageFolder . 'images_md/' . $image) ) {
                    unlink($imageFolder . 'images_md/' . $image);
                }
                if ( is_file($imageFolder . 'images_sm/' . $image) ) {
                    unlink($imageFolder . 'images_sm/' . $image);
                }
            }
        }

        #Adding Images
        foreach ( explode(",", $values['AB']) as $image ) {
            if ( !empty($image) ) {
                    
                if ( $zip == 1 ) {
                    $url = $domain . 'working/zip/import/'. $timeToken .'/images/' . trim($image);
                } else {
                    $url = trim($image);
                }

                $ext = explode(".", $url);
                $ext =  '.' . $ext[sizeof($ext)-1];
                $count = 0;
                $img = $imageFolder . 'images/'. $imgName . '_' . $itemID .'_' . $count . $ext;
                $img_md = $imageFolder . 'images_md/'. $imgName . '_' . $itemID .'_' . $count . $ext;
                $img_sm = $imageFolder . 'images_sm/'. $imgName . '_' . $itemID .'_' . $count . $ext;
                while ( file_exists($img) ) {
                    $count++;
                    $img = $imageFolder . 'images/'. $imgName . '_' . $itemID .'_' . $count . $ext;
                    $img_md = $imageFolder . 'images_md/'. $imgName . '_' . $itemID .'_' . $count . $ext;
                    $img_sm = $imageFolder . 'images_sm/'. $imgName . '_' . $itemID .'_' . $count . $ext;
                }

                if ( !is_dir($imageFolder . 'images/') ) {
                    mkdir($imageFolder . 'images/');
                }
                if ( !is_dir($imageFolder . 'images_md/') ) {
                    mkdir($imageFolder . 'images_md/');
                }
                if ( !is_dir($imageFolder . 'images_sm/') ) {
                    mkdir($imageFolder . 'images_sm/');
                }
                


                $ch=curl_init();
                $timeout=30;

                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                $inputImg=curl_exec($ch);
                $curlError = curl_error($ch);
                $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
                curl_close($ch);

                if ( empty($curlError) ) {
                    if ( strpos($contentType, "image/") === false ) {
                        $intError .= 'Invalid Image: ' . pathinfo($url, PATHINFO_BASENAME) . '<br>';
                    } else {
                        try {
                            file_put_contents($img, $inputImg);
                            create_thumb($img, $imgRes['LARGE'], $imgRes['LARGE'], $img);
                            create_thumb($img, $imgRes['MED'], $imgRes['MED'], $img_md);
                            create_thumb($img, $imgRes['SMALL'], $imgRes['SMALL'], $img_sm);
                            $images .= basename($img) . ",";
                        } catch (Exception $e) {
                            $intError .= $e;
                        }
                    }
                } else {
                    if ( strstr($curlError, "Connection timed out") ) {
                        $intError .= 'Image took too long to download: ' . $url . '<br>' ;
                    } else if ( strstr($curlError, "malformed" ) ) {
                        $intError .= "Invalid Image URL";
                    } else {
                        $intError .= $curlError . '<br>' ;
                    }
                }
            } else {
                $intError .= "No Image Found";
            }
        }

        switch ($values['B']) {
            case 1: {
                $updateImages = $pdo->prepare("UPDATE `rings` SET `images` = :images WHERE `unique_key` = :key");
                break;
            }
            case 2: {
                $updateImages = $pdo->prepare("UPDATE `earrings` SET `images` = :images WHERE `unique_key` = :key");
                break;
            }
            case 3: {
                $updateImages = $pdo->prepare("UPDATE `pendants` SET `images` = :images WHERE `unique_key` = :key");
                break;
            }
            case 4: {
                $updateImages = $pdo->prepare("UPDATE `necklaces` SET `images` = :images WHERE `unique_key` = :key");
                break;
            }
            case 5: {
                $updateImages = $pdo->prepare("UPDATE `bracelets` SET `images` = :images WHERE `unique_key` = :key");
                break;
            } default: {
                return "Invalid Item";
            }
        }
        $updateImages->execute(array(":images" => $images, ":key" => $uniqueKey));

        if ( empty($intError) ) {
            $intError = "No Errors";
        }

        return " - ". $intError;

    }

    function getPriceRange($id) {
        switch ($id) {
            case 1: {
                return array(0, 99.9);
                break;
            }
            case 2: {
                return array(100.0, 299.99);
                break;
            }
            case 3: {
                return array(300.0, 599.9);
                break;
            }
            case 4: {
                return array(600.0, 999.9);
                break;
            }
            case 5: {
                return array(1000.0, 1000000.0);
                break;
            }
            default: {
                return null;
                break;
            }
        }
    }

    function parseCartItem($item) {
        if ( !empty($item) ) {
            $itemInfo = explode("|", $item);
            if ( sizeof($itemInfo) == 3 ) {
                return array("ID" => $itemInfo[0], "SIZE" => $itemInfo[1], "QUANTITY" => $itemInfo[2]);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function addToCart($pdo, $pid, $size, $quantity) {

        $checkCart = $pdo->prepare("SELECT * FROM tb_cart WHERE user_id = :uid AND product_id = :pid AND size = :size");
        $checkCart->execute(array(":uid" => $_SESSION['user_id'], ":pid" => $pid, ":size" => $size));

        if ( $checkCart->rowCount() > 0 ) {
            $updateCart = $pdo->prepare("UPDATE tb_cart SET quantity = quantity + :quantity WHERE user_id = :uid AND product_id = :pid AND size = :size");
            $updateCart->execute(array(":uid" => $_SESSION['user_id'], ":pid" => $pid, ":size" => $size, ":quantity" => intval($quantity)));
        } else {
            $updateCart = $pdo->prepare("INSERT INTO tb_cart (quantity, user_id, product_id, size) VALUES (:quantity, :uid, :pid, :size)");
            $updateCart->execute(array(":uid" => $_SESSION['user_id'], ":pid" => $pid, ":size" => $size, ":quantity" => intval($quantity)));
        }
    }

    function getItemInfo($pid) {
        global $pdo;

        $productCategory = $pdo->prepare("SELECT category FROM items WHERE unique_key = :pid");
        $productCategory->execute(array(":pid" => $pid));

        if ( $productCategory->rowCount() > 0 ) {
            $productCategory = $productCategory->fetch(PDO::FETCH_ASSOC)['category'];

            $categoryName = $pdo->prepare("SELECT category FROM categories WHERE id = :id");
            $categoryName->execute(array(":id" => $productCategory));

            if ( $categoryName->rowCount() > 0 ) {
                $categoryName = $categoryName->fetch(PDO::FETCH_ASSOC)['category'];

                $itemInfo = $pdo->prepare("SELECT * FROM items LEFT JOIN ". $categoryName ." ON items.unique_key = ". $categoryName .".unique_key WHERE items.unique_key = :key");
                $itemInfo->execute(array(":key" => $pid));

                if ( $itemInfo->rowCount() > 0 ) {
                    $itemInfo = $itemInfo->fetch(PDO::FETCH_ASSOC);

                    return $itemInfo;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getTotalValue($pid) {
        global $pdo;
        $itemInfo = getItemInfo($pid);

        if ( $itemInfo ) {
            $productValue = $itemInfo['item_value'];
            $discount = $itemInfo['discount'];
            $vat = $pdo->prepare("SELECT `vat` FROM country_vat WHERE id = :id");
            $vat->execute(array(":id" => $itemInfo['country_id']));

            if ( $vat->rowCount() > 0 ) {
                $vat = $vat->fetch(PDO::FETCH_ASSOC)['vat'];

                $totalValue = $productValue - ($discount / 100 * $productValue);

                $totalValue = $totalValue + ($vat / 100 * $totalValue);

                return round($totalValue, 2);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
	
	function alterFilepathHttps($file) {
		if (substr($file, 0, 5) === 'http:') {
			$file = substr($file, 5);
		}
		return $file;
	}
 $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (strpos($actual_link,'admin') !== false) {
    
}else if(basename($_SERVER['PHP_SELF']) == 'ajax.php' || basename($_SERVER['PHP_SELF']) == 'fetch_item_info.php' || basename($_SERVER['PHP_SELF']) == 'post.php') {
    include '../translation/french.php';
 } else {
    include 'translation/french.php';
 }

function processUrlParameter($urlParam){
    $urlParam = strtolower($urlParam);
    $urlParam = str_replace(" ", "-", $urlParam);
    $urlParam = str_replace("'", "", $urlParam);
    return $urlParam;
}
function makeProductDetailPageUrl($subcategory,$carat,$gold_quality,$materil,$product_name,$unique_key)
{
    global $pdo,$__MAINDOMAIN__,$lang;
    if(is_numeric($subcategory))
    {
        $name = $pdo->prepare("SELECT  category FROM ring_subcategory WHERE id = '".$subcategory."'");
        $name->execute(); 
         $subcategoryQry = $name->fetch();

      if(isset($subcategoryQry['category'])) {
        $subcategory = $subcategoryQry['category'];
      }

    }
    //gold_quality
    $gold_quality = $pdo->prepare("SELECT  gold_quality FROM gold_quality WHERE id = '".$gold_quality."'");
    $gold_quality->execute(); 
    $goldQtyQry = $gold_quality->fetch();

    $gold_quality_str = '';
      if(isset($goldQtyQry['gold_quality'])) {
        $gold_quality_str = $goldQtyQry['gold_quality'];
      }
    //Material
   
    $materials = $pdo->prepare("SELECT  category FROM materials WHERE id = '".$materil."'");
    $materials->execute();
     $materialsQry = $materials->fetch();

    $materials_str = '';
      if(isset($materialsQry['category'])) {
        $materials_str = $materialsQry['category'];
      }


    return $__MAINDOMAIN__.$lang.'/'.__('product').'/'.str_replace(" ", "-", strtolower($subcategory)).'/'.str_replace(".", "", $carat).'-ct-'.$gold_quality_str.'-'.str_replace(" ", "-", strtolower($materials_str)).'-'.str_replace(" ", "-", strtolower($product_name)).'/'.$unique_key;

}

?>
