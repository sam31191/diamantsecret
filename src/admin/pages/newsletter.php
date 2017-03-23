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
?>
<!DOCTYPE html>
<html lang="en">
<?php
include '../../conf/config.php';

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

    <script type="text/javascript" src="../assets/tinymce/tinymce.min.js"></script>
    <script>
    tinymce.init({
        selector: '#tiny_mce',
        width: "100%",
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons paste textcolor colorpicker textpattern imagetools'
          ],
        height: "220px",
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
          toolbar2: 'print preview media | forecolor backcolor emoticons',
          image_advtab: true,
        });
    </script>
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
            <h3>Newsletter 
                <div class="btn-group">
                <?php 
                $selectedSiteFilter = "";
                $selectedSiteHref = "all";
                $selectedSiteID = "all";

                /* FIRST FILTER (Domains) */
                $fetchAllSites = $pdo->prepare("SELECT * FROM tb_websites");
                $fetchAllSites->execute();

                $allSites = "";

                if ( $fetchAllSites->rowCount() > 0 ) {

                    $allSiteOptions = $fetchAllSites->fetchAll();

                    foreach ( $allSiteOptions as $siteOption ) {
                        $allSites .= '<li><a href="?site='. $siteOption['name'] .'">'. $siteOption['label'] .'</a></li>';
                    }

                    if ( isset($_GET['site']) ) {
                        $checkSiteOption = $pdo->prepare("SELECT * FROM tb_websites WHERE name = :name");
                        $checkSiteOption->execute(array(":name" => $_GET['site']));

                        if ( $checkSiteOption->rowCount() > 0 ) {
                            $selectedSiteOption = $checkSiteOption->fetch(PDO::FETCH_ASSOC);
                            $selectedSiteLabel = $selectedSiteOption['label'];
                            $selectedSiteFilter = " WHERE site_id = ". $selectedSiteOption['id'];
                            $selectedSiteHref = $selectedSiteOption['name'];
                            $selectedSiteID = $selectedSiteOption['id'];
                        } else {
                            $selectedSiteLabel = "All Sites";
                        }
                    } else {
                        $selectedSiteLabel = "All Sites";
                    }
                }
                /* FIRST FILTER END */

                echo '<button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    '. $selectedSiteLabel .' <span class="fa fa-caret-down"></span>
                </button>';
                echo'
                  <ul class="dropdown-menu">
                    <li><a href="?site=all">All</a></li>
                    '. $allSites .'
                  </ul>
                  ';
                ?>
                </div>
            </h3>
                <div>
                <?php

                $subs = $pdo->prepare("SELECT * FROM `subscribers`". $selectedSiteFilter);
                $subs->execute();
                $subs = $subs->fetchAll();

                $newestSub = ( sizeof($subs) > 0 ) ? $subs[sizeof($subs)-1]['email'] : "N/A";

                echo '<h4>Total Subscribers: '. sizeof($subs) .' <small><button class="btn btn-custom" onclick="$(\'#showAllModal\').modal(\'toggle\');">View All</button><button class="btn btn-custom" style="float:right;" onclick="$(\'#showTemplates\').modal(\'toggle\');">Templates</button></small></h4>';
                echo '<h5>Newest Subscriber: '. $newestSub .'</h5>';
                ?>
                </div>
                    <!-- <textarea name="rtfEditor" id="rtfEditor" rows="10" cols="80"></textarea>
                    <script type="text/javascript">
                     CKEDITOR.replace( 'rtfEditor' ); 
                     </script>-->

                     <textarea id="tiny_mce"></textarea>
                     <?php
                     if ( sizeof($subs) > 0 ) {
                        echo '<button  class="btn btn-custom" onclick="sendNewsletter(\''. $selectedSiteID .'\')" style="margin: 10px; float: right; width: 100px;">Send</button>';
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

    function sendNewsletter(id){
        
        $.ajax({
            url: './ajax.php?getSubs='+ id,
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

        //console.log(encodeURIComponent(tinyMCE.activeEditor.getContent()));
        $.ajax({
            url: './ajax.php?sendNewsletter=true',
            method: 'POST',
            data: {
                content: encodeURIComponent(tinyMCE.activeEditor.getContent()),
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


<div id="showTemplates" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Templates</h4>
      </div>
      <div class="modal-body" style="max-height: 60vh; overflow: auto;">
        <div class="container">
            <table class="table table-custom table-condensed" style="width:80%; margin-left:10%;">
                <thead>
                    <th>Template</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <?php
                    $templates = scandir('./newsletter/');

                    foreach ( $templates as $template ) {
                        if ( strstr($template, '.html') !== false ) {
                            echo '<tr>';
                            echo '<td>'. $template .'</td>';
                            echo '<td><a class="btn btn-custom" href="./newsletter/'. $template .'" target="_blank">Preview</a><button class="btn btn-custom" onclick="loadTemplate(this)" value="./newsletter/'. $template .'">Load</button></td>';
                            echo '</tr>';
                        }
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

<script type="text/javascript">
    function loadTemplate(element) {
        $.ajax({
            url: $(element).val(),
            type: 'GET',
            success: function(result){
                tinyMCE.activeEditor.setContent(result);
            }
        });

    }
</script>