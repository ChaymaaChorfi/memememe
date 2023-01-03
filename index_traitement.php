<?php include('connexion.php')?>
<?php error_reporting (E_ALL ^ E_NOTICE); ?>
<?php
    $cne=$_POST['cne'];
    $requette="select *from etudiants where cne= '".$cne."'";
    $res=mysqli_query($link,$requette);
    $row=mysqli_fetch_assoc($res);
    if($row['cne']==$cne){
        session_start();
        $_SESSION['cne']=$cne;
        $_SESSION['nom']=$row['nom'];
        $_SESSION['prenom']=$row['prenom'];
        $_SESSION['code']=$row['code_etudiant'];
        $_SESSION['nomprenom']=$row['nom'].' '.$row['prenom'] ;
        ?>
<style>
 p{
    display:inline-block;
    margin-right:60px;
 }
 h4{
    font-weight:bold;
    background:lightblue;
    width:400px;
 }
</style>
<form method="post" action="confirmation.php">
<h4>Etudiant</h4>
<table>
<tr>
<td><p>CNE</p></td>
<td><input type="number" name="cne" value="<?php echo $cne; ?>" disabled="disabled"></td>
</tr>
<td><p>Nom et Prenom</p></td>
<td><input type="text" name="nomprenom" value="<?php echo  $_SESSION['nomprenom']; ?>" disabled="disabled"></td>
<tr>
</table>
<table>
<h4>Etat Civil</h4>
<td>Nom</td>
<td><input type="text" name="nom" value="<?php echo $_SESSION['nom']; ?>"></td>
</tr>
<tr>
<td>Prenom</td>
<td><input type="text" name="prenom" value="<?php echo $_SESSION['prenom']; ?>"></td>
</tr>
<tr>
<td>CIN</td>
<td><input type="text" name="cin"></td>
</tr>
<tr>
<td>CNE</td>
<td><input type="text" name="cne" value="<?php echo $cne ?>" disabled="disabled"></td>
</tr>
<tr>
<td>Sexe</td>
<td>
<select name="sexe">
    <option value="H">H</option> 
    <option value="F">F</option> 
</select></td>
</tr>
<td>Situation Familiale</td>
<td>
<select name="situation">
    <option value="celi">Celibataire</option> 
    <option value="mari">Marie</option> 
</select></td>
</tr>
</table>
<table>
<h4>Naissance</h4>
<tr>
    <td>Date Naissance</td>
<td><input type="date" name="date_naiss"></td>
</tr>
<tr>
<td>Ville Naissance</td>
<td><input type="text" name="ville_naiss"></td>
</tr>
<table>
<h4></h4>
</table>
<table>
<tr>
<td>Adresse</td>
<td><input type="text" name="adresse"></td>
</tr>
<td>Province/pays</td>
<td>
    <select name="province">
    <?php 
      $requette1="select *from province ";
      $res=mysqli_query($link,$requette1);
      while($row=mysqli_fetch_assoc($res)){
        echo '<option value="'.$row['code_pro'].'">'.$row['lib_pro'].'</option>';
      }   
    ?>
    </select>
</td>
<tr>
<td>Telephone</td>
<td><input type="number" name="tel"></td>
</tr> 
    </table>

<table>
    <h4>Bac</h4>
    <tr>
        <td>Serie Bac</td>
        <td>  <select name="serie_bac">
    <?php 
      $requette2="select *from bac ";
      $res2=mysqli_query($link,$requette2);
      while($row2=mysqli_fetch_assoc($res2)){
        echo '<option value="'.$row2['code_bac'].'">'.$row2['lib_bac'].'</option>';
      }   
    ?>
    </select>

    </td>
    </tr>
    <tr>
        <td>Mention</td>
        <td>  <select name="mention">
    <?php 
      $requette3="select *from mention ";
      $res3=mysqli_query($link,$requette3);
      while($row3=mysqli_fetch_assoc($res3)){
        echo '<option value="'.$row3['cod_men'].'">'.$row3['lib_men'].'</option>';
      }   
    ?>
    </select>

    </td>
    </tr>
    <tr>
       <td>Annee</td>
       <td><select name="annee">
           <?php 
           for($i=1990;$i<2023;$i++){
            echo '<option value="'.$i.'">'.$i.'</option>';
           }
           
           ?>
    </select></td>
    </tr>

    <tr>
        <td>Etablissement</td>
        <td>  <select name="etb">
    <?php 
      $requette4="select *from etablissement ";
      $res4=mysqli_query($link,$requette4);
      while($row4=mysqli_fetch_assoc($res4)){
        echo '<option value="'.$row4['code_etb'].'">'.$row4['lib_etb'].'</option>';
      }   
    ?>
    </select>

    </td>
    </tr>
<table>
<h4>Photo</h4>
<tr>
<td>Deposer Votre Photo</td>
<td><input type="file" name="image" ></td>
</tr>
</table>
 
<input type="submit" name="inscrire" value="sinscrire" > 

</form>
<?php } ?>
</html>
