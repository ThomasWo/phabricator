<?php

final class DiffusionPreCommitContentDiffContentHeraldField
  extends DiffusionPreCommitContentHeraldField {

  const FIELDCONST = 'diffusion.pre.commit.diff.content';

  public function getHeraldFieldName() {
    return pht('Diff content');
  }

  public function getHeraldFieldValue($object) {
    return $this->getAdapter()->getDiffContent('*');
  }

  protected function getHeraldFieldStandardConditions() {
    return self::STANDARD_TEXT_MAP;
  }

  public function getHeraldFieldValueType($condition) {
    return HeraldAdapter::VALUE_TEXT;
  }

}
