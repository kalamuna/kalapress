/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';

import {
  useBlockProps,
  useInnerBlocksProps,
  ButtonBlockAppender,
} from '@wordpress/block-editor';

/**
 * Internal dependencies
 */
import './editor.scss';
import './block-styles.js';

import Settings from './settings';

const Edit = ( props ) => {
  const { clientId, attributes, setAttributes } = props;

  // Assign CSS variables to attribute settings.
  const inlineStyles = {
    '--card-columns': attributes.cardColumns,
    '--row-gap': attributes.rowGap,
    '--column-gap': attributes.columnGap,
    '--card-text-color': attributes.cardTextColor,
    '--card-background-color': attributes.cardBackgroundColor,
    '--border-radius': attributes.borderRadius,
    '--card-padding': attributes.cardPadding,
    '--card-content-padding': attributes.cardContentPadding,
  };

  // Set the allowed_blocks and default template.
  const ALLOWED_BLOCKS =  [
    ['native/card'],
  ];

  const TEMPLATE = [
    ['native/card'],
    ['native/card'],
    ['native/card'],
  ];

  // Assign class and styles to the block props.
  const blockProps = useBlockProps({
    className: "cards-grid",
    style: inlineStyles
  });

  // Assign allowed blocks and templates to InnerBlock.
  const { children, ...innerBlocksProps } = useInnerBlocksProps(blockProps, {
    allowedBlocks: ALLOWED_BLOCKS,
    template: TEMPLATE,
    orientation: 'horizontal',
    templateLock: false
  });

  return (
    <>
      {/* Setting/Inspector Controls */}
      <Settings {...{ attributes, setAttributes }} />

      {/* Card Section Content. */}
      <div {...innerBlocksProps}>
        { children }

        {/* Include an appender button for adding new cards. */}
        <div className="cards-grid__appender">
          <ButtonBlockAppender rootClientId={clientId} />
        </div>
      </div>
    </>
  );
};

export default Edit;
