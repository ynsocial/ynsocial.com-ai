(function () {
    "use strict";

    /* Form Wizard 1 */
    let args = {
        "wz_class": ".wizard-tab",
        highlight: true,
        highlight_time: 1000,
    };
    const wizard = new Wizard1(args);
    wizard.init();
    /* Form Wizard 1 */

    /* Data Picker */
    flatpickr("#date", {});
    /* Data Picker */

    /* Form Wizard with validation */
    new Wizard('#basicwizard', {
        validate: true,
    })
    /* Form Wizard with validation */

    /* Wizard with Progress */
    new Wizard("#progresswizard",{
        validate: true,
        progress: true
    });
    /* Wizard with Progress */

})();