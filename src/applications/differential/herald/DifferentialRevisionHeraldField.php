<?php

abstract class DifferentialRevisionHeraldField extends HeraldField {

  public function supportsObject($object) {
    return ($object instanceof DifferentialRevision);
  }

}
