<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type,Accept');

include_once '../../models/users.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($user->validate_params($_POST['CollegeID'])) {
        $user->CollegeID = $_POST['CollegeID'];
    } else {
        echo json_encode(array('Success' => 0, 'message' => 'CollegeID is Required'));
        die();
    }
    if ($user->validate_params($_POST['Name'])) {
        $user->Name = $_POST['Name'];
    } else {
        echo json_encode(array('Success' => 0, 'message' => 'Name is Required'));
        die();
    }
    if ($user->validate_params($_POST['sur_name'])) {
        $user->sur_name = $_POST['sur_name'];
    } else {
        echo json_encode(array('Success' => 0, 'message' => 'Last Name is Required'));
        die();
    }
    $user_image_folder = '../../assets/user_images/';

    if (!is_dir($user_image_folder)) {
        mkdir($user_image_folder, 0, true);
    }

    if (isset($_FILES['image'])) {
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $extension = end(explode('.', $file_name));

        $new_file_name = $user->email . "_profile" . $extension;
        move_uploaded_file($file_tmp, $user_image_folder . "/" . $new_file_name);

        $user->image = 'user_image/' . $new_file_name;
    }
    if ($user->validate_params($_POST['phone'])) {
        $user->phone = $_POST['phone'];
    } else {
        echo json_encode(array('Success' => 0, 'message' => 'Phone Number is Required'));
        die();
    }
    if ($user->validate_params($_POST['email'])) {
        $user->email = $_POST['email'];
    } else {
        echo json_encode(array('Success' => 0, 'message' => 'Email is Required'));
        die();
    }
    if ($user->validate_params($_POST['pass'])) {
        $user->pass = $_POST['pass'];
    } else {
        echo json_encode(array('Success' => 0, 'message' => 'Password is Required'));
        die();
    }
    if ($user->validate_params($_POST['role'])) {
        $user->role = $_POST['role'];
    } else {
        echo json_encode(array('Success' => 0, 'message' => 'Your role is Required'));
        die();
    }
    if ($user->validate_params($_POST['dept'])) {
        $user->dept = $_POST['dept'];
    } else {
        echo json_encode(array('Success' => 0, 'message' => 'Department is Required'));
        die();
    }
    if ($user->validate_params($_POST['isadmin'])) {
        $user->isadmin = $_POST['isadmin'];
    } else {
        echo json_encode(array('Success' => 0, 'message' => 'Select whether you are an Admin'));
        die();
    }
    if ($user->validate_params($_POST['gender'])) {
        $user->gender = $_POST['gender'];
    } else {
        echo json_encode(array('Success' => 0, 'message' => 'Your Gender is Required'));
        die();
    }

    if ($id = $user->register_user()) {
        echo json_encode(array('success' => 1, 'message' => 'User Registered!'));
    } else {
        http_response_code(500);
        echo json_encode(array('success' => 0, 'message' => 'Internal Server Error'));
    }
} else {
    die(header('HTTP/1.1 405 Request Method Not Allowed'));
}

?>