<?php $this->load->view('partials/header'); ?>
  <div id="container">
    <!-- Feature Box Start-->
    <div class="container">&nbsp;</div>
    <!-- Feature Box End-->
    <div class="container">
      <div class="row">
        <!-- Left Part Start-->
        <?php $this->load->view('partials/sidebar'); ?>

        <!-- Left Part End-->
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
          <!-- Slideshow Start-->
          <div class="slideshow single-slider owl-carousel">
            <div class="item"> <a href="#"><img class="img-responsive" src="/assets/image/slider/banner-1.jpg" alt="banner 1" /></a> </div>
            <div class="item"> <a href="#"><img class="img-responsive" src="/assets/image/slider/banner-2.jpg" alt="banner 2" /></a> </div>
            <div class="item"> <a href="#"><img class="img-responsive" src="/assets/image/slider/banner-3.jpg" alt="banner 3" /></a> </div>
          </div>
          <!-- Slideshow End-->
          <!-- Dell Product Start-->
          <h3 class="subtitle">ASUS</h3>
          <div class="owl-carousel product_carousel">
            <?php $products = $this->product->show_product_by(5); ?>
            <?php if ($products): ?>
            <?php foreach ($products as $product): ?>             
            <div class="product-thumb clearfix">
             <div class="image"><a href="<?php echo '/product/' . $product->slug; ?>"><img src="/uploads/<?php echo $product->product_img ?>" width="200" height="200" alt="<?php echo $product->title; ?>" title="<?php echo $product->title; ?>" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?php echo '/product/' . $product->slug; ?>"><?php echo $product->title; ?></a></h4>
                <p class="price"><span class="price-new">Rs/ <?php echo number_format($product->price); ?></span></p>
              </div>
            </div>
            <?php endforeach ?>
            <?php else: ?>
              <div class="alert alert-danger">
                No record found!
              </div>
            <?php endif ?>
          </div>
          <!-- Dell Product End-->
          <!-- Categories Product Slider Start-->
          <div class="category-module" id="latest_category">
            <h3 class="subtitle">HP</h3>
            <div class="category-module-content">
              <div id="tab-cat1" class="tab_content">
                <div class="owl-carousel latest_category_tabs">
                  <?php $products = $this->product->show_product_by(2); ?>
                  <?php if ($products): ?>
                  <?php foreach ($products as $product): ?>             
                  <div class="product-thumb clearfix">
                   <div class="image"><a href="<?php echo '/product/' . $product->slug; ?>"><img src="/uploads/<?php echo $product->product_img ?>" width="200" height="200" alt="<?php echo $product->title; ?>" title="<?php echo $product->title; ?>" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?php echo '/product/' . $product->slug; ?>"><?php echo $product->title; ?></a></h4>
                      <p class="price"><span class="price-new">Rs/ <?php echo number_format($product->price); ?></span></p>
                    </div>
                  </div>
                  <?php endforeach ?>
                  <?php else: ?>
                    <div class="alert alert-danger">
                      No record found!
                    </div>
                  <?php endif ?>  
                </div>
              </div>
            </div>
          </div>
          <!-- Categories Product Slider End-->
          
          <!-- Categories Product Slider Start -->
          <h3 class="subtitle">LENOVO</h3>
          <div class="owl-carousel latest_category_carousel">
            
           <?php $products = $this->product->show_product_by(7); ?>
            <?php if ($products): ?>
            <?php foreach ($products as $product): ?>             
            <div class="product-thumb clearfix">
             <div class="image"><a href="<?php echo '/product/' . $product->slug; ?>"><img src="/uploads/<?php echo $product->product_img ?>" width="200" height="200" alt="<?php echo $product->title; ?>" title="<?php echo $product->title; ?>" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?php echo '/product/' . $product->slug; ?>"><?php echo $product->title; ?></a></h4>
                <p class="price"><span class="price-new">Rs/ <?php echo number_format($product->price); ?></span></p>
              </div>
            </div>
            <?php endforeach ?>
            <?php else: ?>
              <div class="alert alert-danger">
                No record found!
              </div>
            <?php endif ?>

          </div>
          <!-- Categories Product Slider End -->
          <!-- Brand Product Slider Start-->
          <h3 class="subtitle">ACER</h3>
          <div class="owl-carousel latest_brands_carousel">
            
            <?php $products = $this->product->show_product_by(4); ?>
            <?php if ($products): ?>
            <?php foreach ($products as $product): ?>             
            <div class="product-thumb clearfix">
             <div class="image"><a href="<?php echo '/product/' . $product->slug; ?>"><img src="/uploads/<?php echo $product->product_img ?>" width="200" height="200" alt="<?php echo $product->title; ?>" title="<?php echo $product->title; ?>" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?php echo '/product/' . $product->slug; ?>"><?php echo $product->title; ?></a></h4>
                <p class="price"><span class="price-new">Rs/ <?php echo number_format($product->price); ?></span></p>
              </div>
            </div>
            <?php endforeach ?>
            <?php else: ?>
              <div class="alert alert-danger">
                No record found!
              </div>
            <?php endif ?>
            
          </div>
          
          <!-- Brand Product Slider End -->
          <!-- Brand Logo Carousel Start-->
          <div id="carousel" class="owl-carousel nxt">
            <?php $brands = $this->brand->show_all(); ?>
            <?php if ($brands): ?>
            <?php foreach ($brands as $brand): ?>             
              <div class="item text-center"> <a href="#"><img src="/uploads/<?php echo $brand->brand_img; ?>" width="100" height="100" alt="<?php echo $brand->title; ?>" class="img-responsive" /></a> </div>
            <?php endforeach ?>
            <?php else: ?>
              <div class="alert alert-danger">
                No record found!
              </div>
            <?php endif ?>

          </div>
          <!-- Brand Logo Carousel End -->
        </div>
        <!--Middle Part End-->
      </div>
    </div>
  </div>

  <!--Footer Start-->
  <?php $this->load->view('partials/footer'); ?>

