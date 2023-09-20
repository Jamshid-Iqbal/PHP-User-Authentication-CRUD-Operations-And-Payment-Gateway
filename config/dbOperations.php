<?php
include 'dbConnection.php';
function getTableDataByCondition($tableName, $columns, $condition = ""): array
{
    $conn = dbConnection();
    $sql = "SELECT " . $columns . " FROM " . $tableName . " " . $condition;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $records = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return  $records;
    }
    return [];
}
function insertTableData($tableName, $columns, $values)
{
    $conn = dbConnection();
    $columnsStr = implode(', ', $columns);
    $valuesStr = implode('\', \'', $values);
    $sql = "INSERT INTO $tableName ($columnsStr) VALUES('$valuesStr')";
    $result = mysqli_query($conn, $sql);
    return $result;
}
function insertData($tableName, $columns, $values, $isGetId = false)
{
    $conn = dbConnection();
    // Sanitize the inputs to prevent SQL injection 
    $tableName = mysqli_real_escape_string($conn, $tableName);

    // Build the SQL query 
    $columnsStr = implode(', ', array_map('mysqli_real_escape_string', array_fill(0, count($columns), $conn), $columns));
    $valuesStr = implode("', '", array_map('mysqli_real_escape_string', array_fill(0, count($values), $conn), $values));
    $id = null;
    // Complete the query 
    $sql = "INSERT INTO $tableName ($columnsStr) VALUES ('$valuesStr')";

    // Execute the query 
    if (mysqli_query($conn, $sql)) {
        if ($isGetId) {
            $id = mysqli_insert_id($conn);
            // print_r($id);
            if ($id) {
                return $id;
            }
        }
        return true; // Success 
    } else {
        return false;
        // Error 
    }
}
function deleteData($tableName, $condition = "")
{
    $conn = dbConnection();
    $sql = "DELETE FROM $tableName $condition";
    if (mysqli_query($conn, $sql)) {
        return true; // Success 
    } else {
        return false;
        // Error 
    }
}
function updateTableData($tableName, $columnValues, $condition = "")
{
    $conn = dbConnection();
    $sql = "UPDATE $tableName SET $columnValues $condition";
    if (mysqli_query($conn, $sql)) {
        return true; // Success 
    } else {
        return false;
        // Error 
    }
}
// $data = insertData('posts', ["post_description", "created_at", "update_at"], ["asdasd", date("y/m/d"), date("y/m/d")]);
// print_r($data);
// $record = getTableDataByCondition("users", "*", "WHERE email = 'ahsanayoub66@gmail.com' AND password = 'hafizasad'");
// $record = getTableDataByCondition("posts", "first_name, last_name, email, user_id, post_description, created_at, updated_at", "INNER JOIN users ON posts.user_id = users.id");
// session_start();
// print_r($_SESSION["email"]);
// $data = insertData('posts', ["user_id","post_description", "created_at", "updated_at"], [(int)$_SESSION["id"], "asdfgh", date("y/m/d"), date("y/m/d")]);
// $data=updateTableData("posts", "post_description = 'post1'", "WHERE id = 1");
// $update = updateTableData("users", "first_name = 'asd', last_name = 'asdf', description = 'asdfg', address = 'asdf', phone = 'asdf'", "WHERE id = '20'");

// print_r($update);
