<!Doctype html>
<html>
<?php
    if(isset($this->session->userdata['logged_in']))
    {
        header("Location: ".base_url('index.php/UserController/userLoginProcess'));
    }
?>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manager-Registration</title>
    <meta name="viewport" content="width=device-width initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo css_url('bootstrap.min')?>">
    <link rel="stylesheet" href="<?php echo css_url('style')?>">
    <script src="<?php echo  js_url('script')?>"></script>
    <script src="<?php echo js_url('jquery-3.1.0.min')?>"></script>
    <script src="<?php echo js_url('bootstrap.min')?>"></script>

</head>

<body class="body-registration">
    <div class="container registration-container">
        <div class="row">
            <div class="col-md-4 registration-message">
                <span><?php if(isset($message) && !empty($message)) echo $message;?></span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4 signup-form">
                <h3 class="signup-title">Manager SignUp</h3>
                <form action="<?php echo base_url('index.php/RegistrationController/addNewUser')?>" method="post" role="form">
                    <div class="form-group">
                        <label for="username" class="control-label ">Username:</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter username">
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Password:</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password">
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Retype Password:</label>
                        <input type="password" class="form-control" name="repeat-password" placeholder="Repeat password">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-block btn-danger">SignUp</button>
                    </div>

                    <a class="signup-to-login" href="<?php echo base_url()?>">For Login click here</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>