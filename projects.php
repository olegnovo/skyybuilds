<?php


include "DAL/Projects.php";
include "DAL/Tasks.php";
include "DAL/StatusTypes.php";

?>

<!DOCTYPE html>
<html lang="en">

<?php include "head.php"; ?>
  <body>
<?php include "navbar.php"; ?>

    <div class="row">
      <div class="col-sm-12" style="text-align: center; padding-top: 120px;">
      <h2> Current Projects </h2>
      <div class="row">

    <?php

      $projectlist = Projects::loadall();
      foreach ($projectlist as $info) {
    ?>
      <div class="col-sm-3">
    <?php
        echo $info->getProjectName();
        echo $info->getProjectDescription();

      //  echo $task->getProjectID();
        /*$project = new Projects();
        $project->load($info->getProjectID());
        echo $project->getProjectName(); */
      //  $status = new StatusTypes();
      //  $status->load($info->getStatusTypeID());
      //  echo $status->getStatusName();
      //  echo $info->getEndDate();
    //    echo $task->getStatusTypeID();
      //  echo $task->getUserID();

        ?>
          </div>
        <?php

      }     // Closing bracket for the for-loop
      ?>
</div>
      <!-- Footer -->
      <footer>
        <div class="container text-center">
          <p>Copyright &copy; Skyy Builds 2017</p>
        </div>
      </footer>


    </body>




    </html>
