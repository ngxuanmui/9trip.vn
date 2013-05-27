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

<script>
	
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo CFG_FACEBOOK_API_ID ?>";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

</script>

<div id="main-header">
	<div class="logo">
		<a href="<?php echo JURI::base(); ?>" title="Loca.vn"></a>
	</div>
	<div class="right">
		<?php if (!$user->id): ?>
			<div>
				<a href="<?php echo $loginUrl; ?>" class="icon-fb"  rel="nofollow">Đăng nhập bằng Facebook</a> | 
				<a class="modal" href="<?php echo JRoute::_('index.php?option=com_users&view=loca_login&tmpl=component', false); ?>" rel="{handler: 'iframe', size: {x: 340, y: 160}, onClose: function() {}}">Đăng nhập</a> |
				<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration', false); ?>">Đăng ký</a>
			</div>
		<?php else: ?>
			<div class="relative">
				<script type="text/javascript">
					jQuery(function($){
						$('#user-function').click(function(){
							
							$('.list-user-function').toggleClass('display-none');
							
							return false;
						});
					});
				</script>
				<a href="#" id="user-function">
					<?php echo $user->username; ?>
					
					
				</a>
				<div class="absolute list-user-function display-none">
					<ul>
						<li>
							<a href="index.php?option=com_ntrip&task=user_man_hotel.add">
								Thêm mới khách sạn
							</a>
						</li>
						<li>
							<a href="index.php?option=com_ntrip&task=user_man_discover.add">
								Thêm mới khám phá
							</a>
						</li>
						<li>
							<a href="index.php?option=com_ntrip&task=user_man_restaurant.add">
								Thêm mới nhà hàng
							</a>
						</li>
						<li>
							<a href="index.php?option=com_ntrip&task=user_man_promotion.add">
								Thêm mới khuyến mãi
							</a>
						</li>
						<li>
							<a href="index.php?option=com_ntrip&task=user_man_tour.add">
								Thêm mới thăm quan
							</a>
						</li>
						<li>
							<a href="index.php?option=com_ntrip&task=user_man_warning.add">
								Thêm mới cảnh báo
							</a>
						</li>
						<li>
							<a href="index.php?option=com_ntrip&task=user_man_shopping.add">
								Thêm mới mua sắm
							</a>
						</li>
						<li>
							<a href="index.php?option=com_ntrip&task=user_man_question.add">
								Thêm mới câu hỏi
							</a>
						</li>
						<li>
							<a href="index.php?option=com_ntrip&task=user_man_relax.add">
								Thêm mới giải trí
							</a>
						</li>
						<li>
							<a href="index.php?option=com_ntrip&task=user_man_service.add">
								Thêm mới dịch vụ
							</a>
						</li>
						<li>
							<a href="index.php?option=com_users&view=profile">
								Cài đặt
							</a>
						</li>
					</ul>
					<div class="clr">
						<span class="fltlft">
							<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=user_man_hotels'); ?>">
								QUẢN LÝ DỊCH VỤ
							</a>
						</span>
						<span class="fltrgt">ĐĂNG XUẤT</span>
					</div>
				</div>
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
