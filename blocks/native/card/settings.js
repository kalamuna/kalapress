/**
 * WordPress dependencies.
 */
import { __ } from "@wordpress/i18n";

import {
  InspectorControls,
} from "@wordpress/block-editor";

import {
  PanelBody,
  FocalPointPicker,
  ToggleControl,
} from "@wordpress/components";

import { useState } from "@wordpress/element";

const Settings = (props) => {
  const { attributes, setAttributes } = props;

  // Focal point Settings.
  const [focalPoint, setFocalPoint] = useState({
    x: 0.5,
    y: 0.5,
  });

  // Update attributes after onChange event
  const handleFocalPointChange = (newValue) => {
    setAttributes({
      imageAlignment: `${focalPoint.x * 100}% ${focalPoint.y * 100}%`,
    });
    // Update focalPoint state with new value
    setFocalPoint(newValue);
  };

  return (
    <>
      <InspectorControls>
        <PanelBody title={__("Image", "kalapress")} initialOpen={true}>
          <FocalPointPicker
            url={attributes.imageUrl}
            label={__("Image alignment", "kalapress")}
            help={__("Position the image within the Card.", "card")}
            value={focalPoint}
            onDragStart={setFocalPoint}
            onDrag={setFocalPoint}
            onChange={handleFocalPointChange}
          />

          <ToggleControl
            label={__("Show Image", "kalapress")}
            checked={attributes.showImage}
            onChange={(value) => setAttributes({ showImage: value })}
          />
        </PanelBody>
      </InspectorControls>
    </>
  );
};
export default Settings;
