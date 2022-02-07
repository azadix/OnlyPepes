<?php
//--------------------------------------------------------------------------------------------------------------
//PHP part
//--------------------------------------------------------------------------------------------------------------



//--------------------------------------------------------------------------------------------------------------
//HTML part
//--------------------------------------------------------------------------------------------------------------
    require_once "templates/top.html";

    
?>
    <div id="content">
        <p>
            Wybierz zdjęcie do wysłania: (wyłącznie pliki o *.jpg, *.jpeg, *.bmp, *.png)<br />
            Maksymalny rozmiar pliku to 1Mb.
        </p>

        <form action="php/uploadPepe.php" method="POST" enctype="multipart/form-data">
            <label for="name">Nazwa Pepe</label>
            <input type="text" id="name" name="name" placeholder="Wpisz nazwe Pepe" required /><br />
            
            <input id="uploadImage" type="file" accept="image/png, image/jpeg, image/bmp" name="uploadImage" required /><br />
            <input type="submit" value="Dodaj">
        </form>
    </div>
    </body>
</html>