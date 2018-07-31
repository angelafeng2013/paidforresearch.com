<?php
require_once '../includes/anura.php'; 

if(!isset($_SESSION['logged_in'])) :
  echo '<script>window.location.replace("login.php");</script>';
  exit;
else:
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anura Statistics</title>

    <!-- Bootstrap -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <link href="../bower_components/bootstrap-datepicker/bootstrap-datepicker3.min.css" rel="stylesheet">
    <style>
      .error_label{color: #a94442;}
      .error_field{border:1px solid #a94442;}
      table td { word-wrap: break-word; }
    </style>
  </head>
  <body>
    <div class="row">
      <div class="col-md-12" style="margin-bottom: 10px">
        <h1 style="display: inline-block;">Anura Statistics</h1>
        <h1 style="display: inline-block;" class="pull-right">
          <em><a href="logout.php" style="font-size: 50%;">Log Out</a></em>
        </h1>
      </div>
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <form id="stats-filter-form">
              <div class="row">
                <div class="form-group col-md-3">
                  <label for="anura_id">Anura ID</label>
                  <input id="anura_id" type="text" class="this_field form-control"/>
                </div>
                <div class="form-group col-md-2">
                  <label for="status">Status</label>
                  <select class="this_field form-control" id="status" name="status"><option value="" selected="selected"></option><option value="1">Good</option><option value="2">Warning</option><option value="3">Bad</option></select>
                </div>
                <div class="form-group col-md-2">
                  <label for="affiliate">Affiliate ID</label>
                  <input id="affiliate" type="text" class="this_field form-control"/>
                </div>
                <div class="form-group col-md-2">
                  <label for="rev_tracker">Revenue Tracker ID</label>
                  <input id="rev_tracker" type="text" class="this_field form-control"/>
                </div>
                <div class="form-group col-md-3">
                  <label for="email">Email</label>
                  <input id="email" type="text" class="this_field form-control"/>
                </div>
                <div class="form-group col-md-1">
                  <label for="gender">Gender</label>
                  <select class="this_field form-control" id="gender" name="gender"><option value="" selected="selected"></option><option value="F">Female</option><option value="M">Male</option></select>
                </div>
                <div class="col-md-2">
                  <label for="zip">Zip</label>
                  <input class="this_field form-control" id="zip" name="zip" type="text" value="">
                </div>
                <div class="form-group col-md-3">
                  <label for="source_url">Source URL</label>
                  <input class="this_field form-control" id="source_url" name="source_url" type="text" value="">
                </div>
                <div class="form-group col-md-3">
                    <label for="date_from">Date From</label>
                    <div class="input-group date">
                        <input name="date_from" id="date_from" value="" type="text" class="lead_date form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="date_to">Date To</label>
                    <div class="input-group date">
                        <input name="date_to" id="date_to" value="" type="text" class="lead_date form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-default" id="clear" type="button">Clear</button>
                    <input id="getAnuraUsersBtn" class="btn btn-primary" type="submit" value="Search Users" disabled>
                    <a href="excel.php" class="btn btn-primary" id="downloadAnuraUsers" disabled>Download Users</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <table id="stats-table" class="table table-bordered table-striped table-hover table-heading table-datatable responsive-data-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Affiliate</th>
              <th>Revenue Tracker</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Zip</th>
              <th>IP</th>
              <th>Status</th>
              <th>Source URL</th>
              <th>Created At</th>
              <th></th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>

    <div id="more-details-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="moreDetailsModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="moreDetailsModalLabel">More Details</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <table class="table table-striped table-bordered" style="table-layout: fixed;">
                  <tr>
                    <th width="30%">ID</th>
                    <td id="md-id" class="md-deets" width="70%"></td>
                  </tr>
                  <tr>
                    <th>Status</th>
                    <td id="md-stat" class="md-deets"></td>
                  </tr>
                  <tr>
                    <th>Affiliate ID</th>
                    <td id="md-aff" class="md-deets"></td>
                  </tr>
                  <tr>
                    <th>Revenue Tracker ID</th>
                    <td id="md-rt" class="md-deets"></td>
                  </tr>
                  <tr>
                    <th>First Name</th>
                    <td id="md-fn" class="md-deets"></td>
                  </tr>
                  <tr>
                    <th>Last Name</th>
                    <td id="md-ln" class="md-deets"></td>
                  </tr>
                  <tr>
                    <th>Email</th>
                    <td id="md-em" class="md-deets"></td>
                  </tr>
                  <tr>
                    <th>Birthdate</th>
                    <td id="md-bd" class="md-deets"></td>
                  </tr>
                  <tr>
                    <th>Gender</th>
                    <td id="md-gd" class="md-deets"></td>
                  </tr>
                  <tr>
                    <th>Zip</th>
                    <td id="md-zip" class="md-deets"></td>
                  </tr>
                  <tr>
                    <th>State</th>
                    <td id="md-ste" class="md-deets"></td>
                  </tr>
                  <tr>
                    <th>City</th>
                    <td id="md-cty" class="md-deets"></td>
                  </tr>
                  <tr>
                    <th>Address</th>
                    <td id="md-add" class="md-deets"></td>
                  </tr>
                  <tr>
                    <th>Phone</th>
                    <td id="md-phn" class="md-deets"></td>
                  </tr>
                  <tr>
                    <th>IP</th>
                    <td id="md-ip" class="md-deets"></td>
                  </tr>
                  <tr>
                    <th>Source URL</th>
                    <td id="md-surl" class="md-deets"></td>
                  </tr>
                  <tr>
                    <th>Is Mobile</th>
                    <td id="md-im" class="md-deets"></td>
                  </tr>
                  <tr>
                    <th>Browser Agent</th>
                    <td id="md-ba" class="md-deets"></td>
                  </tr>
                  <tr>
                    <th>Local Date Time (Browser Time)</th>
                    <td id="md-ldt" class="md-deets"></td>
                  </tr>
                  <tr>
                    <th>Created At (PST Time)</th>
                    <td id="md-ca" class="md-deets"></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="../js/jquery-1.11.1.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="../bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>

<?php endif;?>