// NOTE: file has an accompanying php function in functions.php
// called: ft_remove_extra_classes_from_screen_reader_text();
import { registerFormatType, toggleFormat } from '@wordpress/rich-text';
import { RichTextToolbarButton } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

const ScreenReaderTextButton = ( props ) => {
  const { onChange, value, isActive } = props;

  return (
    <RichTextToolbarButton
      icon="universal-access-alt"
      title={ __( 'Screen Reader Text' ) }
      onClick={ () => {
        onChange(
          toggleFormat( value, {
            type: 'kalapress/screen-reader-text',
            attributes: {
              class: 'dashicons-before dashicons-universal-access-alt',
            },
          } ),
        );
      } }
      isActive={ isActive }
    />
  );
};

registerFormatType( 'kalapress/screen-reader-text', {
  title: __( 'Screen Reader Text' ),
  tagName: 'span',
  className: 'screen-reader-text-fe',
  edit: ScreenReaderTextButton,
} );
