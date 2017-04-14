<?php 
    $uploaded = [];
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($_FILES['file'])) {
            $files = $_FILES['file'];
            foreach($files['name'] as $key =>  $name) {
                if ($files['error'][$key] == 0 && move_uploaded_file($files['tmp_name'][$key], "files/{$name}")) {
                    $uploaded[] = $name;
                }
            }
        }

        die(json_encode($uploaded));
    }

    // print_r($uploaded);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PHP - File Upload with Progress Indicator</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            #upload-progress {
                //display: none;
            }
        </style>
    </head>
    <body>
    
    <div id="uploaded">
        <?php 
            if (!empty($uploaded)) {
                foreach($uploaded as $name) {
                    echo "<p><a href=''>{$name}</a></p>";
                }
            }
        ?>
    </div>
    <div id="upload-progress"></div>
    <div>
        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <input type="file" id="file" name="file[]" multiple />
                <input type="submit" id="submit" value="Upload" />
            </div>
        </form>
    </div>

    <script src="upload.js"></script>
    </body>
</html>