<article class="blog-post"> <img src="<?php echo  base_url();?>media/content/<?php echo $get_data[0]["content_image"];?>" alt=""><br>
        <h3><a href="blog-single.html"><?php echo $get_data[0]["content_title"];?></a></h3>
        <div class="postmetadata">
          <h6 class="blog-author"><strong></strong></h6>
          <h6 class="blog-cat"><strong></strong> </h6>
        </div>
        <p><?php echo $get_data[0]["content_desc"];?></p>
        <a href="blog-single.html"  class="readmore">read more</a>
        <hr class="vertical-space1">
      </article>