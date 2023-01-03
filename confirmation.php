<?php include('connexion.php') ?>
<?php error_reporting (E_ALL ^ E_NOTICE); ?>
<?php 
session_start();
$cne=$_SESSION['cne'];
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$cin=$_POST['cin'];
$sexe=$_POST['sexe'];
$situation=$_POST['situation'];
$date_naiss=$_POST['date_naiss'];
$ville_naiss=$_POST['ville_naiss'];
$adresse=$_POST['adresse'];
$province=$_POST['province'];
$tel=$_POST['tel'];
$serie_bac=$_POST['serie_bac'];
$mention=$_POST['mention'];
$annee=$_POST['annee'];
$etb=$_POST['etb'];
$code=$_SESSION['code'];
if(isset($_FILES['image']) and $_FILES['image']['error']==0)
    {
        $dossier= 'photo/';
        $temp_name=$_FILES['image']['tmp_name'];
        if(!is_uploaded_file($temp_name))
        {
        exit("le fichier est untrouvable");
        }
        if ($_FILES['image']['size'] >= 1000000){
            exit("Erreur, le fichier est volumineux");
        }
        $infosfichier = pathinfo($_FILES['image']['name']);
        $extension_upload = $infosfichier['extension'];
        
        $extension_upload = strtolower($extension_upload);
        $extensions_autorisees = array('png','jpeg','jpg');
        if (!in_array($extension_upload, $extensions_autorisees))
        {
        exit("Erreur, Veuillez inserer une image svp (extensions autorisées: png)");
        }
        $nom_photo=$code.".".$extension_upload;
        if(!move_uploaded_file($temp_name,$dossier.$nom_photo)){
        exit("Problem dans le telechargement de l'image, Ressayez");
        }
        $num_photo=$nom_photo;
}
else{
    $num_photo="2.jpg";
}    
$reque="select *from etudiants where cne='".$cne."'";
$re=mysqli_query($link,$reque);
$ro=mysqli_fetch_assoc($re);
$code=$ro['code_etudiant'];

$code_etudiant=$_SESSION['code'];
$sql2="UPDATE `etudiants` SET  `sexe`='$sexe',`date_naissance`='$date_naiss',`ville_naissance`='$ville_naiss',`situation_familliale`='$situation', `adresse`='$adresse',`code_pro`='$province',`tel`='$tel',`photo`='$num_photo' WHERE `cne`='".$cne."'";
$res2=mysqli_query($link,$sql2);


$requette2="INSERT INTO `bac_etudiant` (`code_etudiant`, `code_bac`, `code_men`, `annee_obt_bac`, `code_etb`) VALUES ('$code','$serie_bac','$mention','$annee','$etb') ";
$res=mysqli_query($link,$requette2);
    $requette3="select *from etudiants where code_etudiant='".$code_etudiant."'";
    $res3=mysqli_query($link,$requette3);
    $row3=mysqli_fetch_assoc($res3);
?>

<html>

<p>Nom :</p> <?php echo $row3['nom'] ?>
<p>Prenom :</p> <?php echo $row3['prenom'] ?>
<p>Sexe :</p> <?php echo $row3['sexe'] ?>
<p>Ville Naissance :</p> <?php echo $row3['ville_naissance'] ?>
<p>Date Naissance :</p> <?php echo $row3['date_naissance'] ?>
<p>situation familiale :</p> <?php echo $row3['situation_familliale'] ?>
<p>CNE :</p> <?php echo $row3['cne'] ?>
<p>Adresse :</p> <?php echo $row3['adresse'] ?>
<p>code province :</p> <?php echo $row3['code_pro'] ?>
<p>Telephone :</p> <?php echo $row3['tel'] ?>
<?php $image=$row3['photo']  ?>
<p>Photo</p>
<?php  echo "<p><img style='height:50px ; width:50px;' src=photo/".$image."></p>" ?>
<p>Province / Pays</p>
<?php 
$requette4="select *from province where code_pro='".$province."'" ;
$res4=mysqli_query($link,$requette4);
$row4=mysqli_fetch_assoc($res4);
echo $row4['lib_pro'];
?>

<p>Mention</p>
<?php 
$requette5="select *from mention where cod_men='".$mention."'" ;
$res5=mysqli_query($link,$requette5);
$row5=mysqli_fetch_assoc($res5);
echo $row5['lib_men'];
?>







</html>
    