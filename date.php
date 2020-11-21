<?php
class db
{

    public static function connect_db()
    {
        $servername = "localhost";
        $username = "test";
        $password = "123456";
        $dbname = "test";

        // 创建连接
        $conn = new mysqli($servername, $username, $password, $dbname);

        // 检测连接
        if ($conn->connect_error) {
            die("连接失败: " . $conn->connect_error);
        }

        if (!file_exists('db.lock')) {
            fopen('db.lock', 'w+');
            $sql = "CREATE TABLE MoeCount (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name text(30) NOT NULL, 
                num INT(11) NOT NULL,
                day DATE NOT NULL
            )";
            $conn->query($sql);
            $day = date("Y-m-d");
            $sql = "INSERT INTO MoeCount (name, num, day) VALUES ('view', '1234567890', '$day');";
            $sql .= "INSERT INTO MoeCount (name, num, day) VALUES ('demo', '0', '$day')";
            $conn->multi_query($sql);
        }
        return $conn;
        // $conn->close();
    }

    function find_name($name)
    {
        $conn = self::connect_db();
        $result = mysqli_query($conn, "SELECT * FROM MoeCount WHERE name='$name'");
        // print_r($result);
        if ($result) {
            $flag = $result->num_rows;
            // echo $flag;
            $day = date("Y-m-d");
            // print_r($result->num_rows);
            // 判断是否存在名字
            if ($flag == 0) {
                mysqli_query($conn, "INSERT INTO MoeCount (name, num, day) VALUES ('$name', '0', '$day')");
                $result = mysqli_query($conn, "SELECT * FROM MoeCount WHERE name='$name'");
            }
            $row = mysqli_fetch_array($result);
            if ($row['day'] != $day) {
                echo '$flag';
                mysqli_query($conn, "UPDATE MoeCount SET day ='$day' WHERE name = '$name'");
                mysqli_query($conn, "UPDATE MoeCount SET num ='0' WHERE name = '$name'");


                $result = mysqli_query($conn, "SELECT * FROM MoeCount WHERE name='$name'");
                $row = mysqli_fetch_array($result);
            } else {
                $num = $row['num']+1;
                mysqli_query($conn, "UPDATE MoeCount SET num ='$num' WHERE name = '$name'");
            }
            // print_r($row);
            return $row['num'];
        } else {
            echo "数据库错误";
        }
    }
}
