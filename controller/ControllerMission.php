<?php
require_once (File::build_path(array(
    'model',
    'ModelMission.php'
)));

// chargement du modèle
class ControllerMission
{

    public static function updatedMission()
    {
        $cooks = unserialize($_COOKIE['mission']);

        $found = false;

        foreach ($cooks[1] as $c) {
            if ($c[1] == 0) {
                $found = true;
            }
        }

        if ($found) {
            echo ("Vous n'avez pas réussi a effectuer la mission<br>Vérifiez que tout est prêt !");
            ControllerNotification::display();         
        } else {
            $cooks[0] = $cooks[0] + 1;

            if ($cooks[0] > 5) {
                require_once File::build_path(array(
                    'view',
                    'global',
                    'fin.php'
                ));
            } else {
                setcookie("mission", "", time() - 1, "/"); // On supprime le cookie
                setcookie("mission", serialize($cooks), time() + 86400 * 30, "/"); // On supprime le cookie
                ControllerMeteo::display();
            }
        }
    }
}

?>
