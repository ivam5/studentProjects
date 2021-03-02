<?php

include("functions.php");

echo '
<section id="two" class="wrapper style1 special">
    <div class="inner">
        <header>
            <h2>Ipsum Feugiat</h2>
            <p>Semper suscipit posuere apede</p>
        </header>
        <div class="flex flex-4">';
        
        if(is_array($file_array))
        {
            foreach($file_array as $employee)
            {
                echo '
                    <div class="box person">
                        <div class="image round">
                            <img src="images/'.$employee["Slika"].'.jpg" alt="Person '.$employee["Slika"].'" />
                        </div>
                        <h3>'.$employee["Ime"].''." ".''.$employee["Prezime"].'</h3>
                        <p>'.$employee["Titula"].'</p>
                    </div>';
            }
            };

 echo'
                </div>
            </div>
        </div>
    </section>';