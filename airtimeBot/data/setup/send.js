
$('.table-result').show();
$(document).ready(function () {

    var fade = false;
    var color;


    $('body').css("background-color", color);
     console.log(color);


    $('.send_data_modal').on('show.bs.modal', function (event) {
        $('body').css("background-color", "white");
        console.log('the send data modal is triggered');
        var button = $(event.relatedTarget) // Button that triggered the modal
        var page = $(this).attr("id");
       // $('.table-result').hide()
        phone_number_all(page);

        
        color ='red';
     return color;

    })



    function phone_number_all(page) {

        $.ajax({
            url: "./send_all.php",
            method: "POST",
            data: {
                page: page
            },
            success: function (data, textStatus, jqXHR) {
                $('.send_table').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);

            }
        })
        $('.send_table').hide();
        $('.send_table').fadeIn(2200);
        console.log('modal content is fired');
        console.log('data bundle sent to simcards');

    }




});