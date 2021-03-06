<?php

final class PHUIBadgeMiniView extends AphrontTagView {

  private $href;
  private $icon;
  private $quality;
  private $header;

  public function setIcon($icon) {
    $this->icon = $icon;
    return $this;
  }

  public function setHref($href) {
    $this->href = $href;
    return $this;
  }

  public function setQuality($quality) {
    $this->quality = $quality;
    return $this;
  }

  public function setHeader($header) {
    $this->header = $header;
    return $this;
  }

  protected function getTagName() {
    if ($this->href) {
      return 'a';
    } else {
      return 'span';
    }
  }

  protected function getTagAttributes() {
    require_celerity_resource('phui-badge-view-css');
    Javelin::initBehavior('phabricator-tooltips');

    $classes = array();
    $classes[] = 'phui-badge-mini';
    if ($this->quality) {
      $classes[] = 'phui-badge-mini-'.$this->quality;
    }

    return array(
        'class' => implode(' ', $classes),
        'sigil' => 'has-tooltip',
        'href'  => $this->href,
        'meta'  => array(
          'tip' => $this->header,
          ),
        );
  }

  protected function getTagContent() {

    return id(new PHUIIconView())
      ->setIconFont($this->icon);

  }

}
