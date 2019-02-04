<!-- page content starts here -->
<section id="page" class="page-wrapper">
<div class="content">
  <div class="container master-container" role="main">
    <div class="row justify-content-center">
      <div class="mx-auto col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <div class="icon-block icon-register">
          <span class="flaticon-profile"></span>
        </div>
        <div class="page-title">
        <h1>Login</h1>
        </div>
        <div class="page-content">
          <p>Login to your account</p>
          <form action="login.php" method="post">
          <!-- <div id="display_error"></div> -->
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Username" id="username" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password" id="password" class="form-control" required>
          </div>
          <div class="form-group">
            <button name="submit" value="login" type="submit" class="btn btn-lg btn-login"><span class="flaticon-circle10"></span> login</button>
          </div>
        </form>
        <div class="">
        	<p>Don't have an account? <a href="register.php">Sign up</a></p>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
<div class="clearfix"></div>