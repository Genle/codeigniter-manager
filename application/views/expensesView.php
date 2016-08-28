<?php
$data['title'] = $title;
$this->load->view('layout/header', $data);
$this->load->view('layout/nav');
?>


<div class="container-fluid">
    <section class="row">
        <h2>My Expenses</h2>

        <?php if(isset($expenses_limit) && !empty($expenses_limit) ): ?>

            <?php foreach ($expenses_limit as $expense): ?>
                <div class="row expense-subtable-homeview">
                    <div class="col-lg-8 expense-table-homeview">
                        <h4 class="place header-table"><?php echo "Buying place: ".$expense[0]->place ?></h4>
                        <h4 class="date header-table">
                            <?php
                            if (is_array($expense[1] )) {
                                echo "Date: ". $expense[1][0]->date;
                            }
                            else {
                                echo "Date: ". $expense[1];
                            }
                            ?>
                        </h4>
                        <table  class="table table-bordered">
                            <tr class="expenses-number">
                                <th>
                                    <img class="icon-description" src="<?php echo img_url('descriptionIcon.png') ?>" alt="">
                                    Description
                                </th>
                                <th>
                                    <img class="fa-money icon-money" src="<?php echo img_url('moneyIcon.png') ?>" alt="">
                                    Price
                                </th>
                            </tr>
                            <?php foreach ($expense[2] as $product): ?>
                                <tr class="expenses-number">
                                    <td>
                                        <?php echo $product->description ?>
                                    </td>
                                    <td>

                                        <?php echo $product->price ?>
                                    </td>
                                </tr>
                            <?php endforeach;?>


                        </table>

                    </div>
                </div>
            <?php endforeach;?>
        <?php else: ?>

            <span class="message_no_expenses">Database is empty</span>
        <?php endif; ?>



    </section>
</div>


<?php
$this->load->view('layout/footer');

?>
