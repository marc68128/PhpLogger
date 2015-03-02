<?php
$log = json_decode($_POST["log"]);
$title = $log ->{'title'};
$description = $log ->{'description'};
$level = $log ->{'level'};
$date = date('Y-m-d H:i:s');
$st = $log ->{'stack_trace'};
$il = $log ->{'inner_log'};

$host_name  = "db567447493.db.1and1.com";
$database   = "db567447493";
$user_name  = "dbo567447493";
$password   = "themarc68";


// Create connection
$conn = new mysqli($host_name, $user_name, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST["log"]))
{

    $sql = "INSERT INTO Log(Title, Description, Level, Date, StackTrace, InnerLog)
    VALUES ('$title', '$description', $level, '$date', '$st', '$il')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
else{

    $sql = 'SELECT * FROM Log';
    $result = $conn->query($sql);
?>

    <!doctype html>
    <html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Logs</title>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    </head>
    <body>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <td> Date </td>
                <td> Title </td>
                <td> Description </td>
                <td> Level </td>
                <td> Stack Trace </td>
                <td> Inner Log </td>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>'.$row["Date"].'</td>';
                    echo '<td>'.$row["Title"].'</td>';
                    echo '<td>'.$row["Description"].'</td>';
                    echo '<td>'.$row["Level"].'</td>';
                    echo '<td>'.$row["StackTrace"].'</td>';
                    echo '<td>'.$row["InnerLog"].'</td>';
                    echo '</tr>';
                }
            } else {
                echo "0 results";
            }
        ?>
        ²</tbody>
    </table>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo $row["Title"];
            }
        } else {
            echo "0 results";
        }
        ?>
    </body>
    </html>


<?php
    $conn->close();
} ?>