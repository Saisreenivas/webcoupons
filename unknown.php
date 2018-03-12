<?php
$reng = array('c', 'b', 'a', 'r');
$variable = ['af','vda','adv','svdss'];
$i=0;
$j=0;
foreach ($variable as $var) {
  # code...

for ($i=$j ; $i < 4 ; $i++) {
    echo $reng[$i];
    if($i=1){
      break 1;
    }
}
}

?>
