<nav class="navbar navbar-default">
  <div class="container-fluid container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Interno</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav navbar-right">

          <?php
            if (isUserLoggedIn()){
              echo '
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  '.getUserName().' <span class="caret"></span>
                </a>
                  <ul class="dropdown-menu">';

                  //student can Apply
                  if (getUserType()=='0'){
                    echo '<li><a href="index.php">Apply for Internship</a></li>';
                  }

                  //employer can add
                  else {
                    echo '<li><a href="add-internship.php">Add Internship</a></li>';
                  }

                  //both can sign out
                  echo '<li role="separator" class="divider"></li>
                        <li><a href="user.php?signout=true">Sign Out</a></li>
                  </ul>
              </li>';
            }

            //user isnt logged in, show the buttons
              else {
                echo '
                <form class="navbar-form navbar-left" action="user.php" method="post">
                             <input type="submit" name="signin" value="Sign IN" class="btn btn-success">
                </form>
                <form class="navbar-form navbar-left" action="user.php" method="post">
                             <input type="submit" name="signup" value="Sign UP" class="btn btn-default">
                </form>';
              }
           ?>

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
