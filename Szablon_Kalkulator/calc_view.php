<form action="index.php" method="post">

    <label>Kwota kredytu (PLN): </label>
    <input id="id_kwota" type="text" name="kwota" value="<?php print($kwota); ?>" /><br />

    <label>Liczba lat: </label>
    <input id="id_lata" type="text" name="lata" value="<?php print($lata); ?>" /><br />

    <label>Oprocentowanie (%): </label>
    <input id="id_op" type="text" name="oprocentowanie" value="<?php print($oprocentowanie); ?>" /><br />

    <input type="submit" value="Oblicz" />

</form>

<?php
if (!empty($messages)) {
    echo "<ol>";
    foreach ($messages as $msg) {
        echo "<li>$msg</li>";
    }
    echo "</ol>";
}
?>

<?php if (isset($result)) { ?>
<div>
    <?php echo 'Miesięczna rata: ' . $result . ' PLN'; ?>
</div>
<?php } ?>

