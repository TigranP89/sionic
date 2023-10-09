<?php
  require_once ('Connection.php');
  $connection = Connection::getInstance();
  set_time_limit(30 * 60);//30 мин.
  function saveImport($connection, $import)
  {
    try {
      $stmt = $connection->prepare("INSERT INTO data (`name`, `code`, `weight`, `usage`)
                                                VALUES (:name, :code, :weight, :usage)");

      $stmt->bindParam(':name', $import["name"]);
      $stmt->bindParam(':code', $import["code"]);
      $stmt->bindParam(':weight', $import["weight"]);
      $stmt->bindParam(':usage', $import["usage"]);
      $stmt->execute();
    } catch (Exception $e){
      //здесь нечего делать
    }
  }

  function saveOffers($connection, $offers)
  {
    $code = $offers['code'];
    $quantity = (integer)$offers['quantity'];
    $prices = $offers['prices'][0];

    switch ($offers['parent_id']) {
      //Москва
      case "febf7618-7731-4ff1-942d-464809310f52":

        $stmt = $connection->prepare("UPDATE data SET quantity_msk = :quantity_msk, price_msk = :price_msk WHERE code = :code");
        $stmt->bindParam(':code', $code, PDO::PARAM_STR);
        $stmt->bindParam(':quantity_msk', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':price_msk', $prices['price_count'], PDO::PARAM_INT);
        $stmt->execute();

        break;
      //Санкт-Петербург
      case "0ed030a4-c3f7-48bb-b3ab-fe1cd85a089d":
        $stmt = $connection->prepare("UPDATE data SET quantity_st_petersburg = :quantity_st_petersburg, price_st_petersburg = :price_st_petersburg WHERE code = :code");
        $stmt->bindParam(':code', $code, PDO::PARAM_STR);
        $stmt->bindParam(':quantity_st_petersburg', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':price_st_petersburg', $prices['price_count'], PDO::PARAM_INT);
        $stmt->execute();

        break;
      //Самара
      case "97e11fe4-86c7-4cf4-bc98-bf4a909babad":
        $stmt = $connection->prepare("UPDATE data SET quantity_samara = :quantity_samara, price_samara = :price_samara WHERE code = :code");
        $stmt->bindParam(':code', $code, PDO::PARAM_STR);
        $stmt->bindParam(':quantity_samara', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':price_samara', $prices['price_count'], PDO::PARAM_INT);
        $stmt->execute();

        break;
      //Саратов
      case "ae99aae5-88e3-420c-8b55-d8b866703693":
        $stmt = $connection->prepare("UPDATE data SET quantity_saratov = :quantity_saratov, price_saratov = :price_saratov WHERE code = :code");
        $stmt->bindParam(':code', $code, PDO::PARAM_STR);
        $stmt->bindParam(':quantity_saratov', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':price_saratov', $prices['price_count'], PDO::PARAM_INT);
        $stmt->execute();

        break;
      //Казань
      case "695771f0-117f-4a73-a0bb-0b7f6af1bc05":
        $stmt = $connection->prepare("UPDATE data SET quantity_kazan = :quantity_kazan, price_kazan = :price_kazan WHERE code = :code");
        $stmt->bindParam(':code', $code, PDO::PARAM_STR);
        $stmt->bindParam(':quantity_kazan', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':price_kazan', $prices['price_count'], PDO::PARAM_INT);
        $stmt->execute();

        break;
      //Новосибирск
      case "caf5aeb2-99d6-4ce8-b6ba-129e8d37f7c4":
        $stmt = $connection->prepare("UPDATE data SET quantity_novosibirsk = :quantity_novosibirsk, price_novosibirsk = :price_novosibirsk WHERE code = :code");
        $stmt->bindParam(':code', $code, PDO::PARAM_STR);
        $stmt->bindParam(':quantity_novosibirsk', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':price_novosibirsk', $prices['price_count'], PDO::PARAM_INT);
        $stmt->execute();

        break;
      //Челябинск
      case "abf3e096-ecce-4d7a-881f-5c421bd76baa":
        $stmt = $connection->prepare("UPDATE data SET quantity_chelyabinsk = :quantity_chelyabinsk, price_chelyabinsk = :price_chelyabinsk WHERE code = :code");
        $stmt->bindParam(':code', $code, PDO::PARAM_STR);
        $stmt->bindParam(':quantity_chelyabinsk', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':price_chelyabinsk', $prices['price_count'], PDO::PARAM_INT);
        $stmt->execute();

        break;
      //Деловые линии Челябинск
      case "a5608eee-1f3f-4de2-8388-ecb4235ac62a":
        $stmt = $connection->prepare("UPDATE data SET quantity_business_lines_chelyabin = :quantity_business_lines_chelyabin, price_business_lines_chelyabin = :price_business_lines_chelyabin WHERE code = :code");
        $stmt->bindParam(':code', $code, PDO::PARAM_STR);
        $stmt->bindParam(':quantity_business_lines_chelyabin', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':price_business_lines_chelyabin', $prices['price_count'], PDO::PARAM_INT);
        $stmt->execute();

        break;
    }
  }

  function convertImpots($xml)
  {
    $data = [];

    if (isset($xml->Каталог)){

      $goods = $xml->Каталог->Товары->Товар;

      foreach ($goods as $product){
        $innerArray = [];
        $innerArray += ['name' => ((array)$product->Наименование)[0]];
        $innerArray += ['code' => ((array)$product->Код)[0]];
        $innerArray += ['weight' => ((array)$product->Вес)[0]];
        $innerArray += ['usage' => ((array)$product->Наименование)[0]];

        $data[] = $innerArray;
      }
      return $data;
    }
  }

  function convertOffers($xml)
  {
    $data = [];

    if (isset($xml->ПакетПредложений)){
      $offers = $xml->ПакетПредложений->Предложения->Предложение;
      $offers_id = $xml->Классификатор->Ид;

      foreach ($offers as $offer){
        $innerArray = [];
        $innerArray += ['parent_id' => $offers_id];
        $innerArray += ['code' => ((array)$offer->Код)[0]];
        $innerArray += ['quantity' => ((array)$offer->Количество)[0]];
        foreach ($offer->Цены->Цена as $price){
          $innerPrice = [];
          $innerPrice += ['price_id' => ((array)$price->ИдТипаЦены)[0]];
          $innerPrice += ['price_count' => ((array)$price->ЦенаЗаЕдиницу)[0]];

          $innerArray['prices'][] = $innerPrice;
        }
        $data[] = $innerArray;
      }

      return $data;
    }
  }

  function dataQuery($connection)
  {
    $tableName = 'data';

    $drop_query = "DROP TABLE IF EXISTS $tableName";
    $connection->exec($drop_query);

    $create_query = "CREATE TABLE $tableName (
      `id` BIGINT NOT NULL AUTO_INCREMENT, 
      `name` VARCHAR(255) NOT NULL,
      `code` VARCHAR(255) NOT NULL,
      `weight` INT NOT NULL,
      `quantity_msk` INT NULL,
      `quantity_st_petersburg` INT NULL,
      `quantity_samara` INT NULL,
      `quantity_saratov` INT NULL,
      `quantity_kazan` INT NULL,
      `quantity_chelyabinsk` INT NULL,
      `quantity_novosibirsk` INT NULL,
      `quantity_business_lines_chelyabin` INT NULL,
      `price_msk` INT NULL,
      `price_st_petersburg` INT NULL,
      `price_samara` INT NULL,
      `price_saratov` INT NULL,
      `price_kazan` INT NULL,
      `price_novosibirsk` INT NULL,
      `price_chelyabinsk` INT NULL,
      `price_business_lines_chelyabin` INT NULL,
      `usage` VARCHAR(255) NOT NULL, 
      PRIMARY KEY(`id`),
      UNIQUE (`code`))
    ";
    $connection->exec($create_query);
  }

  if (isset($_POST['submit'])){
    $directory = 'data';
    $files = scandir($directory);
    $import = [];
    $offers = [];

    for ($i=2; $i < count($files); $i++){
      $xml = simplexml_load_file($directory . '/' . $files[$i]);

      if ($xml->Каталог){
        $import = array_merge($import, convertImpots($xml));
      } else {
        $offers = array_merge($offers, convertOffers($xml));
      }
    }

    dataQuery($connection);

    for ($i = 0; $i < count($import); $i++){
      saveImport($connection, $import[$i]);
    }

    for ($j = 0; $j < count($offers); $j++){
      saveOffers($connection, $offers[$j]);
    }

    header('Location: index.php');
    exit();
  }


