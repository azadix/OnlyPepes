<?php
//--------------------------------------------------------------------------------------------------------------
//PHP part
//-------------------------------------------------------------------------------------------------------------- 
    require_once "php/DatabaseOperations.php";
    
//--------------------------------------------------------------------------------------------------------------
//HTML part
//--------------------------------------------------------------------------------------------------------------
    require_once "templates/top.html";
    echo '<div id="content">';

    $files = $connection->query("SELECT `name`,`fileName`,`extension` FROM `pepelist`");
    
    foreach ($files as $pepe){
        echo "<div class='pepe'>";
        echo "<h2>{$pepe['name']}</h2>";
        echo "<img src='pepes/{$pepe['fileName']}.{$pepe['extension']}' class='imagePepe' />";
        echo "<hr style='height:1px;border-width:0;color:gray;background-color:gray'/>";
        echo "</div>";
    };

    echo '</div>';
    echo '</body></html>';
?>