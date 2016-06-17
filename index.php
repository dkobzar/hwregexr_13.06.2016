<!--1. Проверить введеный мак адресс на верность. Пример: 02:42:d3:48:08:83-->
<form method="post">
    <p>Введите MAC-адрес в формате **:**:**:**:**:**</p>
    <p>где "*" - цифра или буква латинского алфавита</p>
    <input type="text" name="mac"/>
    <input type="submit" name="submit"/>
</form>
<?php
if (!empty($_POST['mac'])) {
    $macString = $_POST['mac'];
    $macString = trim($macString);
    $macPattern = "/^([0-9a-fA-F][0-9a-fA-F](:|-)){5}[0-9a-fA-F][0-9a-fA-F]$/";
    if (preg_match($macPattern, $macString) === 1) {
        echo 'MAC-адрес корректный' . '<br>\n';
    } else {
        echo 'Неверный формат MAC-адреса' . '<br>\n';
    }
}
?>

<!--2. Найти в css файле все hex цвета, заменить их на красный.-->
<?php
$cssPattern = "/#[a-fA-F\d]{3,6}/";
$cssFile = fopen("all.css", "r");
while (!feof($cssFile)) {
    $cssString = fgets($cssFile);
    $modifiedString = preg_replace($cssPattern, "#FF0000", $cssString);
    file_put_contents("result.css", $modifiedString, FILE_APPEND);
}
fclose($cssFile);
?>

<!--3. Выполнить задачу по проверке сложности пароля с использованием регулярных выражений.
Пароль считатется сложным если в нем есть символы нижнего, верхнего регистра, числа, спец символы.-->
<form method="post">
    <p>Введите пароль:</p>
    <input type="password" name="pass"/>
    <input type="submit">
</form>
<?php
if (!empty($_POST['pass'])) {
    if (
        preg_match("/\d+/", $_POST['pass']) &&
        preg_match("/\W+/", $_POST['pass']) &&
        preg_match("/[a-zA-Z]+/", $_POST['pass'])
    ) {
        echo 'Пароль валидный' . '<br>';
    } else {
        echo 'Пароль невалидный' . '<br>';
    }
}
?>

<!--4. Выполнить поиск IP адресов (например 192.168.0.1) в строке, вернуть массив, оформит как функцию-->
<?php
function checkIP($ipString)
{
    $ipPattern = "/(25[0-5]|2[0-4][0-9]|[0-1][0-9]{2}|[0-9]{2}|[0-9])(\.(25[0-5]|2[0-4][0-9]|[0-1][0-9]{2}|[0-9]{2}|[0-9])){3}/";
    preg_match_all($ipPattern, $ipString, $matches, PREG_PATTERN_ORDER);
    $ipArray = $matches[0];
    return $ipArray;
}
$ip = "Используемые IP-адреса: 192.168.0.1, 192.168.10.1, 10.50.120.120, 95.120.254.10";
print_r(checkIP($ip));
?>