<hr>
<script>

	function deleteMessage() {
		if(!confirm('Do you want to delete this message?')){
			event.preventDefault();
		}
	}

</script>
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
          
        </div><!--/col-3-->
        <div class="col-sm-9">
          
          <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#home" data-toggle="tab">List of Properties</a></li>
            <li><a href="#messages" data-toggle="tab">Inbox</a></li>
            <li><a href="#smessages" data-toggle="tab">Sent Messages</a></li>
            <li><a href="#settings" data-toggle="tab">Settings</a></li>
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
                   
                 <?php echo propertylist();?>
                  
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
            
<div class="tab-pane" id="messages">      
    <h2><?php echo reply_message(); ?></h2>       
        <ul class="list-group">
			<?php echo inbox_list(); ?>
			<?php echo delete_message(); ?>
			
            <!--<div class="blogBox moreBox" style="display: none;">
                <li class="list-group-item-mes text-right"><a style="color:black" href="#" class="pull-left">Here is your a link to the latest summary report from the..</a> 2.13.2014 <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">view</button></li>
				<!-- Modal -->
				<!--<div id="myModal" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<!--<div class="modal-content">
							<div class="modal-header">
								<button type="button"  class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
							<!-- -->
								<!--<div class="input-group"> 
									<h3>Subject example</h3>
									<h4>email: email@gmail.com</h4>
									<h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque viverra vulputate posuere. Nulla at venenatis leo. Quisque tempor leo vel mattis malesuada. Vestibulum venenatis rhoncus nibh ac bibendum. Fusce scelerisque dolor a est dapibus, eget semper nunc congue. Praesent a molestie eros. Proin quis magna iaculis, dapibus nulla eget, cursus orci. In tincidunt dignissim est.</h5>
									<h6>13/12/2017 3:18am</h6>
								</div>
								<br>
								<form action="" method="post">
									<div class="input-group">
										<textarea class="form-control" rows="9" id="comment" placeholder="Reply a message..."></textarea>
										<span class="input-group-addon" id="basic-addon2"></span>
									</div>
									<br>
									<div class="input-group">
										<button type="submit" name="reply_message" class="btn btn-default">Reply</button>
									</div>
								</form>
								<br>
								<br>
							</div>
						</div>
					</div>
				</div>
                <h6></h6>
            </div>-->
            <div id="loadMore" style="">
				<a href="#">Load More</a>
			</div>     
        </ul> 
               
             </div>





<div class="tab-pane" id="smessages">
	<h2></h2>               
	<ul class="list-group">
	<?php echo sent_list();?>
	<?php echo delete_sent();?>
    <!--<div class="sblogBox smoreBox">
        <li class="list-group-item-mes text-right"><a style="color:black" href="#" class="pull-left">Here is your a link to the latest summary report from the..</a> 2.13.2014
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#1myModal">view</button>
		</li>
		<!-- Modal -->
		<!--<div id="1myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
			<!-- Modal content-->
				<!--<div class="modal-content">
					<div class="modal-header">
						<button type="button"  class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<!-- -->
						<!--<div class="input-group"> 
							<h3>Subject example</h3>
							<h4>Recipient: email@gmail.com</h4>
							<h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque viverra vulputate posuere. Nulla at venenatis leo. Quisque tempor leo vel mattis malesuada. Vestibulum venenatis rhoncus nibh ac bibendum. Fusce scelerisque dolor a est dapibus, eget semper nunc congue. Praesent a molestie eros. Proin quis magna iaculis, dapibus nulla eget, cursus orci. In tincidunt dignissim est.</h5>
							<h6>13/12/2017 3:18am</h6>
						</div>
						<br>
						<br>
						<form action="" method="post">
						<input type="hidden" name="pmid">
						<div class="input-group">
							<button type="submit" name="sent_delete" class="btn btn-default">Delete</button>
						</div>
						</form>
						<br>
						<br>
					</div>      
				</div>
			</div>
		</div>
        <h6></h6>   
    </div>-->
    <div id="sloadMore" style="">
        <a href="#">Load More</a>
    </div>
    </ul>
</div>





             <div class="tab-pane" id="settings">
                <div id="form0" class="container">
					<form class="form-horizontal" action="includes/upload-profile-pic.php" method="post" id="registrationForm" enctype="multipart/form-data">

						<h3> Change Profile Picture</h3>
						<div class="form-group">
								Select image to upload:
								<input type="file" name="fileToUpload" id="fileToUpload">
								<img src="" alt="" class="preview">
								<img src="" alt="" class="preview preview--rounded">
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12">
                                <br>
                                <button class="btn btn-md btn-success" name="save_prof_pic" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save Profile Picture</button>   
                            </div>
						</div>
					</form>
					<hr>
					<div id="form1" class="container">
						<form class="form-horizontal" action="##" method="post" id="registrationForm">
						<?php save_info(); ?>
						<script>
							document.getElementById("first_name").value = "<?php echo $prof_fname;?>";
						</script>
                    <h3> Change Info</h3>

                      <div class="form-group">
                          
                          <div class="col-xs-4">
                              <label for="first_name"><h4>First name</h4></label>
                              <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first name" value="<?php profile_settings("fname");?>" title="enter your first name if any.">
                          </div>
                      </div>
                      <div class="form-group">
							<div class="col-xs-4">
								<label for="last_name"><h4>Last name</h4></label>
								<input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" value="<?php profile_settings("lname");?>" title="enter your last name if any.">
							</div>
                      </div>
          
                      <div class="form-group">
                          
                          <div class="col-xs-4">
                              <label for="email"><h4>Email</h4></label>
                              <input type="text" class="form-control" name="email" id="email" placeholder="enter phone" value="<?php profile_settings("email");?>" title="enter your phone number if any.">
                          </div>
                      </div>
          
                      <div class="form-group">
                          <div class="col-xs-4">
                             <label for="Mobile"><h4>Mobile</h4></label>
                              <input type="text" class="form-control" name="mobile" id="mobile" placeholder="enter mobile number" value="<?php profile_settings("mobile");?>" title="enter your mobile number if any.">

                              </br>
                                  <p style="font-style: 10px" class="custom-control custom-radio">
  <input id="radio1" name="hide" type="radio" class="custom-control-input" value="0">
  <span class="custom-control-indicator"></span>
  <span class="custom-control-description">Show Mobile Number</span>
</p>
    <p style="font-style: 10px" class="custom-control custom-radio">
      <input id="radio2" name="hide" type="radio" class="custom-control-input" value="1">
      <span class="custom-control-indicator"></span>
      <span class="custom-control-description">Don't Show Mobile Number</span>
    </p>
                              

                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-4">
                              <label for="Bio"><h4>Bio</h4></label>
                            </br>
                              <textarea rows="4" name="bio" cols="50"><?php profile_settings("bio");?></textarea>
                          </div>
                      </div>
                      
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                                <button class="btn btn-md btn-success" name="save_info" type="submit"><i class="glyphicon glyphicon-ok-sign"></i>Save Info</button>
								<button class="btn btn-md btn-success" type="reset"><i class="glyphicon glyphicon-repeat"></i>Reset Password</button>
                            </div>
                      </div>
                </form>
                </div>

                <div id="form2" class="container">
                  <form class="form-horizontal" action="##" method="post" id="registrationForm">
				  
                      <div class="form-group">
                          <h3> Change Password</h3>
						  <?php change_pass();?>
                          <div class="col-xs-4">
                              <label for="first_name"><h4>Current Password</h4></label>
                              <input type="password" class="form-control" name="old_pass" id="first_name" placeholder="" title="enter your first name if any.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-4">
                            <label for="last_name"><h4>New Password</h4></label>
                              <input type="password" class="form-control" name="new_pass" id="last_name" placeholder="" title="enter your last name if any.">
                          </div>
                      </div>

                      <div class="form-group">
                          
                          <div class="col-xs-4">
                            <label for="last_name"><h4>Confirm Password</h4></label>
                              <input type="password" class="form-control" name="ver_pass" id="last_name" placeholder="" title="enter your last name if any.">
                          </div>
                      </div>
          
                      
                      
                       <div class="form-group">
                           <div class="col-xs-12">
                                <br>
								<button class="btn btn-md btn-success" name="change_pass" type="submit"><i class="glyphicon glyphicon-ok-sign"></i>Change Password</button>
                                <button class="btn btn-md btn-success" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset Password</button>
                            </div>
                      </div>
                </form>
                </div>
                    </div>
               
              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->

</div>
<script type="text/javascript">
  
$( document ).ready(function () {
  $(".moreBox").slice(0, 4).show();
    if ($(".blogBox:hidden").length != 0) {
      $("#loadMore").show();
    }   
    $("#loadMore").on('click', function (e) {
      e.preventDefault();
      $(".moreBox:hidden").slice(0, 8).slideDown();
      if ($(".moreBox:hidden").length == 0) {
        $("#loadMore").fadeOut('slow');
      }
    });
  });


</script>


<script type="text/javascript">
  
$( document ).ready(function () {
  $(".smoreBox").slice(0, 4).show();
    if ($(".sblogBox:hidden").length != 0) {
      $("#sloadMore").show();
    }   
    $("#sloadMore").on('click', function (e) {
      e.preventDefault();
      $(".smoreBox:hidden").slice(0, 8).slideDown();
      if ($(".smoreBox:hidden").length == 0) {
        $("#sloadMore").fadeOut('slow');
      }
    });
  });


</script>