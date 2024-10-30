<?php
// Prevent direct file access.
if (!defined('ABSPATH')) {
	exit;
}
?>

<input name="<?php echo esc_attr(self::OPTION_NAME_AFFILIATE_ID); ?>" value="<?php echo esc_attr($affiliateId); ?>" />

<p class="description">
	<a href="<?php echo esc_attr($url); ?>" target="_blank"><?php echo esc_html($description); ?> </a>
</p>