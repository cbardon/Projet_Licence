<?php
    if(!empty($_GET['Nom']) && !empty($_GET['email']) && !empty($_GET['Objet']) && !empty($_GET['Message']))
    {
        $TO = "admin@clementbardon.com";
    
        $h  = "From: " . $TO;
    
        $message = "";
    
            while (list($key, $val) = each($_GET)) {
                
                $message .= "$key : $val\n";
            }
    
        mail($TO, $subject, $message, $h);
    
        Header("Location: http://clementbardon.com/test/web/index.php/");
    }else

    Header("Location:  http://clementbardon.com/test/web/index.php/erreur/1");

?>