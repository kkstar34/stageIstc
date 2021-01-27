<!doctype html>
<html lang="en">
	<?php include('functions.php');

		if (!isAdmin()) {
	    $_SESSION['erreur'] = "vous devriez etre connecté et admin";
	    header('location: ../index.php');
		}
	?>
  <?php require("../header/header.php"); ?>

<body>
  	<?php require("../nav/nav_Bureau.php"); ?>

  	<div class="container px-lg-5 mt-5">
  		<div class="card-header">
	  		<form method="post" action="">
	  			<h2 align="center">Ajout de bureau et service : </h2>
				<?php echo display_error(); ?>
				<div class="content">
					<!-- notification message -->
					<?php if (isset($_SESSION['success'])) : ?>
						<div class="error success" >
							<h3>
								<?php
									echo $_SESSION['success'];
									session_unset($_SESSION['success']);
								?>
							</h3>
						</div>
					<?php endif ?>

	  				<?php echo display_error(); ?>

		  			<div class="form-group row">
						<label for="nom" class="col-sm-2 col-form-label">Nom du bureau</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="bureau" placeholder="bureau" name="bureau"  value="<?php echo "";?>">
						</div>
					</div>

					<div class="form-group row">
						<label for="service" class="col-sm-2 col-form-label">Nom service</label>
						<div class="col-sm-10">
							<table class="table table-bordered" id="dynamic_field">
	                            <tr>
	                                <td><input type="text" name="name[]" placeholder="service" class="form-control name_list" /></td>
	                                <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fas fa-plus-circle"></i></button></td>
	                            </tr>
	                        </table>
						</div>
					</div>

					<div class="form-group row">
						<label for="localisation" class="col-sm-2 col-form-label">Localisation</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="localisation" placeholder="localisation" name="localisation" value="">
						</div>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="send1">Envoyez</button>
						<button type="reset" class="btn btn-danger">Effacer</button>
					</div>
				</div>
			</form>
		</div>
    </div>

    <?php require("../footer/footer.php"); ?>

    <script>
	    $(document).ready(function(){
	      	var i=1;
	      	$('#add').click(function(){
	           i++;
	           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="service" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
	      	});

	      	$(document).on('click', '.btn_remove', function(){
	           var button_id = $(this).attr("id");
	           $('#row'+button_id+'').remove();
	      	});

	      	$('#submit').click(function(){
	           $.ajax({
	                url:"name.php",
	                method:"POST",
	                data:$('#add_name').serialize(),
	                success:function(data)
	                {
	                     alert(data);
	                     $('#add_name')[0].reset();
	                }
	           });
	      	});
	 	});
 	</script>

</body>
</html>
