<div class="errors">
    <ul class="list">
      <?php
        if (!empty($errors))
        foreach( $errors as $k => $error ){
          echo "<li class='has-error'> $error </li>";
        }
      ?>
    </ul>
  </div>