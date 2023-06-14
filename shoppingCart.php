<!doctype html>
<html lang="en">

<head>
  <title>購物商城-購物車</title>
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
    <?php
    require_once("navbars.php");
    ?>
  </header>
  <main>
    <div class="container">
      <?php
      require_once("mysql.inc.php");
      if (isset($_GET["pid"])) {
        $link = create_connection();
        $sql = "select * from shop where uid = '" . $_GET["pid"] . "'";
        $rs = execute_sql($link, "test", $sql);
        if (mysqli_num_rows($rs) == 0) {
          echo "<div class=''> ";
          echo "<p>此商品不存在";
          echo "<a href='javascript:history.back()'>回到上一頁</a>";
          echo "</div>";
        } else {
          $row = mysqli_fetch_assoc($rs);
          $sql = "select * from cart where pid = '" . $_GET["pid"] . "' and bid = '" . $_COOKIE["uid"] . "'";
          $rs = execute_sql($link, "test", $sql);
          if (mysqli_num_rows($rs) > 0) {
            $row2 = mysqli_fetch_assoc($rs);
            $sql = "update cart set count = count+1, amount = amount+'" . $row["amount"] . "' where pid = '" . $_GET["pid"] . "' and bid = '" . $_COOKIE["uid"] . "'";
            execute_sql($link, "test", $sql);
          } else {
            $sql = "Insert Into cart (bid, pid, count, amount) Values ('" . $_COOKIE["uid"] . "','" . $_GET["pid"] . "','1','" . $row["amount"] . "')";
            execute_sql($link, "test", $sql);
          }
        }
        mysqli_free_result($rs);
        mysqli_close($link);
      }

      if (isset($_COOKIE["uid"])) {
        $link = create_connection();
        $uid = $_COOKIE["uid"];
        $sql = "select b.uid, a.amount, a.count, b.pName from cart as a left join shop as b on a.pid=b.uid where a.bid='$uid'";
        $rs = execute_sql($link, "test", $sql);
        mysqli_close($link);
        if (mysqli_num_rows($rs) == 0) {
          echo "<div class=''> ";
          echo "<p>購物車為空!!";
          echo "</div>";
        } else {
          echo "<div class='table-responsive-md '>";
          echo "<table class='table table-striped'>";
          echo "<thead><tr><th scope='col'>商品代碼</th><th scope='col'>商品名稱</th><th scope='col'>價格</th><th scope='col'>數量</th>";
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