<?php

final class PhabricatorUIExampleRenderController extends PhabricatorController {

  private $class;

  public function shouldAllowPublic() {
    return true;
  }

  public function willProcessRequest(array $data) {
    $this->class = idx($data, 'class');
  }

  public function processRequest() {

    $classes = id(new PhutilSymbolLoader())
      ->setAncestorClass('PhabricatorUIExample')
      ->loadObjects();
    $classes = msort($classes, 'getName');

    $nav = new AphrontSideNavFilterView();
    $nav->setBaseURI(new PhutilURI($this->getApplicationURI('view/')));

    foreach ($classes as $class => $obj) {
      $name = $obj->getName();
      $nav->addFilter($class, $name);
    }

    $selected = $nav->selectFilter($this->class, head_key($classes));

    $example = $classes[$selected];
    $example->setRequest($this->getRequest());

    $result = $example->renderExample();
    if ($result instanceof AphrontResponse) {
      // This allows examples to generate dialogs, etc., for demonstration.
      return $result;
    }

    require_celerity_resource('phabricator-ui-example-css');

    $crumbs = $this->buildApplicationCrumbs();
    $crumbs->addTextCrumb($example->getName());

    $note = id(new PHUIInfoView())
      ->setTitle(pht('%s (%s)', $example->getName(), get_class($example)))
      ->appendChild($example->getDescription())
      ->setSeverity(PHUIInfoView::SEVERITY_NODATA);

    $nav->appendChild(
      array(
        $crumbs,
        $note,
        $result,
      ));

    return $this->buildApplicationPage(
      $nav,
      array(
        'title'   => $example->getName(),
      ));
  }

}
