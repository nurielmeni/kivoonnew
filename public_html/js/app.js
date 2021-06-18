"use strict";

var Kivoon =
  Kivoon ||
  (function ($) {
    var version = "1.0.0.";
    var contactForm = $("#contact-form");

    /**** READY FUNCTION ****/
    $(document).ready(function () {
      $(contactForm).on("click", function (e) {
        console.log("Befroe Submit");
        e.preventDefault();
        var data = contactForm.serialize();
        $.ajax({
          url: contactForm.attr("action"),
          type: "POST",
          data: data,
          success: function (data) {
            // Implement successful
          },
          error: function (jqXHR, errMsg) {
            alert(errMsg);
          },
        });
        return false; // prevent default submit
      });
    });

    return {
      version: version,
    };
  })(jQuery);
