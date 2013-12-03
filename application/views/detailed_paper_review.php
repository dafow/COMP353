	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-body">
    
	      			<h3 class="panel-title"><b>Paper Review</b></h3>  
	      			<br />
	      			
	      			<?php foreach($paper as $row):?>
	      			
		      			<label for="title" class="col-lg-2 control-label">Paper Title:</label>
		      			<p><a href="<?= site_url('Paper/viewPaper') . '?idPaper=' . $row->idPaper ?>"><?= $row->title ?></a></p>
		            	
		            	<label for="abstract" class="col-lg-2 control-label">Paper Abstract:</label>  
		            	<p><?= $row->abstract ?></p> 
		            	
		            	<label for="subject" class="col-lg-2 control-label">Paper Topics:</label>
		            	
		            	<?php foreach($topics as $topic):?>
		            		<p><?= $topic->topicName ?></p> 
		            	<?php endforeach; ?>
	            	
			            <br />
		            	<h3 class="panel-title"><b>My Review</b></h3>
		            	<br />
		            	
		            	<form role="form" class="form-horizontal" action="<?php echo site_url('Paper/submitReview/') . '?idPaper=' . $row->idPaper ?>" 
		            		method="POST" enctype="multipart/form-data">
		            		<div class="form-group">
					            <label for="score" class="col-lg-2 control-label">Paper Score:</label>               
					            <select name="score" data-validate="required">
						            <option value="1">1.0</option>
						            <option value="2">2.0</option>
						            <option value="3">3.0</option>
						            <option value="4">4.0</option>
						            <option value="5">5.0</option>
						            <option value="6">6.0</option>
						            <option value="7">7.0</option>
						            <option value="8">8.0</option>
						            <option value="9">9.0</option>
						            <option value="10">10.0</option>         
					            </select>
					        </div>
					        
					        <div class="form-group">
					            <label for="Comment" class="col-lg-2 control-label">Comments:</label>
					            <input type="text" name="comment" class="form-control" style="height:100px; width:600px" id="comment" data-validate="required">
					        </div>
					        
					        <button style="float:right;" class="btn btn-primary">Submit</button>
		            	</form>
	            	<?php endforeach; ?>
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
		<script src="<?php echo base_url();?>/assets/js/vendor/verify.notify.min.js"></script>
		<script src="<?php echo base_url();?>/assets/js/main.js"></script>
    </body>
</html>
