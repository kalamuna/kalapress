/**
 * WordPress dependencies.
 */
import { __ } from "@wordpress/i18n";

import {
  InspectorControls,
  PanelColorSettings,
  ContrastChecker,
} from "@wordpress/block-editor";

import {
  PanelBody,
  RangeControl,
} from "@wordpress/components";

const Settings = (props) => {
  const { attributes, setAttributes } = props;

  return (
    <>
      <InspectorControls>
        <PanelBody title={__("Layout", "kalapress")} initialOpen={true}>
          <RangeControl
            allowReset
            label={__("Columns", "kalapress")}
            min={1}
            max={4}
            onChange={(value) => setAttributes({ cardColumns: value })}
            value={attributes.cardColumns}
            initialPosition={3}
            resetFallbackValue={3}
          />
          <RangeControl
            allowReset
            label={__("Column Gap", "kalapress")}
            min={0.25}
            max={4.25}
            onChange={(value) => setAttributes({ columnGap: `${value}rem` })}
            value={attributes.columnGap}
            initialPosition={1}
            resetFallbackValue={1}
          />
          <RangeControl
            allowReset
            label={__("Row Gap", "kalapress")}
            min={0.25}
            max={4.25}
            onChange={(value) => setAttributes({ rowGap: `${value}rem` })}
            value={attributes.rowGap}
            initialPosition={1}
            resetFallbackValue={1}
          />
        </PanelBody>
      </InspectorControls>

      <InspectorControls group="color" className="panel__color">
        <div className="full-width-control-wrapper panel__color">
          <PanelColorSettings
            enableAlpha={true}
            clearable={false}
            colorSettings={[
              {
                value: attributes.cardTextColor,
                onChange: (cardTextColor) => setAttributes({ cardTextColor }),
                label: __("Card Text", "kalapress"),
                isShownByDefault: true,
              },
              {
                value: attributes.cardBackgroundColor,
                onChange: (cardBackgroundColor) =>
                  setAttributes({ cardBackgroundColor }),
                label: __("Card Background", "kalapress"),
                isShownByDefault: true,
              },
            ]}
          />
          {/* Compare colors for contrast issues. */}
          <ContrastChecker
            fontSize={13}
            textColor={attributes.cardTextColor}
            backgroundColor={attributes.cardBackgroundColor}
          />
        </div>
      </InspectorControls>

      <InspectorControls group="dimensions">
        <div className="full-width-control-wrapper">
          <RangeControl
            allowReset
            label={__("Card Padding", "kalapress")}
            min={0}
            max={3}
            onChange={(value) => setAttributes({ cardPadding: `${value}rem` })}
            value={attributes.cardPadding}
            initialPosition={0}
            resetFallbackValue={0}
            step={0.25}
            __nextHasNoMarginBottom={ true }
          />
          <RangeControl
            allowReset
            label={__("Card Text Padding", "kalapress")}
            min={1}
            max={3}
            onChange={(value) => setAttributes({ cardContentPadding: `${value}rem` })}
            value={attributes.cardContentPadding}
            initialPosition={1}
            resetFallbackValue={1}
            step={0.25}
            __nextHasNoMarginBottom={ true }
          />
        </div>
      </InspectorControls>

      <InspectorControls group="border">
        <div className="full-width-control-wrapper">
          <RangeControl
            allowReset
            label={__("Border Radius", "kalapress")}
            min={0}
            max={8}
            onChange={(value) => setAttributes({ borderRadius: `${value}rem` })}
            value={attributes.borderRadius}
            initialPosition={0}
            resetFallbackValue={1}
            step={0.25}
            __nextHasNoMarginBottom={ true }
          />
          {/* Maybe: Add BorderBox control for borders? It's an experimental feature though. */}
          {/* Maybe: Add box-shadow options, breakpoint options. */}
        </div>
      </InspectorControls>
    </>
  );
};

export default Settings;
