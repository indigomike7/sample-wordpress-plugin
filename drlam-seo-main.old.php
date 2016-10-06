<?php
register_activation_hook( DRLAMSEO_FILE, 'drlamseo_activate' );
register_deactivation_hook( DRLAMSEO_FILE, 'drlamseo_deactivate' );
drlamseo_load();
function drlamseo_activate()
{

}
function drlamseo_deactivate()
{

}
function drlamseo_load()
{
	add_action('admin_init','drlam_meta_box_init');
	// create custom plugin settings menu
	add_action('admin_menu', 'drlam_create_menu');
}
function power_keyword()
{
?>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Power Keyword
                        </div>
					<!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
								<a href="#myModal" role="button" class="btn btn-large btn-primary" data-toggle="modal">Add New</a>
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Power Keyword</th>
                                            <th>Date Added</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
										
                                    <tbody>
									<?php
									global $wpdb;
									$tk = $wpdb->get_results( "SELECT * FROM drlam_power_keyword" );
									//echo print_r($tk);
									foreach($tk as $key=>$value)
									{
										?>
										<tr>
											<td><?php echo $value->id; ?></td>
											<td><?php echo $value->keyword; ?></td>
											<td><?php echo $value->added_by?></td>
											<td><a href="javascript:;" onclick="edit(<?php echo $value->id;?>);">Edit</a> | <a href="javascript:;" onclick="delete_file(<?php echo $value->id; ?>);">Delete</a></td>
										</tr>
										<?php
									}
									?>
                                    </tbody>
                                </table>
								<a href="#myModal" role="button" class="btn btn-large btn-primary" data-toggle="modal">Add New</a>
                            </div>
                        </div>
                        <!-- /.panel-body -->
            <!-- /.row -->
            <div class="row">
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->


    <div id="myModal" class="modal fade">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">Add Power Keyword</h4>

                </div>

                <div class="modal-body">
				<div id="add_message">
				</div>
					<form id="form_add" name="form_add" action="" method="post" enctype="multipart/form-data">
                    <p>Power Keyword</p>
					<p><input class="form-control" placeholder="keyword" type="text" name="tk_add" id="tk_add"></p>
                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary">Add Keyword</button>
					</form>
                </div>

            </div>

        </div>

    </div>

    <div id="myModal2" class="modal fade">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">Update Power Keyword</h4>

                </div>

                <div class="modal-body">
				<div id="update_message">
				</div>
					<form id="form_edit" name="form_edit" action="" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id_edit" id="id_edit">
                    <p>Target Keyword</p>
					<p><input class="form-control" placeholder="keyword" type="text" name="tk_edit" id="tk_edit"></p>
                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary">Update Data</button>
					</form>
                </div>

            </div>

        </div>

    </div>

    <div id="myModal3" class="modal fade">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">Delete Power Keyword</h4>

                </div>

                <div class="modal-body">
				<div id="delete_message">
				</div>
				<p>Are you sure you want to delete this data? </p>
					<form id="form_delete" name="form_delete" action="" method="post">
					<input type="hidden" name="id_delete" id="id_delete">
                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-danger">Delete Data</button>
					</form>
                </div>

            </div>

        </div>

    </div>
	
	<!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/jquery/dist/jquery.min.js"></script>


    <!-- DataTables JavaScript -->
    <script src="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/datatables-responsive/js/dataTables.responsive.js"></script>
    
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    jQuery(document).ready(function() {
        jQuery('#dataTables-example').DataTable({
                responsive: true,
        "order": [[ 0, "desc" ]]
        });
    });
    </script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.1/jquery.validate.min.js"></script>
	<script type="text/javascript">
	function edit(id)
	{
				$.ajax({
					url:"<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/ajax-keyword.php",
					type:"POST",
					data: "id="+id + "&action=edit2",
					success: function(data,status){
						msg = jQuery.parseJSON(data);
						$("#id_edit").val(msg[0].id);
						$("#tk_edit").val(msg[0].keyword);
						$('#myModal2').modal('show');
					}
				});

	}
	function delete_file(id)
	{
		$("#id_delete").val(id);
		$('#myModal3').modal('show');

	}
		$("#form_add").validate({
			rules: {
				tk_add: {
						required: true
					}
			},
			messages: {
				tk_add: {
						required: "Please enter Keyword"
					}
			},
			submitHandler: function(form) {
				$.ajax({
					url:"<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/ajax-keyword.php",
					type:"POST",
					data: "tk_add=" + $("#tk_add").val() + "&action=add2",
					success: function(data,status){
						msg = jQuery.parseJSON(data);
						if(msg.message=="Data Added")
						{
							$("#add_message").html("<div class='alert alert-success'>Data Added</div>");
							window.location="admin.php?page=drlam-seo/drlam-seo-main.php&action=power_keyword";
						}
						else
						{
							alert(msg.message);
						}
					}
				});
			}
		});
		$("#form_edit").validate({
			rules: {
				title_edit: {
						required: true
					}
			},
			messages: {
				title_edit: {
						required: "Please enter Title"
					}
			},
			submitHandler: function(form) {
				$.ajax({
					url:"<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/ajax-keyword.php",
					type:"POST",
					data: "tk_edit=" + $("#tk_edit").val() + "&action=update2&id="+ $("#id_edit").val(),
					success: function(data,status){
						msg = jQuery.parseJSON(data);
						if(msg.message=="Data Updated")
						{
							$("#update_message").html("<div class='alert alert-success'>Data Updated</div>");
							window.location="admin.php?page=drlam-seo/drlam-seo-main.php&action=power_keyword";
						}
						else
						{
							alert(msg.message);
						}
					}
				});
			}
		});
		$("#form_delete").validate({
			rules: {
				id_delete: {
						required: true
					}
			},
			messages: {
				id_delete: {
						required: "Please enter ID"
					}
			},
			submitHandler: function(form) {
				$.ajax({
					url:"<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/ajax-keyword.php",
					type:form.method,
					data: "action=delete2&id="+ $("#id_delete").val(),
					success: function(data,status){
						msg = jQuery.parseJSON(data);
						if(msg.message=="Data Deleted")
						{
							$("#delete_message").html("<div class='alert alert-success'>Data Deleted</div>");
							window.location="admin.php?page=drlam-seo/drlam-seo-main.php&action=power_keyword";
						}
						else
						{
							alert(msg.message);
						}
					}
				});
			}
		});	</script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/raphael/raphael-min.js"></script>
    <script src="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/morrisjs/morris.min.js"></script>
    <script src="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/dist/js/sb-admin-2.js"></script>

<?php
}
function target_keyword()
{
?>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Target Keyword
                        </div>
					<!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
								<a href="#myModal" role="button" class="btn btn-large btn-primary" data-toggle="modal">Add New</a>
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Target Keyword</th>
                                            <th>Date Added</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
										
                                    <tbody>
									<?php
									global $wpdb;
									$tk = $wpdb->get_results( "SELECT * FROM drlam_target_keyword" );
									//echo print_r($tk);
									foreach($tk as $key=>$value)
									{
										?>
										<tr>
											<td><?php echo $value->id; ?></td>
											<td><?php echo $value->keyword; ?></td>
											<td><?php echo $value->added_by?></td>
											<td><a href="javascript:;" onclick="edit(<?php echo $value->id;?>);">Edit</a> | <a href="javascript:;" onclick="delete_file(<?php echo $value->id; ?>);">Delete</a></td>
										</tr>
										<?php
									}
									?>
                                    </tbody>
                                </table>
								<a href="#myModal" role="button" class="btn btn-large btn-primary" data-toggle="modal">Add New</a>
                            </div>
                        </div>
                        <!-- /.panel-body -->
            <!-- /.row -->
            <div class="row">
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->


    <div id="myModal" class="modal fade">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">Add Target Keyword</h4>

                </div>

                <div class="modal-body">
				<div id="add_message">
				</div>
					<form id="form_add" name="form_add" action="" method="post" enctype="multipart/form-data">
                    <p>Target Keyword</p>
					<p><input class="form-control" placeholder="keyword" type="text" name="tk_add" id="tk_add"></p>
                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary">Add Keyword</button>
					</form>
                </div>

            </div>

        </div>

    </div>

    <div id="myModal2" class="modal fade">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">Update Target Keyword</h4>

                </div>

                <div class="modal-body">
				<div id="update_message">
				</div>
					<form id="form_edit" name="form_edit" action="" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id_edit" id="id_edit">
                    <p>Target Keyword</p>
					<p><input class="form-control" placeholder="keyword" type="text" name="tk_edit" id="tk_edit"></p>
                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary">Update Data</button>
					</form>
                </div>

            </div>

        </div>

    </div>

    <div id="myModal3" class="modal fade">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">Delete Target Keyword</h4>

                </div>

                <div class="modal-body">
				<div id="delete_message">
				</div>
				<p>Are you sure you want to delete this data? </p>
					<form id="form_delete" name="form_delete" action="" method="post">
					<input type="hidden" name="id_delete" id="id_delete">
                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-danger">Delete Data</button>
					</form>
                </div>

            </div>

        </div>

    </div>
	
	<!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/jquery/dist/jquery.min.js"></script>


    <!-- DataTables JavaScript -->
    <script src="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/datatables-responsive/js/dataTables.responsive.js"></script>
    
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    jQuery(document).ready(function() {
        jQuery('#dataTables-example').DataTable({
                responsive: true,
        "order": [[ 0, "desc" ]]
        });
    });
    </script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.1/jquery.validate.min.js"></script>
	<script type="text/javascript">
	function edit(id)
	{
				$.ajax({
					url:"<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/ajax-keyword.php",
					type:"POST",
					data: "id="+id + "&action=edit",
					success: function(data,status){
						msg = jQuery.parseJSON(data);
						$("#id_edit").val(msg[0].id);
						$("#tk_edit").val(msg[0].keyword);
						$('#myModal2').modal('show');
					}
				});

	}
	function delete_file(id)
	{
		$("#id_delete").val(id);
		$('#myModal3').modal('show');

	}
		$("#form_add").validate({
			rules: {
				tk_add: {
						required: true
					}
			},
			messages: {
				tk_add: {
						required: "Please enter Keyword"
					}
			},
			submitHandler: function(form) {
				$.ajax({
					url:"<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/ajax-keyword.php",
					type:"POST",
					data: "tk_add=" + $("#tk_add").val() + "&action=add",
					success: function(data,status){
						msg = jQuery.parseJSON(data);
						if(msg.message=="Data Added")
						{
							$("#add_message").html("<div class='alert alert-success'>Data Added</div>");
							window.location="admin.php?page=drlam-seo/drlam-seo-main.php&action=target_keyword";
						}
						else
						{
							alert(msg.message);
						}
					}
				});
			}
		});
		$("#form_edit").validate({
			rules: {
				title_edit: {
						required: true
					}
			},
			messages: {
				title_edit: {
						required: "Please enter Title"
					}
			},
			submitHandler: function(form) {
				$.ajax({
					url:"<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/ajax-keyword.php",
					type:"POST",
					data: "tk_edit=" + $("#tk_edit").val() + "&action=update&id="+ $("#id_edit").val(),
					success: function(data,status){
						msg = jQuery.parseJSON(data);
						if(msg.message=="Data Updated")
						{
							$("#update_message").html("<div class='alert alert-success'>Data Updated</div>");
							window.location="admin.php?page=drlam-seo/drlam-seo-main.php&action=target_keyword";
						}
						else
						{
							alert(msg.message);
						}
					}
				});
			}
		});
		$("#form_delete").validate({
			rules: {
				id_delete: {
						required: true
					}
			},
			messages: {
				id_delete: {
						required: "Please enter ID"
					}
			},
			submitHandler: function(form) {
				$.ajax({
					url:"<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/ajax-keyword.php",
					type:form.method,
					data: "action=delete&id="+ $("#id_delete").val(),
					success: function(data,status){
						msg = jQuery.parseJSON(data);
						if(msg.message=="Data Deleted")
						{
							$("#delete_message").html("<div class='alert alert-success'>Data Deleted</div>");
							window.location="admin.php?page=drlam-seo/drlam-seo-main.php&action=target_keyword";
						}
						else
						{
							alert(msg.message);
						}
					}
				});
			}
		});	</script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/raphael/raphael-min.js"></script>
    <script src="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/morrisjs/morris.min.js"></script>
    <script src="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/dist/js/sb-admin-2.js"></script>

<?php
}
function drlam_settings()
{

}
function drlam_index()
{
	echo "<h1>DRLAM SEO</h1>";
	echo "<ul>";
	echo "<li><a href='admin.php?page=drlam-seo/drlam-seo-main.php&action=target_keyword'>Target Keyword</a></li>";
	echo "<li><a href='admin.php?page=drlam-seo/drlam-seo-main.php&action=power_keyword'>Power Keyword</a></li>";
	echo "<li><a href='admin.php?page=drlam-seo/drlam-seo-main.php&action=settings'>Settings</a></li>";
	echo "</ul>";
	if(!isset($_GET['action']))
	{
	}
	else
	{
		switch($_GET['action'])
		{
			case "target_keyword":
				target_keyword();
				break;
			case "power_keyword":
				power_keyword();
				break;
			case "settings":
				drlam_settings();
				break;
			default:
				break;
		}
	}

}
function drlam_create_menu() {
	add_menu_page('DRLAM SEO', 'DRLAM SEO','administrator', __FILE__, 'drlam_index',plugins_url('/images/wordpress.png', __FILE__));
	add_submenu_page( __FILE__, 'Target Keyword', 'Target Keyword','administrator','drlam-seo/drlam-seo-main.php&action=target_keyword', 'target_keyword');
	add_submenu_page( __FILE__, 'Power Word', 'Power Word','administrator','drlam-seo/drlam-seo-main.php&action=power_keyword', 'power_keyword');
	add_submenu_page( __FILE__, 'Settings', 'Settings','administrator', 'drlam-seo/drlam-seo-main.php&action=settings', 'drlam_settings');
//	add_submenu_page( __FILE__, 'General Settings Page', 'General','administrator', __FILE__.'_general_settings', 'gmp_settings_general');
} 
function drlam_meta_box_init() {
// create our custom meta box
//add_meta_box('drlam-meta',__('Product Information','drlam-seo'), 'drlam_meta_box','post','side','default');
add_meta_box('drlam-meta',__('HTML Check','drlam-seo'), 'drlam_meta_box','post','normal','default');
// hook to save our meta box data when the post is saved
//add_action('save_post','drlam_save_meta_box');
}
function drlam_save_meta_box($post_id,$post) {
// if post is a revision skip saving our meta box data
if($post->post_type == 'revision') { return; }
// process form data if $_POST is set
if(isset($_POST['drlam_product_type'])) {
// save the meta box data as post meta using the post ID as a unique prefix
update_post_meta($post_id,'_drlam_type', esc_attr($_POST['drlam_product_type']));
update_post_meta($post_id,'_drlam_price', esc_attr($_POST['drlam_price']));
}
}
function drlam_post_content($content)
{
	return $content;
}
function drlam_meta_box($post,$box) {
// retrieve our custom meta box values
/*$featured = get_post_meta($post->ID,'_drlam_type',true);
$drlam_price = get_post_meta($post->ID,'_drlam_price',true);
// custom meta box form elements
echo '<p>' .__('Price','drlam-seo'). ': <input type="text"
name="drlam_price" value="'.esc_attr($drlam_price).'" size="5" /></p>
<p>' .__('Type','drlam-seo'). ': <select name="drlam_product_type"
id="drlam_product_type">
<option value="0" '.(is_null($featured) || $featured == '0' ?
'selected="selected" ' : '').'>Normal</option>
<option value="1" '.($featured == '1' ? 'selected="selected" ' : '').'>
Special</option>
<option value="2" '.($featured == '2' ? 'selected="selected" ' : '').'>
Featured</option>
<option value="3" '.($featured == '3' ? 'selected="selected" ' : '').'>
Clearance</option>
</select></p>';
*/
	?>
	<div id="drlam_message">
	<?php
if(isset($_GET['post']))
{
	$post  = get_post($_GET['post']);
	drlam_seo_check_edit($post,$content="",$title="",$meta_keyword="",$categories="",$page_title="",$slug="",$meta_description="");
}
	?>
	</div>
	<?php
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<button type="button" onclick="repairhtml();">Check With DRLAM Seo Plugin</button>
<script type="text/javascript">
function repairhtml(values)
{
	var myCheckboxes = new Array();
	jq310("input[name='post_category[]']:checked").each(function() {
	   myCheckboxes.push(jq310(this).val());
	});
	var html_textarea_content = encodeURIComponent(jq310('#content').val()).replace(/['()]/g, escape).replace(/\*/g, '%2A').replace(/%(?:7C|60|5E)/g, unescape);
	var keywords = jq310('#yoast_wpseo_metakeywords').val();
	var titles = jq310('#title').val();
	var meta_desc =jq310("#snippet-editor-meta-description").val();
	var slugs = jq310("#snippet-editor-slug").val();
	var page_titles = jq310("#snippet-editor-title").val();
	if(title=="" || html_textarea_content=="" || keywords=="")
	{
		alert("Please enter content, meta keywords and titles")
	}
	else
	{
		jq310("#drlam_message").html("<center>Working...</center><br/><br/>");
		jq310.ajax(
			{	url: "<?php echo get_option('siteurl').'/wp-content/plugins/drlam-seo/ajax-check-html-error.php'; ?>"
		<?php
			if(isset($_GET['post']))
				{
			?>
				,data:{ html_content: html_textarea_content , meta_keyword: keywords , title: titles, categories: myCheckboxes, post: <?php echo $_GET['post'];?>, meta_description : meta_desc ,slug : slugs, page_title:page_titles }
			<?php
				}
			else
				{
			?>
				,data:{ html_content: html_textarea_content , meta_keyword: keywords , title: titles, categories: myCheckboxes, meta_description : meta_desc ,slug : slugs, page_title:page_titles }
			<?php
				}
				?>
				,type:"POST"
				, success: function(result)
				{
					jq310("#drlam_message").html(result);
				}
			});
	}
}
</script>
<script type="text/javascript">
var jq310 = jQuery.noConflict(true); 
</script>
<?php
}
function drlam_seo_check_edit($post,$content,$h1_title,$meta_keyword,$categories,$page_title,$slug,$meta_description)
{

?>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo get_option('siteurl')?>/wp-content/plugins/drlam-seo/resources/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<?php
	$meta_title="";
	if($post<>null)
	{
		$h1_title=$post->post_title;
		$id = $post->ID;
		if($content=="")
		{
			$content = $post->post_content;
		}
	//	echo print_r($post);

		global $wpdb;
		$data = $wpdb->get_results( "SELECT * FROM wp_posts where id = '".$id."'" );
		$slug=strtolower($data[0]->post_name);
		$url=get_option('siteurl')."/".$slug."/".$id."/";
		$x = new DOMDocument;
		$internalErrors = libxml_use_internal_errors(true);
		$x->loadHTMLFile($url);
		libxml_use_internal_errors($internalErrors);
		foreach($x->getElementsByTagName('title') as $title) 
		{
			$meta_title=$title->nodeValue;
		} 
	}
	else
	{
		$meta_title=$page_title;
		$id=null;
	}
//	echo $meta_title;
	/* TITLE */
	drlam_title_count($meta_title);
	drlam_title_contain_keyword($meta_title,$id,$keyword);
	drlam_title_contain_power_word($meta_title);
	/*EOF TITLE*/

	/* META DESC */
	drlam_meta_desc_count($id,$meta_description);
	drlam_meta_desc_contain_keyword($id,$keyword,$meta_description);
	/*EOF META DESC */

	/* SLUG/URL */
	drlam_slug_contain_keyword($id,$keyword,$slug);
	drlam_slug_no_space($id,$slug);
	/* EOF SLUG/URL */
	
	/* H1 */
//	echo $h1_title."<br/>dsds";
	drlam_h1_contain_keyword($id,$h1_title,$keyword);
	/* EOF H1 */

	/* Paragraph Contain Keyword */
	drlam_paragraph_contain_keyword($id,$content,$keyword);
	/* EOF PARAGRAPH */

	/* H2 Contain Keyword */
	drlam_h2_contain_keyword($id,$content,$keyword);
	/* EOF H2 */

	/* A HREF */
	drlam_links($id,$content,$keyword);
	/* EOF A HREF */

	/* IMAGES */
	drlam_images($id,$content,$keyword);
	/* EOF IMAGES */

	/* SOCMED IMAGES */
	drlam_sm_images($id,$content,$keyword);
	/* EOF SOCMED IMAGES */

	/* SLIDE SHOW IMAGES */
	drlam_ss_images($id,$content,$keyword);
	/* EOF SLIDE SHOW IMAGES */

	/* SLIDE SHOW IMAGES */
	drlam_has_categories($id);
	/* EOF SLIDE SHOW IMAGES */

	?>
	<?php
}
function drlam_title_count($title)
{
	/* DISPLAY CHARACTER COUNT ERROR */
	if(strlen($title)<65)
	{
		echo '<div class="alert alert-danger">Count of Characters in Title = '.strlen($title).' < 65 !</div>';
	}
	elseif(strlen($title)>71)
	{
		echo '<div class="alert alert-danger">Count of Characters in Title ='.strlen($title).' > 71 !</div>';
	}
	else
	{
		echo '<div class="alert alert-success">Count of Characters in Title Passed : 65 <= '.strlen($title).' <=71</div>';
	}

}
function drlam_title_contain_keyword($title,$id,$keyword)
{
	global $wpdb;
	$title=strtolower($title);
	$stat=false;
	$data = $wpdb->get_results( "SELECT * FROM wp_postmeta where post_id = '".$id."' and meta_key='_yoast_wpseo_metakeywords'" );
//	echo print_r($data);
	if($keyword!="")
		$mk=$keyword;
	else
		$mk=$data[0]->meta_value;
//	echo $mk;
	$mk_arr=explode(",", $mk);
//	echo print_r($mk_arr);
	foreach($mk_arr as $key=>$value)
	{
		$each_mk=strtolower($value);
//		echo $each_mk.$title;
		$pos = strpos($title, $each_mk);
		if($pos!==false)
		{
			$stat = true;
		}
	}
	if($stat==false)
	{
		echo '<div class="alert alert-danger">Title Tag does not contain meta keyword! <br/>Title : '.$title.', Meta Keyword : ';
		$i=0;
		foreach($mk_arr as $key=>$value)
		{
			echo '"'.$value.'"';
			if($i>0)
			{
				echo ",";
			}
			$i++;
		}
		echo '</div>';
	}
	else
	{
		echo '<div class="alert alert-success">Title Tag contains meta keyword <br/>Title : '.$title.', Meta Keyword : ';
		$i=0;
		foreach($mk_arr as $key=>$value)
		{
			echo '"'.$value.'"';
			if($i>0)
			{
				echo ",";
			}
			$i++;
		}
		echo '</div>';
	}
}
function drlam_title_contain_power_word($title)
{
	global $wpdb;
	$power_word="";
	$title=strtolower($title);
	$stat=false;
	$data = $wpdb->get_results( "SELECT * FROM drlam_power_keyword" );
	if(count($data)>0)
	{
		foreach($data as $key=>$value)
		{
			$pos = strpos($title, strtolower($value->keyword));
//			echo $value->keyword."<br/>";
			if($pos!==false)
			{
				$stat = true;
				$power_word = $value->keyword;
			}
		}
		if($stat==false)
		{
			echo '<div class="alert alert-danger">Title does not contain Power Word! </div>';
		}
		else
		{
			echo '<div class="alert alert-success">Title contains Power Word :"'.$power_word.'"</div>';
		}
	}
	else
	{
		echo '<div class="alert alert-danger">No Power Word defined in database! </div>';
	}
}
function drlam_meta_desc_count($id,$meta_description)
{
	/* DISPLAY CHARACTER COUNT ERROR */
	global $wpdb;
	$md="";
	if($id<>null)
	{
		$data = $wpdb->get_results( "SELECT * FROM wp_postmeta where post_id = '".$id."' and meta_key='_yoast_wpseo_metadesc'" );
		$md=strtolower($data[0]->meta_value);
	}
	else
	{
		$md=$meta_description;
	}
	if(strlen($md)>=165)
	{
		echo '<div class="alert alert-danger">Count of Characters in Meta Description >= 165 !<br/>Meta Description : "'.$data[0]->meta_value.'", Count of Characters : '.strlen($md).'</div>';
	}
	else
	{
		echo '<div class="alert alert-success">Count of Characters in Meta Description Passed <br/><br/>Meta Description : "'.$data[0]->meta_value.'", Count of Characters : '.strlen($md).'</div>';
	}
}
function drlam_meta_desc_contain_keyword($id,$keyword,$meta_description)
{
	global $wpdb;
	$stat=false;
	$found="";
	$md="";
	if($id<>null)
	{
		$data = $wpdb->get_results( "SELECT * FROM wp_postmeta where post_id = '".$id."' and meta_key='_yoast_wpseo_metadesc'" );
		$md=strtolower($data[0]->meta_value);
	}
	else
	{
		$md=$meta_description;
	}
	$data = $wpdb->get_results( "SELECT * FROM wp_postmeta where post_id = '".$id."' and meta_key='_yoast_wpseo_metakeywords'" );
	if($keyword!="")
		$mk=$keyword;
	else
		$mk=strtolower($data[0]->meta_value);

	$mk_arr=explode(",", $mk);
	foreach($mk_arr as $key=>$value)
	{
		$each_mk=strtolower($value);
		$pos = strpos($md, $each_mk);
		if($pos!==false)
		{
			$stat = true;
			$found = $each_mk;
		}
	}
	if($stat==false)
	{
		echo '<div class="alert alert-danger">Meta Description does not contain meta keyword! <br/> Meta Description : '.$md.', Meta Keyword : ';
		$i=0;
		foreach($mk_arr as $key=>$value)
		{
			echo '"'.$value.'"';
			if($i>0)
			{
				echo ",";
			}
			$i++;
		}
		echo '</div>';	}
	else
	{
		echo '<div class="alert alert-success">Meta Description contains meta keyword <br/>Meta Description : "'.$md.'", Meta Keyword : ';
		$i=0;
		foreach($mk_arr as $key=>$value)
		{
			echo '"'.$value.'"';
			if($i>0)
			{
				echo ",";
			}
			$i++;
		}
		echo '</div>';
	}
}
function drlam_slug_contain_keyword($id,$keyword,$slug)
{
	global $wpdb;
	global $wpdb;
	if($id<>null)
	{
		$data = $wpdb->get_results( "SELECT * FROM wp_posts where id = '".$id."'" );
		$slug=str_replace("-"," ", strtolower($data[0]->post_name));
	}
//	echo print_r($data);
	$stat=false;
	$data = $wpdb->get_results( "SELECT * FROM wp_postmeta where post_id = '".$id."' and meta_key='_yoast_wpseo_metakeywords'" );
	if($keyword!="")
		$mk=$keyword;
	else
		$mk=strtolower($data[0]->meta_value);
	$mk_arr=explode(",", $mk);
	foreach($mk_arr as $key=>$value)
	{
		$each_mk=strtolower($value);
		$pos = strpos($slug, $each_mk);
		if($pos!==false)
		{
			$stat = true;
			$found = $each_mk;
		}
	}
	if($stat==false)
	{
		echo '<div class="alert alert-danger">Slug/URL does not contain meta keyword! Slug : "'.$slug.'",Meta Keyword : ';
		$i=0;
		foreach($mk_arr as $key=>$value)
		{
			echo '"'.$value.'"';
			if($i>0)
			{
				echo ",";
			}
			$i++;
		}
		echo '</div>';	
	}
	else
	{
		echo '<div class="alert alert-success">Slug/URL contains meta keyword <br/>Slug : "'.$slug.'", Meta Keyword : ';
		$i=0;
		foreach($mk_arr as $key=>$value)
		{
			echo '"'.$value.'"';
			if($i>0)
			{
				echo ",";
			}
			$i++;
		}
		echo '</div>';	
	}

}
function drlam_slug_no_space($id,$slug)
{
	global $wpdb;
	if($id<>null)
	{
		$data = $wpdb->get_results( "SELECT * FROM wp_posts where id = '".$id."'" );
		$slug=strtolower($data[0]->post_name);
	}
	$stat=false;
	$pos = preg_split('/\s+/', $slug);
///	$pos = strpos($slug, " ");
	if(count($pos)>1)
	{
		$stat = true;
	}
	if($stat==true)
	{
		echo '<div class="alert alert-danger">Slug/URL contain space! <br/> Slug : "'.$slug.'"</div>';
	}
	else
	{
		echo '<div class="alert alert-success">Slug/URL does not contain space <br/> Slug : "'.$slug.'"</div>';
	}

}
function drlam_h1_contain_keyword($id,$title,$keyword)
{
	global $wpdb;
	$title=strtolower($title);
	$stat=false;
	$data = $wpdb->get_results( "SELECT * FROM wp_postmeta where post_id = '".$id."' and meta_key='_yoast_wpseo_metakeywords'" );
//	echo print_r($data);
	if($keyword!="")
		$mk=$keyword;
	else
		$mk=strtolower($data[0]->meta_value);
//	echo $mk;
	$mk_arr=explode(",", $mk);
//	echo print_r($mk_arr);
	foreach($mk_arr as $key=>$value)
	{
		$each_mk=strtolower($value);
//		echo $each_mk.$title;
		$pos = strpos($title, $each_mk);
		if($pos!==false)
		{
			$stat = true;
		}
	}
	if($stat==false)
	{
		echo '<div class="alert alert-danger">Title / H1 does not contain meta keyword! <br/> Title/H1 : '.$title.', Keyword :';
		$i=0;
		foreach($mk_arr as $key=>$value)
		{
			echo '"'.$value.'"';
			if($i>0)
			{
				echo ",";
			}
			$i++;
		}
		echo '</div>';
	}
	else
	{
		echo '<div class="alert alert-success">Title / H1 contains meta keyword <br/> Title/H1 : '.$title.', Keyword :';
		$i=0;
		foreach($mk_arr as $key=>$value)
		{
			echo '"'.$value.'"';
			if($i>0)
			{
				echo ",";
			}
			$i++;
		}
		echo '</div>';
	}
}

function fc($node) 
{
  $child = $node->childNodes;
  foreach($child as $item) {
    if ($item->nodeType == XML_TEXT_NODE) {
      if (strlen(trim($item->nodeValue))) echo trim($item->nodeValue)."<br/>";
    }
    else if ($item->nodeType == XML_ELEMENT_NODE) fc($item);
  }
}
function drlam_paragraph_contain_keyword($id,$content,$keyword)
{
	global $wpdb;
	$first_paragraph="";
	$c_arr=explode("\n", $content);
	$data = $wpdb->get_results( "SELECT * FROM wp_postmeta where post_id = '".$id."' and meta_key='_yoast_wpseo_metakeywords'" );
	if($keyword!="")
		$mk=$keyword;
	else
		$mk=strtolower($data[0]->meta_value);
	$mk_arr=explode(",", $mk);
	$stat=false;
	$i=1;
	foreach($c_arr as $key=>$value)
	{

		if($value!="" && strpos($value, "article-img-left")!==false)
		{
			$pos = preg_split('/(<img[^>]+>)/', $value);
			if($i==1)
			{
				$first_paragraph=$pos[1];
				foreach($mk_arr as $key2=>$value2)
				{
					$each_mk=strtolower($value2);
					$pos = strpos(strtolower($value), $each_mk);
					if($pos!==false)
					{
						$stat = true;
					}
				}

			}
			$i++;
		}
	}
	if($stat==false)
	{
		echo '<div class="alert alert-danger">First Paragraph does not contain meta keyword! <br/> 1st Paragraph : "'.$first_paragraph.'"<br/> Keyword :';
		$i=0;
		foreach($mk_arr as $key=>$value)
		{
			echo '"'.$value.'"';
			if($i>0)
			{
				echo ",";
			}
			$i++;
		}
		echo '</div>';
	}
	else
	{
		echo '<div class="alert alert-success">First Paragraph contains meta keyword <br/> 1st Paragraph : "'.$first_paragraph.'"<br/> Keyword :';
		$i=0;
		foreach($mk_arr as $key=>$value)
		{
			echo '"'.$value.'"';
			if($i>0)
			{
				echo ",";
			}
			$i++;
		}
		echo '</div>';
	}
//	echo print_r($c_arr);
}
function drlam_h2_contain_keyword($id,$content,$keyword)
{
	global $wpdb;
	$data = $wpdb->get_results( "SELECT * FROM wp_postmeta where post_id = '".$id."' and meta_key='_yoast_wpseo_metakeywords'" );
	if($keyword!="")
		$mk=$keyword;
	else
		$mk=strtolower($data[0]->meta_value);
	$mk_arr=explode(",", $mk);
	$x = new DOMDocument;
	$h2_content_screen=array();
	$internalErrors = libxml_use_internal_errors(true);
	$x->loadHTML($content);
	libxml_use_internal_errors($internalErrors);
	$i=0;
    foreach($x->getElementsByTagName('h2') as $title) 
	{
		$h2_content=$title->nodeValue;
		$h2_content_screen[$i]=$title->nodeValue;
		foreach($mk_arr as $key=>$value)
		{
			$each_mk=strtolower($value);
			$pos = strpos(strtolower($h2_content), $each_mk);
			if($pos!==false)
			{
				$stat = true;
			}
		}
		$i++;

	}
	if($stat==false)
	{
		echo '<div class="alert alert-danger">Meta Keyword does not appears in H2! <br/> H2 : ';
		foreach($h2_content_screen as $key=>$value)
		{
			echo '"'.$value.'"<br/>';
		}
		echo '<br/> Keyword :';
		$i=0;
		foreach($mk_arr as $key=>$value)
		{
			echo '"'.$value.'"';
			if($i>0)
			{
				echo ",";
			}
			$i++;
		}
		echo '</div>';
	}
	else
	{
		echo '<div class="alert alert-success">Meta Keyword appears at least once in H2 <br/> H2 : ';
		foreach($h2_content_screen as $key=>$value)
		{
			echo '"'.$value.'"<br/>';
		}
		echo '<br/> Keyword :';
		$i=0;
		foreach($mk_arr as $key=>$value)
		{
			echo '"'.$value.'"';
			if($i>0)
			{
				echo ",";
			}
			$i++;
		}
		echo '</div>';
	}
//	echo print_r($c_arr);

}
function drlam_links($id,$content)
{
	global $wpdb;
	/* STATUS */
	$stat_contain_target_keyword=true;
	$stat_contain_article_keyword=true;
	$stat_contain_strong_property=true;
	$stat_3_6_words=true;
	$stat_target_keyword_empty=false;

	$stat_1st_internal_contain_target_keyword=false;
	$stat_1st_internal_contain_article_keyword=false;
	$stat_1st_internal_contain_strong_property=false;
	$stat_1st_internal_3_6_words=false;
	$stat_1st_target_keyword_empty=false;
	$stat_2nd_internal_contain_target_keyword=false;
	$stat_2nd_internal_contain_article_keyword=false;
	$stat_2nd_internal_contain_strong_property=false;
	$stat_2nd_internal_3_6_words=false;
	$stat_2nd_target_keyword_empty=false;
	$stat_3rd_internal_contain_target_keyword=false;
	$stat_3rd_internal_contain_article_keyword=false;
	$stat_3rd_internal_contain_strong_property=false;
	$stat_3rd_internal_3_6_words=false;
	$stat_3rd_target_keyword_empty=false;

	$stat_ext_contain_article_keyword=false;
	$stat_ext_3_6_words=false;
	$stat_ext_link_target=false;
	$stat_ext_nofollow=false;
	$stat_ext_2nd_half=false;

	$corelink=array("articles/adrenal_fatigue.asp"
	,"blog/75-signs-symptoms-and-alerts-of-adrenal-fatigue-syndrome-2/1970/"
	,"articles/adrenalexhaustion.asp"
	,"protocol/diet/adrenal_fatigue_diet.asp"
	,"articles/adrenalfatiguevshypothyroidism.asp"
	,"blog/adrenal-fatigue-versus-hypothyroidism-2/3643/"
	,"blog/catabolic-state-and-adrenal-fatigue-syndrome/"
	,"blog/neuroendometabolic-symptoms-of-stress/15285/"
	);

	$extlink=array("draxe.com"
	,"mercola.com"
	,"adrenalfatigue.org"
	,"adrenalfatiguesolution.com"
	,"hormone.org"
	,"womentowomen.com"
	,"webmd.com"
	,"fda.gov"
	,"naturalnews.com"
	,"elanaspantry.com"
	,"thespunkycoconut.com"
	,"marksdailyapple.com"
	,"primaltoad.com"
	,"livingthenourishedlife.com"
	,"nourishedkitchen.com"
	,"thehealthyadvocate.com"
	,"tropicaltraditions.com"
	,"www.ncbi.nlm.nih.gov"
	);
	$mk="";
	if($id<>null)
	{
		$data = $wpdb->get_results( "SELECT * FROM wp_postmeta where post_id = '".$id."' and meta_key='_yoast_wpseo_metakeywords'" );
	}
	if($keyword!="")
		$mk=$keyword;
	else
		$mk=strtolower($data[0]->meta_value);
	$mk_arr=explode(",", $mk);
	$x = new DOMDocument;
	$internalErrors = libxml_use_internal_errors(true);
	$x->loadHTML($content);
	libxml_use_internal_errors($internalErrors);
	$count_a = 0;
	$count_ext = 0;

	$core_link_indx=0;
	$core_link_found=array();
	$core_link_title=array();
	$core_link_anchor=array();
	$core_link_target_keyword=array();

	$internal_link_indx=0;
	$internal_link_found=array();
	$internal_link_title=array();
	$internal_link_anchor=array();
	$internal_link_target_keyword=array();

	$ext_link_indx=0;
	$ext_link_found=array();
	$ext_link_title=array();
	$ext_link_rel=array();
	$ext_link_target=array();
	$ext_link_anchor=array();

	foreach($x->getElementsByTagName('a') as $a) 
	{
		$href=$a->getAttribute("href");
		$link_title=$a->getAttribute("title");
		$link_target=$a->getAttribute("target");
		$anchor_text=$a->nodeValue;
		$rel=$a->getAttribute("rel");
		$core_loop_stat=false;
		$ext_loop_stat=false;
		
		foreach($corelink as $key=>$value)
		{
			if(strpos(strtolower($href), $value)!==false)
			{
				$core_link_found[$core_link_indx]=$href;
				$core_link_title[$core_link_indx]=$link_title;
				$core_loop_stat=true;
				/* GET STATUS ARTICLE KEYWORD */
				foreach($mk_arr as $key3=>$value3)
				{
					$each_mk=strtolower($value3);
					$pos = strpos(strtolower($link_title), $each_mk);
					if($pos!==false)
					{
					}
					else
					{
						$stat_contain_article_keyword = false;
					}
				}
				/* EOF GET STATUS ARTICLE KEYWORD */

				/* GET STATUS STRONG */
//				echo htmlentities($anchor_text);
				$z = new DOMDocument;
				$internalErrors = libxml_use_internal_errors(true);
				$z->loadHTML($a->c14n());
				libxml_use_internal_errors($internalErrors);
				foreach($z->getElementsByTagName('strong') as $strong)
				{
//					$stat_contain_strong_property=true;
					$anchor_after_strong=$strong->nodeValue;
					$core_link_anchor[$core_link_indx]=$anchor_after_strong;
//					$words=explode(" ", $anchor_after_strong);
					$words = preg_split('/\s+/', $anchor_after_strong);
					if(count($words)>=3 and count($words)<=6)
					{

					}
					else
					{
						$stat_3_6_words=false;
					}
//					echo "<br/>".$anchor_after_strong."<br/>";
				}
				/* EOF GET STATUS STRONG */
				
				$count_a++;

				/*GET STATUS TARGET KEYWORD*/
				$y = new DOMDocument;
				$internalErrors = libxml_use_internal_errors(true);
				$y->loadHTMLfile("https://www.drlam.com/".$value);
				libxml_use_internal_errors($internalErrors);
				foreach($y->getElementsByTagName('meta') as $meta)
				{
					$meta_name=$meta->getAttribute("name");
					if($meta_name=="keywords")
					{
						$target_keyword=$meta->getAttribute("content");
//						echo "<br/>".$target_keyword."<br/>";
						$tk_arr=explode(",", $target_keyword);
						foreach($tk_arr as $key2=>$value2)
						{
							$core_link_target_keyword[$core_link_indx]=$value2;
							if($value2!="")
							{
								if(strpos(strtolower($link_title), strtolower($value2))!==false)
								{
								}
								else
								{
									$stat_contain_target_keyword=false;
								}
							}
							else
							{	
								$stat_target_keyword_empty=true;

							}

						}


					}
				}
				$core_link_indx++;				
			}

		}
		if($core_loop_stat==false)
		{
				foreach($extlink as $key4=>$value4)
				{
					if(strpos(strtolower($href), strtolower($value4))!==false && $count_ext<=1)
					{
//						echo $href;
						$ext_link_found[$ext_link_indx]=$href;
						$ext_link_title[$ext_link_indx]=$link_title;
						$ext_loop_stat=true;
						$ext_link_anchor[$ext_link_indx]=$anchor_text;
						/* GET STATUS ARTICLE KEYWORD */
						foreach($mk_arr as $key5=>$value5)
						{
							$each_mk=strtolower($value5);
							$pos = strpos(strtolower($link_title), $each_mk);
							if($pos!==false)
							{
								$stat_ext_contain_article_keyword = true;
							}
						}
						/* EOF GET STATUS ARTICLE KEYWORD */

						/* GET STATUS STRONG */
		//				echo htmlentities($anchor_text);
						//$z = new DOMDocument;
					//	$internalErrors = libxml_use_internal_errors(true);
					//	$z->loadHTML($x->c14n());
					//	libxml_use_internal_errors($internalErrors);
					//	foreach($z->getElementsByTagName('strong') as $strong)
					//	{
					//		$anchor_after_strong=$strong->nodeValue;
							$words = preg_split('/\s+/', $anchor_text);
//							$words=explode(" ", $anchor_text);
							if(count($words)>=3 and count($words)<=6)
							{
								$stat_ext_3_6_words=true;
							}
		//					echo "<br/>".$anchor_after_strong."<br/>";
//						}
						/* EOF GET STATUS STRONG */
						
						$count_ext++;

						$ext_link_target[$ext_link_indx]=$link_target;
						$ext_link_rel[$ext_link_indx]=$rel;
						if($link_target<>"" || $link_target<>null)
						{
							$stat_ext_link_target=true;
						}
						if($rel=="nofollow")
						{
							$stat_ext_nofollow=true;
						}
						

					$ext_link_indx++;
					}
					$pos=strpos(strtolower($content), strtolower($value4));
					if($pos!==false)
					{
						$len = strlen($content);
//						echo $len." ".$pos."<br/>";
						if(round($len/$pos)==1)
						{
							$stat_ext_2nd_half=true;
						}
					}
				}



		}
				//echo $href;

				if($core_loop_stat==false && $ext_loop_stat==false)
				{
						$internal_link_found[$internal_link_indx]=$href;
						$internal_link_title[$internal_link_indx]=$link_title;
						$count_internal++;
						foreach($mk_arr as $key6=>$value6)
						{
							$each_mk=strtolower($value6);
							$pos = strpos(strtolower($link_title), $each_mk);
							if($pos!==false)
							{
								if($count_internal==1)
									$stat_1st_internal_contain_article_keyword = true;
								elseif($count_internal==2)
									$stat_2nd_internal_contain_article_keyword = true;
								elseif($count_internal==3)
									$stat_3rd_internal_contain_article_keyword = true;
							}
						}
						/* EOF GET STATUS ARTICLE KEYWORD */

						/* GET STATUS STRONG */
		//				echo htmlentities($anchor_text);
						$zz = new DOMDocument;
						$internalErrors = libxml_use_internal_errors(true);
						$zz->loadHTML($a->c14n());
						libxml_use_internal_errors($internalErrors);
						foreach($zz->getElementsByTagName('strong') as $strong2)
						{
							if($count_internal==1)
								$stat_1st_internal_contain_strong_property=true;
							elseif($count_internal==2)
								$stat_2nd_internal_contain_strong_property=true;
							elseif($count_internal==3)
								$stat_3rd_internal_contain_strong_property=true;
//							$stat_internal_contain_strong_property=true;
							$anchor_after_strong2=$strong2->nodeValue;
//							$words=explode(" ", $anchor_after_strong);
							$words = preg_split('/\s+/', $anchor_after_strong2);
							$internal_link_anchor[$internal_link_indx]=$anchor_after_strong2;
							if(count($words)>=3 and count($words)<=6)
							{
								//$stat_internal_3_6_words=true;
								if($count_internal==1)
									$stat_1st_internal_3_6_words=true;
								elseif($count_internal==2)
									$stat_2nd_internal_3_6_words=true;
								elseif($count_internal==3)
									$stat_3rd_internal_3_6_words=true;
							}
		//					echo "<br/>".$anchor_after_strong."<br/>";
						}
						/* EOF GET STATUS STRONG */
						

						/*GET STATUS TARGET KEYWORD*/
						$yy = new DOMDocument;
						$internalErrors = libxml_use_internal_errors(true);
						$href2=str_replace("../","",$href);
						$yy->loadHTMLfile("https://www.drlam.com/".$href2);
						libxml_use_internal_errors($internalErrors);
						foreach($yy->getElementsByTagName('meta') as $meta2)
						{
							$meta_name2=$meta2->getAttribute("name");
							if($meta_name2=="keywords")
							{
								$target_keyword2=$meta2->getAttribute("content");
		//						echo "<br/>".$target_keyword."<br/>";
								$tk_arr2=explode(",", $target_keyword2);
								foreach($tk_arr2 as $key9=>$value9)
								{
									$internal_link_target_keyword[$internal_link_indx]=$value9;
									if($value9!="")
									{
										if(strpos(strtolower($link_title), strtolower($value9))!==false)
										{
											if($count_internal==1)
												$stat_1st_internal_contain_target_keyword=true;
											elseif($count_internal==2)
												$stat_2nd_internal_contain_target_keyword=true;
											elseif($count_internal==3)
												$stat_3rd_internal_contain_target_keyword=true;
											//$stat_internal_contain_target_keyword=true;
										}
									}
									else
									{
										if($count_internal==1)
											$stat_1st_target_keyword_empty=true;
										elseif($count_internal==2)
											$stat_2nd_target_keyword_empty=true;
										elseif($count_internal==3)
											$stat_3rd_target_keyword_empty=true;
									}

								}


							}
						}
				

			$internal_link_indx++;

			}

	}
	echo "<div class='alert alert-info'>";
	echo "Core Link :<br/>";
	for($i=0;$i<$core_link_indx;$i++)
	{
		echo ($i+1).') Found : "'.$core_link_found[$i].'" , Title : "'.$core_link_title[$i].'", Anchor Text : "'.$core_link_anchor[$i].'" , Target Keyword : "'.$core_link_target_keyword[$i].'"<br/>';
	}
	echo '<br/> Keyword :';
	$i=0;
	foreach($mk_arr as $key=>$value)
	{
		echo '"'.$value.'"';
		if($i>0)
		{
			echo ",";
		}
		$i++;
	}
	if($stat_contain_target_keyword==false)
	{
		echo '<div style="color:red;">One of the Core Links found Title does not contain Target Keyword! </div>';
	}
	else
	{
		echo '<div style="color:green;">Core Links found Title contains Target Keyword </div>';
	}
	if($stat_contain_article_keyword==false)
	{
		echo '<div style="color:red;">One of the Core Links found Title does not contain Article Keyword! </div>';
	}
	else
	{
		echo '<div style="color:green;">Core Links found Title contains Article Keyword </div>';
	}
	if($stat_contain_strong_property==false)
	{
		echo '<div style="color:red;">One of the Core Links Anchor Text does not contain strong property! </div>';
	}
	else
	{
		echo '<div style="color:green;">Core Links Anchor Text contains strong property</div>';
	}
	if($stat_3_6_words==false)
	{
		echo '<div style="color:red;">One of the Core Links found Anchor Text Words count is not 3 - 6 Words! </div>';
	}
	else
	{
		echo '<div style="color:green;">Core Links found Words Anchor Text count is 3 - 6 Words</div>';
	}
	if(	$stat_target_keyword_empty==true)
	{
		echo '<div style="color:red;">Core Link has no meta keyword! </div>';
	}
	else
	{
		echo '<div style="color:green;">Core Link has meta keyword</div>';
	}
	echo '</div>';

	
	echo '<div class="alert alert-info">';
	echo "Internal Link :<br/>";
	for($i=0;$i<$internal_link_indx;$i++)
	{
		echo ($i+1).') Found : "'.$internal_link_found[$i].'" , Title : "'.$internal_link_title[$i].'", Anchor Text : "'.$internal_link_anchor[$i].'" , Target Keyword : "'.$internal_link_target_keyword[$i].'"<br/>';
	}
	echo '<br/> Keyword :';
	$i=0;
	foreach($mk_arr as $key=>$value)
	{
		echo '"'.$value.'"';
		if($i>0)
		{
			echo ",";
		}
		$i++;
	}
	if($count_internal<=0)
	{
		echo '<div style="color:red;">Content does not contain at least one Internal link! </div>';
	}
	else
	{
		echo '<div style="color:green;">Internal Link appears at least once in Content </div>';
	}
	if($stat_1st_internal_contain_target_keyword==false)
	{
		echo '<div style="color:red;">First Internal Link Title found does not contain Target Keyword! </div>';
	}
	else
	{
		echo '<div style="color:green;">First Internal Link Title found contains Target Keyword </div>';
	}
	if($stat_1st_internal_contain_article_keyword==false)
	{
		echo '<div style="color:red;">First Internal Link Title  found does not contain Article Keyword! </div>';
	}
	else
	{
		echo '<div style="color:green;">First Internal Link Title found contains Article Keyword </div>';
	}
	if($stat_1st_internal_contain_strong_property==false)
	{
		echo '<div style="color:red;">First Internal Link  Anchor Text does not contain strong property! </div>';
	}
	else
	{
		echo '<div style="color:green;">First Internal Link Anchor Text contains strong property</div>';
	}
	if($stat_1st_internal_3_6_words==false)
	{
		echo '<div style="color:red;">First Internal Link found Anchor Words count is not 3 - 6 Words! </div>';
	}
	else
	{
		echo '<div style="color:green;">First Internal Link found Anchor Words count is 3 - 6 Words</div>';
	}
	if($stat_1st_target_keyword_empty==true)
	{
		echo '<div style="color:red;">First Internal Link found does not have meta keywords! </div>';
	}
	else
	{
		echo '<div style="color:green;">First Internal Link found has meta keywords</div>';
	}
	if($stat_2nd_internal_contain_target_keyword==false)
	{
		echo '<div style="color:red;">Second Internal Link found Title does not contain Target Keyword! </div>';
	}
	else
	{
		echo '<div style="color:green;">Second Internal Link Title found contains Target Keyword </div>';
	}
	if($stat_2nd_internal_contain_article_keyword==false)
	{
		echo '<div style="color:red;">Second Internal Link Title found does not contain Article Keyword! </div>';
	}
	else
	{
		echo '<div style="color:green;">Second Internal Link Title found contains Article Keyword </div>';
	}
	if($stat_2nd_internal_contain_strong_property==false)
	{
		echo '<div style="color:red;">Second Internal Link  Anchor Text does not contain strong property! </div>';
	}
	else
	{
		echo '<div style="color:green;">Second Internal Link Anchor Text contains strong property</div>';
	}
	if($stat_2nd_internal_3_6_words==false)
	{
		echo '<div style="color:red;">Second Internal Link found Anchor text Words count is not 3 - 6 Words! </div>';
	}
	else
	{
		echo '<div style="color:green;">Second Internal Link found Anchor text Words count is 3 - 6 Words</div>';
	}
	if($stat_2nd_target_keyword_empty==true)
	{
		echo '<div style="color:red;">Second Internal Link found does not have meta keywords! </div>';
	}
	else
	{
		echo '<div style="color:green;">Second Internal Link found has meta keywords</div>';
	}
	if($stat_3rd_internal_contain_target_keyword==false)
	{
		echo '<div style="color:red;">Third Internal Link Title ound does not contain Target Keyword! </div>';
	}
	else
	{
		echo '<div style="color:green;">Third Internal Link Title ound contains Target Keyword </div>';
	}
	if($stat_3rd_internal_contain_article_keyword==false)
	{
		echo '<div style="color:red;">Third Internal Link Title  found does not contain Article Keyword! </div>';
	}
	else
	{
		echo '<div style="color:green;">Third Internal Link Title ound contains Article Keyword </div>';
	}
	if($stat_3rd_internal_contain_strong_property==false)
	{
		echo '<div style="color:red;">Third Internal Link  Anchor Text does not contain strong property! </div>';
	}
	else
	{
		echo '<div style="color:green;">Third Internal Link Anchor Text contains strong property</div>';
	}
	if($stat_3rd_internal_3_6_words==false)
	{
		echo '<div style="color:red;">Third Internal Link found Anchor Words count is not 3 - 6 Words! </div>';
	}
	else
	{
		echo '<div style="color:green;">Third Internal Link found Anchor Words count is 3 - 6 Words</div>';
	}
	if($stat_3rd_target_keyword_empty==true)
	{
		echo '<div style="color:red;">Third Internal Link found does not have meta keywords! </div>';
	}
	else
	{
		echo '<div style="color:green;">Third Internal Link found has meta keywords</div>';
	}
	echo '</div>';

	echo '<div class="alert alert-info">';
	echo "External Link :<br/>";
	for($i=0;$i<$ext_link_indx;$i++)
	{
		echo ($i+1).') Found : "'.$ext_link_found[$i].'" , Title : "'.$ext_link_title[$i].'", Target : "'.$ext_link_target[$i].'" , Rel : "'.$ext_link_rel[$i].'",  Anchor : "'.$ext_link_anchor[$i].'"<br/>';
	}
	echo '<br/> Keyword :';
	$i=0;
	foreach($mk_arr as $key=>$value)
	{
		echo '"'.$value.'"';
		if($i>0)
		{
			echo ",";
		}
		$i++;
	}
	if($stat_ext_contain_article_keyword==false)
	{
		echo '<div style="color:red;">First External Links Found Title does not contain Article Keyword! </div>';
	}
	else
	{
		echo '<div style="color:green;">First External Links found Title contain article Keyword </div>';
	}
	if($stat_ext_3_6_words==false)
	{
		echo '<div style="color:red;">First External Link found Anchor Words count is not 3 - 6 Words! </div>';
	}
	else
	{
		echo '<div style="color:green;">First External Link found Anchor Words count is 3 - 6 Words</div>';
	}
	if($stat_ext_link_target==false)
	{
		echo '<div style="color:red;">First External Link found Words does not contain target="_blank"! </div>';
	}
	else
	{
		echo '<div style="color:green;">First External Link found Words contain target="_blank"</div>';
	}
	if($stat_ext_nofollow==false)
	{
		echo '<div style="color:red;">First External Link found Words does not contain rel="nofollow"! </div>';
	}
	else
	{
		echo '<div style="color:green;">First External Link found Words contain rel="nofollow"</div>';
	}
	if($stat_ext_2nd_half==false)
	{
		echo '<div style="color:red;">First External Link found is not in 2nd Half of the content! </div>';
	}
	else
	{
		echo '<div style="color:green;">First External Link found  is in 2nd Half of the content</div>';
	}
	echo '</div>';
}
function remote_file_size($url){
# Get all header information
$data = get_headers($url, true);
# Look up validity
if (isset($data['Content-Length']))
    # Return file size
    return (int) $data['Content-Length'];
}
function drlam_images($id,$content,$keyword)
{
	global $wpdb;
	/* STATUS */
	$stat_alt_contain_article_keyword=array();
	$stat_title_contain_article_keyword=array();
	$stat_filename_contain_article_keyword=array();
	$stat_filetype_jpg=true;
	$stat_filesize=true;
	$stat_dimension=true;
	$stat_aligned=true;
	$stat_not_link=false;
	$stat_every_500_words=true;
	$stat_ss_dimension=true;

	$stat_filename=true;
	$stat_alt=true;
	$stat_title=true;
	$content2=preg_replace("/<!--(.*?)-->/is","",$content);
	//echo $content2."ii<br/>";
	$content3=strip_tags($content2,"<img>");
	//echo $content3."yy<br/>";

	$content_arr=preg_split("/<img (.*?)>/",$content3);
	//echo print_r($content_arr);
	foreach($content_arr as $key=>$value)
	{
		$words=preg_split("/[\s,]+/", $value);
//		echo count($words)."<br/>";
		if(count($words)>500)
		{
			$stat_every_500_words=false;
		}
	}
	if($id<>null)
	{
		$data = $wpdb->get_results( "SELECT * FROM wp_postmeta where post_id = '".$id."' and meta_key='_yoast_wpseo_metakeywords'" );
	}
	if($keyword!="")
		$mk=$keyword;
	else
		$mk=strtolower($data[0]->meta_value);
	$mk_arr=explode(",", $mk);
	$x = new DOMDocument;
	$internalErrors = libxml_use_internal_errors(true);
	$x->loadHTML($content2);
	libxml_use_internal_errors($internalErrors);
	$count_a = 0;
	$count_ext = 0;
	$i=0;
	$count_image = 0;
	$image_index=0;
	$image_title=array();
	$image_alt=array();
	$image_src=array();
    foreach($x->getElementsByTagName('img') as $img) 
	{
		$count_image++;
	}
    foreach($x->getElementsByTagName('img') as $img) 
	{
		$title=$img->getAttribute("title");
		$alt=$img->getAttribute("alt");
		$src=$img->getAttribute("src");

		$image_title[$image_index]=$img->getAttribute("title");
		$image_alt[$image_index]=$img->getAttribute("alt");
		$image_src[$image_index]=$img->getAttribute("src");

//		echo $title." ".$alt." ".$src." <br/> ";
		$stat_title_contain_article_keyword[$i]["status"] = false;
		$stat_alt_contain_article_keyword[$i]["status"] = false;
		$stat_filename_contain_article_keyword[$i]["status"] = false;
		$src2=str_replace("-"," ",$src);
		if($i<$count_image)
		{
			foreach($mk_arr as $key=>$value)
			{
				$each_mk=strtolower($value);
				$pos = strpos(strtolower($title), $each_mk);
				if($pos!==false)
				{
	//				echo "x";
					$stat_title_contain_article_keyword[$i]["status"] = true;
				}
			}
			foreach($mk_arr as $key=>$value)
			{
				$each_mk=strtolower($value);
				$pos = strpos(strtolower($alt), $each_mk);
				if($pos!==false)
				{
	//				echo "y";
					$stat_alt_contain_article_keyword[$i]["status"] = true;
				}
			}
			foreach($mk_arr as $key=>$value)
			{
				$each_mk=strtolower($value);
				$pos = strpos(strtolower($src2), $each_mk);
				if($pos!==false)
				{
	//				echo "z";
					$stat_filename_contain_article_keyword[$i]["status"] = true;
				}
			}
		}
		$i++;

		$src3=str_replace("../","",$src);
		$src4="https://www.drlam.com/".$src3;
//		echo $src4;
//		$finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension

//		echo finfo_file($finfo, $src4) . "\n";
		$files =getimagesize($src4); 

		 if( $files['mime']<>"image/jpeg")
			 $stat_filetype_jpg = false;

		// echo print_r(files);
//		 echo $files[0];
//		 echo $files['mime'];
		 if( $files[0]<>500 && $files[1]<>333 && $i<>($count_image))
			 $stat_dimension = false;
		 if( $files[0]<>682 && $files[1]<>376 && $i==($count_image))
			 $stat_ss_dimension = false;

//		echo remote_file_size($src4)."<br/>";
		if(remote_file_size($src4)>102400)
			$stat_filesize=false;

//		echo mime_content_type($src4);
		$image_index++;
	}
//	echo print_r($stat_filename_contain_article_keyword);
//	echo print_r($stat_alt_contain_article_keyword);
//	echo print_r($stat_title_contain_article_keyword);
	foreach($stat_filename_contain_article_keyword as $key=>$value)
	{
		if($value['status']==false)
		{
			$stat_filename=false;
		}
	}
	foreach($stat_title_contain_article_keyword as $key=>$value)
	{
//		echo $value['status'];
		if($value['status']==false)
		{
			$stat_title=false;
		}
	}
	foreach($stat_alt_contain_article_keyword as $key=>$value)
	{
		if($value['status']==false)
		{
			$stat_alt=false;
		}
	}

	echo '<div class="alert alert-info">';
	echo "Image Found :<br/>";
	for($i=0;$i<$image_index;$i++)
	{
		echo ($i+1).') Found : "'.$image_src[$i].'" , Title : "'.$image_title[$i].'", Alt : "'.$image_alt[$i].'"<br/>';
	}
	echo '<br/> Keyword :';
	$i=0;
	foreach($mk_arr as $key=>$value)
	{
		echo '"'.$value.'"';
		if($i>0)
		{
			echo ",";
		}
		$i++;
	}
	if($stat_every_500_words==false)
	{
		echo '<div style="color:red;">Each Image is not in every not more than 500 words! </div>';
	}
	else
	{
		echo '<div  style="color:green;">Each Image is in every not more than 500 words</div>';
	}
	if($stat_title==false)
	{
		echo '<div  style="color:red;">Each Image Title does not contain Meta Keyword! </div>';
	}
	else
	{
		echo '<div style="color:green;">Each Image Title contain Meta Keyword</div>';
	}
	if($stat_alt==false)
	{
		echo '<div  style="color:red;">Each Image Alt does not contain Meta Keyword! </div>';
	}
	else
	{
		echo '<div style="color:green;">Each Image Alt contain Meta Keyword</div>';
	}
	if($stat_filename==false)
	{
		echo '<div  style="color:red;">Each Image Filename does not contain Meta Keyword! </div>';
	}
	else
	{
		echo '<div  style="color:green;">Each Image Filename contain Meta Keyword</div>';
	}
	if($stat_filetype_jpg==false)
	{
		echo '<div style="color:red;">One of the image file type is not JPG! </div>';
	}
	else
	{
		echo '<div  style="color:green;">Each Image file type is JPG</div>';
	}
	if($stat_dimension==false)
	{
		echo '<div style="color:red;">One of the image file dimension is not 500 x 333! </div>';
	}
	else
	{
		echo '<div  style="color:green;">Each Image file dimension is 500 x 333</div>';
	}
	if($stat_filesize==false)
	{
		echo '<div style="color:red;">One of the image file size is more than 100KB! </div>';
	}
	else
	{
		echo '<div  style="color:green;">Each Image file size is less or equal to 100 KB</div>';
	}
	if($stat_ss_dimension==false)
	{
		echo '<div style="color:red;">Slide Show image file is not tagged at the bottom of the article.<br/>Slide Show image file dimension is not 628 x 376! </div>';
	}
	else
	{
		echo '<div style="color:green;">Slide Show image file tagged at the bottom of the article.<br/>Slide Show Image file dimension is 628 x 376</div>';
	}
	echo '</div>';

}
function drlam_ss_images($id,$content,$keyword)
{
	global $wpdb;
	/* STATUS */
	$stat_alt_contain_article_keyword=array();
	$stat_title_contain_article_keyword=array();
	$stat_filename_contain_article_keyword=array();
	$stat_filetype_jpg=true;
	$stat_filesize=true;
	$stat_dimension=true;
	$stat_aligned=true;
	$stat_not_link=false;
	$stat_every_500_words=true;
	$stat_ss_dimension=true;

	$stat_filename=true;
	$stat_alt=true;
	$stat_title=true;
	$content2=preg_replace("/<!--(.*?)-->/is","",$content);
	//echo $content2."ii<br/>";
	$content3=strip_tags($content2,"<img>");
	//echo $content3."yy<br/>";

	$content_arr=preg_split("/<img (.*?)>/",$content3);
	//echo print_r($content_arr);
	foreach($content_arr as $key=>$value)
	{
		$words=preg_split("/[\s,]+/", $value);
//		echo count($words)."<br/>";
		if(count($words)>500)
		{
			$stat_every_500_words=false;
		}
	}
	if($id<>null)
	{
		$data = $wpdb->get_results( "SELECT * FROM wp_postmeta where post_id = '".$id."' and meta_key='_yoast_wpseo_metakeywords'" );
	}
	if($keyword!="")
		$mk=$keyword;
	else
		$mk=strtolower($data[0]->meta_value);
	$mk_arr=explode(",", $mk);
	$x = new DOMDocument;
	$internalErrors = libxml_use_internal_errors(true);
	$x->loadHTML($content2);
	libxml_use_internal_errors($internalErrors);
	$count_a = 0;
	$count_ext = 0;
	$i=0;
	$count_image = 0;
    foreach($x->getElementsByTagName('img') as $img) 
	{
		$count_image++;
	}
    foreach($x->getElementsByTagName('img') as $img) 
	{
		$title=$img->getAttribute("title");
		$alt=$img->getAttribute("alt");
		$src=$img->getAttribute("src");

		$stat_title_contain_article_keyword[0]["status"] = false;
		$stat_alt_contain_article_keyword[0]["status"] = false;
		$stat_filename_contain_article_keyword[0]["status"] = false;
		$src2=str_replace("-"," ",$src);
		if($i==($count_image-1))
		{
//			echo $title." ".$alt." ".$src." <br/> ";
			foreach($mk_arr as $key=>$value)
			{
				$each_mk=strtolower($value);
				$pos = strpos(strtolower($title), $each_mk);
				if($pos!==false)
				{
//					echo "x";
					$stat_title_contain_article_keyword[0]["status"] = true;
				}
			}
			foreach($mk_arr as $key=>$value)
			{
				$each_mk=strtolower($value);
				$pos = strpos(strtolower($alt), $each_mk);
				if($pos!==false)
				{
//					echo "y";
					$stat_alt_contain_article_keyword[0]["status"] = true;
				}
			}
			foreach($mk_arr as $key=>$value)
			{
				$each_mk=strtolower($value);
				$pos = strpos(strtolower($src2), $each_mk);
				if($pos!==false)
				{
//					echo "z";
					$stat_filename_contain_article_keyword[0]["status"] = true;
				}
			}
		}
		$i++;

	}

	foreach($stat_filename_contain_article_keyword as $key=>$value)
	{
		if($value['status']==false)
		{
			$stat_filename=false;
		}
	}
	foreach($stat_title_contain_article_keyword as $key=>$value)
	{
//		echo $value['status']."nnn";
		if($value['status']==false)
		{
			$stat_title=false;
		}
	}
	foreach($stat_alt_contain_article_keyword as $key=>$value)
	{
		if($value['status']==false)
		{
			$stat_alt=false;
		}
	}
	if($stat_title==false)
	{
		echo '<div class="alert alert-danger">Slide Show Image Title does not contain Meta Keyword! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Slide Show Image Title contain Meta Keyword</div>';
	}
	if($stat_alt==false)
	{
		echo '<div class="alert alert-danger">Slide Show Image Alt does not contain Meta Keyword! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Slide Show Image Alt contain Meta Keyword</div>';
	}

}
function drlam_sm_images($id,$content)
{
	global $wpdb;

	$stat_top=false;
	$stat_pin_dimension=true;
	$stat_fb_dimension=true;
	$content2=preg_replace('/<!-- socmed(.*?)-->/is','$1',$content);
	$content2_arr=preg_split('/<!-- socmed(.*?)-->/is',$content);
//	$content_html=str_replace('<!-- socmed',"",$content2_arr[0]);
//	$content_html=str_replace('-->',"",$content2_arr[0]);

//	echo count($content2_arr);
	if(count($content2_arr)==2)
		$stat_top=true;
	$x = new DOMDocument;
	$internalErrors = libxml_use_internal_errors(true);
	$x->loadHTML($content2);
	libxml_use_internal_errors($internalErrors);
	$count_a = 0;
	$count_ext = 0;
	$i=0;
	$count_image = 0;
    foreach($x->getElementsByTagName('img') as $img) 
	{
		if($i<2)
		{
			$src=$img->getAttribute("src");
			$src2=str_replace("../","",$src);
			$src3="https://www.drlam.com/".$src2;
			if(strpos(strtolower($src), "pin-")!==false)
			{
				$files =getimagesize($src3); 


				 if( $files[0]<>700 && $files[1]<>1050)
					 $stat_pin_dimension = false;
			}
			if(strpos(strtolower($src), "fb-")!==false)
			{
				$files =getimagesize($src3); 


				 if( $files[0]<>1200 && $files[1]<>628)
					 $stat_fb_dimension = false;
			}
		}
		$i++;
	}
	if($stat_top==false)
	{
		echo '<div class="alert alert-danger">Social Media Image is not in the top of content! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Social Media Image is in the top of content</div>';
	}
	if($stat_pin_dimension==false)
	{
		echo '<div class="alert alert-danger">Pinterest Image dimension is not 700 x 1050! </div>';
	}
	else
	{
		echo '<div class="alert alert-success">Pinterest Image dimension is 700 x 1050</div>';
	}
	if($stat_top==false)
	{
		echo '<div class="alert alert-danger">Facebook Image dimension is not 1200 x 628!</div>';
	}
	else
	{
		echo '<div class="alert alert-success">Facebook Image dimension is 1200 x 628</div>';
	}
}
function drlam_has_categories($id)
{
	global $wpdb;
	$data = $wpdb->get_results( "SELECT p.ID, t.term_id FROM wp_posts p INNER JOIN wp_term_relationships rel ON rel.object_id = p.ID LEFT JOIN wp_term_taxonomy tax ON tax.term_taxonomy_id = rel.term_taxonomy_id LEFT JOIN wp_terms t ON t.term_id = tax.term_id where p.ID = '".$id."'" );
	if(count($data)<=0)
	{
		echo '<div class="alert alert-danger">Post does not have categories yet!</div>';
	}
	else
	{
		echo '<div class="alert alert-success">Post has categories</div>';
	}
}
?>