<!doctype html>
<html lang="en">

<head>
  <title>購物商城-上架商品</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>
<?php
if (!(isset($_COOKIE["passed"]) and $_COOKIE["passed"] == "TRUE")) {
  echo "<script type='text/javascript'>";
  echo "alert('請先登入網站，再操作此功能');";
  echo "</script>";
  header("location:index.php");
  exit();
}
?>

<body>
  <header>
    <!-- place navbar here -->
    <nav class="navbar navbar-expand-md navbar-dark bg-warning" data-bs-theme="dark">
      <div class="container">
        <a class="navbar-brand" href="#">購物商城</a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
          <ul class="navbar-nav me-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="index.php" aria-current="page">首頁 <span class="visually-hidden">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="addProduct" href="addproduct.php">上架商品</a>
            </li>
          </ul>
          <?php
          if (isset($_COOKIE["passed"]) and $_COOKIE["passed"] == "TRUE") {
          ?>
            <a class="nav-link text-white mx-3" href=""><?php echo $_COOKIE["nickName"]  ?></a>
            <a class="nav-link text-white mx-3" href="logout.php">登出</a>
          <?php
          } else {
          ?>
            <a class="nav-link text-white mx-3" href="register.html">註冊</a>
            <a class="nav-link text-white mx-3" href="login.html">登入</a>
          <?php
          }
          ?>
        </div>
      </div>
    </nav>

  </header>
  <main>
    <div class="container">
      <form action="addproduct.php" method="POST">
        <div class="form-outline mb-4">
          <label class="form-label" for="form2Example4">商品名稱</label>
          <input type="text" id="form2Example4" class="form-control" name="pName" required />
        </div>
        <div class="form-outline mb-4">
          <label class="form-label" for="form2Example4">價格</label>
          <input type="number" id="form2Example4" class="form-control" name="amount" required />
        </div>
        <div class="form-outline mb-4">
          <label class="form-label" for="form2Example4">商品數量</label>
          <input type="number" id="form2Example4" class="form-control" name="count" required />
        </div>
        <div class="row mb-4">
          <button type="submit" class="btn btn-warning btn-block mb-4">新增商品</button>
        </div>
      </form>

      <?php
      require_once("mysql.inc.php");

      $data = $_POST;
      if (isset($data['pName'])) {
        $sql = "INSERT INTO `shop`(`sid`, `pName`, `amount`, `count`) VALUES ('" . $_COOKIE["uid"] . "','" . $data['pName'] . "','" . $data['amount'] . "','" . $data['count'] . "')";
        $link = create_connection();
        execute_sql($link, "test", $sql);
        mysqli_close($link);
      }

      if (isset($_COOKIE["uid"])) {
        $link = create_connection();
        $uid = $_COOKIE["uid"];
        $sql = "select * from shop where sid='$uid'";
        $rs = execute_sql($link, "test", $sql);
        mysqli_close($link);
        if (mysqli_num_rows($rs) == 0) {
          echo "<div class=''> ";
          echo "<p>商城為空!!";
          echo "</div>";
        } else {
          echo "<div class='table-responsive-md '>";
          echo "<table class='table table-striped'>";
          echo "<thead><tr><th scope='col'>uid</th><th scope='col'>商品名稱</th><th scope='col'>價格</th><th scope='col'>數量</th>";
          echo "</thead><tbody>";
          while ($row = mysqli_fetch_assoc($rs)) {
            echo "<tr>";
            echo "<td scope='row'>" . $row["uid"] . "</td>";
            echo "<td>" . $row["pName"] . "</td>";
            echo "<td>" . $row["amount"] . "</td>";
            echo "<td>" . $row["count"] . "</td>";
            echo "</tr>";
          }
          echo "</tbody></table>";
          echo "</div>";
        }
      } else {
        echo "<div>NO COOKIE</div>";
      }
      ?>
    </div>

  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>