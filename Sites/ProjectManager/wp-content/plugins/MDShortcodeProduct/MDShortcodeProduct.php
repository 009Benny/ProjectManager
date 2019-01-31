<?php
/*
Plugin Name: MD ShortcodeProduct
Plugin URI: http://tiendamilenio.com
Description: Crear un shortcode estilo Milenio. [milenio-product id=''] con el id del producto de WooCommerce
Author: Milenio
Version: 1.0
Author URI: https://milenio.com
*/

/*//Agregar css
function add_shortcode_css(){
  wp_register_style( 'MDshortcode-css', plugin_dir_url( __FILE__ ).'/main.css.js', array());
}
add_action('wp_enqueue_style', 'add_shortcode_css');*/

/*Ajax Zone*/
function add_shortcode_script() {
  wp_enqueue_script('MDshortcode-carrusel',plugin_dir_url( __FILE__ ).'/js/MDShortcodeProduct.js', array('jquery'));
  wp_enqueue_script('MDshortcode-ajax',plugin_dir_url( __FILE__ ).'/js/MDShortcodeAjax.js', array('jquery'));
  wp_localize_script('MDshortcode-ajax', 'obj_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'add_shortcode_script');

function loadShortcode(){
  include 'Class/MDProduct.php';
  if(isset($_REQUEST)){
    $id_product = $_REQUEST['id'];
    $html = HTMLShortcode($id_product);
    echo $html;
  }
  die();
}

add_action('wp_ajax_loadShortcode', 'loadShortcode');
add_action('wp_ajax_nopriv_loadShortcode', 'loadShortcode');

/*End Ajax Zone*/





function MDProductShortcode($atts){
  include 'Class/MDProduct.php';
  $params = shortcode_atts( array (
      'id'     => '0',
  ), $atts );

  if($params['id'] !== 0){
    $html = HTMLShortcode($params['id']);
    return $html;
  }else {
    return '';
  }
}

function HTMLShortcode($id_product){
  //Vars
  $objProduct = new MDProduct($id_product);
  $array_product = $objProduct->getProduct();
  $i = 0;
  $array_gallery = $array_product['gallery'];
  $count_images = count($array_gallery)+1;
  $gallery_count = $count_images*100;
  $image_size = (100/$count_images).'%';

  //Images

  //Price
  $price = '<h2>'.'$'.$array_product['regular_price'].'MXN </h2>';
  if(!empty($array_product['ofer_price'])){
    $oferPrice = '<div class="ofer-price"><h2>'.'$'.$array_product['ofer_price'].'MXN</h2></div>';
    $price = $oferPrice.'<div class="regular-price-opacity">'.$price.'</div>'.'';
  }else{
    $price = '<div class="regular-price">'.$price.'</div>';
  }

  //Description
  $description = '<p>'.$array_product['description'].'</p>';

  //Form Cart
  $AddToCart = '
  <form class="cart" action="" method="post" enctype="">
      <div class="en-linea sin-margen">
         <h2>Cantidad:</h2>
      </div>
      <div class="en-lineacontainer-cant">
        <button type="button" name="substract" class="button-price substract-price">-</button>
        <div class="quantity">
          <input type="number" id="" class="input-text qty text" step="1" min="1" max="" name="quantity" value="1" title="Cantidad" size="4" pattern="[0-9]*" inputmode="numeric" aria-labelledby="">
        </div>
        <button type="button" name="sum" class="button-price sum-price">+</button>
      </div>
  <button type="submit" name="add-to-cart" value="'.$array_product['id'].'" class="button button-add-cart">
    <span class="glyphicon glyphicon-shopping-cart"></span>Añadir al carrito
  </button>
  </form>';

  //ShortcodeProduct
  $html ='<div class="MDModalShortCode">
    <div class="title-product">
      <a href="'.$array_product['link'].'">
        <h1>'.$array_product['title'].'</h1>
      </a>
    </div>

    <div class="center-images-container">
    <div class="images-container">
      <div class="big-image">
        <div class="visor-container">
          <div class="slider-container" style="width:'.$gallery_count.'%">';
  $html = $html.'<div class="image-slider-container" style="width:'.$image_size.'">
                    <img src="'.$array_product['image']['src'].'" class="slider-image position-'.$i++.'">
                 </div>';
  //$html = $html.'<img src="'.$array_product["image"]["src"].'" style="width:'.$image_size.'" class="slider-image position-'.$i++.'">';
  foreach ($array_gallery as $imageSrc):
    $html = $html.'<div class="image-slider-container" style="width:'.$image_size.'">
                      <img src="'.$imageSrc['src'].'" class="slider-image position-'.$i++.'">
                   </div>';
    //$html = $html.'<img src="'.$imageSrc['src'].'" style="width:'.$image_size.'" class="slider-image position-'.$i++.'">';
  endforeach;

  $html = $html.'
          </div>;
        </div>
      </div>

      <div class="control-slider-images">';

  $html = $html.'<img src="'.$array_product["image"]["src"].'" data-target="0" class="control-slider op-0 control-selected">';
  $i=0;
  foreach ($array_gallery as $imageSrc):
    $html = $html.'<img src="'.$imageSrc['src'].'" data-target="'.++$i.'" class="control-slider op-'.$i.'">';
  endforeach;
  $html = $html.'
      </div>
    </div>
    </div>

    <div class="info-container">
      <div class="left-container">
        <div class="price-container">';
  $html = $html.$price.'
        </div>
        <div class="description-container">
          <h2>Descripción</h2>';
  $html = $html.$description.'
        </div>
      </div>
      <div class="cart-container">';
  $html = $html.$AddToCart.'
      </div>
    </div>
  </div>';
  return $html;
}

add_shortcode('milenio-product', 'MDProductShortcode');

?>
