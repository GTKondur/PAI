<?php
/* Smarty version 5.8.0, created on 2026-03-25 20:40:26
  from 'file:D:\ksampStudia\htdocs\SzablonSmarty/app/calc.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69c43a2a567c58_80355542',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd4dbc005ec16403f57a38ee6738c40e96d6924c3' => 
    array (
      0 => 'D:\\ksampStudia\\htdocs\\SzablonSmarty/app/calc.html',
      1 => 1774467625,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69c43a2a567c58_80355542 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\ksampStudia\\htdocs\\SzablonSmarty\\app';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_163728329469c43a2a54feb7_66959757', 'content');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_119592488869c43a2a567288_44937668', 'footer');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "../templates/main.html", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_163728329469c43a2a54feb7_66959757 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\ksampStudia\\htdocs\\SzablonSmarty\\app';
?>


<h2 class="content-head is-center">Kalkulator kredytowy</h2>

<div>
    <div>
        <form action="<?php echo $_smarty_tpl->getValue('app_url');?>
/index.php" method="post">
            <fieldset>
                <label for="id_kwota">Kwota:</label>
                <input id="id_kwota" type="text" name="kwota" value="<?php echo $_smarty_tpl->getValue('form')['kwota'];?>
">

                <label for="id_lata">Lata:</label>
                <input id="id_lata" type="text" name="lata" value="<?php echo $_smarty_tpl->getValue('form')['lata'];?>
">

                <label for="id_oprocentowanie">Oprocentowanie (%):</label>
                <input id="id_oprocentowanie" type="text" name="oprocentowanie" value="<?php echo $_smarty_tpl->getValue('form')['oprocentowanie'];?>
">

                <button type="submit" style="margin: center">Oblicz ratę</button>
            </fieldset>
        </form>
    </div>

    <div >
        <?php if ($_smarty_tpl->getValue('messages')) {?>
            <div >
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
            </div>
        <?php }?>

        <?php if ((true && ($_smarty_tpl->hasVariable('result') && null !== ($_smarty_tpl->getValue('result') ?? null)))) {?>
            <div>
                <h4>Miesięczna rata:</h4>
                <p><?php echo $_smarty_tpl->getValue('result');?>
 PLN</p>
            </div>
        <?php }?>
    </div>
</div>

<?php
}
}
/* {/block 'content'} */
/* {block 'footer'} */
class Block_119592488869c43a2a567288_44937668 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\ksampStudia\\htdocs\\SzablonSmarty\\app';
?>

    Autor: Konrad Kucharski
<?php
}
}
/* {/block 'footer'} */
}
