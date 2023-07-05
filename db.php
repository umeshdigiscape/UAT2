<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname='test';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>PHP MySQL Stored Procedure Demo 1</title>
        <link rel="stylesheet" href="css/table.css" type="text/css" />
    </head>
    <body>
        <?php
        // require_once 'dbconfig.php';
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            // execute the stored procedure
            $sql = 'CALL GetCustomers()';
            // call the stored procedure
            $q = $pdo->query($sql);
            $q->setFetchMode(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
        ?>
        <table>
            <tr>
                <th>Std Name</th>
                <th>Std code</th>
            </tr>
            <?php while ($r = $q->fetch()): ?>
                <tr>
                    <td><?php echo $r['std_name'] ?></td>
                    <td><?php echo $r['std_code'] ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </body>
</html>



<?php



/**
 * Get customer level
 * @param int $customerNumber
 * @return string
 */
function getCustomerLevel() {
    try {
      $host = "localhost";
$username = "root";
$password = "";
$dbname='test';

        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        // calling stored procedure command
        $sql = 'CALL display_max_mark(@level)';

        // prepare for execution of the stored procedure
        // $stmt = $pdo->prepare($sql);
         $stmt = $pdo->query($sql);


        
        // execute the stored procedure if we are using prepare statements
        // $stmt->execute(); 

        // $stmt->closeCursor();

        // execute the second query to get customer's level
        $row = $pdo->query("SELECT @level AS level")->fetch(PDO::FETCH_ASSOC);
      
        if ($row) {
            return $row !== false ? $row['level'] : null;
        }
    } catch (PDOException $e) {
        die("Error occurred:" . $e->getMessage());
    }
    return null;
}


// echo "Highest Marks : ";
// echo getCustomerLevel();
?>
<?php 
 $dbh = new mysqli($host, $username, $password, $dbname);
 if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
   }

   if ($result_set = $dbh->query("CALL display_max_mark(@level)"))
   {
      while($rowtest=$result_set->fetch_object())
      {
        print_r($rowtest);
         // printf("<tr><td>%s</td><td>%s</td></tr>\n",
                  // $row->department_id, $row->department_name);
      } 
   }
   else // Query failed - show error
   {
      printf("<p>Error retrieving stored procedure result set:%d (%s) %s\n",
             mysqli_errno($dbh),mysqli_sqlstate($dbh),mysqli_error($dbh));
      $dbh->close();
      exit();
   }  
   /* free result set */
   $result_set->close();
   $dbh->close();
   
?>
<!--  while($row=$result_set->fetch_object())
      {
         printf("<tr><td>%s</td><td>%s</td></tr>\n",
                  $row->department_id, $row->department_name);
      } -->