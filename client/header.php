

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="./"> 
      <img src="./public/logo.png"/>
    </a>
   
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        
        <li class="nav-item">
          <a class="nav-link active" href="./">Home</a>
        </li>

        <?php if (isset($_SESSION['user']) && isset($_SESSION['user']['username'])): ?>
          <!-- Show Logout if user is logged in -->
          <li class="nav-item">
            <a class="nav-link" href="./server/requests.php?logout=true">Logout(<?php echo ucfirst( $_SESSION['user']['username']) ?>)</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?ask=true">Ask A Question</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?u-id=<?php echo $_SESSION['user']['user_id']?>">My Questions</a>
          </li>
        <?php else: ?>
          <!-- Show Login & Signup if user not logged in -->
          <li class="nav-item">
            <a class="nav-link" href="?login=true">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?signup=true">SignUp</a>
          </li>
        <?php endif; ?>

      
        <li class="nav-item">
          <a class="nav-link" href="?latest=true">Latest Question</a>
        </li>
      </ul>
      
    </div>
    <form class="d-flex " action="" >
        <input class="form-control me-2 margin-left-4" name="search" type="search" placeholder="Search questions">
        <button class="btn btn-outline-success margin-left-4" type="submit">Search</button>
      </form>
  </div>
</nav>
