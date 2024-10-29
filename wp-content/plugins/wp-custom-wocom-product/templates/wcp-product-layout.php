<div class="wcp_custom_plugin">
  <h2>Add WooCommerce Product</h2>
  <form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
      <label for="name">Product Name</label>
      <input type="text" id="name" name="name" required>
    </div>
    
    <div class="form-group">
      <label for="regular_price">Regular Price ($)</label>
      <input type="number" id="regular_price" name="regular_price" required>
    </div>
    
    <div class="form-group">
      <label for="sale_price">Sale Price ($)</label>
      <input type="number" id="sale_price" name="sale_price">
    </div>
    
    <div class="form-group">
      <label for="description">Description</label>
      <textarea id="description" name="description" required></textarea>
    </div>
    
    <div class="form-group">
      <label for="short_description">Short Description</label>
      <textarea id="short_description" name="short_description"></textarea>
    </div>
    
    <div class="form-group">
      <label for="sku">SKU</label>
      <input type="text" id="sku" name="sku">
    </div>
    
    <div class="form-group">
      <label for="product_image">Product Image</label>
      <input type="file" id="product_image" name="product_image" accept="image/*">
    </div>
    
    <button type="submit" class="btn-submit">Add Product</button>
    
  </form>
</div>
