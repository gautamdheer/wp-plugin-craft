<div class="wcp_custom_plugin" >
  <h2>Add WooCommerce Product</h2>
  <form action="" method="post" enctype="multipart/form-data">
    
  <?php wp_nonce_field('wcp_handle_form_submission', 'wcp_add_product_nonce'); ?>

    <div class="form-group">
      <label for="name">Product Name</label>
      <input required type="text" id="name" name="wcp_name" required>
    </div>
    
    <div class="form-group">
      <label for="regular_price">Regular Price ($)</label>
      <input required type="number" id="regular_price" name="wcp_regular_price" required>
    </div>
    
    <div class="form-group">
      <label for="sale_price">Sale Price ($)</label>
      <input type="number" id="sale_price" name="wcp_sale_price">
    </div>
    
    <div class="form-group">
      <label for="description">Description</label>
      <textarea id="description" name="wcp_description" required></textarea>
    </div>
    
    <div class="form-group">
      <label for="short_description">Short Description</label>
      <textarea id="short_description" name="wcp_short_description"></textarea>
    </div>
    
    <div class="form-group">
      <label for="sku">SKU</label>
      <input type="text" id="sku" name="wcp_sku">
    </div>
    
    <div class="form-group">
      <label for="product_image">Product Image</label>
      <input type="file" id="product_image" name="wcp_product_image" accept="image/*">
    </div>
      
    <button type="submit" class="btn-submit" name="wcp_add_product" id="wcp_add_product">Add Product</button>
    
  </form>
</div>
