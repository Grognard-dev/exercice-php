<!DOCTYPE html >
<html lang="fr">
<head>
    <title>Test Base de donnée</title>
</head>
<body>
    <h1>cinema</h1>
    <form method="post" action="exo_formulaire.php">
        <div class="formulaire">
            <input type="text" class="form-control" placeholder="id" name="id_cinema" value="<?= htmlentities($id_cinema ?? '') ?>">
        </div>
        <div class="formulaire">
            <input type="text" class="form-control"  placeholder="nom cinema" name="nom_cinema" value="<?= htmlentities($nom_cinema ?? '') ?>">
        </div>
        <div class="formulaire">
            <input type="text" class="form-control"  placeholder="ville cinema" name="ville_cinema" value="<?= htmlentities($ville_cinema ?? '') ?>">
        </div>
        <div class="formulaire">
            <input type="text" class="form-control"  placeholder="adresse cinema" name="adresse_cinema" value="<?= htmlentities($adresse_cinema ?? '') ?>">
        </div>
        <div class="formulaire">
            <input type="email" class="form-control"  placeholder="email cinema" name="mail_cinema" value="<?= htmlentities($mail_cinema ?? '') ?>">
        </div>
        <div class="formulaire">
            <input type="text" class="form-control"  placeholder="telephone cinema" name="telephone_cinema" value="<?= htmlentities($telephone_cinema ?? '') ?>">
        </div>
        <div class="bouton">
            <button type="submit" name="bouton" class="btn btn-primary mb-2">Envoyé</button>
        </div>
    </form>

    
        </body>
        <?php
        $user = "dbu164958";
        $pass = "***REMOVED***";
        
        $dbh = new PDO('mysql:host=db5000303931.hosting-data.io;dbname=dbs296967', $user, $pass);
    
     if (isset($_POST['bouton'])){
        $id_cinema = empty($_POST['id_cinema']) ? null : $_POST['id_cinema'];
        $nom_cinema = empty($_POST['nom_cinema']) ? null : $_POST['nom_cinema'];
        $ville_cinema = empty($_POST['ville_cinema']) ? null : $_POST['ville_cinema'];
        $adresse_cinema = empty($_POST['adresse_cinema']) ? null : $_POST['adresse_cinema'];
        $mail_cinema = empty($_POST['mail_cinema']) ? null : $_POST['mail_cinema'];
        $telephone_cinema = empty($_POST['telephone_cinema']) ? null : $_POST['telephone_cinema'];
        if ($id_cinema === null || $nom_cinema === null || $ville_cinema === null || $adresse_cinema === null || $mail_cinema === null || $telephone_cinema === null) {
        echo '404 error';
     }else {
       $pdoStat = $dbh->prepare ("INSERT INTO cinema (id_cinema, nom_cinema, ville_cinema, adresse_cinema, mail_cinema, telephone_cinema) VALUES (:id_cinema, :nom_cinema, :ville_cinema, :adresse_cinema, :mail_cinema, :telephone_cinema)") ;
        
        $pdoStat->bindValue(':id_cinema', $id_cinema);
        $pdoStat->bindValue(':nom_cinema', $nom_cinema);
        $pdoStat->bindValue(':ville_cinema', $ville_cinema);
        $pdoStat->bindValue(':adresse_cinema', $adresse_cinema);
        $pdoStat->bindValue(':mail_cinema', $mail_cinema);
        $pdoStat->bindValue(':telephone_cinema', $telephone_cinema);
        
        $pdoStat->execute();
    }
        $sth = $dbh->prepare("SELECT id_cinema, nom_cinema, ville_cinema, adresse_cinema, mail_cinema, telephone_cinema FROM cinema");
    $sth->execute();
    $result = $sth->fetchAll();
    echo "les cinema <br>";
    echo "<br>";
    foreach($result as $tableau){
        echo "cinema <br>". '<br> ' .$tableau['id_cinema']. '<br>' .$tableau['nom_cinema']. ' <br>' .$tableau['ville_cinema']. '<br>' .$tableau['adresse_cinema']. '<br>' .$tableau['telephone_cinema']. '<br>';
    }
    echo "<br>";
    echo "les equipement <br>";
    echo "<br>";
     $sth = $dbh->prepare("SELECT id_equipement, nom_equipement FROM equipement");
    $sth->execute();
    $result = $sth->fetchAll();
    
    foreach($result as $tableau){
        echo " equipement <br>". '<br> ' .$tableau['id_equipement']. '<br>' .$tableau['nom_equipement']. '<br>';
    }
    echo "<br>";
    echo " les salle <br>";
    echo "<br>";
    $sth = $dbh->prepare("SELECT id_salle, numero_salle, capacite_salle, id_cinema FROM salle");
    $sth->execute();
    $result = $sth->fetchAll();
    
    foreach($result as $tableau){
        echo   "salle <br>". '<br> ' .$tableau['id_salle']. '<br>' .$tableau['numero_salle']. '<br>'.$tableau['capacite_salle']. '<br>'.$tableau['id_cinema']. '<br>';
    }
     
     }
    

?>
        </html>