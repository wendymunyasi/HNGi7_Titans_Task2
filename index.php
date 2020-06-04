<style media="screen">

body{
  font-family:lato;
  background: #eee;
  margin: 0;
  padding: 0;
}

.chart{
  display: flex;
  justify-content: center;
  flex-direction: column;
  position: fixed;
  top: 70px;
  right: 10px;
}

.breakdown{
  background: black;
  color: #fff;
  padding: 10px;
  border-radius:20px 6px 20px 6px;
  width: 150px;
  display: flex;
  justify-content: center;
  align-items: center;
  opacity: 0;
  animation-name: magicslide;
  animation-fill-mode: forwards;
  animation-duration: 1s;
}


.titans{
  left: 0;
  right: 0;
  top: 0;
  height: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 5px;
  background-color: #000;
  /* background: linear-gradient(to right, rgb(0, 4, 40), rgb(0, 78, 146)); */
  color: #fff;
  font-size: 1.8rem;
  font-weight: bold;
  position: fixed;
  font-family: monospace;
    box-shadow:0 2px 5px #ddd;
    z-index: 10;
}

.titans p span:nth-of-type(1){
  color: blue;
  margin-left: 2px;
}

.titans p{
  width: 200px;
  position: relative;
  text-transform: uppercase;
}

.titans p::after{
  content: "";
  position: absolute;
  bottom: -5px;
  height: 4px;
  width: 50px;
  right: 45px;
  background-color: blue;
}

.container{
  display: flex;
  justify-content: space-between;
  min-height: 100vh;
  margin-top: 60px;
}

.bar-div{
  width: 200px;
  height: 250px;
  display: flex;
  justify-content: space-between;
  text-align: center;
  position: relative;
  border-left: 2px solid #ccc;
  border-bottom: 2px solid #ccc;
  margin-right: 20px;
  margin-top: 50px;
}

.bar-pass, .bar-fail{
  position: absolute;
  bottom: 0;
  width: 40px;
  color: #fff;
  font-size: 0.8rem;
  font-weight: bold;
  display: flex;
  justify-content: center;
  align-items: center;
}

.bar-div p{
  transform: rotate(30deg);
}


.bar-pass{
  background: green;
  left: 50px;
  opacity: 0;
  animation-name: magicht;
  animation-fill-mode: forwards;
  animation-duration: 1s;
}

.bar-fail{
  background: red;
  left: 100px;
  opacity: 0;
  animation-name: magicht;
  animation-fill-mode: forwards;
  animation-duration: 1s;
  animation-delay: 0.5s;
}

tr.divider td{
  height: 7px;
  padding: 0;
}
tr.whoiam{
   height: 50px;
   transition: all 0.5s ease-in 0.1s;
   color: #fff;
   opacity: 0;
   animation-name: magicrow;
   animation-fill-mode: forwards;
   animation-duration: 0.5s;
   /* border-top: 5px solid #eee; */
}
table{
  /* box-shadow:0 0 8px #ccc; */
  border-radius:6px;
  display: relative;
  background-color: #eee;
  width: 80vw;
  padding: 10px;
}
tr.whoiam td{
  /* transition: all 0.3s 0.5s; */
  /* border-bottom: 6px solid #ddd;
  border-left: 6px solid #ddd; */
}
tr td{
  border-radius:20px 6px 20px 6px;
  padding:15px;
}

tr th:nth-of-type(1){
  border-radius: 5px 0 0 0;
}
tr th:nth-of-type(4){
  border-radius: 0 5px 0 0;
}


tr.whoiam:hover{
  transform: scale(1.005);
}
tr th{
  background-color: black;
  color: #fff;
  padding: 10px;
  font-size: 1.1rem;
}
.failed{
  background-color: #e02727c9;
}
tr.whoiam td{
  position: relative;
  font-size: 0.9rem;
  font-weight: bold;
}

.pass{
  background-color: #24a824c2;
}

.error-div{
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;

}
.error, .error-num{
  color: #ccc;
}
.error{
  display: inline-block;
  margin-top: -200px;
  font-size: 1.5rem;
}
.error-num{
  font-size: 10.5rem;
  font-weight: 700;
}

tr.whoiam td:hover{
  /* background-color: #e91e63; */
  box-shadow:0 5px 15px #ccc;
}

@keyframes  magicrow {
  0%{ opacity: 0; transform: scale(0.9);}
  50%{ opacity: 1; transform: scale(1.005);}
  100%{ opacity: 1; transform: scale(1);}
}

@keyframes  magicht {
  0%{ opacity: 0; height: 0;}
  50%{ opacity: 1; height: 10px;}
  100%{ opacity: 1;}
}


@keyframes  magicslide {
  0%{ opacity: 0; transform: translateX(30px);}
  50%{ opacity: 1;transform: translateX(10px);}
  100%{ opacity: 1; transform: translateX(0);}
}
</style>


<?php
  $dir = "./scripts/";

  $files = scandir($dir);
  $filesLength = count($files);

  $index = 2;

  $titans = array();

    $queries = $_SERVER['QUERY_STRING'];


  $pass = 0;
  $failed = 0;


  $error = "Query is not valid";
  $error_num = "404";
    if($queries !== "json" || $queries === "html"){

  echo "<div class='titans'> <p>Team<span>-</span>Titans</p> </div>";

  echo "<div class='container'>";
// echo round(25.22222222215,2);

  echo '<table class="main">';
    echo '<tr> <th>#</th> <th>Full Name</th> <th>Infomation</th> <th>Status</th> </tr>';
}
  while($index < $filesLength){

  if($queries !== "json" || $queries === "html"){
    echo "<tr class='divider'><td></td><td></td><td></td><td></td></tr>";
  }

    $array = explode('.', $dir.$files[$index]);
    $extension = end($array);

    switch ($extension) {
      case 'js':
      $output = exec('node '.$dir.$files[$index]);
        break;

      case 'php':
      $output = exec('php '.$dir.$files[$index]);
      break;

      case 'py':
      $output = exec('python '.$dir.$files[$index]);
      break;

      default:
        $output = "nothing do you jare";
        break;
    }

    $full_match=[];
    preg_match_all("/(?<=this is)(.*)(?=with)|(?<=ID)(.*)(?=and)|(?<=email)(.*)(?=using)|(?<=using)(.*)(?=for)/", $output, $matches);
    preg_match_all("/Hello World, this is(.*)with HNGi7 ID(.*)and email(.*)using(.*)for stage 2 task/",$output, $full_match);


    //
    // $newout =  str_replace(array( '[', ']' ), '', $output);
    //
    $withoutMial = preg_replace('/(and\semail\s\w+\.{0,1}\w+\@(gmail|yahoo|hotmail).com )/','',$output);

    // print_r($withoutMial);

    $status = "failed";


    //
    // $words = array("Hello World,", "this is", "with HNGi7 ID", "and email", "using", "for stage 2 task");
    //
    // $x = 0;
    // while ($x <= count($words)-1) {
    //   if(strpos(strtolower($output), strtolower($words[$x])) !== false){
    //     $status = "pass";
    //   }else{
    //     $status = "failed";
    //     break;
    //   }
    //   $x++;
    // }

    if(count($full_match[0]) == 1){
      // array_push($pass,"okay");
      $status = "pass";
      $pass++;
    }else{
      // array_push($failed,"failed");
      $status = "failed";
      $failed++;
    }


    $jsonForm = array(
      "file"=>$files[$index],
      "output"=> $withoutMial,
      "name"=>$matches[0][0],
      "id"=>$matches[0][1],
      "email"=>$matches[0][2],
      "language"=>$matches[0][3],
      "status"=>$status
    );
    array_push($titans, $jsonForm);


  // print_r($newout);

  $num = $index - 1;
  $anim = $num/(7).s;

    if($queries !== "json" || $queries === "html"){
      echo "<tr class='whoiam  $status' style='animation-delay: $anim'>";
      echo '<td>'. $num .'</td>';
      echo '<td>'. $matches[0][0] .'</td>';
      echo '<td>'. $output .'</td>';
      echo '<td>'. $status .'</td>';
      echo '</tr>';
      // echo "<br/>";
    }

    $index++;

  }

  // print_r($pass);
  // print_r($pass);
  $numfiles = $filesLength - 2;

  $failpercentage = round((($failed/$numfiles) * 100),2).'%';
  $passpercentage = round((($pass/$numfiles) * 100),2).'%';
  if($queries !== "json" || $queries === "html"){

  echo '</table>';

  echo "<div class='chart'>";
      echo "<p class='breakdown'>";
        echo "Total ".$numfiles;
      echo "</p>";
      echo "<span>";
        echo "Passed :".$pass;
      echo "</span>";
      echo "<span>";
        echo "Failed :".$failed;
      echo "</span>";
    echo "<div class='bar-div'>";
        echo "<div class='bar-pass' style='height: $passpercentage'>";
           echo "<p>";
             echo $passpercentage;
           echo "</p>";
        echo "</div>";
        echo "<div class='bar-fail' style='height: $failpercentage'>";
            echo "<p>";
             echo $failpercentage;
           echo "</p>";
        echo "</div>";
    echo "</div>";

    echo "</div>";
  echo "</div>";

}
  // function findOut(){
  //
  // }

  if($queries === "json"){
    // header('Content-Type: application/json');
    $fineJson = json_encode($titans, JSON_PRETTY_PRINT);
    echo '<pre>'.$fineJson.'</pre>';
    return false;
  }

 ?>



 <script type="text/javascript">

 // let magic = document.getElementsByClassName('whoiam');
 // console.log(magic.length);
 //
 // for(let x = 0; x < magic.length; x++){
 //    setTimeout(()=>{
 //     // console.log(magic[x]);
 //     magic[x].classList.add('magic');
 //   },1000);
 // }

 </script>

