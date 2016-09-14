<!DOCTYPE html>
<html lang="en">
<?php
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
if ( !isset($_SESSION['modSession']) ) {
	 header ('Location: ../../index.php');
	 die();
}
if ( isset($_SESSION['modSession']) ) {
	if ( !$_SESSION['modSession'] || $_SESSION['admin'] <= 0 ) {
		header ('Location: ../../index.php');
		die();
	}
}
include '../../url/require.php';

?>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Newsletter - Admin Panel</title>
    <!-- Bootstrap -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <!-- Custom Theme Style -->
    <link href="../assets/custom.min.css" rel="stylesheet">
    <link href="../assets/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/admin.css" rel="stylesheet">
    <link rel="icon" href="../../images/gfx/favicon.png?v=1" type="image/png" sizes="16x16">

    <script src="../assets/ckeditor/ckeditor.js"></script>
    <script src="../assets/ckeditor/config.js"></script>
  </head>
  <div id="sendingMailDiv" style="background:rgba(0,0,0,0.75); height:100%; width:100%; position:fixed; z-index:100" hidden>
            <div class="alert alert-info" id="resultDiv" style="position: absolute; left: 50%; top: 50%; text-align: center; width: 800px; height: 400px; margin-left: -400px; margin-top: -200px; overflow: auto; font-variant:normal;background: rgb(238, 238, 238) none repeat scroll 0% 0%; color: black; border: none;">
                <h4><div class='alert alert-info' style="position: fixed;" id="alertDiv">Sending <span id="sentMails">0</span>/<span id="totalMails">0</span></div>
                <a href="javascript:void(0);" id="closeIcon" class="btn btn-danger" style="font-size: 20px; margin: 0px 16px; /* right: 0px; */ position: fixed; display: block; /* float: right; */ margin-left: 700px;" onclick="location.reload();" data-toggle="tooltip" data-placement="bottom" title="Close">Close</a>
                </h4><table class='table table-condensed table-custom' style="table-layout: fixed; word-wrap: break-word;"><thead><th style="width: 30px;">#</th><th style="width: 60%;">Email</th><th>Result</th></thead><tbody id="resultTable"></tbody></table>
            </div>
        </div>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
      	<!-- sidebar -->
        <div class="col-md-3 left_col">
          <?php include 'sidebar.php'; ?>
        </div>
		<!-- /sidebar -->
        <!-- top navigation -->
        <div class="top_nav">
          <?php include 'navbar.php'; ?>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div>
            <h3>Newsletter</h3>
                <div>
                <?php
                $subs = $pdo->prepare("SELECT * FROM `subscribers`");
                $subs->execute();
                $subs = $subs->fetchAll();

                $newestSub = ( sizeof($subs) > 0 ) ? $subs[sizeof($subs)-1]['email'] : "N/A";

                echo '<h4>Total Subscribers: '. sizeof($subs) .' <small><button class="btn btn-custom" onclick="$(\'#showAllModal\').modal(\'toggle\');">View All</button></small></h4>';
                echo '<h5>Newest Subscriber: '. $newestSub .'</h5>';
                ?>
                </div>
                    <textarea name="rtfEditor" id="rtfEditor" rows="10" cols="80"></textarea>
                    <script type="text/javascript">
                     CKEDITOR.replace( 'rtfEditor' ); 
                     </script>
                     <?php
                     if ( sizeof($subs) > 0 ) {
                        echo '<button  class="btn btn-custom" onclick="sendNewsletter()" style="margin: 10px; float: right; width: 100px;">Send</button>';
                     }
                     ?>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer style="margin-top:-20px;">
          <?php include 'footer.php'; ?>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    
	<script src="../../js/jquery-1.12.0.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../assets/custom.min.js"></script>
    <script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip(); 
	});

    var currentMail = 0;
    var mailQ = [];

    function sendNewsletter(){
        
        $.ajax({
            url: './ajax.php?getSubs=all',
            method: 'GET',
            success: function(result) {
                console.log(result);
                try {
                    mailQ = JSON.parse(result);
                    checkQ();
                    $("#totalMails").text(mailQ.length);
                    console.log("MailQ: " + mailQ);
                } catch ( e ){
                    console.log("Failure");
                }
            }
        });
    }

    function checkQ() {
        console.log("Total: " + mailQ.length);
        console.log("Current: " + currentMail);
        $('#sentMails').text(currentMail);
        if ( currentMail == mailQ.length ) {
            $("#closeIcon").show();
            $('#alertDiv').removeClass("alert-info");
            $('#alertDiv').addClass("alert-success");
            $('#alertDiv').html("Newsletter Sent!");
        }
        if ( currentMail < mailQ.length ) {
            console.log("Sending Mail: " + currentMail);
            sendMail(mailQ[currentMail]);
        } else {
            console.log("Ending at: " + currentMail);
        }
    }

    function sendMail(mail) {
        console.log("Mail: " + mail);

        $.ajax({
            url: './ajax.php?sendNewsletter=true',
            method: 'POST',
            data: {
                content: encodeURIComponent(CKEDITOR.instances.rtfEditor.getData()),
                email: mail
            },
            beforeSend: function(){
                console.log("SENDING MAIL TO :" + mail);
                count = currentMail;
                $("#sendingMailDiv").show();
                $("#closeIcon").hide();
                $("#resultTable").append("<tr><td>"+ currentMail +"</td><td>"+ mail +"</td><td id='result_"+ count +"'><img src='../../images/gfx/cube.gif' style='width:24px;'/></tr>");
            },
            complete: function() {
                if ( currentMail == mailQ.length ) {
                    $("#closeIcon").show();
                    $('#alertDiv').addClass("alert-success");
                    $('#alertDiv').html("Newsletter Sent!");
                }
                currentMail++;
                checkQ();
            },
            success: function(result) {
                $("#result_"+count).html(result);
                console.log(result);
            },
            failure: function(result) {
                $("#result_"+count).html(result);
            }
        });
    }
	</script>
  </body>
</html>

<div id="showAllModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Subscribers</h4>
      </div>
      <div class="modal-body" style="max-height: 60vh; overflow: auto;">
        <div class="container">
            <table class="table table-custom table-condensed" style="width:60%; margin-left:20%;">
                <thead>
                    <th>Email</th>
                </thead>
                <tbody>
                    <?php
                    foreach ( $subs as $sub ) {
                        echo '<tr><td>'. $sub['email'] .'</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<style type="text/css">
.form-label {
    text-align: right;
    font-size: 14px;
    font-variant: small-caps;
}
.table-item-label {
	width: 20%;
}
.table-item {
	margin: 5px 10px 15px;
}
.table-row {
	margin: 10px;
}
.form-control:invalid {
	background-color: #FFCDD2;
}
.form-control:valid {
	background-color: #DCEDC8;
}
</style>