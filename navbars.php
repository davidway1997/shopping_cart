    <nav class="navbar navbar-expand-md navbar-dark bg-warning mb-5" data-bs-theme="dark">
      <div class="container">
        <a class="navbar-brand" href="#">購物商城</a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
          <ul class="navbar-nav me-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link" id="main" href="index.php" aria-current="page">首頁 <span class="visually-hidden">(current)</span></a>
            </li>
            <?php
            if (isset($_COOKIE["type"]) and $_COOKIE["type"] == "B") {
            ?>
              <li class="nav-item">
                <a class="nav-link" id="productQuery" href="product.php">商品查詢</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="shoppingCart" href="shoppingCart.php">購物車</a>
              </li>
            <?php
            } else if (isset($_COOKIE["type"]) and $_COOKIE["type"] == "S") {
            ?>
              <li class="nav-item">
                <a class="nav-link" id="addProduct" href="addproduct.php">上架商品</a>
              </li>
            <?php
            }
            ?>
          </ul>
          <?php
          if (isset($_COOKIE["passed"]) and $_COOKIE["passed"] == "TRUE") {
          ?>
            <a class="nav-link text-white mx-3" href=""><?php echo $_COOKIE["realName"]  ?></a>
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