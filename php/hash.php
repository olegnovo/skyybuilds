<?php

class SessionManager {

  public static function setSessionId($x) {
    $_SESSION["userid"] = $x;
  }
  public static function getSessionId() {
    return $_SESSION["userid"];
  }
  public static function setFirstName($x) {
    $_SESSION["firstname"] = $x;
  }
  public static function getFirstName() {
    return $_SESSION["firstname"];
  }


}

?>
