<?php

class Kiwicom_Widget_Settings
{
	const SETTINGS_PAGE_IDENTIFIER = 'kiwicom';

	const SECTION_WIDGET = 'kiwicom_section_widget';
	const OPTION_NAME_AFFILIATE_ID = 'kiwicom_affiliate_id';

	public function __construct()
	{
		add_action('admin_menu', [$this, 'kiwicom_widget_admin_menu']);
		add_action('admin_init', [$this, 'kiwicom_widget_settings_init']);
		add_action('admin_footer', [$this, 'kiwicom_widget_expose_settings']);
	}

	public function kiwicom_widget_admin_menu()
	{
		add_options_page(
			__('Kiwi.com Widget', 'kiwicom-widget'),
			__('Kiwi.com Widget', 'kiwicom-widget'),
			'manage_options',
			self::SETTINGS_PAGE_IDENTIFIER,
			[$this, 'kiwicom_widget_display_settings_page']
		);
	}

	/**
	 * Setup all the settings (fields, sections ...)
	 */
	public function kiwicom_widget_settings_init()
	{
		register_setting(self::SETTINGS_PAGE_IDENTIFIER, self::OPTION_NAME_AFFILIATE_ID, [
			$this,
			'kiwicom_widget_validate_affiliate_id'
		]);

		add_settings_section(
			self::SECTION_WIDGET,
			__('Widget settings', 'kiwicom-widget'),
			null,
			self::SETTINGS_PAGE_IDENTIFIER
		);

		add_settings_field(
			self::OPTION_NAME_AFFILIATE_ID,
			__('Affiliate ID', 'kiwicom-widget'),
			[$this, 'kiwicom_widget_display_affiliate_id_field'],
			self::SETTINGS_PAGE_IDENTIFIER,
			self::SECTION_WIDGET
		);
	}

	public function kiwicom_widget_display_settings_page()
	{
		if (!current_user_can('manage_options')) {
			return;
		}

		include __DIR__ . '/../views/settings.php';
	}

	public function kiwicom_widget_display_affiliate_id_field()
	{
		$description = __('Become a Kiwi.com affiliate!', 'kiwicom-widget');
		$url         = 'https://partners.kiwi.com/our-solutions/tequila/?utm_source=wpplugin&utm_medium=marketplace&utm_campaign=widgets-wp-plugin'; 
		$affiliateId   = get_option(self::OPTION_NAME_AFFILIATE_ID, '');

		include __DIR__ . '/../includes/fields/affiliate_id_field.php';
	}

	public function kiwicom_widget_validate_affiliate_id($affiliateId)
	{
		// affiliate ID has definitely no spaces
		$trimmed = str_replace(' ','',$affiliateId);

		if(preg_match('/^[a-z\d]+$/',$trimmed)){
			return $trimmed;
		}
		return 'notvalid';
	}

	public function kiwicom_widget_expose_settings()
	{
		$kiwicom_data = [
			'affiliateID' => esc_html(get_option(self::OPTION_NAME_AFFILIATE_ID, ''))
		];
		echo "<script>kiwicomData = " . json_encode($kiwicom_data) . "</script>";
	}
}
