import Popper from '../../node_modules/popper.js/dist/popper.js';

// Required to enable animations on dropdowns/tooltips/popovers
Popper.Defaults.modifiers.computeStyle.gpuAcceleration = false;

export { Popper };
