<? include 'lib/config.php';
/* include 'header.php';
include 'pages/promise.php';
include 'footer.php';
*/
if ($iid) header('Location: '.MAIN_URL.'#!promise?i='.$iid);
else header('Location: '.MAIN_URL.'#!promise')
 ?>
