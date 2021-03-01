<?php
header("Content-type: application/json");


try{
  $pdo = new PDO('mysql:89.234.180.33;port=3306;dbname=ApiFilms','marinech','Ma12ch72');
}catch(Exception $e){
  $retour["succes"]=false;
  $retour["message"]="Probème de connexion à la BD";
}

if(!empty($_GET["title"]) && !empty($_GET["description"]) && !empty($_GET["id_auteurs"]) && !empty($_GET["id_categories"])){
  $query = $pdo->prepare("INSERT INTO `Films` (`id`, `title`,`description`,`id_auteurs`,`id_categories`) VALUES (NULL,:title,:descript,:id_auteurs,:id_categories)");
  $query->bindParam(':title', $_GET['title']);
  $query->bindParam(':descript', $_GET['description']);
  $query->bindParam(':id_auteurs', $_GET['id_auteurs']);
  $query->bindParam(':id_categories', $_GET['id_categories']);
  $query->execute();
  $retour['message']="Votre film à bien été créée";

}else{

  $retour["message"]="Les paramètres GET entrés sont incorrects. Champs a rentrer : title,description, id_auteurs, id_categories.";
  $retour['URL']="Formule URL: ?title=test ";
}

echo json_encode($retour);

 ?>
