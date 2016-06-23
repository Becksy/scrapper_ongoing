<?php
session_start();?>


<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['nickname'];?>&nbsp;<span class="caret"></span></a>
  <ul class="dropdown-menu">
    
    <li><a href="scrap/login/logout.php">Log out</a></li>
  </ul>
</li>
