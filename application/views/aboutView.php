<?php
$data['title'] = $title;
$this->load->view('layout/header', $data);
$this->load->view('layout/nav');
?>


<div class="container-fluid">
    <div class="row ">
        <div class="col-md-6 col-md-offset-3">
            <h2>About</h2>
            <p>
               This web application is a personal project. A personal project created because i wanted to have a tool to process my
                expenses and deal with the flow of my months income. This application let you record every expense you do from different
                places, time.
            </p>
            </div>
    </div>
</div>


<?php
$this->load->view('layout/footer');

?>
