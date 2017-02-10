<!DOCTYPE html> 
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta content="width=device-width, minimum-scale=1, maximum-scale=1" name="viewport"> 
    <title>Easter Date</title>
</head>
<body>
<?php
date_default_timezone_set("Europe/Zurich");
include("easter.php");
$easter = new Easter();
?>
<h1>Easter Date Gregorian</h1>

<?php
for ($y = 1900; $y <= 2050; $y++) {
    echo "<br>". strftime("%d.%m.%Y", $easter->GetGregorian($y))." : ".strftime("%D", $easter->GetGregorian($y));
}

?>

<h1>Easter Date Julian</h1>
<?php
for ($y = 1900; $y <= 2050; $y++) {
    echo "<br>".strftime("%d.%m.%Y", $easter->GetGregorian($y))." : ".strftime("%D", $easter->GetJulian($y));
}
?>

</body>
</html>
