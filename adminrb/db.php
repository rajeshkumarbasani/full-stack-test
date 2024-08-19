<?php
include 'config.php';
function doLogin($username, $password)
{
    try
    {
        $dbhost = 'mysql:host='. constant('DB_HOST') .';dbname='.constant('DB_NAME');
        $db = new PDO($dbhost, constant('DB_USER'), constant('DB_PASSWORD'));
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $db->prepare("SELECT adminID, adminName FROM admin WHERE (adminUsername = :adminUsername and adminPassword = :adminPassword) and isBlocked=0");// removed limit 1
        $statement->bindValue(':adminUsername', $username);
        $statement->bindValue(':adminPassword',  MD5($password));
        $statement->execute();
        $rowCount = $statement->rowCount();
        if($rowCount==1)
        {
            $row = $statement->fetch();
            $_SESSION['adminID'] =  $row["adminID"];
            $_SESSION['adminName'] =  $row["adminName"];
            
            
        }
        return $rowCount;
    }
    catch(exception $e)
    {
        echo $e;

    }
}



?>