<?php

//session_start();

class SessionManager {

  public static function setActiveId($x) {
    $_SESSION["userid"] = $x;
  }
  public static function getActiveId() {
    if (isset($_SESSION["userid"]) && ($_SESSION["userid"] > 0)) {
      return $_SESSION["userid"];
    } else {
    return 0;
  }
  }
  public static function setFirstName($x) {
    $_SESSION["firstname"] = $x;
  }
  public static function getFirstName() {
    return $_SESSION["firstname"];
  }


}

?>
