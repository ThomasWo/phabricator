<?php

final class PhrictionDocumentContentHeraldField
  extends PhrictionDocumentHeraldField {

  const FIELDCONST = 'phriction.document.content';

  public function getHeraldFieldName() {
    return pht('Content');
  }

  public function getHeraldFieldValue($object) {
    return $object->getContent()->getContent();
  }

  protected function getHeraldFieldStandardConditions() {
    return self::STANDARD_TEXT;
  }

  public function getHeraldFieldValueType($condition) {
    return HeraldAdapter::VALUE_TEXT;
  }

}
