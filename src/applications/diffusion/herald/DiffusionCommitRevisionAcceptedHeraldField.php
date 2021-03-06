<?php

final class DiffusionCommitRevisionAcceptedHeraldField
  extends DiffusionCommitHeraldField {

  const FIELDCONST = 'diffusion.commit.revision.accepted';

  public function getHeraldFieldName() {
    return pht('Accepted Differential revision');
  }

  public function getHeraldFieldValue($object) {
    $revision = $this->getAdapter()->loadDifferentialRevision();
    if (!$revision) {
      return null;
    }

    $data = $object->getCommitData();
    $status = $data->getCommitDetail(
      'precommitRevisionStatus',
      $revision->getStatus());

    switch ($status) {
      case ArcanistDifferentialRevisionStatus::ACCEPTED:
      case ArcanistDifferentialRevisionStatus::CLOSED:
        return $revision->getPHID();
    }

    return null;
  }

  protected function getHeraldFieldStandardConditions() {
    return self::STANDARD_PHID_BOOL;
  }

  public function getHeraldFieldValueType($condition) {
    return HeraldAdapter::VALUE_NONE;
  }

}
