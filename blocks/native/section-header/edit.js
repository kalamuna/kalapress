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
  useInnerBlocksProps,
  AlignmentToolbar,
  BlockControls,
  RichText,
} from '@wordpress/block-editor';

import { Dashicon } from '@wordpress/components';

/**
 * Internal dependencies
 */
import Settings from './settings';

const Edit = ( props ) => {
  const { clientId, attributes, setAttributes } = props;

  // Set the allowed innerblocks and default template.
  const ALLOWED_BLOCKS = [
    'core/buttons',
    'core/paragraph',
    'core/separator'
  ];

  const TEMPLATE = [
    ['core/paragraph', {  placeholder: 'Write description...' }],
  ];

  const classes = classnames(
    'section-header',
    `section-header--${attributes.alignment}`
  );

  // Assign properties to the block.
  const blockProps = useBlockProps({
    className: classes
  });

  // Assign properties to the InnerBlocks children.
  const { children, ...innerBlocksProps  } =  useInnerBlocksProps(blockProps, {
    allowedBlocks: ALLOWED_BLOCKS,
    template: TEMPLATE,
    templateLock: false
  });

  // Update the alignment of the Section Header content.
  const onChangeAlignment = ( newAlignment ) => {
    setAttributes( {
      alignment: newAlignment
    });
  }

  // Update the Section Heading value.
  const updateHeadingValue = ( newHeading ) => {
    setAttributes( { sectionHeading: newHeading } );
  };

  return (
    <>
      {/* Setting/Inspector Controls */}
      <Settings {...{ attributes, setAttributes }} />

      <div {...innerBlocksProps}>
        {/* Custom Toolbar buttons. */}
        <BlockControls>
          <AlignmentToolbar
            value={ attributes.alignment }
            onChange={ onChangeAlignment }
          />
        </BlockControls>

        {/* Use a RichText component to ensure the heading cannot be removed. */}
        <div className={
          attributes.hideSectionHeading === true
            ? 'screen-reader-text-fe section-header__heading'
            : 'section-header__heading'
        }>
          {attributes.hideSectionHeading === true && (
            <Dashicon icon="universal-access-alt" />
          )}
          <RichText
            tagName="h2"
            value={ attributes.sectionHeading }
            onChange={ updateHeadingValue }
            placeholder={ __('Write Heading...', 'kalapress') }
          />
        </div>
        
        { children }
      </div>
    </>
  );
}
export default Edit;
