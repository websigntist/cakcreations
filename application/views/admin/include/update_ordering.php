<?php
if (isset($_GET["user_ordering"])) {
    $id_ary = explode(",", $_GET["user_ordering"]);
    for ($i = 0; $i < count($id_ary); $i++) {
        $sql = "UPDATE users SET ordering ='" . ($i + 1) . "' WHERE id=" . $id_ary[$i];
        $db->query($sql);
    }
}
