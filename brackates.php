<?php
require_once("./connects.php");

$exp = "[7] * 11 - ( [3 - 10] * [7-9])";
$string1 = "( 2 * 45 [ 11 ) - 7]";
$string2 = "( 2 { 3 / [ ? } 1 ] )";
$string3 = "> < > <";
$result = array();

$brack = ['[', '(', '{', '<'];
$brack_next = [']', ')', '}', '>'];



$str = '<><';

function insertResult($str, $result) {
    global $pdo;
    $brack_table = 'brack';
    $sql = "INSERT INTO $brack_table(input, result) VALUES('$str', '$result')";
    // echo $sql;
    // echo var_dump($pdo);
    $query = $pdo->prepare($sql);
    
    $query->execute(['input' => $str, 'result' => $result]);
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
                $result = ['success' => false];
                insertResult($str, 'false');
                return $result;
            }
        }
    }
    
    if( count($stack)==0 ) {
        $result = ['success'=> true];
        insertResult($str, 'true');
        return $result;
    }
    else {
        $result = ['success' => false];
        insertResult($str, 'false');
        return $result;
    }
}

$string4 = "< ( { [ 42 ] } ) >";
$string5 = "( 2 * 44 [ 11 ] ) ";
$string6 = "< a * ( 4 / 7 - [ 2 - 2] / { 11 } ) >";
$string7 = "(привет+пока)";
 

$str = $_GET['str'];
$answer = brackets($str);
$data_json = json_encode($answer, JSON_UNESCAPED_UNICODE);
echo $data_json;