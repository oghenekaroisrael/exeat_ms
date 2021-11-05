<?php 
include_once('../inc/db.php');
if (isset($_POST['role']) && $_POST['role'] == 'hall_admin') {
    $halls = Database::getInstance()->select('Halls');
    foreach ($halls as $hall) {
        echo '<option value="'.$hall['id'].'">'.$hall['hallName'].'</option>';
    }
}else if (isset($_POST['role']) && $_POST['role'] == 'department') {
    $depts = Database::getInstance()->select('Departments');
    foreach ($depts as $dept) {
        echo '<option value="'.$dept['id'].'">'.$dept['departmentName'].'</option>';
    }
}else if (isset($_POST['role']) && $_POST['role'] == 'chapel') {
    $chapels = Database::getInstance()->select('Chapels');
    foreach ($chapels as $chapel) {
        echo '<option value="'.$chapel['id'].'">'.$chapel['chapelName'].'</option>';
    }
}

?>