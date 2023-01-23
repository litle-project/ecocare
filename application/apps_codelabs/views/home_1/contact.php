    <article class="blog-post"> <img src="<?php echo  base_url();?>media/content/<?php echo $get_data[0]["content_image"];?>" alt=""><br>
        <div class="two columns alpha">
          <div class="blog-date-sec">
             </div>
        </div>
        <div class="nine columns omega">
          <h3><a href="#"><?php echo $get_data[0]["content_title"];?></a></h3>
          <div class="postmetadata">
            <h6 class="blog-author"> </h6>
            <h6 class="blog-cat"> </h6>
          </div>
          <p> <?php echo $get_data[0]["content_desc"];?></p>
          <!--<a href="blog-single.html"  class="readmore">read more</a>--> </div>
        <hr class="vertical-space1">
    </article>