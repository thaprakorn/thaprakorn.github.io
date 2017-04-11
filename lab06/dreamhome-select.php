<?php
echo "เงินเดือนที่มากที่สุดของแต่ละตำแหน่งในตารางพนักงาน แยกตามตำแหน่ง สำหรับตำแหน่งที่ไม่ใช่ Assistant";
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Firstname</th><th>Lastname</th><th>Position</th><th>max salary</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<th style='width:150px;border:1px solid black;'>" . parent::current(). "</th>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dreamhome";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT fname,lname,position,MAX(salary) FROM staff WHERE position != 'Assistant' GROUP BY position"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>