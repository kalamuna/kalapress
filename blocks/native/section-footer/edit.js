/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies.
 */
import { __ } from '@wordpress/i18n';

import {
  useBlockProps,
  useInnerBlocksProps
} from '@wordpress/block-editor';

const Edit = (props) => {
  const { clientId, attributes, setAttributes } = props;

  // Set the allowed innerblocks and default template.
  const ALLOWED_BLOCKS = [
    'core/heading',
    'core/paragraph',
    'core/buttons',
    'core/button',
    'core/separator'
  ];

  const TEMPLATE = [
    [
      'core/buttons', { 'className': 'is-content-justification-center' }, 
      [
        ['core/button', { placeholder: 'Write button text...'}]
      ],
    ],
  ];

  // Assign properties to the block.
  const blockProps = useBlockProps({
    className: 'section-footer'
  });

  // Assign properties to the InnerBlocks children.
  const { children, ...innerBlocksProps  } =  useInnerBlocksProps(blockProps, {
    allowedBlocks: ALLOWED_BLOCKS,
    template: TEMPLATE,
    templateLock: false
  });
  
  return (
    <div {...innerBlocksProps}>
      { children }
    </div>
  );
}
export default Edit;
