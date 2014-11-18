    <?php if (is_array($data) && count($data) > 0): ?>
<!-- Recent Works -->
        <div class="headline"><h2 data-toggle="tooltip" title="últimos videos sincronizados">Last synchronized <i class="fa fa-youtube-play"></i></h2></div>
        <div class="row margin-bottom-20">
            <?php foreach ($data as $key => $value): ?>
            <div class="col-md-2 col-sm-3">
                <div class="thumbnails thumbnail-style thumbnail-kenburn">
                    <div class="thumbnail-img easy-block-v1">
                        <div class="easy-block-v1-badge">
                            <?php echo vtLevelDescription($value['level']) ?>
                        </div>                        
                        <a class="hand" href="<?php echo generateUrlVideo($value['title'], $value['id']) ?>" title="<?php echo $value['title'] ?>">
                        <div class="overflow-hidden product">
                        <img class="lazy img-responsive" 
                                data-original="https://i.ytimg.com/vi/<?php echo $value['id_youtube'] ?>/hqdefault.jpg">
                        </div>
                        </a>
                        <!--<a class="btn-more hover-effect" href="#">lbl</a>-->
                    </div>                    
                    <h5 class="sil-lockup-title"><a class="hover-effect" href="<?php echo generateUrlVideo($value['title'], $value['id']) ?>" title="<?php echo $value['title'] ?>"><?php echo truncate_string($value['title'], 14) ?></a></h5>                    
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
            
        </div>
    	<!-- End Recent Works -->