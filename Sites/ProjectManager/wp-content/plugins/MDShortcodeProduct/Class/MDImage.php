<?php
if(!class_exists('MDImage')):
class MDImage{
  private $src_id;
  private $src;
  private $width;
  private $height;
  private $type;

  function __construct($src_id){
    $src = wp_get_attachment_image_url($src_id,'full');
    list($this->width, $this->height, $this->type) = getimagesize($src);
    $this->src    = $src;
    $this->src_id = $src_id;
  }

  public function getImage(){
    $arrayImage = array(
      'image_id'  => $this->src_id,
      'src'       => $this->src,
      'width'     => $this->width,
      'height'    => $this->height,
      'type'      => $this->type
    );
    return $arrayImage;
  }

}
endif;
?>
