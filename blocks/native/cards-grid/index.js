/**
 * WordPress dependencies.
 */
import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks } from '@wordpress/block-editor';

/**
 * Internal dependencies
 */
import metadata from './block.json';
import './style.scss';
import edit from './edit.js';

const { name } = metadata;

registerBlockType(name, {
  ...metadata,
  edit,
  save: () => <InnerBlocks.Content />,
});
