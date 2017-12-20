<hr>
<div class="container">
    <div class="row">
       <!--  <div class="col-sm-10"><h1>Aegor Targaryen</h1></div> -->
<br>
<br>
<br>
    </div>
    <div class="row">
        <div class="col-sm-3"><!--left col-->
              
           <?php echo profile();?>
               
          <!-- <div class="panel panel-default">
            <div class="panel-heading">Website <i class="fa fa-link fa-1x"></i></div>
            <div class="panel-body"><a href="http://bootply.com">bootply.com</a></div>
          </div> -->
          
          
          <!-- <ul class="list-group">
            <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Properties Posted</strong></span> 3</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Properties Sold</strong></span> 13</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Connections</strong></span> 37</li>
          
          </ul>  -->
               
          <!-- <div class="panel panel-default">
            <div class="panel-heading">Social Media</div>
            <div class="panel-body">
                <i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>
            </div>
          </div> -->
       <button type="button" class="btn btn-info btn-lg" data-toggle="modal" <?php $i="'"; if(!isset($_SESSION['ID'])){echo 'onclick="window.location.href='.$i.'index.php?source=loginandregister'.$i.'"';}?> data-target="#myModal">Send A Message</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button"  class="close" data-dismiss="modal">&times;</button>
        <h4  class="modal-title">Send a Message</h4>
      </div>
      <div class="modal-body">
<!-- -->
<form action="" method="post">
		<?php echo send_new_message(); ?>
        <div class="input-group"> 
  <span class="input-group-addon" id="basic-addon1">Subject</span>
  <input type="text" name="subject" class="form-control" placeholder="Subject" aria-label="" aria-describedby="basic-addon1">
</div>
<br>
<div class="input-group">
  <textarea class="form-control" name="message" rows="9" id="comment"></textarea>
  <span class="input-group-addon" id="basic-addon2"></span>
</div>
<br>
<div class="input-group">
  <button type="submit" name="new_message" class="btn btn-default">Send Message</button>
</div>
<br>

<br>
</form>
      </div>
      
    </div>

  </div>
</div>


        </div><!--/col-3-->
        <div class="col-sm-9">
          
          <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#home" data-toggle="tab">List of Properties</a></li>
            
            
          </ul>
              
          <div class="tab-content">
            <div class="tab-pane active" id="home">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Price</th>
                      <th>Status</th>
                      <th>Location</th>
                      
                    </tr>
                  </thead>
                  <tbody id="items">
                   
                 <?php echo propertylistview();?>

                  </tbody>
                </table>
                <hr>
                <div class="row">
                  <div class="col-md-4 col-md-offset-4 text-center">
                    <ul class="pagination" id="myPager"></ul>
                  </div>
                </div>
              </div><!--/table-resp-->
              
              <hr>
              
<!--               <h4>Recent Activity</h4>
              
              <div class="table-responsive">
                <table class="table table-hover">
                  
                  <tbody>
                    <tr>
                      <td><i class="pull-right fa fa-edit"></i> Today, 1:00 - This guy posted a new property</td>
                    </tr>
                    <tr>
                      <td><i class="pull-right fa fa-edit"></i> Today, 12:23 - That guy has a new connection</td>
                    </tr>
                    <tr>
                      <td><i class="pull-right fa fa-edit"></i> Today, 12:20 - You have a new connection.</td>
                    </tr>
                    <tr>
                      <td><i class="pull-right fa fa-edit"></i> 2 Days Ago - You got a new message from this guy.</td>
                    </tr>
                  </tbody>
                </table>
              </div> -->
              
             </div><!--/tab-pane-->
            
             
               
              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
