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

  </header>
  <main>
    <?php
    require_once("mysql.inc.php");
    $data = $_POST;

    $link = create_connection();

    if ($data['uType'] == 'buyer') {
      $sql = "select * from buyerdata where mobile='" . $data["mobile"] . "' and passwd='" . $data["passwd"] . "'";
    } else if ($data['uType'] == 'seller') {
      $sql = "select * from sellerdata where mobile='" . $data["mobile"] . "' and passwd='" . $data["passwd"] . "'";
    }
    $rs = execute_sql($link, "test", $sql);

    if (mysqli_num_rows($rs) == 0) {
      mysqli_free_result($rs);

      mysqli_close($link);
      echo "<script type='text/javascript'>";
      echo "alert('帳號密碼錯誤，請查明後再登入');";
      echo "history.back();";
      echo "</script>";
    } else {
      if ($data['uType'] == 'buyer') {
        setcookie("type", "B", time() + 60 * 60 * 3);
      } else if ($data['uType'] == 'seller') {
        setcookie("type", "S", time() + 60 * 60 * 3);
      }

      $rs1 = mysqli_fetch_object($rs);
      $realName = $rs1->realName;
      $nickName = $rs1->nickName;
      $uid = $rs1->uid;

      mysqli_free_result($rs);
      mysqli_close($link);

      setcookie("mobile", $mobile, time() + 60 * 60 * 3);
      setcookie("passed", "TRUE", time() + 60 * 60 * 3);
      setcookie("realName", $realName, time() + 60 * 60 * 3);
      setcookie("nickName", $nickName, time() + 60 * 60 * 3);
      setcookie("uid", $uid, time() + 60 * 60 * 3);

      header("location:index.php");
    }
    ?>

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