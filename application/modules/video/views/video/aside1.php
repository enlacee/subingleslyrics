        <?php if (count($data) > 0): ?>
        <!-- init main images-->
        <div class="headline"><h2>Main videos</h2></div>
        <?php foreach ($array as $key => $value): ?>
        <?php if($key == 0): ?>
        <div class="row margin-bottom-20">
            <div class="col-md-4 col-sm-6">
                <div class="thumbnails thumbnail-style thumbnail-kenburn">
                    <div class="thumbnail-img">
                        <a class="thumbnail fancybox-button" data-rel="" title="Project Title" href="assets/img/main/4.jpg">
                            <div class="overflow-hidden">  
                                <img alt="" src="https://i.ytimg.com/vi/k0qbZttt0lw/hqdefault.jpg" class="img-responsive">
                                <span class="zoom-icon"></span>
                            </div>
                        </a><a class="btn-more hover-effect" href="#">lvl <?php echo $value['level'] ?></a>
                    </div>
                    <div class="caption red">
                        <h2><a class="hover-effect" href="#"><?php echo $value['title']</a></h2>                       
                    </div>
                </div>
            </div>            
            <?php else: ?>
            <div class="col-md-2 col-sm-3">
                <div class="thumbnails thumbnail-style thumbnail-kenburn">
                    <div class="thumbnail-img">
                        <a class="hand" href="#">
                        <div class="overflow-hidden">
                            <img class="img-responsive" src="https://i.ytimg.com/vi/k0qbZttt0lw/hqdefault.jpg" alt="">
                        </div>
                        </a>
                        <a class="btn-more hover-effect" href="#">3:01</a>
                    </div>                    
                    <h5><a class="hover-effect" href="#">Project Three - warrior</a></h5>                    
                </div>
            </div> 
            <?php endif; ?>
            <?php endforeach; ?>
            
        </div>
        <hr class="margin-bottom-30">
        <!-- init main images-->   
        <?php endif; ?>