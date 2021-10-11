<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=no'>
    <title>Slug-Tool</title>
</head>
<body>
    <form action='' method='post'>
        <textarea name='raw_data' placeholder='One per line'></textarea>
        <input type='submit' name='submit_raw_data' value='Slugify!'>
    </form>
    <?php 
    
    if ( isset($_POST["submit_raw_data"]) ) :
        $raw_data_arr = explode(PHP_EOL, htmlspecialchars($_POST["raw_data"]));
        foreach ($raw_data_arr as $raw_data) :
            $slug = strtolower($raw_data);
            $slug = str_replace(" ", "-", $slug);
            $slug = preg_replace("/[^A-Za-z0-9\-]/", "", $slug);
            $slug = str_replace("-", "_", $slug);
            echo $slug."<br>";
        endforeach;
    endif;
    
    ?>
</body>
</html>