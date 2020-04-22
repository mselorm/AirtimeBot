<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirtimeBot| Load csv</title>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {



            $('button#submit').bind('click', function(e) {
                e.preventDefault();
                var file_data = $('#file').prop('files')[0];
                var form_data = new FormData();
                form_data.append('file', file_data);

                alert(form_data);

                var formData = {
                    import_: import_


                }


                console.log("csv import");
                console.log(form_data);
                // $('.add').hide();

                $.ajax({
                    url: "./loadcsv.php",

                    dataType: 'text', // what to expect back from the PHP script, if anything
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data + formData,
                    success: function(data, textStatus, jqXHR) {


                        $('#csvresult').html(data);

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);

                    }
                });


                /*	function() {
                		$("#frmCSVImport").on(
                		"submit",
                		function() {

                			$("#response").attr("class", "");
                			$("#response").html("");
                			var fileType = ".csv";
                			var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+("
                					+ fileType + ")$");
                			if (!regex.test($("#file").val().toLowerCase())) {
                				$("#response").addClass("error");
                				$("#response").addClass("display-block");
                				$("#response").html(
                						"Invalid File. Upload : <b>" + fileType
                								+ "</b> Files.");
                				return false;
                			}
                			return true;
                		}); });  */
            });

        });
    </script>
</head>

<body>


    <form class="form-horizontal" action="" method="post" name="uploadCSV" enctype="multipart/form-data">
        <div class="input-row">
            <label class="col-md-4 control-label">Choose CSV File</label> <input type="file" name="file" id="file" accept=".csv">
            <button type="submit" id="submit" name="import" class="btn-submit">Import</button>
            <br />

        </div>
        <div id="csvresult"></div>
    </form>

</body>

</html>