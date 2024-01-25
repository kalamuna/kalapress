/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';

import {
  useBlockProps,
  useInnerBlocksProps,
} from '@wordpress/block-editor';

/**
 * Internal dependencies
 */
const Edit = ( props ) => {
  const { clientId, attributes, setAttributes } = props;

  const classes = classnames(
    'cards-section',
  );

  // Set the allowed_blocks.
  const ALLOWED_BLOCKS =  [
    ['native/section-header'],
    ['native/cards-grid'],
    ['native/section-footer'],
  ];

  // Set a default template of blocks.
  const TEMPLATE = [
    ['native/section-header'],
    ['native/cards-grid'],
    ['native/section-footer']
  ];

  const blockProps = useBlockProps({
    className: classes,
  });

  // Assign allowed blocks and templates to InnerBlock.
  const { children, ...innerBlocksProps } = useInnerBlocksProps(blockProps, {
    allowedBlocks: ALLOWED_BLOCKS,
    template: TEMPLATE,
    templateLock: 'all'
  });

  return (
    <>
      <section {...innerBlocksProps}>
        <div className="cards-section__container">
          {/* InnerBlocks Content. */}
          { children }
        </div>
      </section>
    </>
  );
};

export default Edit;
