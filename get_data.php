<?php
  require_once ('Connection.php');
  $connection = Connection::getInstance();

  try {
    $items_per_page = 10;
    $data = [];
    $i = 1;
    $total_items = 0;
    $total_pages = 1;
    $current_page = 1;

    $tableName = 'data';
    $exists_query = $connection->prepare( "SHOW TABLES LIKE :table_name");
    $exists_query->bindParam(':table_name', $tableName, PDO::PARAM_STR);
    $exists_query->execute();

    $tableExists = $exists_query->rowCount() > 0;

    if ($tableExists){
      $stmt_1 = $connection->prepare("SELECT * FROM data");
      $stmt_1->execute();

      $total_items  = $stmt_1->rowCount();
      $total_pages = ceil($total_items / $items_per_page);

      $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
      $offset = ($current_page - 1) * $items_per_page;

      $stmt = $connection->prepare("SELECT * FROM data ORDER BY id DESC LIMIT $items_per_page OFFSET $offset");
      $stmt->execute();
      $data = $stmt->fetchAll();
    }

  } catch (Exception $e){
    echo $e->getMessage();
    exit();
  }