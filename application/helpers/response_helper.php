<?php

function successResponse($message, $data = [])
{
    $response = ["success" => true, "message" => "$message", "data" => $data];
    $ci = &get_instance();
    echo  $ci->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response))
        ->_display();
    exit();
}
function successResponse1($message, $data = [])
{
    $response = array_merge(["success" => true, "message" => "$message"], $data);

    $ci = &get_instance();
    echo  $ci->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response))
        ->_display();
    exit();
}
function failureRessponse($message, $data = [])
{
    $response = ["success" => false, "message" => $message, "data" => $data];
    $ci = &get_instance();
    echo  $ci->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response))
        ->_display();
    exit();
}
function createImage($imageData, $imageName, $path)
{
    if (strlen($imageData) < 256) {
        return $imageData;
    }
    $splited = explode(',', substr($imageData, 5), 2);

    $mime = $splited[0];
    $data = $splited[1];
    $mime_split_without_base64 = explode(';', $mime, 2);
    $mime_split = explode('/', $mime_split_without_base64[0], 2);

    if (count($mime_split) == 2) {
        if (preg_match('~\.(png|gif|jpe?g|bmp|jpg|jpeg)~i', $imageName)) {
            $output_file_with_extension = $imageName;
        } else {
            $extension = $mime_split[1];
            if ($extension == 'jpeg') $extension = 'jpg';
            $output_file_with_extension = implode(".", [$imageName, $extension]);
        }
        if (!file_exists(UPLOADDIR . $path)) {
            mkdir(UPLOADDIR . $path, 0777, true);
        }
        file_put_contents(UPLOADDIR . $path . $output_file_with_extension, base64_decode($data));
        return  $path .  $output_file_with_extension;
    }
    return false;
}
function handleFileUpload($file, $identifier)
{
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filePath = "studentImage/{$identifier}." . $ext;

    if (!is_dir(UPLOADDIR . "studentImage/")) {
        mkdir(UPLOADDIR . "studentImage/", 0777, true);
    }

    if (!move_uploaded_file($file['tmp_name'], UPLOADDIR . $filePath)) {
        return false;
    }

    return $filePath;
}


function getFinanical_year()
{
    $current_year = date('Y');
    $current_month = date('m');

    return ($current_month < 4)  ? ($current_year - 1) . "-" . $current_year : $current_year . "-" . ($current_year + 1);
}
