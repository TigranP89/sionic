<?php
  require_once('get_data.php');
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link href="assets/bootstrap/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <title>Sionic</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <form action="load_data.php" method="post">
          <input type="submit" class="btn btn-secondary m-5" name="submit" value="Загрузка данных">
        </form>
          <table class="table mt-2">
            <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Code</th>
              <th scope="col">Weight</th>
              <th scope="col">Quantity_msk</th>
              <th scope="col">Quantity_st_petersburg</th>
              <th scope="col">Quantity_samara</th>
              <th scope="col">Quantity_saratov</th>
              <th scope="col">Quantity_kazan</th>
              <th scope="col">Quantity_chelyabinsk</th>
              <th scope="col">Quantity_novosibirsk</th>
              <th scope="col">Quantity_business_lines_chelyabin</th>
              <th scope="col">Price_msk</th>
              <th scope="col">Price_st_petersburg</th>
              <th scope="col">Price_samara</th>
              <th scope="col">Price_saratov</th>
              <th scope="col">Price_kazan</th>
              <th scope="col">Price_novosibirsk</th>
              <th scope="col">Price_chelyabinsk</th>
              <th scope="col">Price_business_lines_chelyabin</th>
              <th scope="col">Usage</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $item){ ?>
            <tr>
              <th scope="row"><?= $i++;  ?></th>
              <td><?= $item['name'];  ?></td>
              <td><?= $item['code'];  ?></td>
              <td><?= $item['weight'];  ?></td>
              <td><?= $item['quantity_msk'];  ?></td>
              <td><?= $item['quantity_st_petersburg'];  ?></td>
              <td><?= $item['quantity_samara'];  ?></td>
              <td><?= $item['quantity_saratov'];  ?></td>
              <td><?= $item['quantity_kazan'];  ?></td>
              <td><?= $item['quantity_chelyabinsk'];  ?></td>
              <td><?= $item['quantity_novosibirsk'];  ?></td>
              <td><?= $item['quantity_business_lines_chelyabin'];  ?></td>
              <td><?= $item['price_msk'];  ?></td>
              <td><?= $item['price_st_petersburg'];  ?></td>
              <td><?= $item['price_samara'];  ?></td>
              <td><?= $item['price_saratov'];  ?></td>
              <td><?= $item['price_kazan'];  ?></td>
              <td><?= $item['price_novosibirsk'];  ?></td>
              <td><?= $item['price_chelyabinsk'];  ?></td>
              <td><?= $item['price_business_lines_chelyabin'];  ?></td>
              <td><?= $item['usage'];  ?></td>
              <td></td>
            </tr>
            <?php } ?>
            </tbody>
          </table>

        <!-- Pagination -->
        <ul class="pagination">
          <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
            <li class="page-item <?php if ($i == $current_page) echo 'active'; ?>">
              <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </div>

  <script src="assets/bootstrap/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="assets/bootstrap/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="assets/bootstrap/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
