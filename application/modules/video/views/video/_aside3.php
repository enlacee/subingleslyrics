    <?php if (count($data) > 0): ?>
<!-- Recent Works -->
        <div class="headline"><h2>Other videos</h2></div>
        <div class="row margin-bottom-20">
            <?php foreach ($data as $key => $value): ?>
            <div class="col-md-2 col-sm-3">
                <div class="thumbnails thumbnail-style thumbnail-kenburn">
                    <div class="thumbnail-img">
                        <a class="hand" href="#" title="<?php echo $value['title'] ?>">
                        <div class="overflow-hidden product">
                            <img class="img-responsive" src="https://i.ytimg.com/vi/<?php echo $value['id_youtube']?>/hqdefault.jpg" alt="">
                        </div>
                        </a>
                        <a class="btn-more hover-effect" href="#">lvl <?php echo $value['level'] ?></a>
                    </div>                    
                    <h5><a class="hover-effect" href="#" title="<?php echo $value['title'] ?>"><?php echo truncate_string($value['title'], 14) ?></a></h5>                    
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
            
        </div>
    	<!-- End Recent Works -->