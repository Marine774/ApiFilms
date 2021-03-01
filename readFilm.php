<?php
header("Content-type: application/json");


try{
  $pdo = new PDO('mysql:89.234.180.33;port=3306;dbname=ApiFilms','marinech','Ma12ch72');

}catch(Exception $e){
  $retour["succes"]=false;
  $retour["message"]="Connexion API REST Failed";
}

if(!empty($_GET["nom"]) && !empty($_GET['prenom'])){
  $query=$pdo->prepare("SELECT title,description,Auteurs.nom,Auteurs.prenom,Categories.libelle FROM Films
  INNER JOIN Auteurs ON Auteurs.id =Films.id_auteurs
  INNER JOIN Categories ON Categories.id =Films.id_categories
  WHERE Auteurs.nom=:nom AND Auteurs.prenom=:prenom");
    $query->bindParam(':nom', $_GET['nom']);
    $query->bindParam(':prenom', $_GET['prenom']);

}else{
  $query=$pdo->prepare("SELECT title,img FROM Films");
}

$query->execute();

$retour['Films'] = $query->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($retour);
 ?>
