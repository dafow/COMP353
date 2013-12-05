    <script language="JavaScript" src="../assets/js/ts_picker.js">
    //Script by Denis Gritcyuk: tspicker@yahoo.com
    //Submitted to JavaScript Kit (http://javascriptkit.com)
    //Visit http://javascriptkit.com for this script
    </script>    
     <div class="container">
          <h3>Edit a News Message:</h3>  
      <div class="panel-body">
        
        
    <form name="newsForm" action="<?php echo site_url('News/updateNews');?>" method="post">
        <?php foreach ($news as $article) { ?>
            <input type="hidden" name="id" value="<?php echo $article->idNews; ?>"/>
             <div class="form-group">
                <label class="col-lg-3 control-label" for="date">Date: </label>
                <input class="col-lg-8" type="Text" name="date" data-validate="required" value="<?php echo  date( "Y-m-d H:i:s", strtotime($article->newsDate)); ?>">
                <a href="javascript:show_calendar('document.newsForm.date', document.newsForm.date.value);"><img src="../assets/img/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the start Time"></a>
            </div>
            <br/>
            <div class="form-group">
                <label class="col-lg-3 control-label" for="title">Title (limit 100 characters): </label>
                <input class="col-lg-9" type="Text" name="title" size="100" data-validate="required,max(100)" value="<?php echo $article->newsTitle; ?>">
            </div>
            <br/>
            <div class="form-group">
                <label class="col-lg-3 control-label" for="idEvent" >Event:</label>
                    <select class="col-lg-9" name="idEvent" data-validate="required">
                        <?php foreach($events as $event): ?>
                           <option value="<?=$event->idEvent;?>" <?php echo ($event->idEvent == $article->idEvent) ? "selected" : ""; ?>> <?= $event->eventName ?> </option>
                        <?php endforeach; ?>
                    </select>
            </div>
            <br/>
            <div class="form-group">
                <label class="col-lg-3 control-label" for="description">News Description (limit 2000 characters): </label>
                <textarea class="col-lg-9" name="description" rows="10" cols="150" data-validate="required,max(2000)"><?php echo $article->newsDescription; ?></textarea>
            </div>
            <br/>
        <?php } ?>
        <div class="form-group">
                <label class="col-lg-10 control-label"></label>
                <div class="col-lg-2">
                    <button type="submit" class="btn btn-success">Save News Message</button>
                </div>
        </div>
    </form>  
       
    </div>
    <!-- Example row of columns -->

    <footer>
        <p>&copy; Best Concordia Team</p>
    </footer>
    </div> <!-- /container -->
		<script src="../assets/js/vendor/jquery-1.10.1.min.js"></script>
		<script src="../assets/js/vendor/bootstrap.min.js"></script>
		<script src="../assets/js/plugins.js"></script>
		<script src="../assets/js/main.js"></script>
    </body>
</html>
