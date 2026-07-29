<?php
include("includes/conexao.php");

$id = $_GET['id'];

$sql = "SELECT * FROM perfumes WHERE id='$id'";
$resultado = mysqli_query($conexao,$sql);

$perfume = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<title><?php echo $perfume['nome']; ?></title>

<link rel="stylesheet" href="includes/style.css">

</head>

<body>

<?php include("includes/header.php"); ?>

<div style="text-align:center;margin-top:60px;">

<h1 style="color:#00bfff;">
<?php echo $perfume['nome']; ?>
</h1>

<img src="uploads/<?php echo $perfume['imagem']; ?>" 
style="width:350px;margin-top:30px;border-radius:10px;">

</div>

</body>
</html>