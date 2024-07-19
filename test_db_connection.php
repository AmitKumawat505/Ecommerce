<?php

require 'config/config.php'; 

class TestDBConnection {
    private $_dbHandle;

    function connect() {
        $this->_dbHandle = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
        if ($this->_dbHandle) {
            if (mysqli_select_db($this->_dbHandle, DB_NAME)) {
                mysqli_set_charset($this->_dbHandle, 'utf8');
                return 1;
            } else {
                echo "Database does not exist.";
                return 0;
            }
        } else {
            echo "Unable to connect to database.";
            return 0;
        }
    }

    function testQuery() {
        $query = 'SELECT id, name, price FROM product LIMIT 10';  // Adjust the table name as needed
        $result = mysqli_query($this->_dbHandle, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                print_r($row);
            }
            mysqli_free_result($result);
        } else {
            echo "Query failed: " . mysqli_error($this->_dbHandle);
        }
    }
}

$testDB = new TestDBConnection();
if ($testDB->connect()) {
    echo "Connected successfully\n";
    $testDB->testQuery();
}
?>
