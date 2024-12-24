<?php 
const _USER='root';
const _PASS='';
const _DB='tphone';
const _HOST='localhost';

try{
    if(class_exists('PDO')){
        $dsn='mysql:dbname='._DB.';host='._HOST;
        $conn=new PDO($dsn,_USER,_PASS);

    }
    
}
catch(Exception $exception){
    echo $exception->getMessage().'<br>';
    die();
}

?>