<!doctype html>
<html lang="en">

<head>
  <title>資料庫示範-商品資料</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <header>
    <!-- place navbar here -->
    <nav class="navbar navbar-expand-md navbar-dark bg-warning" data-bs-theme="dark">
      <div class="container">
        <a class="navbar-brand" href="#">資料庫</a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
          <ul class="navbar-nav me-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="index.php" aria-current="page">首頁<span class="visually-hidden">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">會員註冊</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


  </header>
  <main>
    <?php
    require_once("mysql.inc.php");
    $data = $_POST;
    $link = create_connection();

    if ($data['uType'] == 'buyer') {
      $sql = "select * from buyerdata where mobile='" . $data["mobile"] . "' ";
    } else if ($data['uType'] == 'seller') {
      $sql = "select * from sellerdata where mobile='" . $data["mobile"] . "'";
    }
    $rs = execute_sql($link, "test", $sql);

    if (mysqli_num_rows($rs) != 0) {
      mysqli_free_result($rs);

      mysqli_close($link);
      echo "<script type='text/javascript'>";
      echo "alert('資料已註冊，請使用其他資料');";
      echo "history.back();";
      echo "</script>";
    } else {
      mysqli_free_result($rs);

      if ($data['uType'] == 'buyer') {
        $sql = "Insert into buyerdata(  mobile, 
                                        passwd,
                                        realName,
                                        nickName
                              )Values(
                                        '" . $data["mobile"] . "',
                                        '" . $data["passwd"] . "',
                                        '" . $data["realName"] . "',
                                        '" . $data["nickName"] . "'
        )";
        $rs = execute_sql($link, "test", $sql);
      } else if ($data['uType'] == 'seller') {
        $sql = "Insert into sellerdata( mobile, 
                                        passwd,
                                        realName,
                                        nickName
                              )Values(
                                        '" . $data["mobile"] . "',
                                        '" . $data["passwd"] . "',
                                        '" . $data["realName"] . "',
                                        '" . $data["nickName"] . "'
        )";
        $rs = execute_sql($link, "test", $sql);
      }
      mysqli_close($link);
    }
    ?>
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">註冊成功</h5>
        <p class="card-text">恭禧註冊成功，請記位你的帳號及密碼，然後<a href="login.html" class="card-link">登入網站</a></p>
      </div>
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