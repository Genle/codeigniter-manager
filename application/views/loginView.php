<!Doctype html>

<html>
<?php
    if(isset($this->session_userdata['logged_in']))
        header("Location: http://localhost/codeigniter-manager/index.php/UserController/userLoginProcess");
?>
<head>
    <meta name="viewport" content="width= device-width, initial-scale=1">
    <title>Codeigniter-manager-login</title>
    <link rel="stylesheet" type="text/css" href="<?php echo css_url('bootstrap.min')?>">
    <link rel="stylesheet" href="<?php echo css_url('style')?>">
</head>
<body class="login-container">

    <div class="container ">
        <div class="row">
            <?php if(isset($message) && stristr($message, 'successfull') == TRUE ):?>

                <div class="row">
                    <div class="login-message-success col-md-4 col-md-offset-4">
                        <?php echo $message ?>
                    </div>
                </div>

            <?php  elseif(isset($message)): ?>

                <div class="row">
                    <div class="login-message-warning col-md-4 col-md-offset-4">
                            <?php echo $message ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row">
<!--                <img src="--><?php //echo img_url('login-figurant.jpg')?><!--" alt="">-->
            </div>

            <div class="col-md-4 col-md-offset-4 login-view-form">
                <h3 class="login-view-title">Manager Login</h3>
                <form action="<?php echo base_url('index.php/UserController/userLoginProcess') ?>" method="POST" role="form">
                    <div class="form-group">
                        <label for="username" class="control-label">Username: </label>
                        <input type="text" class="form-control" name="username" placeholder="Enter username" autocomplete="off">

                    </div>
                    <div class="form-group">
                        <label for="username" class=" control-label">Password: </label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary" >Login</button>
                        <a class="btn  btn-block login-btn-signup" href="<?php echo base_url('index.php/UserController/userRegistration')?>">SignUp</a>
                    </div>





                </form>
            </div>
        </div>
    </div>

</body>
</html>