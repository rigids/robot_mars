<?php
 $direction   =   array('N','E','S','W');
 $land        =   array();
 $current_dir =   $result = "";
 $action      =   array(
                    array(0,1),
                    array(1,0),
                    array(0,-1),
                    array(-1,0)
                  );


  // Fetch the values 
  // @TODO validations, Sanitizing
  $x         =   @$_POST["areaX"];  
    
  if(count($x)>0){
    $y         =   $_POST["areaY"];
    $currentX  =   $_POST["intialX"];
    $currentY  =   $_POST["intialY"];
    $dir       =   $_POST["direction"];
    $cmd       =   $_POST["inputstring"];
    // Create Surface of Planet Mars modelled by a rectangular grid.
    for($i=0;$i<=$x;$i++){
      for($j=0;$j<=$y;$j++){
         $land[$i][$j] = -1;
      }
    }
    
    // Loop through the initial cordinate
    for($k=0;$k<count($currentX);$k++){
      for($currentDir=0; $direction[$currentDir]!=$dir[$k]; $currentDir++);
      $len  = strlen($cmd[$k]);
      $lost = 0;
      // move through commands LRF
      for($i=0;$i<$len && !$lost;$i++){
         switch($cmd[$k][$i]){
            case 'F':
               $currentX[$k] += $action[$currentDir][0];
               $currentY[$k] += $action[$currentDir][1];
               if($currentX[$k]<0 || $currentX[$k]>$x || $currentY[$k]<0 || $currentY[$k]>$y){
                  $currentX[$k] -= $action[$currentDir][0];
                  $currentY[$k] -= $action[$currentDir][1];
                  if($land[$currentX[$k]][$currentY[$k]]!=-1)
                     break;
                  $land[$currentX[$k]][$currentY[$k]] = $currentDir;
                  $result .= $currentX[$k] .' '.$currentY[$k].' '.$direction[$currentDir].' LOST <br>';
                  $lost = 1;
               }
               break;
            case 'L':
               $currentDir = ($currentDir+3)%4;
               break;
            case 'R':
               $currentDir = ($currentDir+5)%4;
               break;
         }
      }
      if(!$lost):
        $result .= $currentX[$k] .' '.$currentY[$k].' '.$direction[$currentDir]. ' <br>';
      endif;
   }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#000000">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jQuery.js"></script>
    <script src="js/siteQuery.js"></script>
    <title>Mars Robot</title>
  </head>
  <body>
    <noscript>
      You need to enable JavaScript to run this app.
    </noscript>
    
    <!-- Construct -->
    <div class="container">
      <div class="container">
        <div class="col-md-12 py-5">
          <?php  if($result): ?>
            <h4 class="mt-2">Result is</h4>
            <h4 class="mt-3 mb-3"><?php echo $result ?></h4>
          <?php else: ?>
            Please fill the form first
          <?php endif; ?>
          <br><a href="index.html"  title="">Go Back</a>
        </div>
      </div>
    </div>
  </body>
</html>