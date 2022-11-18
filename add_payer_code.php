<?php
include "./database/sql.php";
include "./components/side-bar.php";
include "./components/top-bar.php";
$conn = OpenCon();
date_default_timezone_set('Asia/Kolkata');
$type = $_COOKIE['type'];
$result = pg_query($conn, "SELECT * FROM permission WHERE account_type='$type'");
if (pg_num_rows($result) > 0) {
    while ($row = pg_fetch_assoc($result)) {
        $importpermission = $row['import_check'] == '1';
        $exportpermission = $row['export_check'] == '1';
        $user_permission = $row['user_permission'];
    }
}
if ($user_permission != 1) {
    echo "<script>window.location.href = './summary'</script>";
}
$payer_code_query = pg_query($conn, "SELECT * FROM static_master_payer_code");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Add Prayer code</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- CSS -->
    <link rel="stylesheet" href="./css/index.css">
    <!-- <link rel="stylesheet" href="./css/add-user.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css" type="text/css" />

    <!-- JS -->
    <script src="./js/main.js"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.css" integrity="sha512-CaTMQoJ49k4vw9XO0VpTBpmMz8XpCWP5JhGmBvuBqCOaOHWENWO1CrVl09u4yp8yBVSID6smD4+gpzDJVQOPwQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

    <!-- Data Table  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <!-- captcha -->
    <script src="https://www.google.com/recaptcha/api.js?render=6Le6my0hAAAAAKkeamNMFcXqpIhinxSLX7y1W2qO"></script>


    <style>
        .bttn {
            background-color: #7367F0;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container-main">
        <?php
        $type = strtoupper($_COOKIE["type"]);
        if ("ADMIN" == $type)
            TopBar('user');
        else
            nTopBar('user');
        ?>
        <div class="content">
            <!-- main container -->

            <div class="px-4">
                <div class="graph-card mx-2 mt-4 p-4">
                    <div id="msgshowsuccess" style="display: none;">
                        <div class="alert alert-dismissible alert-success">
                            <button type="button" onclick="$('#msgshowsuccess').hide();" class="close" data-dismiss="alert">&times;</button>
                            <span id="update_msg">Payer code added succesfully.</span>
                        </div>
                    </div>
                    <div id="msgshowerror" style="display: none;">
                        <div class="alert alert-dismissible alert-danger">
                            <button type="button" class="close" onclick="$('#msgshowerror').hide();" data-dismiss="alert">&times;</button>
                            Payer code already exist
                        </div>
                    </div>

                    <div id="db_error_msg" style="display: none;">
                        <div class="alert alert-dismissible alert-danger">
                            <button type="button" class="close" onclick="$('#db_error_msg').hide();" data-dismiss="alert">&times;</button>
                           Something wrong..........
                        </div>
                    </div>

                    <div id="delete_msg" style="display: none;">
                        <div class="alert alert-dismissible alert-success">
                            <button type="button" onclick="$('#delete_msg').hide();" class="close" data-dismiss="alert">&times;</button>
                            Payer code Deleted Successfully.
                        </div>
                    </div>
                    <center>
                        <div class="card-title">Add Payer Code</div>
                    </center>
                    <div class="d-flex justify-content-between">
                        <div><a href="clients"><button style="background-color: transparent;outline: none;border: none;font-size: 25px;"><i class="fa fa-angle-left"></i></button></a></div>
                    </div>
                    <div class="px-2">
                        <!-- form -->
                        <form method="post" name="profitCenterForm" id="profitCenterForm">
                            <div class="form-group mb-3">
                                <label for="payer_code">Payer Code:</label>
                                <input type="text" id="payer_code" name="payer_code" class="form-control" placeholder="Enter New Payer Code" required="" maxlength="20" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            </div>
                            <input type="hidden" name="payer_id" id="payer_id">
                            <input type="hidden" id="captcha_token" name="captcha_token">

                            <div class="d-flex justify-content-center">
                                <input type="submit" class="btn btn-success ml-2" data-toggle="modal" name="payer_code_submit" id="submit" value="Add Payer Code" />
                                <input type="button" class="btn btn-success ml-2" data-toggle="modal" name="update_prayer_code" id="update_prayer_code" value="Update Prayer Code" />
                            </div>
                        </form>
                        <!-- form -->
                    </div>

                    <div class="container">
                        <table id="table_list" class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Payer Code</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                if (pg_num_rows($payer_code_query) > 0) {
                                    while ($payer_code_row = pg_fetch_array($payer_code_query)) {
                                        $count++;
                                ?>
                                        <tr>
                                            <td><?= $count; ?></td>
                                            <td><?= $payer_code_row['payer_code']; ?></td>
                                            <td>
                                                <a href="javascript:void(0)" class="bttn btn-sm edit" data-id="<?= $payer_code_row['id']; ?>"><i class="bi bi-pencil-square"></i></a>
                                                <a href="javascript:void(0)" class=" btn-danger btn-sm delete" data-id="<?= $payer_code_row['id']; ?>"> <i class="bi bi-trash"></i></a>
                                            </td>
                                        </tr>
                                <?php             }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                include "./components/footer.php"
                ?>
            </div>
        </div>

    </div>
    <?php
    if (isset($_POST['payer_code_submit'])) {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        $secret = "6Le6my0hAAAAAODDi8UgKvu3JQU1VfCIB78-NGwt";
        $response = $_POST['captcha_token'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $response . "&remoteip=" . $ip;

        $request =  file_get_contents($url);
        $result = json_decode($request);

        if ($result->success == true) {
            if (array_key_exists("payer_code_submit", $_POST)) {

                $payer_code = $_POST["payer_code"];
                $check_payer_code_sql = pg_query($conn, "SELECT * FROM static_master_payer_code");
                $already = 0;

                if (pg_num_rows($check_payer_code_sql) > 0) {
                    while ($check_payer_code_row = pg_fetch_assoc($check_payer_code_sql)) {
                        if ($check_payer_code_row["payer_code"] == $_POST["payer_code"]) {
                            $already = 1;
                        }
                    }
                }

                if ($already != 1) {
                    $payer_code = $_POST['payer_code'];
                    $insert_query = "
							INSERT INTO static_master_payer_code(payer_code)
							VALUES('$payer_code')";
                    $insert_result = pg_query($conn, $insert_query);

                    if ($insert_result) {
                        echo "<script>$('#msgshowsuccess').show();</script>";
                        echo '<meta http-equiv="Refresh" content="1;url=add_payer_code">';
                    } else {
                        echo "<script>$('#db_error_msg').show();</script>";
                        echo '<meta http-equiv="Refresh" content="1;url=add_payer_code">';
                    }
                } else {
                    echo "<script>$('#msgshowerror').show();</script>";
                    echo '<meta http-equiv="Refresh" content="1;url=add_payer_code">';
                }
            }
        } else {
            echo "<script> alert('Captcha Invalid') </script>";
        }
    }

    ?>
    <?php
    if (!$exportpermission) {
        echo "<script>$('#add-users').prop('disabled', true);</script>";
        echo "<script>$('#add-users').parent().css('cursor', 'no-drop');</script>";
        echo "<script>$('#add-users').parent().on('click', function() {alert('No permission')});</script>";
    }
    if (!$importpermission) {
        echo "<script>$('#download-users').prop('disabled', true);</script>";
        echo "<script>$('#download-users').parent().css('cursor', 'no-drop');</script>";
        echo "<script>$('#download-users').parent().on('click', function() {alert('No permission')});</script>";
    }
    ?>
    <?php
    // echo json_encode($_POST['account_type']);
    // echo 'hi';
    require_once("./importuser.php");
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.js" integrity="sha512-ztxZscxb55lKL+xmWGZEbBHekIzy+1qYKHGZTWZYH1GUwxy0hiA18lW6ORIMj4DHRgvmP/qGcvqwEyFFV7OYVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.js" integrity="sha512-Xd3wzuGJmU0vEl1Rt2R8WMr7roPdHGCbeoKWAFNOdLfKHSjaCvgTn0UqPXLjuYIKd9biT1KU4t/icygeGYRz2w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>
<script>
    $(document).ready(function() {
        $('#update_prayer_code').hide();
        $('#table_list').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50],
                ["10/page", "25/page", "50/page"],
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search Prayer code",
            }
        });
    })

    //edit code
    $(".edit").click(function() {
        var id = $(this).data('id');
        console.log(id);

        $.ajax({
            type: "post",
            url: "edit_prayer_code.php",
            data: {
                editid: id
            },
            dataType: 'json',
            success: function(data) {
                $("#payer_code").val(data.payer_code);
                $("#payer_id").val(data.id);
                $("#submit").hide();
                $("#update_prayer_code").show();
            }
        })
    })

    $("#update_prayer_code").click(function() {
        var id = $("#payer_id").val();
        var payer_code = $("#payer_code").val();
        var formData = {
            id: id,
            payer_code: payer_code,
            update_prayer_code: 'update_prayer_code'
        }

        $.ajax({
            type: "POST",
            url: "edit_prayer_code.php",
            data: formData,
            success: function(data) {

                $("#submit").show();
                $("#update_prayer_code").hide();
                $("#payer_id").val('');
                $("#payer_code").val('');
                if(data == 'updated'){
                    $("#update_msg").text("Payer code updated succesfully.");
                    $('#msgshowsuccess').show();
                }
                if(data == 'alredy'){
                    $('#msgshowerror').show();
                }
                if(data == 'wrong'){
                    $('#db_error_msg').show();
                }
                setTimeout(function () {
                    location.reload(true);
                }, 1000);
                
                // window.location.reload();

            }
        });
    });

    //delete
    $(".delete").click(function() {
        if (confirm("Are you want to delete this payer code?") == true) {
            var id = $(this).data('id');
            $.ajax({
                type: "post",
                url: "edit_prayer_code.php",
                data: {
                    delid: id
                },
                success: function(data) {
                    if(data == 'delete'){
                        $('#delete_msg').show();
                    }
                    setTimeout(function () {
                    location.reload(true);
                }, 1000);
                }
            })
        }
    })
</script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6Le6my0hAAAAAKkeamNMFcXqpIhinxSLX7y1W2qO', {
            action: 'payer_code_submit'
        }).then(function(token) {
            // Add your logic to submit to your backend server here.
            var response = document.getElementById('captcha_token');
            response.value = token;
        });
    });
</script>