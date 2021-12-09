<?php
require_once("./connects.php");


function insertResult($result, $pdo) {
    // htmlentities помогла избавиться от xss
    $str = htmlentities(trim($_POST['str']));
    $brack_table = 'brack';
    if(!empty($str)) {
        $query = $pdo->prepare("INSERT INTO $brack_table(input, result) VALUES(:str, :result)");
        $query->bindParam(':str', $str);
        $query->bindParam(':result', $result);
        
        $query->execute();
    }
}

function brackets($str) {
    $brack = [1 => '[', 2 => '(', 3 => '{', 4 => '<'];
    $brack_next = [1 => ']',  2 => ')', 3 => '}', 4 => '>'];
    $stack = array();
    for( $i=0; $i<strlen($str); $i++ ){
        if (in_array($str[$i], $brack)) {
            array_push($stack, $str[$i]);
        }
        elseif(in_array($str[$i], $brack_next)) {
            $key = array_search($str[$i], $brack_next);
            $elem = $brack[$key];
        
            if ($elem == end($stack)) {
                array_pop($stack);
            }
            else {
                $result = 'false';
                return $result;
            }
        }
    }
    
    if( count($stack)==0 ) {
        $result = 'true';
        return $result;
    }
    else {
        $result = 'false';
        return $result;
    }
}
 
$str = $_POST['str'];
$answer = brackets($str);
insertResult($answer, $pdo);
$data_json = json_encode(['success' => $answer], JSON_UNESCAPED_UNICODE);
echo $data_json;
