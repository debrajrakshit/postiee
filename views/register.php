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
          <h1>Register</h1>
          </div>
          <div class="page-content">
            <p>Create your account</p>
            <form action="register.php" method="post">
            <div class="form-group">
              <label for="username">Username(must be unique) <span class="required">*</span></label>
              <input type="text" name="username" placeholder="Username" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="firstname">First Name <span class="required">*</span></label>
              <input type="text" name="firstname" placeholder="First Name" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="lastname">Last Name <span class="required">*</span></label>
              <input type="text" name="lastname" placeholder="Last Name" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="username">Email <span class="required">*</span></label>
              <input type="email" name="email" placeholder="Email" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="password">Password <span class="required">*</span></label>
              <input type="password" name="password" placeholder="Password" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="password">Confirm Password <span class="required">*</span></label>
              <input type="password" name="confirm-password" placeholder="Confirm Password" class="form-control" required>
            </div>
            <div class="form-group">
              <button name="submit" value="Register" class="btn btn-lg btn-login"><span class="flaticon-circle10"></span> Register</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="clearfix"></div>