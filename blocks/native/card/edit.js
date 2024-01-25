/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies.
 */
import { __ } from '@wordpress/i18n';

import {
  BlockControls,
  InnerBlocks,
  useBlockProps,
  MediaReplaceFlow,
  URLInput,
  URLPopover
} from '@wordpress/block-editor';

import { 
  Button, 
  ToggleControl, 
  ToolbarGroup, 
  ToolbarButton 
 } from '@wordpress/components';

import { select, dispatch } from '@wordpress/data';
import { useState } from "@wordpress/element";
import { group, link, keyboardReturn, warning, linkOff, trash } from '@wordpress/icons';

/**
 * Internal dependencies
 */
import './editor.scss';
import Settings from './settings.js';

const Edit = (props) => {
  const { clientId, attributes, setAttributes, isSelected } = props;
  
  // Assign multiple classes.
  const classes = classnames(
    'card',
    {
      'has-child-selected': isSelected,
      'is-active': isSelected,
    }
  );

  // Set the allowed innerblocks and default template.
  const ALLOWED_BLOCKS = [
    'core/heading',
    'core/paragraph',
    'core/buttons',
    'core/details',
    'core/list',
    'core/separator'
  ];
  const TEMPLATE = [
    ['core/heading', { withoutInteractiveFormatting: true, level: 3, placeholder: 'Write Heading...' }],
    ['core/paragraph', {  placeholder: 'Write Description...' }],
  ];

  // Add classes to the card block.
  const blockProps = useBlockProps({
    className: classes,
  });
  
  // Set a placeholder image.
  const placeholderImg = require('./assets/placeholder.jpg'); // Add field for a custom placeholder image?

  // If a new image is selected, update the image attributes.
  const onSelectMedia = (media) => {
    props.setAttributes({
      imageId: media.id,
      imageUrl: media.url,
      imageAlt: media.alt, 
    });
  };

  const CloneButton = () => (
    <ToolbarButton
      icon={group}
      onClick={cloneSelectedBlocks}
      label={'Clone Block'}
    />
  )
  
  const DeleteButton = () =>(
    <ToolbarButton
      icon={trash}
      label={'Remove Block'}
      onClick={deleteSelectedBlocks}
    />
  )

  const deleteSelectedBlocks = () => {
    const {removeBlocks} = dispatch('core/block-editor');
    const blockId = select('core/block-editor').getSelectedBlockClientIds();
    removeBlocks(blockId);
  };
  
  const cloneSelectedBlocks = () => {
    const blockId = select('core/block-editor').getSelectedBlockClientIds();
    dispatch('core/block-editor').duplicateBlocks(blockId);
    console.log('This is supposed to clone the block.')
  };

  const LinkButton = () =>(
    <ToolbarButton
      icon={ link }
      title={ __( 'Edit Link', 'kalapress' ) }
      onClick={ () => { 
        setShowPopover( true );
      } }
      isPressed={isURLSet ? true : false  }
    />
  )

  // Toolbar URL Popover for Card Link.
  const [ showPopover, setShowPopover ] = useState( false );
  const [ cardLinkTarget, setCardLinkTarget ] = useState( false );
  const isURLSet = !! attributes.cardLink;

  // Function for when the URLPopover form is submitted.
  const handleSubmit = (event) => {
    event.preventDefault();

    // Close the form on submit.
    setShowPopover( false );
    
    // Create a Warning notice on submit.
    const noticeText = __('When a card has a parent link, any links embedded within that card will not be displayed on the frontend.', 'kalapress');

    const createNotice = wp.data.dispatch('core/notices').createNotice('warning', noticeText, {
      type: 'snackbar',
      explicitDismiss: false,
      icon: warning
    });
  };

  // Toolbar button function to remove the Card Link.
  const unlink = () => {
    props.setAttributes({
      cardLink: undefined,
      cardLinkTarget: undefined,
    });
  };
  
  return (
    <>
      {/* Setting/Inspector Controls */}
      <Settings
        clientId={clientId}
        attributes={attributes}
        setAttributes={setAttributes}
      />

      {/* Add custom controls to the Block Toolbar. */}
      <BlockControls>
        <ToolbarGroup>
          {/* Link button to Toolbar. */}
          <LinkButton />
  
          {/* When the LinkButton is clicked, reveal the URL Popover. */}
          { showPopover && (
            <URLPopover
            onClose={ () => setShowPopover( false ) }
            renderSettings={() => (
              <ToggleControl
                label={__('Open in new tab', 'kalapress' ) }
                checked={ cardLinkTarget }
                onChange={(newValue) => {
                  if (newValue) {
                    setAttributes({cardLinkTarget: newValue}); 
                  }
                  setCardLinkTarget(newValue);
                }}
              />
            )}
          >
            <form onSubmit={handleSubmit}>
              <>
                <URLInput
                  type="url"
                  value={attributes.cardLink}
                  onChange={(value) => setAttributes({ cardLink: value })}
                  __nextHasNoMarginBottom={ true }
                />
                <Button
                  icon={keyboardReturn}
                  label={ __( 'Submit', 'kalapress' ) }
                  type="submit"
                />
                {/* If a Card URL is set, provide an option to remove the link. */}
                { isURLSet && (
                  <Button
                    icon={linkOff}
                    label={ __( 'Remove Link', 'kalapress' ) }
                    type="button"
                    onClick={unlink}
                  /> 
                )}
              </>
            </form>
          </URLPopover>
          )}
        </ToolbarGroup>
        <ToolbarGroup>
          {/* Add a Media button to the toolbar. */}
          <MediaReplaceFlow
            onSelect={ onSelectMedia }
          ></MediaReplaceFlow>
        </ToolbarGroup>
        <ToolbarGroup>
          {/* Add Clone, Delete buttons to Toolbar. */}
          <CloneButton />
          <DeleteButton />
        </ToolbarGroup>
      </BlockControls>

      <div {...blockProps}>
        <div className="card__contents">
          <div className="card__text-content">
            <div className="card__text-content-inner">
              <InnerBlocks
                allowedBlocks={ALLOWED_BLOCKS}
                template={TEMPLATE}
              />
            </div>
          </div>
          {attributes.showImage && (
            <div className="card__media">
              <img
                src={attributes.imageUrl}
                alt={attributes.imageAlt}
                style={{
                  objectPosition: `${attributes.imageAlignment}`,
                }}
              />
            </div>
          )}
        </div>
      </div>
    </>
  );
}
export default Edit;
