<?php

function cleanString($string){
    $string=trim($string);
    $string=stripslashes($string);
    $string=str_ireplace("<script>", "", $string);
    $string=str_ireplace("</script>", "", $string);
    $string=str_ireplace("<script src", "", $string);
    $string=str_ireplace("<script type=", "", $string);
    $string=str_ireplace("SELECT * FROM", "", $string);
    $string=str_ireplace("DELETE FROM", "", $string);
    $string=str_ireplace("INSERT INTO", "", $string);
    $string=str_ireplace("DROP TABLE", "", $string);
    $string=str_ireplace("DROP DATABASE", "", $string);
    $string=str_ireplace("TRUNCATE TABLE", "", $string);
    $string=str_ireplace("SHOW TABLES;", "", $string);
    $string=str_ireplace("SHOW DATABASES;", "", $string);
    $string=str_ireplace("<?php", "", $string);
    $string=str_ireplace("?>", "", $string);
    $string=str_ireplace("--", "", $string);
    $string=str_ireplace("^", "", $string);
    $string=str_ireplace("<", "", $string);
    $string=str_ireplace("[", "", $string);
    $string=str_ireplace("]", "", $string);
    $string=str_ireplace("==", "", $string);
    $string=str_ireplace(";", "", $string);
    $string=str_ireplace("::", "", $string);
    $string=trim($string);
    $string=stripslashes($string);
    return $string;
}