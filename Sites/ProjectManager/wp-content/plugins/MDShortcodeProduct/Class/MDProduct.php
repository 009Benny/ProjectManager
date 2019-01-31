<?php

include 'MDImage.php';
if(!class_exists('MDProduct')):
class MDProduct{
  private $ID;
  private $title;
  private $description;
  private $currency;
  private $price;
  private $discount;
  private $link;
  private $category;//falta
  private $image_id;
  private $gallery_ids;//falta
  //private $label; //etiqueta

  function __construct($product_id){
    $dominio = 'http://'.$_SERVER['HTTP_HOST'];
    $dom_local = 'localhost';
    if(strcmp($dom_local, $dominio) !==0){
      $dominio = $dominio.'/wordpress';
    }
    $args = array(
      'p' => $product_id,
      'post_type'  => 'product'
    );
    $query = new WP_Query($args);
    if($query->have_posts()){
      $products = $query->posts;
      foreach ($products as $product) {
        $id_product = $product->ID;
        $currency = get_woocommerce_currency_symbol();
        $description = $product->post_excerpt;
        $description = preg_replace("/\<(.*?)\>/i",'',$description);
        if('&#36;'== $currency){
          $currency = 'MXN';
        }
        $gallery_ids = get_post_meta($id_product, '_product_image_gallery', true);
        $array_gallery = explode(",", $gallery_ids);
        $this->ID           = $id_product;
        $this->title        = $product->post_title;//Titulo
        $this->description  = $description;//Descripcion Corta
        $this->currency     = $currency;
        $this->price        = get_post_meta($id_product, '_regular_price', true);//Regular price
        $this->discount     = get_post_meta($id_product, '_sale_price', true);//Discount price
        $this->link         = $dominio.'/shop/'.$product->post_name;//article_page
        $this->image_id     = get_post_thumbnail_id($id_product);//id first image
        $this->gallery_ids  = $array_gallery;
      }
    }
    wp_reset_query();
  }
  public function getProduct(){
    $arrayGallery = array();
    $gallery_ids = $this->gallery_ids;
    foreach ($gallery_ids as $gallery_id) {
      $objImage = new MDImage($gallery_id);
      array_push($arrayGallery, $objImage->getImage());
    }
    $objImage     = new MDImage($this->image_id);
    $array_product = array(
      'id'             => $this->ID,
      'title'          => $this->title,
      'description'    => $this->description,
      'currency'       => $this->currency,
      'regular_price'  => $this->price,
      'ofer_price'     => $this->discount,
      'link'           => $this->link,
      'image'          => $objImage->getImage(),
      'gallery'        => $arrayGallery
    );
    return $array_product;
  }
}
endif;
?>
