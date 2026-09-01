<?php
/**
 * Archived homepage customization showcase.
 *
 * Removed from the main landing page during the relief-first pass.
 * Keep this partial available for a future /features page or dedicated CTA/button
 * customization showcase without having to reconstruct the original markup.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- ========== WIDGET & BUTTON CUSTOMIZATION ========== -->
<section class="customize-section" id="customize">
  <div class="container">
    <div class="customize-section__header reveal">
      <span class="section-label">Widget and Button Customization</span>
      <h2>Customize Your Widget and Button</h2>
      <p class="customize-section__subtitle">
        Match SiteStaffr to your brand with live controls for icon styles, colors, typography, borders, spacing, and hover effects.
      </p>
    </div>

    <div class="customize-grid">
      <article class="customize-panel reveal" id="customizeWidgetPanel">
        <div class="customize-panel__header">
          <h3>Floating Widget Preview</h3>
        </div>

        <div class="customize-preview customize-preview--widget">
          <div class="customize-browser">
            <div class="customize-browser__chrome">
              <span></span><span></span><span></span>
            </div>
            <div class="customize-browser__body customize-browser__body--widget">
              <div class="customize-mock-site customize-mock-site--widget" aria-hidden="true">
                <div class="customize-mock-chip-row">
                  <span class="customize-mock-chip"></span>
                  <span class="customize-mock-chip"></span>
                </div>
                <div class="customize-mock-hero">
                  <span class="customize-mock-line customize-mock-line--lg"></span>
                  <span class="customize-mock-line customize-mock-line--md"></span>
                  <span class="customize-mock-line customize-mock-line--sm"></span>
                </div>
                <div class="customize-mock-columns">
                  <div class="customize-mock-card">
                    <span class="customize-mock-line customize-mock-line--md"></span>
                    <span class="customize-mock-line customize-mock-line--sm"></span>
                  </div>
                  <div class="customize-mock-card">
                    <span class="customize-mock-line customize-mock-line--sm"></span>
                    <span class="customize-mock-line customize-mock-line--xs"></span>
                  </div>
                </div>
              </div>
              <div class="customize-widget-off" id="lpWidgetOffNotice" hidden>Widget hidden (auto-display off)</div>
              <button type="button" class="customize-widget-btn" id="lpWidgetPreviewButton" aria-label="Talk to our AI voice agent"></button>
            </div>
          </div>
        </div>

        <details class="customize-controls-toggle">
          <summary>Customize widget settings</summary>
          <div class="customize-controls">
            <div class="customize-control customize-control--switch">
              <label for="lpWidgetAutoDisplay">Show on all pages</label>
              <input id="lpWidgetAutoDisplay" type="checkbox" checked data-widget-control>
            </div>

            <div class="customize-control">
              <label for="lpWidgetIcon">Icon type</label>
              <select id="lpWidgetIcon" data-widget-control>
                <option value="sitestaffr">SiteStaffr</option>
                <option value="phone">Phone</option>
                <option value="microphone">Microphone</option>
                <option value="chat">Chat</option>
                <option value="headset">Headset</option>
              </select>
            </div>

            <div class="customize-control">
              <label for="lpWidgetSize">Widget size <span id="lpWidgetSizeValue" class="customize-control__value">60px</span></label>
              <input id="lpWidgetSize" type="range" min="46" max="80" value="60" data-widget-control>
            </div>

            <div class="customize-control">
              <label for="lpWidgetIconSize">Icon size <span id="lpWidgetIconSizeValue" class="customize-control__value">40px</span></label>
              <input id="lpWidgetIconSize" type="range" min="14" max="64" value="40" data-widget-control>
            </div>

            <div class="customize-control customize-control--full customize-radius-group">
              <div class="customize-radius-group__header">
                <p class="customize-radius-group__title">Border Radius</p>
                <label class="customize-radius-group__lock" for="lpWidgetRadiusLock">
                  <span>Lock all corners</span>
                  <input id="lpWidgetRadiusLock" type="checkbox" data-widget-control>
                </label>
              </div>
              <div class="customize-radius-group__grid">
                <div class="customize-control customize-control--radius">
                  <label for="lpWidgetRadiusTop">Top <span id="lpWidgetRadiusTopValue" class="customize-control__value">20px</span></label>
                  <input id="lpWidgetRadiusTop" type="range" min="0" max="80" value="20" data-widget-control>
                </div>
                <div class="customize-control customize-control--radius">
                  <label for="lpWidgetRadiusRight">Right <span id="lpWidgetRadiusRightValue" class="customize-control__value">20px</span></label>
                  <input id="lpWidgetRadiusRight" type="range" min="0" max="80" value="20" data-widget-control>
                </div>
                <div class="customize-control customize-control--radius">
                  <label for="lpWidgetRadiusBottom">Bottom <span id="lpWidgetRadiusBottomValue" class="customize-control__value">20px</span></label>
                  <input id="lpWidgetRadiusBottom" type="range" min="0" max="80" value="20" data-widget-control>
                </div>
                <div class="customize-control customize-control--radius">
                  <label for="lpWidgetRadiusLeft">Left <span id="lpWidgetRadiusLeftValue" class="customize-control__value">0px</span></label>
                  <input id="lpWidgetRadiusLeft" type="range" min="0" max="80" value="0" data-widget-control>
                </div>
              </div>
            </div>

            <div class="customize-control">
              <label for="lpWidgetBg">Background</label>
              <input id="lpWidgetBg" type="color" value="#10b981" data-widget-control>
            </div>

            <div class="customize-control">
              <label for="lpWidgetHoverBg">Hover color</label>
              <input id="lpWidgetHoverBg" type="color" value="#0ea572" data-widget-control>
            </div>

            <div class="customize-control">
              <label for="lpWidgetIconColor">Icon color</label>
              <input id="lpWidgetIconColor" type="color" value="#ffffff" data-widget-control>
            </div>
          </div>
        </details>
      </article>

      <article class="customize-panel customize-panel--button reveal reveal-delay-1" id="customizeButtonPanel">
        <div class="customize-panel__sticky">
          <div class="customize-panel__header">
            <h3>Inline Button Preview</h3>
          </div>

          <div class="customize-preview customize-preview--button">
            <div class="customize-browser">
              <div class="customize-browser__chrome">
                <span></span><span></span><span></span>
              </div>
              <div class="customize-browser__body customize-browser__body--button">
                <div class="customize-mock-site customize-mock-site--button" aria-hidden="true">
                  <div class="customize-mock-line customize-mock-line--lg"></div>
                  <div class="customize-mock-line customize-mock-line--md"></div>
                  <div class="customize-mock-line customize-mock-line--sm"></div>
                </div>
                <section class="customize-cta-block" aria-label="Example call to action placement">
                  <h4 class="customize-cta-block__title">Need Assistance?</h4>
                  <div class="customize-button-wrap customize-button-wrap--cta" id="lpButtonPreviewWrap">
                    <button type="button" class="customize-button-preview" id="lpButtonPreviewButton" aria-label="Contact us button preview"></button>
                  </div>
                </section>
              </div>
            </div>
          </div>
        </div>

        <details class="customize-controls-toggle" id="customizeButtonControls">
          <summary>Customize button settings</summary>
          <div class="customize-controls">
            <div class="customize-control customize-control--full">
              <label for="lpButtonText">Button text</label>
              <input id="lpButtonText" type="text" value="Contact Us" data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonIcon">Icon type</label>
              <select id="lpButtonIcon" data-button-control>
                <option value="sitestaffr">SiteStaffr</option>
                <option value="microphone">Microphone</option>
                <option value="phone">Phone</option>
                <option value="chat">Chat</option>
                <option value="headset">Headset</option>
                <option value="none">None</option>
              </select>
            </div>

            <div class="customize-control">
              <label for="lpButtonIconPosition">Icon position</label>
              <select id="lpButtonIconPosition" data-button-control>
                <option value="left">Left</option>
                <option value="right">Right</option>
              </select>
            </div>

            <div class="customize-control">
              <label for="lpButtonIconSize">Icon size <span id="lpButtonIconSizeValue" class="customize-control__value">32px</span></label>
              <input id="lpButtonIconSize" type="range" min="12" max="48" value="32" data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonFontSize">Font size <span id="lpButtonFontSizeValue" class="customize-control__value">16px</span></label>
              <input id="lpButtonFontSize" type="range" min="13" max="22" value="16" data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonFontWeight">Font weight</label>
              <select id="lpButtonFontWeight" data-button-control>
                <option value="400">Normal</option>
                <option value="600" selected>Semi-Bold</option>
                <option value="700">Bold</option>
              </select>
            </div>

            <div class="customize-control">
              <label for="lpButtonTextTransform">Text transform</label>
              <select id="lpButtonTextTransform" data-button-control>
                <option value="none" selected>None</option>
                <option value="uppercase">UPPERCASE</option>
                <option value="capitalize">Capitalize</option>
              </select>
            </div>

            <div class="customize-control">
              <label for="lpButtonTextColor">Text color</label>
              <input id="lpButtonTextColor" type="color" value="#ffffff" data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonIconColor">Icon color</label>
              <input id="lpButtonIconColor" type="color" value="#ffffff" data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonBg">Background</label>
              <input id="lpButtonBg" type="color" value="#1fb6cc" data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonHoverBg">Hover color</label>
              <input id="lpButtonHoverBg" type="color" value="#17a2b8" data-button-control>
            </div>
          </div>

          <div class="customize-controls__divider">Advanced controls</div>

          <div class="customize-controls customize-controls--advanced">
            <div class="customize-control customize-control--switch">
              <label for="lpButtonGradient">Enable gradient</label>
              <input id="lpButtonGradient" type="checkbox" checked data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonGradientEnd">Gradient end color</label>
              <input id="lpButtonGradientEnd" type="color" value="#10b981" data-button-control>
            </div>

            <div class="customize-control customize-control--full customize-radius-group">
              <div class="customize-radius-group__header">
                <p class="customize-radius-group__title">Border Radius</p>
                <label class="customize-radius-group__lock" for="lpButtonRadiusLock">
                  <span>Lock all corners</span>
                  <input id="lpButtonRadiusLock" type="checkbox" data-button-control>
                </label>
              </div>
              <div class="customize-radius-group__grid">
                <div class="customize-control customize-control--radius">
                  <label for="lpButtonRadiusTop">Top <span id="lpButtonRadiusTopValue" class="customize-control__value">80px</span></label>
                  <input id="lpButtonRadiusTop" type="range" min="0" max="120" value="80" data-button-control>
                </div>
                <div class="customize-control customize-control--radius">
                  <label for="lpButtonRadiusRight">Right <span id="lpButtonRadiusRightValue" class="customize-control__value">80px</span></label>
                  <input id="lpButtonRadiusRight" type="range" min="0" max="120" value="80" data-button-control>
                </div>
                <div class="customize-control customize-control--radius">
                  <label for="lpButtonRadiusBottom">Bottom <span id="lpButtonRadiusBottomValue" class="customize-control__value">80px</span></label>
                  <input id="lpButtonRadiusBottom" type="range" min="0" max="120" value="80" data-button-control>
                </div>
                <div class="customize-control customize-control--radius">
                  <label for="lpButtonRadiusLeft">Left <span id="lpButtonRadiusLeftValue" class="customize-control__value">80px</span></label>
                  <input id="lpButtonRadiusLeft" type="range" min="0" max="120" value="80" data-button-control>
                </div>
              </div>
            </div>

            <div class="customize-control">
              <label for="lpButtonBorderWidth">Border width <span id="lpButtonBorderWidthValue" class="customize-control__value">0px</span></label>
              <input id="lpButtonBorderWidth" type="range" min="0" max="8" value="0" data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonBorderColor">Border color</label>
              <input id="lpButtonBorderColor" type="color" value="#1fb6cc" data-button-control>
            </div>

            <div class="customize-control customize-control--switch">
              <label for="lpButtonShadow">Enable shadow</label>
              <input id="lpButtonShadow" type="checkbox" checked data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonShadowBlur">Shadow blur <span id="lpButtonShadowBlurValue" class="customize-control__value">10px</span></label>
              <input id="lpButtonShadowBlur" type="range" min="0" max="28" value="10" data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonShadowOffset">Shadow offset <span id="lpButtonShadowOffsetValue" class="customize-control__value">4px</span></label>
              <input id="lpButtonShadowOffset" type="range" min="0" max="18" value="4" data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonPaddingX">Horizontal padding <span id="lpButtonPaddingXValue" class="customize-control__value">24px</span></label>
              <input id="lpButtonPaddingX" type="range" min="12" max="48" value="24" data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonPaddingY">Vertical padding <span id="lpButtonPaddingYValue" class="customize-control__value">12px</span></label>
              <input id="lpButtonPaddingY" type="range" min="8" max="24" value="12" data-button-control>
            </div>

            <div class="customize-control customize-control--switch">
              <label for="lpButtonFullWidth">Full width button</label>
              <input id="lpButtonFullWidth" type="checkbox" data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonHoverAnimation">Hover animation</label>
              <select id="lpButtonHoverAnimation" data-button-control>
                <option value="none" selected>None</option>
                <option value="scale">Scale</option>
                <option value="glow">Glow</option>
                <option value="pulse">Pulse</option>
              </select>
            </div>
          </div>
        </details>
      </article>
    </div>

    <p class="customize-section__note reveal">Preview only. Your live settings are saved and managed inside the SiteStaffr plugin dashboard.</p>
  </div>
</section>
