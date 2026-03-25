<?php
/* Smarty version 5.8.0, created on 2026-03-25 20:39:15
  from 'file:D:\ksampStudia\htdocs\SzablonSmarty\app\../templates/main.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69c439e3519a16_48981359',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7c7f99af446c25a7c6c6d11ae1f990d306e8f034' => 
    array (
      0 => 'D:\\ksampStudia\\htdocs\\SzablonSmarty\\app\\../templates/main.html',
      1 => 1774467553,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69c439e3519a16_48981359 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\ksampStudia\\htdocs\\SzablonSmarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
?>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (($tmp = $_smarty_tpl->getValue('page_title') ?? null)===null||$tmp==='' ? "Kalkulator" ?? null : $tmp);?>
</title>

    <link rel="stylesheet" href="<?php echo $_smarty_tpl->getValue('app_url');?>
/assets/css/main.css">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->getValue('app_url');?>
/assets/css/fontawesome-all.min.css">
    
    <noscript>
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->getValue('app_url');?>
/assets/css/noscript.css">
    </noscript>
</head>
<body>

<header style="text-align: center; margin: 1em; border: 1px solid #ccc; padding: 1em;">
    <h1>Kalkulator kredytowy</h1>
</header>

<div style="margin: 1em; border: px solid #ccc; padding: 1em;">
    <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_164583947569c439e3512223_03293216', 'content');
?>

</div>

<div class="footer" style="text-align:center; margin-top:3em; border: 1px solid #ccc; padding: 1em;">
    <p>Autor: Konrad Kucharski</p>
</div>

</body>
</html><?php }
/* {block 'content'} */
class Block_164583947569c439e3512223_03293216 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\ksampStudia\\htdocs\\SzablonSmarty\\templates';
?>
 
        <?php
}
}
/* {/block 'content'} */
}
