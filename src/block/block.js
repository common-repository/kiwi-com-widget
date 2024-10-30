/* eslint-disable react/display-name */
/**
 * BLOCK: kww-wp-plugin
 */
import React from 'react';

import Builder from './components/Builder';
import { KiwiComIcon } from './icon';


const Element = props => {
  return <div dangerouslySetInnerHTML={{ __html: props.attributes.script }} />;
};

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const category = 'embed';

registerBlockType('cgb/block-kiwicom-wp-plugin-search', {
  attributes: {
    script: {
      type: 'string',
      default: '<script></script>'
    },
  },
  title: __('Kiwi.com Widget'),
  description: __('Widget for kiwi.com'),
  icon: KiwiComIcon,
  category,
  keywords: [
    __('widget'),
    __('kiwi'),
    __('kiwicom'),
    __('kiwicom-widget'),
    __('travel'),
    __('flight'),
    __('tourism'),
  ],
  edit: props => <Builder {...props} />,
  save: props => {
    return Element(props);
  },
});
