
$(document).ready(function () {

    // $('.table-result').hide();

    var l;

    $("#add_phone").click(function () {
        alert('muddy waters');

    })

    $(document).on('click', '.love', function () {
        var page = $(this).attr("id");
        $('.table-result').hide()
        phone_number_all(page);
    });
    /******************************** */
    //fetch phone numbers from db
    /******************************** */

    function phone_number_all(page) {

        $.ajax({
            url: "./pagination.php",
            method: "POST",
            data: {
                page: page
            },
            success: function (data, textStatus, jqXHR) {
                $('.table').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);

            }
        })

        console.log('the button is click');




    }
    /******************************** */
    //remove number from db
    /******************************** */
    $(document).on('click', '.remove', function () {
        // var page = $(this).attr("id");
        $('.table-result').hide();
        remove_number();
    });

    function remove_number() {
        $('.table-result1').show();

        $.ajax({
            url: "./remove_number.php",
            method: "POST",
            data: {
                page: 4
            },
            success: function (data, textStatus, jqXHR) {
                $('.table').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);

            }
        })

        console.log('the remove button is click');




    }
    /******************************** */
    //click page number
    /******************************** */
    $(document).on('click', '.pagination_link', function () {
        var page1 = $(this).attr("id");
        phone_number_all(page1);
        console.log('the page is click');
        console.log(page1);
    });

    /******************************** */
    //search query input field    add_customer
    /******************************** */
    $('#submitDonation').bind('click', function (e) {
        e.preventDefault();
        var inp = $('#id').val();

        if (inp == 'readone') {
            processDonation();
        }


        //if all products call fetchall
        if (inp == 'all') {
            fetchall();
        }


        //if all customers call load_data
        if (inp == 'customers') {
            load_data();
        }

        //if all products call load_data_products
        if (inp == 'products') {
            load_data_products();
        }


    });// pull - right

    /******************************** */
    //add customer data
    /******************************** */
    $('#add_customer').bind('click', function (e) {
        e.preventDefault();
        var formData = {
            cus_id: $('#cus_id').val(),
            name: $('#name').val(),
            location: $('#location').val(),
            occupation: $('#occupation').val(),
            item: $('#item').val(),
            item_type: $('#item_type').val(),
            price: $('#price').val(),
            amount_paid: $('#amount_paid').val(),
            phone_number: $('#phone_number').val(),
        }

        console.log(formData);
        // $('.add').hide();

        $.ajax({
            url: "./customers/create_data.php",
            //   $('.add').val();
            /**
             *
             * make the div hide all content and show new one
             */

            type: "POST",
            data: formData,
            success: function (data, textStatus, jqXHR) {
                //  window.location = data;
                //  $('.add').show();
                $('#pagination_data').html(data);

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);

            }
        });

    });

    $('#wwadd_phone').bind('click', function (e) {
        e.preventDefault();
        var formData = {
            name: $('#name').val(),
            phone: $('#phone').val(),
            car_number: $('#car_number').val(),
        }

        console.log(formData);
        alert('hello world');
        // $('.add').hide();
        /*
                $.ajax({
                    url: "./customers/create_data.php",
                  
                    type: "POST",
                    data: formData,
                    success: function (data, textStatus, jqXHR) {
                        //  window.location = data;
                        //  $('.add').show();
                        $('#pagination_data').html(data);
        
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
        
                    }
                });
        */
    });







    /******************************** /
    //submit new phone number
    /********************************/
    $(document).on('click', '#add_phone', function () {
        //var page = $(this).attr("id");
        alert('page');
    });







    /******************************** */
    //read one product from db
    /******************************** */

    function processDonation() {

        var formData = {

            id: 8,

        }

        console.log(formData);


        $.ajax({
            url: "./product/read_one.php",
            type: "POST",
            data: formData,
            success: function (data, textStatus, jqXHR) {
                //  window.location = data;
                $('#pagination_data').html(data);

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);

            }
        });

    }




    /******************************** */
    //read all products from db
    /******************************** */

    function fetchall() {

        var inp = $('#id').val();

        var formData = {

            id: $('#id').val(),

        }
        if (inp == 'all') {
            console.log(formData);

            $.ajax({
                url: "./customers/readall.php",
                type: "POST",
                data: formData,
                success: function (data, textStatus, jqXHR) {
                    //  window.location = data;
                    $('#pagination_data').html(data);

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);

                }
            })

        }
    }




    /******************************** */
    //read all customers  from db
    /******************************** */

    function load_data(page) {
        $.ajax({
            url: "./customers/pagination.php",
            method: "POST",
            data: {
                page: page
            },
            success: function (data) {
                $('#pagination_data').html(data);
            }
        })
    }



    /******************************** */
    //read all products  from db
    /******************************** */

    function load_data_products(page) {
        $.ajax({
            url: "./product/pagination.php",
            method: "POST",
            data: {
                page: page
            },
            success: function (data) {
                $('#pagination_data').html(data);
            }
        })
    }

});

