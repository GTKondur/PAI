<?php
/* Smarty version 5.8.0, created on 2026-03-24 19:32:57
  from 'file:D:\ksampStudia\htdocs\SzablonSmarty/app/calc.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69c2d8d97efdb6_94108328',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dd27ca028f238116f40829c241a3806d1c4fb1c6' => 
    array (
      0 => 'D:\\ksampStudia\\htdocs\\SzablonSmarty/app/calc.html',
      1 => 1774377094,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69c2d8d97efdb6_94108328 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\ksampStudia\\htdocs\\SzablonSmarty\\app';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Kalkulator kredytowy</title>
</head>

<body>

<h2>Kalkulator kredytowy</h2>

<form method="post">

    <label>Kwota:</label>
    <input type="text" name="kwota" value="<?php echo $_smarty_tpl->getValue('form')['kwota'];?>
" /><br>

    <label>Lata:</label>
    <input type="text" name="lata" value="<?php echo $_smarty_tpl->getValue('form')['lata'];?>
" /><br>

    <label>Oprocentowanie:</label>
    <input type="text" name="oprocentowanie" value="<?php echo $_smarty_tpl->getValue('form')['oprocentowanie'];?>
" /><br>

    <input type="submit" value="Oblicz">

</form>

<?php if ($_smarty_tpl->getValue('messages')) {?>
<ol>
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('messages'), 'msg');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('msg')->value) {
$foreach0DoElse = false;
?>
        <li><?php echo $_smarty_tpl->getValue('msg');?>
</li>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
</ol>
<?php }?>

<?php if ($_smarty_tpl->getValue('result')) {?>
<p>Miesięczna rata: <?php echo $_smarty_tpl->getValue('result');?>
 PLN</p>
<?php }?>

</body>
</html><?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "main.html", $_smarty_current_dir);
}
}
