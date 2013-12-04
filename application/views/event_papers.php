	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Papers Submitted to Event: <?= $event->eventName ?></h4>
				</div>
				<div class="panel-body">
					<table border="1" class = "table">
      					<tr>
      						 <td><h4 class="panel-title"><b>Paper Title</b> </h4></td> 
      						 <td><h4 class="panel-title"><b>Abstract </b></h4></td>
      						 <td><h4 class="panel-title"><b>Submitted By </b></h4></td>
      					</tr>
						<?php foreach($papers as $row):?>
							<tr>
								<td><?= $row->title ?></td>
								<td><?= $row->abstract ?></td>
								<td><?= $row->submittedBy ?></td>
							</tr>
						<?php endforeach; ?>
					</table>
				</div>
			</div>
		</div>
	</div>

    <div class="container">
      <!-- Example row of columns -->

         <footer>
        <p>&copy; Best Concordia Team</p>
      </footer>
    </div> <!-- /container -->
	
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
		<script src="<?php echo base_url();?>/assets/js/vendor/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>/assets/js/plugins.js"></script>
		<script src="<?php echo base_url();?>/assets/js/main.js"></script>
    </body>
</html>