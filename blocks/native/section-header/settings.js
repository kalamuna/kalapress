/**
 * WordPress dependencies.
 */
import { __ } from "@wordpress/i18n";

import {
  InspectorControls,
  PanelColorSettings,
  ContrastChecker,
  URLInput,
} from "@wordpress/block-editor";

import {
  Notice,
  PanelBody,
  TextControl,
  ToggleControl,
  RangeControl,
  Tip,
  __experimentalUnitControl as UnitControl,
} from "@wordpress/components";

const Settings = (props) => {
  const { attributes, setAttributes } = props;

  return (
    <>
      <InspectorControls>
        <PanelBody title={__("Elements", "kalapress")} initialOpen={true}>
          <ToggleControl
            label={__("Visually hide heading", "kalapress")}
            checked={attributes.hideSectionHeading}
            onChange={(value) => setAttributes({ hideSectionHeading: value })}
          />
          {/* Display this tip if the editor chooses to visually hide the heading. */}
          {attributes.hideSectionHeading === true && (
            <Tip>
              {__(
                "Section headings are mandatory, offering context to content. If visually hidden, they're still read by screen readers.",
                "kalapress",
              )}
            </Tip>
          )}

        </PanelBody>
  
      </InspectorControls>

    </>
  );
};

export default Settings;
