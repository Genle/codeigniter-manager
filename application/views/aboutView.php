<?php
$data['title'] = $title;
$this->load->view('layout/header', $data);
$this->load->view('layout/nav');
?>


<div class="container">
    <div class="row ">
        <div class="col-md-4"></div>
        <h2>About</h2>
        <p style="wid">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ab adipisci aliquid, aperiam commodi consequuntur doloremque dolorum excepturi expedita inventore ipsum obcaecati odio quia, quibusdam repellat sapiente sint vel voluptate.
        </p>
    </div>
</div>


<?php
$this->load->view('layout/footer');

?>
