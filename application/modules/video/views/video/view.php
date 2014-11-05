<?php if (is_array($data) && count($data) > 0): ?>
<div class="row blog-page">    
            <!-- Left Sidebar -->
        	<div class="col-md-8">
                <!-- Bordered Funny Boxes -->
                <div class="funny-boxes-top-sea">
                    <div class="row">

					<div class="col-md-12">
                        <div class="thumbnail">
                            <a class="linkPlayer zoomer fancybox-button" dataYoutubeId='<?php echo $data['id_youtube'] ?>' data-rel="fancybox-button" title="Project #1" href="#">
                                <span class="overlay-zoom">
                                	<div class="product videoWrapper" style="min-height:250px;background: black;">
                                        <div id = "player" class=""></div>
                                        <!--<iframe class="hide" width="560" height="349" src="//www.youtube.com/embed/V9xAMlQP9tE" frameborder="0" allowfullscreen></iframe>-->
                                        <!--<img class="img-responsive" src="https://i.ytimg.com/vi/UpBHyj1ZDQ8/hqdefault.jpg" alt=""
                                        dataId='UpBHyj1ZDQ8'>-->
									</div>
                                    <span class="zoom-icon"></span>                   
                                </span>                                              
                            </a>                    
                            <div class="caption">
                            	<h1><?php echo $data['title'] ?></h1>                                
                                <!--
                                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec id elit non mi porta gravida at eget metus. Fusce dapibus, justo sit amet risus etiam porta sem.</p>
                                -->                        
                                <a target="_blank" 
                                href="http://www.youtube-mp3.org/?e=t_exp&r=true#v=<?php echo $data['id_youtube'] ?>" 
                                class="btn-u btn-u-small">Download mp3</a>
                            </div>
                        </div>


                        <hr class="margin-bottom-30">

                    </div>

                    </div>                            
                </div>
                <!-- End Bordered Funny Boxes -->





            </div>
            <!-- End Left Sidebar -->

            <!-- Right Sidebar -->
        	<div class="col-md-4">
                <!-- Social Icons -->
                <div class="servive-block rounded-2x servive-block-light" style="min-height:290px">
                	
                    <!-- banner google -->

                    <div class="clearfix"></div>                
                </div>
                <!-- End Social Icons -->

                <hr class="margin-bottom-30">

            	<!-- Blog Latest Tweets
                <div class="blog-twitter">
                    <div class="headline headline-md"><h2>Latest Tweets</h2></div>
                    <div class="blog-twitter-inner">
                        <i class="icon-twitter"></i>
                        <a href="#">@htmlstream</a> 
                        At vero eos et accusamus et iusto odio dignissimos. 
                        <a href="#">http://t.co/sBav7dm</a> 
                        <span>5 hours ago</span>
                    </div>
                    <div class="blog-twitter-inner">
                        <i class="icon-twitter"></i>
                        <a href="#">@htmlstream</a> 
                        At vero eos et accusamus et iusto odio dignissimos. 
                        <a href="#">http://t.co/sBav7dm</a> 
                        <span>5 hours ago</span>
                    </div>
                    <div class="blog-twitter-inner">
                        <i class="icon-twitter"></i>
                        <a href="#">@htmlstream</a> 
                        At vero eos et accusamus et iusto odio dignissimos. 
                        <a href="#">http://t.co/sBav7dm</a> 
                        <span>5 hours ago</span>
                    </div>
                </div>
                End Blog Latest Tweets -->
            </div>
            <!-- End Right Sidebar -->
        </div>




<!--- DEMO MODAL -->
<!-- Button trigger modal -->
<!--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button>
-->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">I Thanks for collaborate</h4>
      </div>
      <div class="modal-body funny-boxes">
        <div class="col-md-4">
            <img alt="" src="https://i.ytimg.com/vi/<?php echo $data['id_youtube'] ?>/default.jpg" class="img-responsive">
        </div>
        <div class="col-md-8">
            You liked this video, You want share with friends.
        </div>        
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>
<?php else: ?>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="error-v1">
                <span class="error-v1-title">404</span>
                <span>That’s an error!</span>
                <p>The requested URL was not found on this server. That’s all we know.</p>
                <a class="btn-u btn-bordered" 
                href="<?php echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : site_url() ?>">Back Home</a>
            </div>
        </div>
    </div>    
<?php endif; ?>    
