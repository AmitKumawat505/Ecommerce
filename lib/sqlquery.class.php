<?php
// include './config/config.php';
class SQLQuery
{

    public $_dbHandle;
    protected $_result;
    /** Connects to database * */
    function connect()
    {
        $this->_dbHandle = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
        if ($this->_dbHandle) {
            if (mysqli_select_db($this->_dbHandle, DB_NAME)) {
                mysqli_set_charset($this->_dbHandle, 'utf8');
                return 1;
            } else {
                echo "not exist db";
                return 0;
            }
        } else {
            echo "unable to connect to db2";
            return 0;
        }
    }

    /** Disconnects from database * */
    function disconnect()
    {
        if (@mysqli_close($this->_dbHandle) != 0) {
            return 1;
        } else {
            return 0;
        }
    }

    function selectAll()
    {
        $query = 'select * from `' . $this->_table . '`';
        return $this->query($query);
    }

    public function select($id)
    {
        $query = 'select * from `' . $this->_table . '` where `id` = \'' . mysqli_real_escape_string($this->_dbHandle, $id) . '\'';
        return $this->query($query, 1);
    }

    public function select_by_alias($alias)
    {
        $query = 'select * from `' . $this->_table . '` where `alias` = \'' . mysqli_real_escape_string($this->_dbHandle, $alias) . '\'';
        return $this->query($query, 1);
    }

    /** Custom SQL Query * */
    function query($query, $singleResult = 0)
    { // echo $query;
        $this->_result = mysqli_query($this->_dbHandle, $query);
        if (preg_match("/select/i", $query)) {
            $result = array();
            if ($this->_result) {
                $table = array();
                $field = array();
                $tempResults = array();
                $numOfFields = 0;
                while ($fieldinfo = mysqli_fetch_field($this->_result)) {
                    array_push($table, $fieldinfo->table);
                    array_push($field, $fieldinfo->name);
                    $numOfFields++;
                }
                while ($row = mysqli_fetch_row($this->_result)) {
                    for ($i = 0; $i < $numOfFields; ++$i) {
                        $table[$i] = trim(ucfirst($table[$i]), "s");
                        $tempResults[$table[$i]][$field[$i]] = $row[$i];
                    }
                    if ($singleResult == 1) {
                        mysqli_free_result($this->_result);
                        return $tempResults;
                    }
                    array_push($result, $tempResults);
                }
                mysqli_free_result($this->_result);
            }
            return ($result);
        }
    }
    function escape($field)
    {
        return mysqli_real_escape_string($this->_dbHandle, $field);
    }
    // function escape($table, $field)
    // {
    // }
    /** Get number of rows * */
    function getNumRows()
    {
        return mysqli_num_rows($this->_result);
    }

    /** Free resources allocated by a query * */
    function freeResult()
    {
        mysqli_free_result($this->_result);
    }

    /** Get error string * */
    function getError()
    {
        return mysqli_error($this->_dbHandle);
    }

    function getInserted()
    {
        return array_values($this->query("select LAST_INSERT_ID() as id", true))[0];
    }

    function affected_rows()
    {
        return mysqli_affected_rows($this->_dbHandle);
    }
}
