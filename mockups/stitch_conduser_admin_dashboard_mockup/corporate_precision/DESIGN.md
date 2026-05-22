---
name: Corporate Precision
colors:
  surface: '#f9f9ff'
  surface-dim: '#d3daef'
  surface-bright: '#f9f9ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f1f3ff'
  surface-container: '#e9edff'
  surface-container-high: '#e1e8fd'
  surface-container-highest: '#dce2f7'
  on-surface: '#141b2b'
  on-surface-variant: '#3e4a3e'
  inverse-surface: '#293040'
  inverse-on-surface: '#edf0ff'
  outline: '#6d7a6d'
  outline-variant: '#bdcabb'
  surface-tint: '#006d32'
  primary: '#006b30'
  on-primary: '#ffffff'
  primary-container: '#00873f'
  on-primary-container: '#f7fff3'
  inverse-primary: '#60df83'
  secondary: '#7c5800'
  on-secondary: '#ffffff'
  secondary-container: '#fcb812'
  on-secondary-container: '#6a4b00'
  tertiary: '#0058be'
  on-tertiary: '#ffffff'
  tertiary-container: '#2170e4'
  on-tertiary-container: '#fefcff'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#7dfc9c'
  primary-fixed-dim: '#60df83'
  on-primary-fixed: '#00210a'
  on-primary-fixed-variant: '#005224'
  secondary-fixed: '#ffdea7'
  secondary-fixed-dim: '#ffbb1e'
  on-secondary-fixed: '#271900'
  on-secondary-fixed-variant: '#5e4200'
  tertiary-fixed: '#d8e2ff'
  tertiary-fixed-dim: '#adc6ff'
  on-tertiary-fixed: '#001a42'
  on-tertiary-fixed-variant: '#004395'
  background: '#f9f9ff'
  on-background: '#141b2b'
  surface-variant: '#dce2f7'
typography:
  display-lg:
    fontFamily: Inter
    fontSize: 36px
    fontWeight: '700'
    lineHeight: '1.2'
    letterSpacing: -0.02em
  headline-md:
    fontFamily: Inter
    fontSize: 24px
    fontWeight: '600'
    lineHeight: '1.3'
    letterSpacing: -0.01em
  headline-sm:
    fontFamily: Inter
    fontSize: 20px
    fontWeight: '600'
    lineHeight: '1.4'
  body-lg:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: '1.6'
  body-md:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '400'
    lineHeight: '1.5'
  label-md:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '500'
    lineHeight: '1.4'
    letterSpacing: 0.01em
  label-sm:
    fontFamily: Inter
    fontSize: 11px
    fontWeight: '600'
    lineHeight: '1.2'
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  unit: 4px
  space-xs: 4px
  space-sm: 8px
  space-md: 16px
  space-lg: 24px
  space-xl: 32px
  layout-margin: 24px
  layout-gutter: 16px
---

## Brand & Style

This design system is engineered for a high-trust administrative environment where clarity and efficiency are paramount. The visual language balances the vitality of a modern tech platform with the sobriety required for accounting and professional management. 

The aesthetic follows a **Corporate / Modern** style. It prioritizes data legibility through generous whitespace and a rigid structural grid. The interface avoids unnecessary decorative elements, relying instead on precise geometry and a refined color application to guide the user through complex financial workflows. The goal is to evoke a sense of organized calm and institutional reliability.

## Colors

The palette is anchored by a "Professional Green," specifically tuned to remain vibrant on digital displays while maintaining enough depth to ensure accessibility in text and iconography. 

- **Primary:** Used for main actions, active navigation states, and key financial indicators.
- **Secondary Accent:** The "Road-line Yellow" is reserved for cautionary alerts, highlights, and secondary calls to action that require visibility without the urgency of an error.
- **Neutrals:** A high-contrast approach using a white background for the primary workspace and a soft light gray for the sidebar and secondary structural sections.
- **Functional Colors:** Blue is utilized for additive or informational "minus" states (as requested for specific icon logic), and red is reserved for destructive actions or critical errors.

## Typography

This design system utilizes **Inter** across all levels to leverage its exceptional legibility and systematic "utilitarian" feel. 

Headlines are set with slightly tighter letter spacing to maintain a compact, professional look at larger scales. Body text defaults to a comfortable 16px for long-form reading, while 14px is the standard for dashboard density and data tables. Labels and captions use a medium weight to ensure they remain legible even at smaller sizes against gray backgrounds.

## Layout & Spacing

The layout philosophy follows a **Fixed-Fluid Hybrid Grid**. The main dashboard container has a maximum width of 1440px to prevent excessive line lengths on ultra-wide monitors, while content within cards flows fluidly.

- **Sidebar:** A fixed width of 260px provides a persistent anchor for navigation.
- **Grid:** A 12-column system is used for dashboard layouts, allowing for 3-column (quarter-width), 4-column (one-third), and 6-column (half-width) card spans.
- **Rhythm:** An 8px baseline grid dictates all vertical spacing, ensuring consistent alignment between disparate components like tables, inputs, and buttons.

## Elevation & Depth

Visual hierarchy is achieved through **Tonal Layers** and **Low-Contrast Outlines** rather than heavy shadows.

- **Level 0 (Surface):** Soft gray (`background_offset`) for the global application background and sidebar.
- **Level 1 (Cards):** Pure white surfaces with a subtle 1px border (`#E5E7EB`).
- **Level 2 (Interaction):** A soft, diffused shadow (0px 4px 6px rgba(0,0,0,0.05)) is applied only to floating elements like dropdowns, tooltips, or modals to separate them from the primary workspace.

This approach keeps the interface looking flat and organized, reducing visual noise for users who spend hours interacting with data.

## Shapes

The shape language is consistently **Rounded**. A 0.5rem (8px) radius is the standard for most interface elements including input fields, buttons, and small cards. 

- **Standard Radius:** 8px (Buttons, Inputs, Small Cards).
- **Large Radius:** 12px (Main Content Containers, Dashboard Widgets).
- **Circular:** Used exclusively for user avatars and status indicators.

These rounded corners soften the industrial nature of accounting data, making the platform feel more modern and accessible while remaining firmly within the corporate domain.

## Components

### Buttons
- **Primary:** Solid green background with white text. High-contrast hover state (darker green).
- **Secondary:** Transparent background with a green border and green text.
- **Accent (Yellow):** Used for specific high-visibility utilities or cautionary actions.

### Input Fields
- **Design:** 8px radius, white background, 1px light gray border.
- **Focus State:** 1px solid green border with a subtle 3px green outer glow (20% opacity).
- **Icons:** Inline icons (like 'eye' for password visibility) should be 18px and use a medium gray color.

### Sidebar Navigation
- **Structure:** Vertical list with clear grouping headers.
- **Active State:** A left-aligned 4px green "indicator bar" and a light green background tint for the entire menu item.
- **Icons:** Use the designated icon set (User, Bank, etc.) in a consistent stroke weight.

### Cards
- **Structure:** Rounded (12px), subtle border, and a clear header section separated by a horizontal rule if the content is complex. Padding should be a minimum of 24px (`space-lg`).

### Icons
- **Logic:** Plus icons are consistently green. Minus icons use blue for administrative reductions or red for financial deletions/errors. Visibility (eye) and filter icons are neutral gray unless active.