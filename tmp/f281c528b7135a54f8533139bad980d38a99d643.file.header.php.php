<?php /* Smarty version Smarty-3.0.8, created on 2015-07-26 16:42:32
         compiled from "view/header.php" */ ?>
<?php /*%%SmartyHeaderCode:36874848255b4f1d8012af8-23528285%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f281c528b7135a54f8533139bad980d38a99d643' => 
    array (
      0 => 'view/header.php',
      1 => 1437750653,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '36874848255b4f1d8012af8-23528285',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<header id="header">
    <nav id="nav">
      <div id="logo-float">
        <a class="logo" href="/" >
          <img src="/image/logo.png" width="180px">
        </a>
      </div>
      <div style="margin-left:220px;">
        <a href="/">Developer</a>
        <a href="/">User</a>
        <a href="/">FAQ</a>
        <a href="/">About</a>
      </div>
      <div id="top-float">
        <a class="ui basic button" style="padding: 10px 20px;font-size:12px;" href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'login'),$_smarty_tpl);?>
">Log In</a>
        <a class="ui black button" style="padding: 10px 20px;font-size:12px;background-color:#343434;color:#fff;"
         href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'signup'),$_smarty_tpl);?>
">Sign Up</a>
      </div>
    </nav>

</header>
