<?php

class Kiwicom_Widget extends WP_Widget
{
  /**
   * @since    1.0.0*
   * @var      string
   */
  const WIDGET_SLUG = 'kiwicom-widget';

  /**
   * @inheritdoc
   */
  public function __construct()
  {
    parent::__construct(
      self::WIDGET_SLUG,
      __('Kiwi.com Widget', 'kiwicom-widget'),
      [
        'classname'   => self::WIDGET_SLUG . '-class',
        'description' => __('Displays Kiwi.com flights.', 'kiwicom-widget'),
      ]
    );
  }
}
