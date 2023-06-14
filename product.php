<!doctype html>
<html lang="en">

<head>
  <title>購物商城-商品頁</title>
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
      if (isset($_POST["query"])) {
        $link = create_connection();
        $query = $_POST["query"];
        $sql = "select * from shop where pName like '%" . $_POST["pName"] . "%'";
        $rs = execute_sql($link, "test", $sql);
        if (mysqli_num_rows($rs) == 0) {
          echo "<div class=''> ";
          echo "<p>查無此商品名稱相關資料";
          echo "<a href='javascript:history.back()'>回到上一頁</a>";
          echo "</div>";
        } else {
          echo "<div class='table-responsive-md '>";
          echo "<table class='table table-striped'>";
          echo "<thead><tr><th scope='col'>商品代碼</th><th scope='col'>商品名稱</th><th scope='col'>價格</th>";
          echo "<th scope='col'>商品數量</th><th scope='col'>操作功能</th></tr></thead>";
          echo "<tbody>";
          while ($row = mysqli_fetch_assoc($rs)) {
            echo "<tr>";
            echo "<td scope='row'>" . $row["uid"] . "</td>";
            echo "<td>" . $row["pName"]  . "</td>";
            echo "<td>" . $row["amount"] . "</td>";
            echo "<td>" . $row["count"]  . "</td>";
            echo "<td><a href='shoppingCart.php?pid=" . $row["uid"] . "'>購買</td>";
            echo "</tr>";
          }
          echo "</tbody></table>";
          echo "</div>";
        }
        mysqli_free_result($rs);
        mysqli_close($link);
      } else {

      ?>
        <form action="product.php" method="POST">
          <div class="form-outline mb-4">
            <label class="form-label mt-2" for="form2Example1">搜尋商品</label>
            <input type="text" id="form2Example1" class="form-control" name="pName" required />
          </div>
          <div class="form-outline mb-4">
            <input type="hidden" id="form2Example1" class="form-control" name="query" value="query" />
          </div>
          <div class="row mb-4">
            <button type="submit" class="btn btn-warning btn-block mb-4">查詢</button>
          </div>
        </form>
      <?php
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#productQuery").addClass('active');
    });
  </script>

</body>

</html>