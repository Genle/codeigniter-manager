<?php
$data['title'] = $title;
$this->load->view('layout/header', $data);
$this->load->view('layout/nav');
?>


<div class="container">
    <h2>Statistics</h2>
</div>


<?php
$this->load->view('layout/footer');

?>
