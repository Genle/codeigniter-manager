<nav class="navbar navbar-default">
    <div class="container-fluid nav-container">
        <div class="navbar-header">
            <a href="#" class="navbar-brand">
                Manager
            </a>

        </div>
        <div class=" navbar ">
            <ul class="nav navbar-nav">
                <li class="divider-vertical"></li>
                <li><a href="<?php echo base_url('index.php/HomeController')?>">Home</a></li>
                <li><a href="<?php echo base_url('index.php/ListExpensesController')?>">Expenses</a></li>
                <li><a href="<?php echo base_url('index.php/SearchController')?>">Search</a></li>
                <li><a href="#">Statistics</a></li>
                <li><a href="<?php echo base_url('index.php/AboutController')?>">About</a></li>

            </ul>
            <ul class=" nav navbar-nav navbar-right">
                <li><a href="<?php echo base_url('index.php/UserController/logout') ?>">Logout</a></li>
            </ul>


        </div>
    </div>
</nav>