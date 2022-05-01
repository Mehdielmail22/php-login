<?php
session_start();
// Connexion la base de données
// mysql_connect('mysql:host=localhost;dbname=hy', 'root', '');
// mysql_selectdb("hy");
$connex=new PDO('mysql:host=localhost;dbname=hy', 'root', '');
?>
<html>
<head></head>
<body>
<form method="post" action="login.php">
Login : <input type="text" name="log" /><br />
Password : <input type="password" name="pass" /><br />
<input type="submit" value="Entrer" />
</form>
<?php
if (isset ($_POST['log'])){
$login = $_POST["log"];
$password = $_POST["pass"];
$sql = "SELECT * FROM user WHERE login='$login' AND
password='$password'";
$a=$connex->query($sql);
$row=$a->fetchAll(\PDO::FETCH_ASSOC);
if (!$row){
 // ici l’utilisateur n’est pas reconnu
 $_SESSION["msg"] = "Votre login ou mot de passe est incorrect";
 ?>
 <h3 align="left"><?php echo $_SESSION["msg"]; ?></h3>
 <?php
 $a=0;
 }
 else {
 // Ici l’utilisateur a fourni les bonnes informations
 $_SESSION["login"] = 1;
 $_SESSION["msg"] ="Bienvenu M. " . $row[0]['login'];
 ?>
 <h3 align="left"><?php echo $_SESSION["msg"]; ?></h3>

 <!-- <h3 align="left"><?php echo $_SESSION["msg"]; ?></h3> -->
 <?php
 echo "<div class='bienvenu'></div><h2>Ma page protégée</h2><a
href='login.php?fer=1'>Logout</a>";
 }

}
if (isset ($_POST['fer'])){
 session_start();
session_destroy();
}
?>
</body>
</html>