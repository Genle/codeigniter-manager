/**
 * Created by shadowx on 8/7/16.
 */

$(function(){
    $("#home a:contains('Home')").parent().addClass("active");
    $("#new-expense a:contains('New expense')").parent().addClass("active");
    $("#expenses a:contains('Expenses')").parent().addClass("active");
    $("#search a:contains('Search')").parent().addClass("active");
    $("#statistics a:contains('Statistics')").parent().addClass("active");
    $("#about a:contains('About')").parent().addClass("active");
});


$(document).ready(function () {
    var i = 1;
    if($("#checkbox-same-date").is(':checked')){
        console.log(date);
        var date = $("#date").first().val();
        alert(date);
        $('#add').click(function () {
            i++;
            $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="description[]" id="description" class="form-control" placeholder="Enter description"></td><td><input type="text" name="price[]"  id="price" placeholder="Enter price" class="form-control"></td><td><input type="text" name="date[]" id="date" value="'+ date +'" placeholder="Enter date" class="form-control"></td><td> <button name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');

        });
    }else{
        $('#add').click(function () {
            i++;
            $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="description[]" id="description" class="form-control" placeholder="Enter description"></td><td><input type="text" name="price[]"  id="price" placeholder="Enter price" class="form-control"></td><td><input type="text" name="date[]" id="date" placeholder="Enter date" class="form-control"></td><td> <button name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');

        });
    }


    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $("#row"+button_id+"").remove();
    });

    $('#submit').click(function () {
        $.ajax({
            url:'http://localhost/codeigniter-manager/index.php/ExpenseController/newExpense',
            method:'POST',
            dataType:'text',
            data:$('#add-new-expense').serialize(),
            success:function (data) {
                alert(data);


            }
        });
    });


});