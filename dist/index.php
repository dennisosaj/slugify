<?php 
echo "<!DOCTYPE html>";
echo "<html lang='en-US'>";
    echo "<head>";
        echo "<title>Slugify</title>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=no'>";
        echo "<meta name='description' content=''>";
        echo "<meta name='keywords' content=''>";
        echo "<link rel='apple-touch-icon' sizes='57x57' href='img/favicon/apple-icon-57x57.png'>";
        echo "<link rel='apple-touch-icon' sizes='60x60' href='img/favicon/apple-icon-60x60.png'>";
        echo "<link rel='apple-touch-icon' sizes='72x72' href='img/favicon/apple-icon-72x72.png'>";
        echo "<link rel='apple-touch-icon' sizes='76x76' href='img/favicon/apple-icon-76x76.png'>";
        echo "<link rel='apple-touch-icon' sizes='114x114' href='img/favicon/apple-icon-114x114.png'>";
        echo "<link rel='apple-touch-icon' sizes='120x120' href='img/favicon/apple-icon-120x120.png'>";
        echo "<link rel='apple-touch-icon' sizes='144x144' href='img/favicon/apple-icon-144x144.png'>";
        echo "<link rel='apple-touch-icon' sizes='152x152' href='img/favicon/apple-icon-152x152.png'>";
        echo "<link rel='apple-touch-icon' sizes='180x180' href='img/favicon/apple-icon-180x180.png'>";
        echo "<link rel='icon' type='image/png' sizes='192x192'  href='img/favicon/android-icon-192x192.png'>";
        echo "<link rel='icon' type='image/png' sizes='32x32' href='img/favicon/favicon-32x32.png'>";
        echo "<link rel='icon' type='image/png' sizes='96x96' href='img/favicon/favicon-96x96.png'>";
        echo "<link rel='icon' type='image/png' sizes='16x16' href='img/favicon/favicon-16x16.png'>";
        echo "<link rel='manifest' href='img/favicon/manifest.json'>";
        echo "<meta name='msapplication-TileColor' content='#ffffff'>";
        echo "<meta name='msapplication-TileImage' content='img/favicon/ms-icon-144x144.png'>";
        echo "<meta name='theme-color' content='#ffffff'>";
        echo "<link rel='stylesheet' href='css/style.css' type='text/css'>";
    echo "</head>";
    echo "<body>";
        echo "<div class='wrapper big'>";
            echo "<div class='container'>";
                echo "<h2 class='mb-150'>Input</h2>";
                echo "<form class='form' action='' method='post'>";
                    echo "<input name='delimeter' placeholder='Delimeter, default: End-Of-Line' class='form__input'>";
                    echo "<input name='whitespace' placeholder='Whitespace, default: \"_\"' class='form__input'>";
                    echo "<textarea name='raw_data' placeholder='Data, multiple possible' class='form__textarea'></textarea>";
                    echo "<input class='button blue full' type='submit' name='submit_raw_data' value='Slugify!'>";
                echo "</form>";
            echo "</div>";
            if ( isset($_POST["submit_raw_data"]) ) :
                echo "<div class='container'>";
                    echo "<h2 class='mb-150'>Output</h2>";
                    echo "<div class='output'>";
                        $delimeter    = !empty($_POST["delimeter"]) ? $_POST["delimeter"] : PHP_EOL;
                        $whitespace   = !empty($_POST["whitespace"]) ? $_POST["whitespace"] : "_";
                        $raw_data_arr = explode($delimeter, $_POST["raw_data"]);
                        foreach ($raw_data_arr as $raw_data) :
                            $slug = strip_tags($raw_data); // Remove Tags
                            $slug = htmlspecialchars($slug); // Escape Special Chars
                            $slug = strtolower($slug); // Lower Case
                            $slug = preg_replace("!\s+!", " ", $slug); // Remove Tab-Stops
                            $slug = str_replace(" ", "-", $slug); // Replace Whitespaces
                            $slug = preg_replace("/[^A-Za-z0-9\-]/", "", $slug); // Remove Special Chars
                            $slug = str_replace("-", $whitespace, $slug); // Replace Former Whitespaces
                            echo $slug."<br>";
                        endforeach;
                    echo "</div>";
                echo "</div>";
                echo "<div class='container'>";
                    echo "<h2 class='mb-150'>Raw</h2>";
                    echo str_replace(PHP_EOL, "<br>", $_POST["raw_data"]);
                echo "</div>";
            endif;
        echo "</div>";
    echo "</body>";
echo "</html>";
?>