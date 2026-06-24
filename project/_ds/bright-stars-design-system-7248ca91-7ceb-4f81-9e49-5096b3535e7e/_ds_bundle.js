/* @ds-bundle: {"format":3,"namespace":"BrightStarsDesignSystem_7248ca","components":[{"name":"Button","sourcePath":"components/buttons/Button.jsx"},{"name":"IconButton","sourcePath":"components/buttons/IconButton.jsx"},{"name":"Avatar","sourcePath":"components/display/Avatar.jsx"},{"name":"Badge","sourcePath":"components/display/Badge.jsx"},{"name":"Card","sourcePath":"components/display/Card.jsx"},{"name":"Eyebrow","sourcePath":"components/display/Eyebrow.jsx"},{"name":"Checkbox","sourcePath":"components/forms/Checkbox.jsx"},{"name":"Input","sourcePath":"components/forms/Input.jsx"},{"name":"Select","sourcePath":"components/forms/Select.jsx"},{"name":"Switch","sourcePath":"components/forms/Switch.jsx"}],"sourceHashes":{"components/buttons/Button.jsx":"a7826435fd74","components/buttons/IconButton.jsx":"4d1fefa70890","components/display/Avatar.jsx":"a6c879850f05","components/display/Badge.jsx":"ae64fdf31edb","components/display/Card.jsx":"8c0fbdf37123","components/display/Eyebrow.jsx":"3321e4c8c038","components/forms/Checkbox.jsx":"781fde0dd8ee","components/forms/Input.jsx":"de6959ca4b4d","components/forms/Select.jsx":"1e7ff76046b0","components/forms/Switch.jsx":"e755879c34ad","ui_kits/agency-landing/SectionsBottom.jsx":"066d101e3ca2","ui_kits/agency-landing/SectionsTop.jsx":"5b3d648efb0e","ui_kits/agency-landing/shared.jsx":"e93771e9ce77","ui_kits/marketing/CTA.jsx":"7222f515ea8e","ui_kits/marketing/Features.jsx":"ee0acc922f26","ui_kits/marketing/Footer.jsx":"89dcc0f42c53","ui_kits/marketing/Hero.jsx":"04491cc8bdb1","ui_kits/marketing/Nav.jsx":"a2087a5bfd26","ui_kits/marketing/shared.jsx":"aca0d1275d5c"},"inlinedExternals":[],"unexposedExports":[]} */

(() => {

const __ds_ns = (window.BrightStarsDesignSystem_7248ca = window.BrightStarsDesignSystem_7248ca || {});

const __ds_scope = {};

(__ds_ns.__errors = __ds_ns.__errors || []);

// components/buttons/Button.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
const sizes = {
  sm: {
    height: 36,
    padding: "0 14px",
    fontSize: 14
  },
  md: {
    height: 44,
    padding: "0 20px",
    fontSize: 15
  },
  lg: {
    height: 48,
    padding: "0 26px",
    fontSize: 16
  }
};

/**
 * Bright Stars button. Orange primary glows on hover; near-black text on orange
 * keeps it WCAG-safe. Variants: primary | secondary | ghost.
 */
function Button({
  children,
  variant = "primary",
  size = "md",
  disabled = false,
  iconLeft = null,
  iconRight = null,
  onClick,
  style = {},
  ...rest
}) {
  const [hover, setHover] = React.useState(false);
  const [active, setActive] = React.useState(false);
  const s = sizes[size] || sizes.md;
  const base = {
    display: "inline-flex",
    alignItems: "center",
    justifyContent: "center",
    gap: 8,
    height: s.height,
    padding: s.padding,
    fontSize: s.fontSize,
    fontFamily: "var(--font-display)",
    fontWeight: 600,
    letterSpacing: "-0.01em",
    borderRadius: "var(--radius)",
    border: "1px solid transparent",
    cursor: disabled ? "not-allowed" : "pointer",
    opacity: disabled ? 0.45 : 1,
    transition: "background var(--dur) var(--ease), box-shadow var(--dur) var(--ease), transform var(--dur-fast) var(--ease), border-color var(--dur) var(--ease)",
    transform: active && !disabled ? "translateY(0)" : hover && !disabled ? "translateY(-2px)" : "translateY(0)",
    whiteSpace: "nowrap",
    boxSizing: "border-box"
  };
  const variants = {
    primary: {
      background: active ? "var(--accent-pressed)" : hover ? "var(--accent-hover)" : "var(--accent)",
      color: "var(--on-accent)",
      boxShadow: hover && !disabled ? "var(--glow)" : "none"
    },
    secondary: {
      background: hover && !disabled ? "var(--navy-700)" : "transparent",
      color: "var(--text)",
      borderColor: "var(--border-strong)"
    },
    ghost: {
      background: hover && !disabled ? "var(--orange-soft)" : "transparent",
      color: "var(--brand-orange)"
    }
  };
  return /*#__PURE__*/React.createElement("button", _extends({
    type: "button",
    disabled: disabled,
    onClick: onClick,
    onMouseEnter: () => setHover(true),
    onMouseLeave: () => {
      setHover(false);
      setActive(false);
    },
    onMouseDown: () => setActive(true),
    onMouseUp: () => setActive(false),
    style: {
      ...base,
      ...variants[variant],
      ...style
    }
  }, rest), iconLeft, children, iconRight);
}
Object.assign(__ds_scope, { Button });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/buttons/Button.jsx", error: String((e && e.message) || e) }); }

// components/buttons/IconButton.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/**
 * Square icon-only button. Mirrors Button variants but sized for a single glyph.
 */
function IconButton({
  children,
  variant = "secondary",
  size = "md",
  disabled = false,
  "aria-label": ariaLabel = "button",
  onClick,
  style = {},
  ...rest
}) {
  const [hover, setHover] = React.useState(false);
  const dim = size === "sm" ? 36 : size === "lg" ? 48 : 44;
  const variants = {
    primary: {
      background: hover && !disabled ? "var(--accent-hover)" : "var(--accent)",
      color: "var(--on-accent)",
      boxShadow: hover && !disabled ? "var(--glow)" : "none",
      border: "1px solid transparent"
    },
    secondary: {
      background: hover && !disabled ? "var(--navy-700)" : "transparent",
      color: "var(--text)",
      border: "1px solid var(--border-strong)"
    },
    ghost: {
      background: hover && !disabled ? "var(--orange-soft)" : "transparent",
      color: "var(--brand-orange)",
      border: "1px solid transparent"
    }
  };
  return /*#__PURE__*/React.createElement("button", _extends({
    type: "button",
    "aria-label": ariaLabel,
    disabled: disabled,
    onClick: onClick,
    onMouseEnter: () => setHover(true),
    onMouseLeave: () => setHover(false),
    style: {
      width: dim,
      height: dim,
      display: "inline-flex",
      alignItems: "center",
      justifyContent: "center",
      borderRadius: "var(--radius)",
      cursor: disabled ? "not-allowed" : "pointer",
      opacity: disabled ? 0.45 : 1,
      transition: "background var(--dur) var(--ease), box-shadow var(--dur) var(--ease)",
      boxSizing: "border-box",
      ...variants[variant],
      ...style
    }
  }, rest), children);
}
Object.assign(__ds_scope, { IconButton });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/buttons/IconButton.jsx", error: String((e && e.message) || e) }); }

// components/display/Avatar.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
const dims = {
  sm: 28,
  md: 36,
  lg: 48
};

/**
 * Avatar — initials on navy by default, or an image. Square-ish rounded.
 */
function Avatar({
  name = "",
  src = null,
  size = "md",
  style = {},
  ...rest
}) {
  const d = dims[size] || dims.md;
  const initials = name.split(" ").map(w => w[0]).filter(Boolean).slice(0, 2).join("").toUpperCase();
  return /*#__PURE__*/React.createElement("div", _extends({
    style: {
      width: d,
      height: d,
      borderRadius: "var(--radius)",
      background: src ? "transparent" : "var(--navy-600)",
      color: "var(--navy-100)",
      display: "inline-flex",
      alignItems: "center",
      justifyContent: "center",
      fontFamily: "var(--font-display)",
      fontWeight: 600,
      fontSize: d * 0.4,
      overflow: "hidden",
      border: "1px solid var(--border)",
      flex: "none",
      ...style
    }
  }, rest), src ? /*#__PURE__*/React.createElement("img", {
    src: src,
    alt: name,
    style: {
      width: "100%",
      height: "100%",
      objectFit: "cover"
    }
  }) : initials);
}
Object.assign(__ds_scope, { Avatar });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/display/Avatar.jsx", error: String((e && e.message) || e) }); }

// components/display/Badge.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
const tones = {
  navy: {
    background: "var(--navy-700)",
    color: "var(--navy-200)",
    border: "1px solid var(--navy-600)"
  },
  orange: {
    background: "var(--orange-soft)",
    color: "var(--brand-orange)",
    border: "1px solid rgba(245,128,33,.25)"
  },
  success: {
    background: "rgba(47,184,115,.12)",
    color: "var(--success)",
    border: "1px solid rgba(47,184,115,.3)"
  },
  warning: {
    background: "rgba(255,200,87,.12)",
    color: "var(--warning)",
    border: "1px solid rgba(255,200,87,.3)"
  },
  danger: {
    background: "rgba(240,82,75,.12)",
    color: "var(--danger)",
    border: "1px solid rgba(240,82,75,.3)"
  },
  neutral: {
    background: "var(--surface-2)",
    color: "var(--text-muted)",
    border: "1px solid var(--border)"
  }
};

/**
 * Status badge / chip. tone selects the semantic color; dot adds a leading marker.
 */
function Badge({
  children,
  tone = "navy",
  dot = false,
  style = {},
  ...rest
}) {
  const t = tones[tone] || tones.navy;
  return /*#__PURE__*/React.createElement("span", _extends({
    style: {
      display: "inline-flex",
      alignItems: "center",
      gap: 6,
      height: 24,
      padding: "0 10px",
      fontFamily: "var(--font-mono)",
      fontSize: 11,
      fontWeight: 500,
      letterSpacing: "0.04em",
      textTransform: "uppercase",
      borderRadius: "var(--radius-pill)",
      ...t,
      ...style
    }
  }, rest), dot && /*#__PURE__*/React.createElement("span", {
    style: {
      width: 6,
      height: 6,
      borderRadius: "50%",
      background: "currentColor"
    }
  }), children);
}
Object.assign(__ds_scope, { Badge });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/display/Badge.jsx", error: String((e && e.message) || e) }); }

// components/display/Card.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/**
 * Surface card. Optional orange top-bracket accent. Lifts + glows on hover when
 * interactive. Compose anything inside.
 */
function Card({
  children,
  accent = false,
  interactive = false,
  style = {},
  ...rest
}) {
  const [hover, setHover] = React.useState(false);
  return /*#__PURE__*/React.createElement("div", _extends({
    onMouseEnter: () => interactive && setHover(true),
    onMouseLeave: () => interactive && setHover(false),
    style: {
      position: "relative",
      background: "var(--surface-2)",
      border: "1px solid var(--border)",
      borderRadius: "var(--radius-lg)",
      padding: 24,
      color: "var(--text)",
      fontFamily: "var(--font-body)",
      transition: "transform var(--dur) var(--ease), box-shadow var(--dur) var(--ease), border-color var(--dur) var(--ease)",
      transform: hover ? "translateY(-2px)" : "translateY(0)",
      boxShadow: hover ? "var(--shadow-lg)" : "var(--shadow-sm)",
      borderColor: hover ? "var(--border-strong)" : "var(--border)",
      cursor: interactive ? "pointer" : "default",
      ...style
    }
  }, rest), accent && /*#__PURE__*/React.createElement("span", {
    style: {
      position: "absolute",
      top: 14,
      left: 14,
      width: 18,
      height: 18,
      borderTop: "2px solid var(--brand-orange)",
      borderLeft: "2px solid var(--brand-orange)"
    }
  }), children);
}
Object.assign(__ds_scope, { Card });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/display/Card.jsx", error: String((e && e.message) || e) }); }

// components/display/Eyebrow.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/**
 * Brand eyebrow label — mono, uppercase, +6% tracking, wrapped in < >.
 * The signature Bright Stars text device. tone: navy | orange.
 */
function Eyebrow({
  children,
  tone = "navy",
  style = {},
  ...rest
}) {
  const color = tone === "orange" ? "var(--brand-orange)" : "var(--navy-200)";
  return /*#__PURE__*/React.createElement("span", _extends({
    style: {
      fontFamily: "var(--font-mono)",
      fontSize: 13,
      fontWeight: 500,
      letterSpacing: "0.06em",
      textTransform: "uppercase",
      color,
      display: "inline-flex",
      alignItems: "center",
      gap: 6,
      ...style
    }
  }, rest), /*#__PURE__*/React.createElement("span", {
    style: {
      opacity: 0.5
    }
  }, "<"), children, /*#__PURE__*/React.createElement("span", {
    style: {
      opacity: 0.5
    }
  }, ">"));
}
Object.assign(__ds_scope, { Eyebrow });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/display/Eyebrow.jsx", error: String((e && e.message) || e) }); }

// components/forms/Checkbox.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/** Checkbox — orange fill + near-black check when on. */
function Checkbox({
  checked = false,
  label = null,
  disabled = false,
  onChange,
  style = {},
  ...rest
}) {
  return /*#__PURE__*/React.createElement("label", _extends({
    style: {
      display: "inline-flex",
      alignItems: "center",
      gap: 10,
      fontFamily: "var(--font-body)",
      fontSize: 15,
      color: "var(--text)",
      cursor: disabled ? "not-allowed" : "pointer",
      opacity: disabled ? 0.5 : 1,
      ...style
    }
  }, rest), /*#__PURE__*/React.createElement("input", {
    type: "checkbox",
    checked: checked,
    disabled: disabled,
    onChange: onChange,
    style: {
      position: "absolute",
      opacity: 0,
      width: 0,
      height: 0
    }
  }), /*#__PURE__*/React.createElement("span", {
    style: {
      width: 20,
      height: 20,
      flex: "none",
      borderRadius: "var(--radius-sm)",
      background: checked ? "var(--accent)" : "var(--surface)",
      border: `1px solid ${checked ? "var(--accent)" : "var(--border-strong)"}`,
      display: "inline-flex",
      alignItems: "center",
      justifyContent: "center",
      transition: "background var(--dur) var(--ease), border-color var(--dur) var(--ease)"
    }
  }, checked && /*#__PURE__*/React.createElement("svg", {
    width: "12",
    height: "12",
    viewBox: "0 0 12 12",
    fill: "none"
  }, /*#__PURE__*/React.createElement("path", {
    d: "M2.5 6.2L5 8.7L9.5 3.5",
    stroke: "#0A0F18",
    strokeWidth: "2",
    strokeLinecap: "round",
    strokeLinejoin: "round"
  }))), label);
}
Object.assign(__ds_scope, { Checkbox });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/forms/Checkbox.jsx", error: String((e && e.message) || e) }); }

// components/forms/Input.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/**
 * Text input. Focus lights the orange border + 3px glow ring. Optional label and
 * leading icon. error switches the ring to danger.
 */
function Input({
  label = null,
  placeholder = "",
  value,
  defaultValue,
  type = "text",
  iconLeft = null,
  error = false,
  disabled = false,
  onChange,
  style = {},
  ...rest
}) {
  const [focus, setFocus] = React.useState(false);
  const ring = error ? "0 0 0 3px rgba(240,82,75,.25)" : focus ? "var(--glow-soft)" : "none";
  const borderColor = error ? "var(--danger)" : focus ? "var(--brand-orange)" : "var(--border)";
  return /*#__PURE__*/React.createElement("label", {
    style: {
      display: "block",
      fontFamily: "var(--font-body)",
      ...style
    }
  }, label && /*#__PURE__*/React.createElement("span", {
    style: {
      display: "block",
      fontSize: 13,
      fontWeight: 500,
      color: "var(--text-muted)",
      marginBottom: 8
    }
  }, label), /*#__PURE__*/React.createElement("span", {
    style: {
      display: "flex",
      alignItems: "center",
      gap: 8,
      height: 44,
      padding: "0 14px",
      background: "var(--surface)",
      border: `1px solid ${borderColor}`,
      borderRadius: "var(--radius)",
      boxShadow: ring,
      transition: "border-color var(--dur) var(--ease), box-shadow var(--dur) var(--ease)",
      opacity: disabled ? 0.5 : 1
    }
  }, iconLeft && /*#__PURE__*/React.createElement("span", {
    style: {
      color: "var(--text-subtle)",
      display: "inline-flex"
    }
  }, iconLeft), /*#__PURE__*/React.createElement("input", _extends({
    type: type,
    placeholder: placeholder,
    value: value,
    defaultValue: defaultValue,
    disabled: disabled,
    onChange: onChange,
    onFocus: () => setFocus(true),
    onBlur: () => setFocus(false),
    style: {
      flex: 1,
      minWidth: 0,
      border: "none",
      outline: "none",
      background: "transparent",
      color: "var(--text)",
      fontFamily: "var(--font-body)",
      fontSize: 15
    }
  }, rest))));
}
Object.assign(__ds_scope, { Input });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/forms/Input.jsx", error: String((e && e.message) || e) }); }

// components/forms/Select.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/** Native select styled to match Input. Focus lights the orange ring. */
function Select({
  label = null,
  value,
  defaultValue,
  onChange,
  disabled = false,
  children,
  style = {},
  ...rest
}) {
  const [focus, setFocus] = React.useState(false);
  return /*#__PURE__*/React.createElement("label", {
    style: {
      display: "block",
      fontFamily: "var(--font-body)",
      ...style
    }
  }, label && /*#__PURE__*/React.createElement("span", {
    style: {
      display: "block",
      fontSize: 13,
      fontWeight: 500,
      color: "var(--text-muted)",
      marginBottom: 8
    }
  }, label), /*#__PURE__*/React.createElement("span", {
    style: {
      position: "relative",
      display: "block"
    }
  }, /*#__PURE__*/React.createElement("select", _extends({
    value: value,
    defaultValue: defaultValue,
    disabled: disabled,
    onChange: onChange,
    onFocus: () => setFocus(true),
    onBlur: () => setFocus(false),
    style: {
      width: "100%",
      height: 44,
      padding: "0 38px 0 14px",
      appearance: "none",
      background: "var(--surface)",
      color: "var(--text)",
      border: `1px solid ${focus ? "var(--brand-orange)" : "var(--border)"}`,
      borderRadius: "var(--radius)",
      boxShadow: focus ? "var(--glow-soft)" : "none",
      fontFamily: "var(--font-body)",
      fontSize: 15,
      outline: "none",
      cursor: disabled ? "not-allowed" : "pointer",
      opacity: disabled ? 0.5 : 1,
      transition: "border-color var(--dur) var(--ease), box-shadow var(--dur) var(--ease)"
    }
  }, rest), children), /*#__PURE__*/React.createElement("span", {
    style: {
      position: "absolute",
      right: 14,
      top: "50%",
      transform: "translateY(-50%)",
      pointerEvents: "none",
      color: "var(--text-subtle)",
      fontFamily: "var(--font-mono)",
      fontSize: 12
    }
  }, ">")));
}
Object.assign(__ds_scope, { Select });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/forms/Select.jsx", error: String((e && e.message) || e) }); }

// components/forms/Switch.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/** Toggle switch — track turns orange when on. */
function Switch({
  checked = false,
  label = null,
  disabled = false,
  onChange,
  style = {},
  ...rest
}) {
  return /*#__PURE__*/React.createElement("label", _extends({
    style: {
      display: "inline-flex",
      alignItems: "center",
      gap: 10,
      fontFamily: "var(--font-body)",
      fontSize: 15,
      color: "var(--text)",
      cursor: disabled ? "not-allowed" : "pointer",
      opacity: disabled ? 0.5 : 1,
      ...style
    }
  }, rest), /*#__PURE__*/React.createElement("input", {
    type: "checkbox",
    checked: checked,
    disabled: disabled,
    onChange: onChange,
    style: {
      position: "absolute",
      opacity: 0,
      width: 0,
      height: 0
    }
  }), /*#__PURE__*/React.createElement("span", {
    style: {
      width: 40,
      height: 24,
      flex: "none",
      borderRadius: "var(--radius-pill)",
      background: checked ? "var(--accent)" : "var(--border-strong)",
      position: "relative",
      transition: "background var(--dur) var(--ease)"
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      position: "absolute",
      top: 3,
      left: checked ? 19 : 3,
      width: 18,
      height: 18,
      borderRadius: "50%",
      background: checked ? "var(--on-accent)" : "var(--text)",
      transition: "left var(--dur) var(--ease)"
    }
  })), label);
}
Object.assign(__ds_scope, { Switch });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/forms/Switch.jsx", error: String((e && e.message) || e) }); }

// ui_kits/agency-landing/SectionsBottom.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
// Bottom of the Bright Starts landing: Work, Testimonials, Team, Contact, Footer.

function Work() {
  const cases = [{
    tag: "RETAIL · E-COMMERCE",
    t: "Oasis Living",
    d: "Rebuilt the funnel and scaled paid social.",
    m: "+312% revenue",
    c: "linear-gradient(135deg, #C9A227, #8A6710)"
  }, {
    tag: "HOSPITALITY",
    t: "Al Bahr Resorts",
    d: "Brand refresh + booking-first website.",
    m: "2.4x direct bookings",
    c: "linear-gradient(135deg, #1F6B4F, #0E3B2E)"
  }, {
    tag: "FINTECH",
    t: "Mizan Pay",
    d: "GTM strategy and launch campaign in 3 markets.",
    m: "60k signups",
    c: "linear-gradient(135deg, #2E568A, #0A1F38)"
  }];
  return /*#__PURE__*/React.createElement("section", {
    style: {
      maxWidth: 1200,
      margin: "0 auto",
      padding: "84px 40px 72px"
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: "flex",
      alignItems: "flex-end",
      justifyContent: "space-between",
      marginBottom: 36,
      flexWrap: "wrap",
      gap: 16
    }
  }, /*#__PURE__*/React.createElement("div", null, /*#__PURE__*/React.createElement(Eyebrow, null, "SELECTED WORK"), /*#__PURE__*/React.createElement("h2", {
    style: {
      fontFamily: "var(--font-display)",
      fontWeight: 700,
      letterSpacing: "-.02em",
      fontSize: 44,
      margin: "16px 0 0"
    }
  }, "Results we're proud of")), /*#__PURE__*/React.createElement(LuxBtn, {
    variant: "ghost",
    iconRight: /*#__PURE__*/React.createElement(Icon, {
      name: "arrow-right",
      size: 16,
      color: "var(--bs-accent-strong)"
    })
  }, "All case studies")), /*#__PURE__*/React.createElement("div", {
    style: {
      display: "grid",
      gridTemplateColumns: "repeat(3, 1fr)",
      gap: 18
    }
  }, cases.map((cs, i) => /*#__PURE__*/React.createElement(CaseCard, _extends({
    key: i
  }, cs)))));
}
function CaseCard({
  tag,
  t,
  d,
  m,
  c
}) {
  const [h, setH] = React.useState(false);
  return /*#__PURE__*/React.createElement("div", {
    onMouseEnter: () => setH(true),
    onMouseLeave: () => setH(false),
    style: {
      borderRadius: "var(--radius-lg)",
      overflow: "hidden",
      border: "1px solid var(--bs-line)",
      background: "var(--bs-panel-2)",
      transition: "all var(--dur) var(--ease)",
      transform: h ? "translateY(-3px)" : "none",
      boxShadow: h ? "var(--shadow-lg)" : "none",
      cursor: "pointer"
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      position: "relative",
      height: 168,
      background: c
    }
  }, /*#__PURE__*/React.createElement("span", {
    "aria-hidden": true,
    style: {
      position: "absolute",
      inset: 0,
      background: "radial-gradient(circle at 70% 20%, rgba(255,255,255,.18), transparent 60%)"
    }
  }), /*#__PURE__*/React.createElement("span", {
    "aria-hidden": true,
    style: {
      position: "absolute",
      right: 16,
      bottom: -14,
      width: 60,
      height: 60,
      border: "2px solid rgba(255,255,255,.35)",
      borderRadius: 10,
      transform: "rotate(45deg)"
    }
  }), /*#__PURE__*/React.createElement("span", {
    style: {
      position: "absolute",
      top: 16,
      left: 16,
      fontFamily: "var(--font-mono)",
      fontSize: 10.5,
      letterSpacing: ".12em",
      color: "rgba(255,255,255,.92)",
      background: "rgba(0,0,0,.28)",
      padding: "5px 9px",
      borderRadius: 6
    }
  }, tag)), /*#__PURE__*/React.createElement("div", {
    style: {
      padding: 22
    }
  }, /*#__PURE__*/React.createElement("h3", {
    style: {
      fontFamily: "var(--font-display)",
      fontWeight: 600,
      fontSize: 20,
      letterSpacing: "-.01em",
      margin: "0 0 6px"
    }
  }, t), /*#__PURE__*/React.createElement("p", {
    style: {
      fontFamily: "var(--font-body)",
      fontSize: 14,
      lineHeight: 1.55,
      color: "var(--bs-fg-muted)",
      margin: "0 0 14px"
    }
  }, d), /*#__PURE__*/React.createElement("div", {
    style: {
      display: "inline-flex",
      alignItems: "center",
      gap: 8,
      fontFamily: "var(--font-display)",
      fontWeight: 700,
      fontSize: 17,
      color: "var(--bs-accent)"
    }
  }, /*#__PURE__*/React.createElement(Diamond, {
    size: 8
  }), m)));
}
function Testimonials() {
  const quotes = [{
    q: "Bright Starts feels like our in-house team — senior, fast, and genuinely invested in the numbers.",
    n: "Layla Al-Harthy",
    r: "CMO, Oasis Living"
  }, {
    q: "From idea to launch in six weeks. The strategy was sharp and the execution flawless.",
    n: "Omar Said",
    r: "Founder, Mizan Pay"
  }];
  return /*#__PURE__*/React.createElement("section", {
    style: {
      background: "var(--bs-panel)",
      borderTop: "1px solid var(--bs-line)",
      borderBottom: "1px solid var(--bs-line)"
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      maxWidth: 1200,
      margin: "0 auto",
      padding: "76px 40px"
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      textAlign: "center",
      marginBottom: 40
    }
  }, /*#__PURE__*/React.createElement(Eyebrow, null, "CLIENT VOICES")), /*#__PURE__*/React.createElement("div", {
    style: {
      display: "grid",
      gridTemplateColumns: "1fr 1fr",
      gap: 18
    }
  }, quotes.map((qt, i) => /*#__PURE__*/React.createElement("div", {
    key: i,
    style: {
      background: "var(--bs-panel-2)",
      border: "1px solid var(--bs-line)",
      borderRadius: "var(--radius-lg)",
      padding: 32
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      fontFamily: "var(--font-hero)",
      fontSize: 48,
      lineHeight: .5,
      color: "var(--bs-accent)",
      height: 24
    }
  }, "\u201C"), /*#__PURE__*/React.createElement("p", {
    style: {
      fontFamily: "var(--font-display)",
      fontWeight: 500,
      fontSize: 21,
      lineHeight: 1.45,
      letterSpacing: "-.01em",
      margin: "0 0 22px"
    }
  }, qt.q), /*#__PURE__*/React.createElement("div", {
    style: {
      display: "flex",
      alignItems: "center",
      gap: 12
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      width: 40,
      height: 40,
      borderRadius: "var(--radius)",
      background: "color-mix(in srgb, var(--bs-accent) 18%, var(--bs-panel))",
      display: "inline-flex",
      alignItems: "center",
      justifyContent: "center",
      fontFamily: "var(--font-display)",
      fontWeight: 700,
      color: "var(--bs-accent)"
    }
  }, qt.n.split(" ").map(w => w[0]).slice(0, 2).join("")), /*#__PURE__*/React.createElement("div", null, /*#__PURE__*/React.createElement("div", {
    style: {
      fontFamily: "var(--font-body)",
      fontWeight: 600,
      fontSize: 14.5
    }
  }, qt.n), /*#__PURE__*/React.createElement("div", {
    style: {
      fontFamily: "var(--font-mono)",
      fontSize: 11,
      letterSpacing: ".06em",
      color: "var(--bs-fg-subtle)",
      marginTop: 2
    }
  }, qt.r))))))));
}
function Team() {
  const people = [{
    n: "Yusuf Al-Balushi",
    r: "Founder & Strategy",
    c: "linear-gradient(135deg,#C9A227,#9A7B16)"
  }, {
    n: "Mariam Khalfan",
    r: "Creative Director",
    c: "linear-gradient(135deg,#1F6B4F,#0E3B2E)"
  }, {
    n: "Tariq Nasser",
    r: "Head of Performance",
    c: "linear-gradient(135deg,#2E568A,#13335A)"
  }, {
    n: "Sara Al-Lawati",
    r: "Head of Content",
    c: "linear-gradient(135deg,#D86A12,#7A3A08)"
  }];
  return /*#__PURE__*/React.createElement("section", {
    style: {
      maxWidth: 1200,
      margin: "0 auto",
      padding: "84px 40px 72px"
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      marginBottom: 36
    }
  }, /*#__PURE__*/React.createElement(Eyebrow, null, "THE TEAM"), /*#__PURE__*/React.createElement("h2", {
    style: {
      fontFamily: "var(--font-display)",
      fontWeight: 700,
      letterSpacing: "-.02em",
      fontSize: 44,
      margin: "16px 0 0"
    }
  }, "Senior people, no juniors learning on you")), /*#__PURE__*/React.createElement("div", {
    style: {
      display: "grid",
      gridTemplateColumns: "repeat(4, 1fr)",
      gap: 18
    }
  }, people.map(p => /*#__PURE__*/React.createElement("div", {
    key: p.n,
    style: {
      borderRadius: "var(--radius-lg)",
      overflow: "hidden",
      border: "1px solid var(--bs-line)",
      background: "var(--bs-panel-2)"
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      position: "relative",
      height: 170,
      background: p.c
    }
  }, /*#__PURE__*/React.createElement("span", {
    "aria-hidden": true,
    style: {
      position: "absolute",
      inset: 0,
      background: "radial-gradient(circle at 50% 30%, rgba(255,255,255,.15), transparent 65%)"
    }
  }), /*#__PURE__*/React.createElement("span", {
    "aria-hidden": true,
    style: {
      position: "absolute",
      right: 14,
      bottom: 14,
      width: 22,
      height: 22,
      transform: "rotate(45deg)",
      border: "1.5px solid rgba(255,255,255,.5)",
      borderRadius: 4
    }
  })), /*#__PURE__*/React.createElement("div", {
    style: {
      padding: "16px 18px"
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      fontFamily: "var(--font-display)",
      fontWeight: 600,
      fontSize: 16,
      letterSpacing: "-.01em"
    }
  }, p.n), /*#__PURE__*/React.createElement("div", {
    style: {
      fontFamily: "var(--font-mono)",
      fontSize: 11,
      letterSpacing: ".05em",
      color: "var(--bs-accent)",
      marginTop: 4,
      textTransform: "uppercase"
    }
  }, p.r))))));
}
function Contact({
  sent,
  email,
  setEmail,
  onSend
}) {
  return /*#__PURE__*/React.createElement("section", {
    style: {
      maxWidth: 1200,
      margin: "0 auto",
      padding: "40px 40px 96px"
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      position: "relative",
      overflow: "hidden",
      background: "var(--bs-panel-2)",
      border: "1px solid var(--bs-line)",
      borderRadius: "var(--radius-lg)",
      padding: "58px 48px",
      boxShadow: "var(--bs-glow)"
    }
  }, /*#__PURE__*/React.createElement("span", {
    "aria-hidden": true,
    style: {
      position: "absolute",
      top: 18,
      left: 18,
      width: 26,
      height: 26,
      borderTop: "2px solid var(--bs-accent)",
      borderLeft: "2px solid var(--bs-accent)"
    }
  }), /*#__PURE__*/React.createElement("span", {
    "aria-hidden": true,
    style: {
      position: "absolute",
      bottom: 18,
      right: 18,
      width: 26,
      height: 26,
      borderBottom: "2px solid var(--bs-accent)",
      borderRight: "2px solid var(--bs-accent)"
    }
  }), /*#__PURE__*/React.createElement("div", {
    style: {
      maxWidth: 600
    }
  }, /*#__PURE__*/React.createElement(Eyebrow, {
    ar: "\u0644\u0646\u0628\u062F\u0623"
  }, "LET'S BUILD"), /*#__PURE__*/React.createElement("h2", {
    style: {
      fontFamily: "var(--font-hero)",
      fontWeight: 800,
      textTransform: "uppercase",
      fontSize: 54,
      lineHeight: 1.02,
      letterSpacing: ".01em",
      margin: "18px 0 0"
    }
  }, "Tell us the bright idea"), /*#__PURE__*/React.createElement("p", {
    style: {
      fontFamily: "var(--font-body)",
      fontSize: 17,
      lineHeight: 1.6,
      color: "var(--bs-fg-muted)",
      margin: "16px 0 30px"
    }
  }, "Share your goal and we'll come back within one business day with how we'd approach it."), sent ? /*#__PURE__*/React.createElement("div", {
    style: {
      display: "inline-flex",
      alignItems: "center",
      gap: 10,
      fontFamily: "var(--font-display)",
      fontWeight: 600,
      fontSize: 18,
      color: "var(--bs-accent)"
    }
  }, /*#__PURE__*/React.createElement(Icon, {
    name: "check-circle-2",
    size: 22,
    color: "var(--bs-accent)"
  }), " Thank you \u2014 we'll be in touch at ", email || "your inbox", ".") : /*#__PURE__*/React.createElement("div", {
    style: {
      display: "flex",
      gap: 12,
      alignItems: "center",
      maxWidth: 520
    }
  }, /*#__PURE__*/React.createElement("input", {
    value: email,
    onChange: e => setEmail(e.target.value),
    placeholder: "you@company.om",
    type: "email",
    style: {
      flex: 1,
      height: 54,
      padding: "0 18px",
      borderRadius: "var(--radius)",
      border: "1px solid var(--bs-line)",
      background: "color-mix(in srgb, var(--bs-bg) 50%, transparent)",
      color: "var(--bs-fg)",
      fontFamily: "var(--font-body)",
      fontSize: 16,
      outline: "none"
    },
    onFocus: e => {
      e.target.style.borderColor = "var(--bs-accent)";
      e.target.style.boxShadow = "var(--glow-soft)";
    },
    onBlur: e => {
      e.target.style.borderColor = "var(--bs-line)";
      e.target.style.boxShadow = "none";
    }
  }), /*#__PURE__*/React.createElement(LuxBtn, {
    size: "lg",
    onClick: onSend,
    iconRight: /*#__PURE__*/React.createElement(Icon, {
      name: "arrow-right",
      size: 18,
      color: "var(--bs-on-accent)"
    })
  }, "Send")))));
}
function Footer() {
  const cols = [{
    h: "Services",
    l: ["SEO", "Paid Media", "Social", "Web & App"]
  }, {
    h: "Agency",
    l: ["Work", "About", "Team", "Careers"]
  }, {
    h: "Contact",
    l: ["hello@brightstarts.om", "+968 2200 0000", "Muscat, Oman"]
  }];
  return /*#__PURE__*/React.createElement("footer", {
    style: {
      borderTop: "1px solid var(--bs-line)",
      padding: "48px 40px 40px"
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      maxWidth: 1200,
      margin: "0 auto",
      display: "flex",
      justifyContent: "space-between",
      gap: 40,
      flexWrap: "wrap"
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      maxWidth: 280
    }
  }, /*#__PURE__*/React.createElement(Logo, {
    height: 28
  }), /*#__PURE__*/React.createElement("p", {
    style: {
      fontFamily: "var(--font-mono)",
      fontSize: 12,
      color: "var(--bs-fg-subtle)",
      letterSpacing: ".03em",
      margin: "16px 0 0",
      lineHeight: 1.7
    }
  }, "< FROM IDEA TO EXECUTION >")), /*#__PURE__*/React.createElement("div", {
    style: {
      display: "flex",
      gap: 56
    }
  }, cols.map(c => /*#__PURE__*/React.createElement("div", {
    key: c.h
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      fontFamily: "var(--font-mono)",
      fontSize: 11,
      letterSpacing: ".08em",
      textTransform: "uppercase",
      color: "var(--bs-accent)",
      marginBottom: 14
    }
  }, c.h), /*#__PURE__*/React.createElement("ul", {
    style: {
      listStyle: "none",
      padding: 0,
      margin: 0,
      display: "flex",
      flexDirection: "column",
      gap: 10
    }
  }, c.l.map(x => /*#__PURE__*/React.createElement("li", {
    key: x
  }, /*#__PURE__*/React.createElement("a", {
    href: "#",
    style: {
      fontFamily: "var(--font-body)",
      fontSize: 14,
      color: "var(--bs-fg-muted)",
      textDecoration: "none"
    }
  }, x)))))))), /*#__PURE__*/React.createElement("div", {
    style: {
      maxWidth: 1200,
      margin: "40px auto 0",
      paddingTop: 24,
      borderTop: "1px solid var(--bs-line)",
      display: "flex",
      justifyContent: "space-between",
      fontFamily: "var(--font-mono)",
      fontSize: 12,
      color: "var(--bs-fg-subtle)"
    }
  }, /*#__PURE__*/React.createElement("span", null, "\xA9 2026 Bright Starts \xB7 Muscat, Oman"), /*#__PURE__*/React.createElement("span", null, "Terms \xB7 Privacy")));
}
Object.assign(window, {
  Work,
  Testimonials,
  Team,
  Contact,
  Footer
});
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/agency-landing/SectionsBottom.jsx", error: String((e && e.message) || e) }); }

// ui_kits/agency-landing/SectionsTop.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
// Top of the Bright Starts landing: Nav, Hero, Services, Process.

function Nav({
  onContact
}) {
  const links = ["Services", "Work", "Process", "Team"];
  return /*#__PURE__*/React.createElement("header", {
    style: {
      position: "sticky",
      top: 0,
      zIndex: 30,
      display: "flex",
      alignItems: "center",
      justifyContent: "space-between",
      padding: "18px 40px",
      borderBottom: "1px solid var(--bs-line)",
      background: "color-mix(in srgb, var(--bs-bg) 78%, transparent)",
      backdropFilter: "blur(12px)"
    }
  }, /*#__PURE__*/React.createElement(Logo, {
    height: 32
  }), /*#__PURE__*/React.createElement("nav", {
    style: {
      display: "flex",
      gap: 30
    }
  }, links.map(l => /*#__PURE__*/React.createElement("a", {
    key: l,
    href: "#",
    style: {
      fontFamily: "var(--font-body)",
      fontSize: 14.5,
      fontWeight: 500,
      color: "var(--bs-fg-muted)",
      textDecoration: "none"
    },
    onMouseEnter: e => e.currentTarget.style.color = "var(--bs-fg)",
    onMouseLeave: e => e.currentTarget.style.color = "var(--bs-fg-muted)"
  }, l))), /*#__PURE__*/React.createElement(LuxBtn, {
    size: "sm",
    onClick: onContact,
    iconRight: /*#__PURE__*/React.createElement(Icon, {
      name: "arrow-up-right",
      size: 16,
      color: "var(--bs-on-accent)"
    })
  }, "Start a project"));
}
function Hero({
  onContact
}) {
  return /*#__PURE__*/React.createElement("section", {
    style: {
      position: "relative",
      maxWidth: 1200,
      margin: "0 auto",
      padding: "104px 40px 88px",
      overflow: "hidden"
    }
  }, /*#__PURE__*/React.createElement("div", {
    "aria-hidden": true,
    style: {
      position: "absolute",
      right: -90,
      top: 30,
      width: 420,
      height: 420,
      border: "1.5px solid var(--bs-line)",
      borderRadius: 56,
      transform: "rotate(45deg)"
    }
  }), /*#__PURE__*/React.createElement("div", {
    "aria-hidden": true,
    style: {
      position: "absolute",
      right: 30,
      top: 150,
      width: 200,
      height: 200,
      border: "1.5px solid var(--bs-line)",
      borderRadius: 28,
      transform: "rotate(45deg)"
    }
  }), /*#__PURE__*/React.createElement("div", {
    style: {
      position: "relative",
      maxWidth: 800
    }
  }, /*#__PURE__*/React.createElement(Eyebrow, {
    ar: "\u0648\u0643\u0627\u0644\u0629 \u062A\u0633\u0648\u064A\u0642 \u0631\u0642\u0645\u064A"
  }, "DIGITAL MARKETING \xB7 OMAN"), /*#__PURE__*/React.createElement("h1", {
    style: {
      fontFamily: "var(--font-hero)",
      fontWeight: 800,
      textTransform: "uppercase",
      fontSize: 82,
      lineHeight: .98,
      letterSpacing: ".005em",
      margin: "22px 0 0"
    }
  }, "From idea", /*#__PURE__*/React.createElement("br", null), "to ", /*#__PURE__*/React.createElement("span", {
    style: {
      color: "var(--bs-accent)"
    }
  }, "execution.")), /*#__PURE__*/React.createElement("p", {
    style: {
      fontFamily: "var(--font-body)",
      fontSize: 20,
      lineHeight: 1.6,
      color: "var(--bs-fg-muted)",
      maxWidth: 560,
      margin: "26px 0 0"
    }
  }, "Bright Starts is a Muscat-based digital marketing agency for ambitious brands \u2014 we partner with you across growth, strategy and build, turning the bright idea into measurable results."), /*#__PURE__*/React.createElement("div", {
    style: {
      display: "flex",
      gap: 14,
      marginTop: 38
    }
  }, /*#__PURE__*/React.createElement(LuxBtn, {
    size: "lg",
    onClick: onContact,
    iconRight: /*#__PURE__*/React.createElement(Icon, {
      name: "arrow-right",
      size: 18,
      color: "var(--bs-on-accent)"
    })
  }, "Start a project"), /*#__PURE__*/React.createElement(LuxBtn, {
    size: "lg",
    variant: "secondary"
  }, "View our work")), /*#__PURE__*/React.createElement("div", {
    style: {
      display: "flex",
      alignItems: "center",
      gap: 28,
      marginTop: 56
    }
  }, [["120+", "Brands grown"], ["8 yrs", "In the Gulf"], ["4.2x", "Avg. ROAS"]].map(([n, l]) => /*#__PURE__*/React.createElement("div", {
    key: l,
    style: {
      display: "flex",
      alignItems: "center",
      gap: 28
    }
  }, /*#__PURE__*/React.createElement("div", null, /*#__PURE__*/React.createElement("div", {
    style: {
      fontFamily: "var(--font-display)",
      fontWeight: 700,
      fontSize: 30,
      color: "var(--bs-fg)",
      letterSpacing: "-.02em"
    }
  }, n), /*#__PURE__*/React.createElement("div", {
    style: {
      fontFamily: "var(--font-mono)",
      fontSize: 11,
      letterSpacing: ".08em",
      textTransform: "uppercase",
      color: "var(--bs-fg-subtle)",
      marginTop: 4
    }
  }, l)))))));
}
function Services() {
  const items = [{
    icon: "search",
    t: "SEO & Organic Growth",
    d: "Technical SEO, content engines and authority building that compound month over month."
  }, {
    icon: "target",
    t: "Paid Media & PPC",
    d: "Performance campaigns across Google, Meta and TikTok — engineered for ROAS, not vanity."
  }, {
    icon: "share-2",
    t: "Social Media",
    d: "Always-on content, community and creator partnerships tuned for the Gulf audience."
  }, {
    icon: "pen-tool",
    t: "Content & Branding",
    d: "Brand systems, art direction and bilingual content that look and sound premium."
  }, {
    icon: "layout",
    t: "Web & App Design",
    d: "Conversion-first websites and product experiences, designed and built end to end."
  }, {
    icon: "compass",
    t: "Strategy & Consulting",
    d: "Market entry, positioning and growth roadmaps from a senior, embedded team."
  }];
  return /*#__PURE__*/React.createElement("section", {
    style: {
      maxWidth: 1200,
      margin: "0 auto",
      padding: "40px 40px 80px"
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: "flex",
      alignItems: "flex-end",
      justifyContent: "space-between",
      marginBottom: 40,
      flexWrap: "wrap",
      gap: 20
    }
  }, /*#__PURE__*/React.createElement("div", null, /*#__PURE__*/React.createElement(Eyebrow, null, "WHAT WE DO"), /*#__PURE__*/React.createElement("h2", {
    style: {
      fontFamily: "var(--font-display)",
      fontWeight: 700,
      letterSpacing: "-.02em",
      fontSize: 44,
      margin: "16px 0 0"
    }
  }, "Full-funnel, full-service")), /*#__PURE__*/React.createElement("p", {
    style: {
      fontFamily: "var(--font-body)",
      color: "var(--bs-fg-muted)",
      maxWidth: 360,
      fontSize: 16,
      lineHeight: 1.6,
      margin: 0
    }
  }, "One senior team across every channel \u2014 so your growth is joined-up, not stitched together.")), /*#__PURE__*/React.createElement("div", {
    style: {
      display: "grid",
      gridTemplateColumns: "repeat(3, 1fr)",
      gap: 18
    }
  }, items.map((it, i) => /*#__PURE__*/React.createElement(ServiceCard, _extends({
    key: i
  }, it, {
    feature: i === 0
  })))));
}
function ServiceCard({
  icon,
  t,
  d,
  feature
}) {
  const [h, setH] = React.useState(false);
  return /*#__PURE__*/React.createElement("div", {
    onMouseEnter: () => setH(true),
    onMouseLeave: () => setH(false),
    style: {
      position: "relative",
      background: "var(--bs-panel-2)",
      border: "1px solid var(--bs-line)",
      borderRadius: "var(--radius-lg)",
      padding: 28,
      transition: "all var(--dur) var(--ease)",
      transform: h ? "translateY(-3px)" : "none",
      boxShadow: h ? "var(--shadow-lg)" : "none"
    }
  }, /*#__PURE__*/React.createElement("span", {
    "aria-hidden": true,
    style: {
      position: "absolute",
      top: 14,
      left: 14,
      width: 16,
      height: 16,
      borderTop: "2px solid var(--bs-accent)",
      borderLeft: "2px solid var(--bs-accent)",
      opacity: feature ? 1 : 0,
      transition: "opacity var(--dur)"
    }
  }), /*#__PURE__*/React.createElement("span", {
    style: {
      display: "inline-flex",
      alignItems: "center",
      justifyContent: "center",
      width: 46,
      height: 46,
      borderRadius: "var(--radius)",
      background: "color-mix(in srgb, var(--bs-accent) 12%, transparent)",
      marginBottom: 18
    }
  }, /*#__PURE__*/React.createElement(Icon, {
    name: icon,
    size: 22,
    color: "var(--bs-accent)"
  })), /*#__PURE__*/React.createElement("h3", {
    style: {
      fontFamily: "var(--font-display)",
      fontWeight: 600,
      fontSize: 19,
      letterSpacing: "-.01em",
      margin: "0 0 8px"
    }
  }, t), /*#__PURE__*/React.createElement("p", {
    style: {
      fontFamily: "var(--font-body)",
      fontSize: 14.5,
      lineHeight: 1.6,
      color: "var(--bs-fg-muted)",
      margin: 0
    }
  }, d));
}
function Process() {
  const steps = [{
    n: "01",
    t: "Discover",
    d: "Audit, market research and goals. We learn your business before we touch a campaign."
  }, {
    n: "02",
    t: "Strategize",
    d: "A clear roadmap: channels, budget, KPIs and the bright idea that ties it together."
  }, {
    n: "03",
    t: "Execute",
    d: "Design, build and launch — creative, media and web, shipped by one senior team."
  }, {
    n: "04",
    t: "Grow",
    d: "Measure, optimise and scale what works. Transparent reporting, every week."
  }];
  return /*#__PURE__*/React.createElement("section", {
    style: {
      background: "var(--bs-panel)",
      borderTop: "1px solid var(--bs-line)",
      borderBottom: "1px solid var(--bs-line)"
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      maxWidth: 1200,
      margin: "0 auto",
      padding: "76px 40px"
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      textAlign: "center",
      marginBottom: 14
    }
  }, /*#__PURE__*/React.createElement(Eyebrow, {
    ar: "\u0645\u0646 \u0627\u0644\u0641\u0643\u0631\u0629 \u0625\u0644\u0649 \u0627\u0644\u062A\u0646\u0641\u064A\u0630"
  }, "FROM IDEA TO EXECUTION")), /*#__PURE__*/React.createElement("h2", {
    style: {
      textAlign: "center",
      fontFamily: "var(--font-display)",
      fontWeight: 700,
      letterSpacing: "-.02em",
      fontSize: 44,
      margin: "0 0 48px"
    }
  }, "How we work"), /*#__PURE__*/React.createElement("div", {
    style: {
      display: "grid",
      gridTemplateColumns: "repeat(4, 1fr)",
      gap: 0
    }
  }, steps.map((s, i) => /*#__PURE__*/React.createElement("div", {
    key: s.n,
    style: {
      padding: "0 24px",
      borderLeft: i === 0 ? "none" : "1px solid var(--bs-line)"
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: "flex",
      alignItems: "center",
      gap: 10,
      marginBottom: 16
    }
  }, /*#__PURE__*/React.createElement(Diamond, {
    size: 9
  }), /*#__PURE__*/React.createElement("span", {
    style: {
      fontFamily: "var(--font-mono)",
      fontSize: 13,
      color: "var(--bs-accent)",
      letterSpacing: ".1em"
    }
  }, s.n)), /*#__PURE__*/React.createElement("h3", {
    style: {
      fontFamily: "var(--font-display)",
      fontWeight: 600,
      fontSize: 22,
      letterSpacing: "-.01em",
      margin: "0 0 10px"
    }
  }, s.t), /*#__PURE__*/React.createElement("p", {
    style: {
      fontFamily: "var(--font-body)",
      fontSize: 14.5,
      lineHeight: 1.6,
      color: "var(--bs-fg-muted)",
      margin: 0
    }
  }, s.d))))));
}
Object.assign(window, {
  Nav,
  Hero,
  Services,
  Process
});
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/agency-landing/SectionsTop.jsx", error: String((e && e.message) || e) }); }

// ui_kits/agency-landing/shared.jsx
try { (() => {
// Shared helpers for the Bright Starts agency landing.

function Icon({
  name,
  size = 20,
  color = "currentColor",
  strokeWidth = 1.75,
  style = {}
}) {
  const ref = React.useRef(null);
  React.useEffect(() => {
    if (ref.current && window.lucide) {
      ref.current.innerHTML = "";
      const el = document.createElement("i");
      el.setAttribute("data-lucide", name);
      ref.current.appendChild(el);
      window.lucide.createIcons({
        attrs: {
          width: size,
          height: size,
          stroke: color,
          "stroke-width": strokeWidth
        }
      });
    }
  });
  return /*#__PURE__*/React.createElement("span", {
    ref: ref,
    style: {
      display: "inline-flex",
      width: size,
      height: size,
      ...style
    }
  });
}

// Mono eyebrow wrapped in < >, gold/accent toned — the brand device.
function Eyebrow({
  children,
  ar = null,
  style = {}
}) {
  return /*#__PURE__*/React.createElement("span", {
    style: {
      display: "inline-flex",
      alignItems: "center",
      gap: 8,
      fontFamily: "var(--font-mono)",
      fontSize: 12.5,
      fontWeight: 500,
      letterSpacing: ".16em",
      textTransform: "uppercase",
      color: "var(--bs-accent)",
      ...style
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      opacity: .5
    }
  }, "<"), children, ar && /*#__PURE__*/React.createElement("span", {
    style: {
      fontFamily: "var(--font-arabic)",
      letterSpacing: 0,
      opacity: .8
    }
  }, "\xB7 ", ar), /*#__PURE__*/React.createElement("span", {
    style: {
      opacity: .5
    }
  }, ">"));
}

// A small rotated-square diamond divider/ornament.
function Diamond({
  size = 10,
  filled = true,
  style = {}
}) {
  return /*#__PURE__*/React.createElement("span", {
    style: {
      width: size,
      height: size,
      transform: "rotate(45deg)",
      display: "inline-block",
      background: filled ? "var(--bs-accent)" : "transparent",
      border: filled ? "none" : "1.5px solid var(--bs-accent)",
      borderRadius: 2,
      ...style
    }
  });
}

// Gold hairline rule with a centered diamond.
function GoldRule({
  style = {}
}) {
  return /*#__PURE__*/React.createElement("span", {
    style: {
      display: "flex",
      alignItems: "center",
      gap: 12,
      ...style
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      flex: 1,
      height: 1,
      background: "linear-gradient(90deg, transparent, var(--bs-line))"
    }
  }), /*#__PURE__*/React.createElement(Diamond, {
    size: 8
  }), /*#__PURE__*/React.createElement("span", {
    style: {
      flex: 1,
      height: 1,
      background: "linear-gradient(90deg, var(--bs-line), transparent)"
    }
  }));
}
function Logo({
  height = 30
}) {
  return /*#__PURE__*/React.createElement("span", {
    style: {
      display: "inline-flex",
      alignItems: "center",
      gap: 11
    }
  }, /*#__PURE__*/React.createElement("img", {
    src: "../../assets/logo-mark-color.png",
    alt: "",
    style: {
      height,
      width: "auto",
      display: "block"
    }
  }), /*#__PURE__*/React.createElement("span", {
    style: {
      display: "flex",
      flexDirection: "column",
      lineHeight: 1
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      fontFamily: "var(--font-hero)",
      fontWeight: 800,
      fontSize: height * 0.6,
      letterSpacing: ".02em",
      color: "var(--bs-fg)",
      textTransform: "uppercase"
    }
  }, "Bright Starts"), /*#__PURE__*/React.createElement("span", {
    style: {
      fontFamily: "var(--font-mono)",
      fontSize: height * 0.2,
      letterSpacing: ".32em",
      color: "var(--bs-accent)",
      textTransform: "uppercase",
      marginTop: 3
    }
  }, "Muscat \xB7 Oman")));
}

// Luxe button — gold fill (primary) / outline (secondary) / text (ghost).
function LuxBtn({
  children,
  variant = "primary",
  size = "md",
  iconRight = null,
  onClick,
  style = {}
}) {
  const [h, setH] = React.useState(false);
  const pad = size === "lg" ? "0 30px" : size === "sm" ? "0 16px" : "0 24px";
  const ht = size === "lg" ? 54 : size === "sm" ? 38 : 46;
  const base = {
    display: "inline-flex",
    alignItems: "center",
    justifyContent: "center",
    gap: 9,
    height: ht,
    padding: pad,
    fontFamily: "var(--font-display)",
    fontWeight: 600,
    fontSize: size === "lg" ? 16 : 14.5,
    letterSpacing: ".01em",
    borderRadius: "var(--radius)",
    cursor: "pointer",
    border: "1px solid transparent",
    whiteSpace: "nowrap",
    transition: "all var(--dur) var(--ease)",
    transform: h ? "translateY(-2px)" : "none"
  };
  const v = {
    primary: {
      background: "var(--bs-accent)",
      color: "var(--bs-on-accent)",
      boxShadow: h ? "var(--bs-glow)" : "none"
    },
    secondary: {
      background: "transparent",
      color: "var(--bs-fg)",
      borderColor: "var(--bs-line)",
      borderWidth: 1,
      ...(h ? {
        borderColor: "var(--bs-accent)"
      } : {})
    },
    ghost: {
      background: h ? "var(--bs-line-soft)" : "transparent",
      color: "var(--bs-accent-strong)"
    }
  };
  return /*#__PURE__*/React.createElement("button", {
    onClick: onClick,
    onMouseEnter: () => setH(true),
    onMouseLeave: () => setH(false),
    style: {
      ...base,
      ...v[variant],
      ...style
    }
  }, children, iconRight);
}
Object.assign(window, {
  Icon,
  Eyebrow,
  Diamond,
  GoldRule,
  Logo,
  LuxBtn
});
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/agency-landing/shared.jsx", error: String((e && e.message) || e) }); }

// ui_kits/marketing/CTA.jsx
try { (() => {
function CTA({
  onGetStarted,
  joined,
  email,
  setEmail
}) {
  const {
    Button,
    Input,
    Eyebrow,
    Badge
  } = window.BrightStarsDesignSystem_7248ca;
  return /*#__PURE__*/React.createElement("section", {
    style: {
      padding: "40px 32px 96px",
      maxWidth: 1200,
      margin: "0 auto"
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      position: "relative",
      overflow: "hidden",
      background: "var(--surface-2)",
      border: "1px solid var(--border)",
      borderRadius: "var(--radius-lg)",
      padding: "56px 48px",
      boxShadow: "var(--glow)"
    }
  }, /*#__PURE__*/React.createElement("span", {
    "aria-hidden": true,
    style: {
      position: "absolute",
      top: 18,
      left: 18,
      width: 26,
      height: 26,
      borderTop: "2px solid var(--brand-orange)",
      borderLeft: "2px solid var(--brand-orange)"
    }
  }), /*#__PURE__*/React.createElement("span", {
    "aria-hidden": true,
    style: {
      position: "absolute",
      bottom: 18,
      right: 18,
      width: 26,
      height: 26,
      borderBottom: "2px solid var(--brand-orange)",
      borderRight: "2px solid var(--brand-orange)"
    }
  }), /*#__PURE__*/React.createElement("div", {
    style: {
      maxWidth: 560
    }
  }, /*#__PURE__*/React.createElement(Eyebrow, {
    tone: "orange"
  }, "START BUILDING"), /*#__PURE__*/React.createElement("h2", {
    style: {
      fontFamily: "var(--font-hero)",
      fontWeight: 800,
      textTransform: "uppercase",
      fontSize: 52,
      lineHeight: 1.02,
      letterSpacing: "0.01em",
      margin: "18px 0 0",
      color: "var(--text)"
    }
  }, "Your best work starts here"), /*#__PURE__*/React.createElement("p", {
    style: {
      fontFamily: "var(--font-body)",
      fontSize: 17,
      lineHeight: 1.6,
      color: "var(--text-muted)",
      margin: "16px 0 28px"
    }
  }, "Create a free workspace in seconds. No credit card, no sales call."), joined ? /*#__PURE__*/React.createElement("div", {
    style: {
      display: "inline-flex",
      alignItems: "center",
      gap: 10
    }
  }, /*#__PURE__*/React.createElement(Badge, {
    tone: "success",
    dot: true
  }, "You're in"), /*#__PURE__*/React.createElement("span", {
    style: {
      fontFamily: "var(--font-body)",
      color: "var(--text)",
      fontSize: 16
    }
  }, "Check ", email || "your inbox", " for the magic link.")) : /*#__PURE__*/React.createElement("div", {
    style: {
      display: "flex",
      gap: 12,
      alignItems: "flex-end",
      maxWidth: 480
    }
  }, /*#__PURE__*/React.createElement(Input, {
    placeholder: "you@team.dev",
    type: "email",
    value: email,
    onChange: e => setEmail(e.target.value),
    iconLeft: /*#__PURE__*/React.createElement(Icon, {
      name: "mail",
      size: 16,
      color: "var(--text-subtle)"
    }),
    style: {
      flex: 1
    }
  }), /*#__PURE__*/React.createElement(Button, {
    variant: "primary",
    size: "md",
    onClick: onGetStarted
  }, "Get started")))));
}
Object.assign(window, {
  CTA
});
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/marketing/CTA.jsx", error: String((e && e.message) || e) }); }

// ui_kits/marketing/Features.jsx
try { (() => {
function Features() {
  const {
    Card,
    Eyebrow
  } = window.BrightStarsDesignSystem_7248ca;
  const items = [{
    icon: "rocket",
    title: "Ship in minutes",
    body: "Push to deploy with zero-config pipelines. Preview every branch on its own URL."
  }, {
    icon: "shield-check",
    title: "Secure by default",
    body: "SOC 2, SSO, and per-environment secrets. Compliance that stays out of your way."
  }, {
    icon: "git-branch",
    title: "Built for teams",
    body: "Branch-based workflows, review apps, and audit logs that engineers actually read."
  }, {
    icon: "gauge",
    title: "Observability in",
    body: "Traces, logs, and metrics wired from the first commit — no dashboards to glue together."
  }, {
    icon: "terminal",
    title: "CLI-first",
    body: "Everything you click, you can script. A clean API surface and a fast local dev loop."
  }, {
    icon: "users",
    title: "Elite network",
    body: "Get matched with vetted senior engineers, or get discovered for the work that fits."
  }];
  return /*#__PURE__*/React.createElement("section", {
    style: {
      padding: "72px 32px",
      maxWidth: 1200,
      margin: "0 auto"
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      textAlign: "center",
      marginBottom: 48
    }
  }, /*#__PURE__*/React.createElement(Eyebrow, {
    tone: "navy"
  }, "WHY BRIGHT STARS"), /*#__PURE__*/React.createElement("h2", {
    style: {
      fontFamily: "var(--font-display)",
      fontWeight: 700,
      letterSpacing: "-0.02em",
      fontSize: 42,
      margin: "16px 0 0",
      color: "var(--text)"
    }
  }, "The platform senior teams choose")), /*#__PURE__*/React.createElement("div", {
    style: {
      display: "grid",
      gridTemplateColumns: "repeat(3, 1fr)",
      gap: 20
    }
  }, items.map((it, i) => /*#__PURE__*/React.createElement(Card, {
    key: i,
    accent: i === 0,
    interactive: true
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      display: "inline-flex",
      alignItems: "center",
      justifyContent: "center",
      width: 44,
      height: 44,
      borderRadius: "var(--radius)",
      background: "var(--orange-soft)",
      color: "var(--brand-orange)",
      marginBottom: 16
    }
  }, /*#__PURE__*/React.createElement(Icon, {
    name: it.icon,
    size: 22,
    color: "var(--brand-orange)"
  })), /*#__PURE__*/React.createElement("h3", {
    style: {
      fontFamily: "var(--font-display)",
      fontWeight: 600,
      letterSpacing: "-0.02em",
      fontSize: 20,
      margin: "0 0 8px",
      color: "var(--text)"
    }
  }, it.title), /*#__PURE__*/React.createElement("p", {
    style: {
      fontFamily: "var(--font-body)",
      fontSize: 15,
      lineHeight: 1.6,
      color: "var(--text-muted)",
      margin: 0
    }
  }, it.body)))));
}
Object.assign(window, {
  Features
});
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/marketing/Features.jsx", error: String((e && e.message) || e) }); }

// ui_kits/marketing/Footer.jsx
try { (() => {
function Footer() {
  const cols = [{
    h: "Platform",
    links: ["Deploy", "Observability", "Secrets", "CLI"]
  }, {
    h: "Company",
    links: ["About", "Careers", "Blog", "Press"]
  }, {
    h: "Resources",
    links: ["Docs", "Changelog", "Status", "Support"]
  }];
  return /*#__PURE__*/React.createElement("footer", {
    style: {
      borderTop: "1px solid var(--border)",
      padding: "48px 32px 40px"
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      maxWidth: 1200,
      margin: "0 auto",
      display: "flex",
      justifyContent: "space-between",
      gap: 40,
      flexWrap: "wrap"
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      maxWidth: 280
    }
  }, /*#__PURE__*/React.createElement(Logo, {
    height: 26
  }), /*#__PURE__*/React.createElement("p", {
    style: {
      fontFamily: "var(--font-mono)",
      fontSize: 12,
      color: "var(--text-subtle)",
      letterSpacing: ".03em",
      margin: "16px 0 0",
      lineHeight: 1.7
    }
  }, "< BUILD BRIGHT >", /*#__PURE__*/React.createElement("br", null), "The home for top-tier builders.")), /*#__PURE__*/React.createElement("div", {
    style: {
      display: "flex",
      gap: 56
    }
  }, cols.map(c => /*#__PURE__*/React.createElement("div", {
    key: c.h
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      fontFamily: "var(--font-mono)",
      fontSize: 11,
      letterSpacing: ".06em",
      textTransform: "uppercase",
      color: "var(--navy-200)",
      marginBottom: 14
    }
  }, c.h), /*#__PURE__*/React.createElement("ul", {
    style: {
      listStyle: "none",
      padding: 0,
      margin: 0,
      display: "flex",
      flexDirection: "column",
      gap: 10
    }
  }, c.links.map(l => /*#__PURE__*/React.createElement("li", {
    key: l
  }, /*#__PURE__*/React.createElement("a", {
    href: "#",
    style: {
      fontFamily: "var(--font-body)",
      fontSize: 14,
      color: "var(--text-muted)",
      textDecoration: "none"
    }
  }, l)))))))), /*#__PURE__*/React.createElement("div", {
    style: {
      maxWidth: 1200,
      margin: "40px auto 0",
      paddingTop: 24,
      borderTop: "1px solid var(--border)",
      display: "flex",
      justifyContent: "space-between",
      fontFamily: "var(--font-mono)",
      fontSize: 12,
      color: "var(--text-subtle)"
    }
  }, /*#__PURE__*/React.createElement("span", null, "\xA9 2026 Bright Stars, Inc."), /*#__PURE__*/React.createElement("span", null, "Terms \xB7 Privacy \xB7 Security")));
}
Object.assign(window, {
  Footer
});
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/marketing/Footer.jsx", error: String((e && e.message) || e) }); }

// ui_kits/marketing/Hero.jsx
try { (() => {
function Hero({
  onGetStarted
}) {
  const {
    Button,
    Eyebrow,
    Badge
  } = window.BrightStarsDesignSystem_7248ca;
  return /*#__PURE__*/React.createElement("section", {
    style: {
      position: "relative",
      padding: "96px 32px 80px",
      maxWidth: 1200,
      margin: "0 auto",
      overflow: "hidden"
    }
  }, /*#__PURE__*/React.createElement("div", {
    "aria-hidden": true,
    style: {
      position: "absolute",
      right: -60,
      top: 40,
      width: 360,
      height: 360,
      border: "2px solid var(--navy-700)",
      borderRadius: 48,
      transform: "rotate(45deg)",
      opacity: .6
    }
  }), /*#__PURE__*/React.createElement("div", {
    style: {
      position: "relative",
      maxWidth: 760
    }
  }, /*#__PURE__*/React.createElement(Eyebrow, {
    tone: "orange"
  }, "BUILD BRIGHT"), /*#__PURE__*/React.createElement("h1", {
    style: {
      fontFamily: "var(--font-hero)",
      fontWeight: 800,
      textTransform: "uppercase",
      fontSize: 76,
      lineHeight: 1.0,
      letterSpacing: "0.01em",
      margin: "20px 0 0",
      color: "var(--text)"
    }
  }, "Where top-tier", /*#__PURE__*/React.createElement("br", null), "builders ", /*#__PURE__*/React.createElement("span", {
    style: {
      color: "var(--brand-orange)"
    }
  }, "ship.")), /*#__PURE__*/React.createElement("p", {
    style: {
      fontFamily: "var(--font-body)",
      fontSize: 19,
      lineHeight: 1.6,
      color: "var(--text-muted)",
      maxWidth: 540,
      margin: "24px 0 0"
    }
  }, "Bright Stars is the home for senior dev teams \u2014 precise infrastructure, zero fluff, and the network that connects elite engineers to the work that matters."), /*#__PURE__*/React.createElement("div", {
    style: {
      display: "flex",
      gap: 14,
      marginTop: 36
    }
  }, /*#__PURE__*/React.createElement(Button, {
    variant: "primary",
    size: "lg",
    onClick: onGetStarted,
    iconRight: /*#__PURE__*/React.createElement(Icon, {
      name: "arrow-right",
      size: 18,
      color: "#0A0F18"
    })
  }, "Start building"), /*#__PURE__*/React.createElement(Button, {
    variant: "secondary",
    size: "lg",
    iconLeft: /*#__PURE__*/React.createElement(Icon, {
      name: "code-2",
      size: 18
    })
  }, "View the docs")), /*#__PURE__*/React.createElement("div", {
    style: {
      display: "flex",
      alignItems: "center",
      gap: 12,
      marginTop: 40
    }
  }, /*#__PURE__*/React.createElement(Badge, {
    tone: "success",
    dot: true
  }, "99.99% uptime"), /*#__PURE__*/React.createElement(Badge, {
    tone: "navy"
  }, "SOC 2 Type II"), /*#__PURE__*/React.createElement("span", {
    style: {
      fontFamily: "var(--font-mono)",
      fontSize: 12,
      color: "var(--text-subtle)",
      letterSpacing: ".04em"
    }
  }, "Trusted by 4,200+ engineering teams"))));
}
Object.assign(window, {
  Hero
});
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/marketing/Hero.jsx", error: String((e && e.message) || e) }); }

// ui_kits/marketing/Nav.jsx
try { (() => {
function Nav({
  onGetStarted
}) {
  const {
    Button
  } = window.BrightStarsDesignSystem_7248ca;
  const links = ["Platform", "Solutions", "Pricing", "Careers", "Docs"];
  return /*#__PURE__*/React.createElement("header", {
    style: {
      position: "sticky",
      top: 0,
      zIndex: 20,
      display: "flex",
      alignItems: "center",
      justifyContent: "space-between",
      padding: "16px 32px",
      borderBottom: "1px solid var(--border)",
      background: "rgba(0,0,0,.72)",
      backdropFilter: "blur(10px)"
    }
  }, /*#__PURE__*/React.createElement(Logo, {
    height: 30
  }), /*#__PURE__*/React.createElement("nav", {
    style: {
      display: "flex",
      gap: 28
    }
  }, links.map(l => /*#__PURE__*/React.createElement("a", {
    key: l,
    href: "#",
    style: {
      fontFamily: "var(--font-body)",
      fontSize: 14.5,
      fontWeight: 500,
      color: "var(--text-muted)",
      textDecoration: "none",
      transition: "color var(--dur) var(--ease)"
    },
    onMouseEnter: e => e.currentTarget.style.color = "var(--text)",
    onMouseLeave: e => e.currentTarget.style.color = "var(--text-muted)"
  }, l))), /*#__PURE__*/React.createElement("div", {
    style: {
      display: "flex",
      alignItems: "center",
      gap: 12
    }
  }, /*#__PURE__*/React.createElement(Button, {
    variant: "ghost",
    size: "sm"
  }, "Sign in"), /*#__PURE__*/React.createElement(Button, {
    variant: "primary",
    size: "sm",
    onClick: onGetStarted
  }, "Get started")));
}
Object.assign(window, {
  Nav
});
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/marketing/Nav.jsx", error: String((e && e.message) || e) }); }

// ui_kits/marketing/shared.jsx
try { (() => {
// Shared Icon helper — renders a Lucide glyph and (re)hydrates it.
function Icon({
  name,
  size = 20,
  color = "currentColor",
  strokeWidth = 1.9,
  style = {}
}) {
  const ref = React.useRef(null);
  React.useEffect(() => {
    if (ref.current && window.lucide) {
      ref.current.innerHTML = "";
      const el = document.createElement("i");
      el.setAttribute("data-lucide", name);
      ref.current.appendChild(el);
      window.lucide.createIcons({
        attrs: {
          width: size,
          height: size,
          stroke: color,
          "stroke-width": strokeWidth
        }
      });
    }
  });
  return /*#__PURE__*/React.createElement("span", {
    ref: ref,
    style: {
      display: "inline-flex",
      width: size,
      height: size,
      ...style
    }
  });
}

// Logo lockup (mark image + wordmark text)
function Logo({
  height = 30
}) {
  return /*#__PURE__*/React.createElement("span", {
    style: {
      display: "inline-flex",
      alignItems: "center",
      gap: 10
    }
  }, /*#__PURE__*/React.createElement("img", {
    src: "../../assets/logo-mark-color.png",
    alt: "",
    style: {
      height,
      width: "auto",
      display: "block"
    }
  }), /*#__PURE__*/React.createElement("span", {
    style: {
      fontFamily: "var(--font-hero)",
      fontWeight: 800,
      fontSize: height * 0.62,
      letterSpacing: "0.02em",
      color: "var(--text)",
      textTransform: "uppercase"
    }
  }, "Bright Stars"));
}
Object.assign(window, {
  Icon,
  Logo
});
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/marketing/shared.jsx", error: String((e && e.message) || e) }); }

__ds_ns.Button = __ds_scope.Button;

__ds_ns.IconButton = __ds_scope.IconButton;

__ds_ns.Avatar = __ds_scope.Avatar;

__ds_ns.Badge = __ds_scope.Badge;

__ds_ns.Card = __ds_scope.Card;

__ds_ns.Eyebrow = __ds_scope.Eyebrow;

__ds_ns.Checkbox = __ds_scope.Checkbox;

__ds_ns.Input = __ds_scope.Input;

__ds_ns.Select = __ds_scope.Select;

__ds_ns.Switch = __ds_scope.Switch;

})();
