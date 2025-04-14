<?php
setcookie('pseudo','BOB', time()+100, "/", true, true);
// setcookie (nom_cookie, valeur_, date_expiration, chemin, domaine, securite, httponly)

echo "cookie créer";

/*if (isset($_COOKIE['pseudo'])) {
    
    echo "<br> cookie que j'ai créer est: "  . $_COOKIE['pseudo'];

} else {
    echo "cookie non créer";
} */

setcookie('pseudo','BOB', time()-100, "/", true, true);


?>
