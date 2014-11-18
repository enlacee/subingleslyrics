        <?php if (count($data) > 0): ?>
        <!-- init main images-->




        <div class="headline">
            <h2 data-toggle="tooltip" title="Videos Principales">Main videos</h2>
        </div>
        <?php foreach ($data as $key => $value): ?>
        <?php if($key == 0): ?>
        <div class="row margin-bottom-20">
            <div class="col-md-4 col-sm-6">
                <div class="thumbnails thumbnail-style thumbnail-kenburn">
                    <div class="easy-block-v1">
                        <div class="easy-block-v1-badge">
                            <?php  echo vtLevelDescription($value['level']) ?>
                        </div>
                        <a class="" data-rel="" title="<?php echo $value['title'] ?>" 
                            href="<?php echo generateUrlVideo($value['title'], $value['id']) ?>">
                            <div class="overflow-hidden product">                                
                                <img class="lazy img-responsive" 
                                data-original="https://i.ytimg.com/vi/<?php echo $value['id_youtube'] ?>/hqdefault.jpg">
                            </div>
                        </a>
                        <!--<a class="btn-more hover-effect" href="#">lbl</a>-->
                    </div>
                    <div>
                        <h2 class="sil-lockup-title">
                            <a class="hover-effect" title="<?php echo $value['title'] ?>" href="<?php echo generateUrlVideo($value['title'], $value['id']) ?>">
                            <?php echo truncate_string($value['title'], 40) ?></a>
                        </h2>                       
                    </div>
                </div>
            </div>            
            <?php else: ?>
            <div class="col-md-2 col-sm-3">
                <div class="thumbnails thumbnail-style thumbnail-kenburn">
                    <div class="easy-block-v1">
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
                    <h5 class="sil-lockup-title">
                        <a class="hover-effect" href="<?php echo generateUrlVideo($value['title'], $value['id']) ?>" 
                        title="<?php echo $value['title'] ?>"><?php echo truncate_string($value['title'], 35) ?></a>
                    </h5>                    
                </div>
            </div> 
            <?php endif; ?>
            <?php endforeach; ?>
            
        </div>
        <hr class="margin-bottom-30">
        <!-- init main images-->   
        <?php endif; ?>