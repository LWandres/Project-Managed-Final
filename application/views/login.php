<html>

  <head>
    <title>Login/Registration</title>
    <link rel="stylesheet" type="text/css" href="/assets/css/login.css">
  </head>
</div>
  <body>
    <!-- including header partial -->
    <?php include_once("header.php"); ?>
    <!-- end header partial -->
    <div id="background">
      <div id="login-container">
        <div id="main">
        <div class="row forms">
          <div class='col-md-6'>

            <form action="/access/login" method="post" class="form-horizontal" role="form">
              <h2>Log In</h2>
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                  <input  type="text" name="email" class="form-control" id="email" placeholder="email">
                </div>

              <div class="form-group">
                <label class="control-label col-sm-4" for="password">Password:</label>
                <div class="col-sm-10">
                  <input  type="password" name="password" class="form-control" id="password" placeholder="Enter password">
                </div>
              </div>
              <div class="errors">
              <?php

                if($this->session->flashdata('log_errors')){
                  echo($this->session->flashdata('log_errors'));
                }
              ?>

            </div>
              <div class="form-group">
                <div class=" col-sm-10 ">
                  <button type="submit" value="add user!" class="btn btn-primary add button">Login</button>
                </div>
              </div>
            </form>

    </div>
    <div class='col-md-5 col-md-offset-1 '>
      <div id="registration">
        <form action="/access/register" method="post" class="form-horizontal" role="form">
          <h2>Register</h2>
          <div class="form-group">
            <label class="control-label col-sm-6" for="name">First Name:</label>
            <div class="col-sm-10">
              <input  type="name" name="firstname" class="form-control" id="firstname" placeholder="Enter Name">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-6" for="name">Last Name:</label>
            <div class="col-sm-10">
              <input  type="name" name="lastname" class="form-control" id="lastname" placeholder="Enter Name">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="name">Email:</label>
            <div class="col-sm-10">
              <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-6" for="name">Role:</label>
            <div class="col-sm-10">
              <select name="role" class="form-control">
                  <option value="PM">Project Manager</option>
                  <option value="PM">Meeting Participant</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-6" for="password">Password:</label>
            <div class="col-sm-10">
              <input  type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-8" for="confirmpassword">Confirm Password:</label>
            <div class="col-sm-10">
              <input type="password" name="confirmpassword" class="form-control" id="confirmpassword" placeholder="Confirm Password">
            </div>
          </div>

          <div class="errors">
          <?php
          if($this->session->flashdata('reg_errors')){
            echo($this->session->flashdata('reg_errors')[0]);
          }

          ?>
        </div>

          <div class="form-group">
            <div class=" col-sm-10 ">
              <button type="submit" value="add user!" class="btn btn-primary add button">Register</button>
            </div>
          </div>
        </form>
      </div>

    </div>
    </div>
  </div>
</body>
</div>
</html>
