<?php
// no direct access
defined('_JEXEC') or die;

$facebook = new Facebook(array(
	'appId'  => CFG_FACEBOOK_API_ID,
  	'secret' => CFG_FACEBOOK_API_SECRET,
));

$user 	= JFactory::getUser();
$userFB = $facebook->getUser();

//var_dump($user);

$isLogedIn 	= false;
$fbMe		= null;
if ($user->id) {
	$isLogedIn = true;
} else {
	if ($userFB) {
		try {
	    	// Proceed knowing you have a logged in user who's authenticated.
	    	$fbMe = $facebook->api('/me');
	  	} catch (FacebookApiException $e) {
	    	$userFB = null;
	  	}
	}
}

$logoutUrl= '';
$loginUrl = '';

if ($userFB) {
	$logoutUrl	= $facebook->getLogoutUrl();
} else {
  	$loginUrl	= $facebook->getLoginUrl(
  		array(
  			'scope' => 'email, publish_stream',
  			'redirect_uri' => JRoute::_(JURI::root() . 'index.php?option=com_profile&task=customer.fbregistration', false)
  		)
	);
}
$loginUrl	= $facebook->getLoginUrl(
  		array(
  			'scope' => 'email, publish_stream',
  			'redirect_uri' => JRoute::_(JURI::root() . 'index.php?option=com_profile&task=customer.fbregistration', false)
  		)
	);
?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo CFG_FACEBOOK_API_ID ?>";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="main-header">
	<div class="logo">
		<a href="<?php echo JURI::base(); ?>" title="Loca.vn"></a>
	</div>
	<div class="right">
		<?php if (!$user->id): ?>
			<div>
				<a href="<?php echo $loginUrl; ?>" class="icon-fb"  rel="nofollow">Đăng nhập bằng Facebook</a> | 
				<a href="<?php echo JRoute::_('index.php?option=com_users&view=login', false); ?>">Đăng nhập</a> |
				<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration', false); ?>">Đăng ký</a>
			</div>
		<?php else: ?>
			<div>
				Hello 
				<a href="<?php echo JRoute::_('index.php?option=com_users&view=profile'); ?>">
					<?php echo $user->username; ?>
				</a>
				|
				<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="logout-form" style="display: inline;">
				<?php if ($params->get('greeting')) : ?>
					<div class="login-greeting">
					<?php if($params->get('name') == 0) : {
						echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('name')));
					} else : {
						echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('username')));
					} endif; ?>
					</div>
				<?php endif; ?>
					
				<button type="submit" class="btn-logout"><?php echo JText::_('JLOGOUT'); ?></button>
				
				<input type="hidden" name="option" value="com_users" />
				<input type="hidden" name="task" value="user.logout" />
				<input type="hidden" name="return" value="<?php echo $return; ?>" />
				<?php echo JHtml::_('form.token'); ?>
					
				</form>
				
			</div>
		<?php endif; ?>
		
		<form>
			<input type="text" name="search" value="" placeholder="Nhập thông tin cần tìm" />
			<button class="btn-search"></button>
		</form>
	</div>
</div>
