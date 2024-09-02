<nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3">
  <div class="container">
    <a class="navbar-brand" href="#">E-commerce</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <?php if(isset($_SESSION['user'])){ ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= isset($_SESSION['user']) ? explode(' ', $_SESSION['user']['name'])[0] : "Unknown User" ?>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Update Profile</a></li>
            <li><a class="dropdown-item" href="#">Change Password</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="./logout.php">Logout</a></li>
          </ul>
        </li>
        <?php }else{ ?>
          <li class="nav-item">
            <a class="nav-link" href="./login.php">Log in</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./register.php">Register</a>
          </li>
        <?php } ?>
      </ul>
      <form action="" method="post">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search">
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
      </form>
    </div>
    <a href="cart.php" class="btn btn-primary ms-2 position-relative">
        <i class="fa-solid fa-shopping-cart"></i>
        <span class="position-absolute start-100 top-0 bg-danger translate-middle rounded-circle small" style="width: 24px; line-height: 24px;">0</span>
    </a>
  </div>
</nav>