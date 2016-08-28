<?php
    $data['title'] = $title;
    $this->load->view('layout/header', $data);
    $this->load->view('layout/nav');
?>
    <div class="container-fluid new-expense-form" ng-app="app">
        <?php if(isset($message) && stristr($message, 'successfull') == TRUE ):?>

            <div class="row">
               <h4 style="color: blue"><?php echo $message ?></h4>
            </div>

        <?php  elseif(isset($message)): ?>

            <div class="row">
                <h4 style="color: red"><?php echo $message ?></h4>
            </div>
        <?php endif; ?>
<!--        <h2 class="title-space">-->
<!--            HELLO WORLD-->
<!--        </h2>-->

        <section class="row section-input"><!-- Add new expense form-->
            <div class="col-md-8">
                <div class="form-group">
                    <fieldset style="border: 1px solid black; padding-right: 10px;">
                        <legend style="font-size: 16px; border-style: none; width: 15%; margin-left:3%;">Add new expense</legend>
                        <form   name="new-expense" id="add-new-expense" role="form" method="post">
                            <table class="table table-responsive table-input " id="dynamic_field" style="margin-left: 5px;">
                                <tr>
                                    <td><label for="place">Place:</label></td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="place" class="form-control" placeholder="Enter place"></td>
                                </tr>
                                <tr>
                                    <td><label for="product">Product(s)</label></td>
                                </tr>
                                <tr>
                                    <td><input name="checkbox" id="checkbox-same-date" type="checkbox" class="form-inline"> <label for="checkbox" style="font-weight: inherit; font-size: 14px;">Is it an expense from different date?</label></td>
                                </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="description[]" id="description" class="form-control" placeholder="Enter description">
                                        </td>
                                        <td><input type="text" name="price[]"  id="price" placeholder="Enter price" class="form-control"></td>
                                        <td><input type="text" name="date[]" id="date" placeholder="Enter date (day-month-year)" class="form-control"></td>
                                        <td> <button type="button" name="add" id="add" class="btn btn-primary">Add more</button></td>
                                    </tr>

                            </table>
                            <td><input style="margin-left: 10px; margin-bottom: 10px;" type="submit" id="submit" value="Add expense" class="btn btn-primary" ></td>
                        </form>
                    </fieldset>

                </div>
            </div>
            <div style=" height: 340px;" class="col-md-4" ng-controller="currencyController"><!--currency data api -->
                <fieldset style="border: 1px solid black; padding-right: 10px; height: 339px; ">
                    <legend style="color: black;font-size: 16px; border-style: none; width: 25%;  margin-left:3%;">Currency rate</legend>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <table style="position: relative; top: 50px;" class="table table-bordered currency-table">
                                <tr class="btn-info">
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Value</th>
                                </tr>
                                <tr>
                                    <td>USD</td>
                                    <td>EUR</td>
                                    <td> {{currency.quotes.USDEUR}}</td>
                                </tr>
                                <tr>
                                    <td>USD</td>
                                    <td>HTG</td>
                                    <td>{{currency.quotes.USDHTG}}</td>
                                </tr>
                                <tr>
                                    <td>USD</td>
                                    <td>DOP</td>
                                    <td> {{currency.quotes.USDDOP}}</td>
                                </tr>

                            </table>
                        </div>

                    </div>
                </fieldset>

            </div><!--currency data api -->
        </section><!-- Add new expense form-->

        <section class="row">
            <h3 class="table-header-homeview">Last expenses</h3>


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