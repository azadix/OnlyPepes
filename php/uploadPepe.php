<?php  
    require_once "DatabaseOperations.php";
    
    
    function generatemd5Hash($original, $uploadTime) {
        $hash = md5($original . $uploadTime);
        return $hash;
    }

    $uploadStatus = 1;
    $originalFilename = basename($_FILES["uploadImage"]["name"]);
    $filePrompt = htmlspecialchars($_POST['name']);
    $imageExtension = strtolower(pathinfo($originalFilename, PATHINFO_EXTENSION));
    $uploadTime = time();

    var_dump($filePrompt);

    //Define empty array to store error messages
    $errorMessage = array();    
    
    $randomFilename =  generatemd5Hash($originalFilename, $uploadTime);
    $fileSaveDirectory = "../pepes/{$randomFilename}.{$imageExtension}";
    
    if (isset($_POST["submit"])) {
        $checkExtenstions = getimagesize($_FILES["uploadImage"]["tmp_name"]);
        
        if ($checkExtenstions !== false) {
            $uploadStatus = 1;
        } else {
            array_push($errorMessage, "Wrong extenstion");
            $uploadStatus = 0;
        }
    }

    //Check if already exists
    if (file_exists($fileSaveDirectory)) {
        array_push($errorMessage, "File with this name is already on server");
        $uploadStatus = 0;
    }

    //Check file if filesize is above 1MB
    if ($_FILES["uploadImage"]["size"] > 1000000) {
        array_push($errorMessage, "Sorry, your file is too large. Maximum size allowed is 1Mb");
        $uploadStatus = 0;
    }

    //Check if file passed all check
    if ($uploadStatus == 1) {
        if (move_uploaded_file($_FILES["uploadImage"]["tmp_name"], $fileSaveDirectory)) {
            array_push($errorMessage, "The file " . $randomFilename . " has been uploaded.");
            $userID = 1;
            $qr = "INSERT INTO 
                        pepelist (
                            name, 
                            uploaderId, 
                            uploadTime, 
                            fileName,
                            extension
                        )
                    VALUES (
                        `{$filePrompt}`,
                        `{$userID}`,
                        `{$uploadTime}`,
                        `{$randomFilename}`,
                        `{$imageExtension}`
                    )";
                    var_dump($qr);
            $connection->query($qr);
        } else {
            array_push($errorMessage, "Sorry, there was an error uploading your file.");
        }
    }

    //header("Location: ../index.php");
    foreach ($errorMessage as $message){
        echo $message;
    }
    exit;
?>