"use strict";

var Kivoon =
  Kivoon ||
  (function ($) {
    var version = "1.0.0.";
    var errorMessage =
      '<h3 style="text-align: center; padding-top: 40px;">התרחשה שגיאה</h3><p style="text-align: center">שליחת הפנייה נכשלה.</p>';
    var contactFormSelector = "#kivoon-contact";
    var contactForm = $(contactFormSelector)[0];
    var applyFormSelector = "#kivoon-apply";
    var applyForm = $(applyFormSelector)[0];
    var loader = $('<div id="nls-loader" class="loader">אנא המתן...</div>');

    // APPLY JOB
    $(document).on("beforeSubmit", applyFormSelector, applyJob.bind(this));

    // CONTACT
    $(document).on("beforeSubmit", contactFormSelector, contact.bind(this));

    $(document).on(
      "click",
      ".content-wrapper .results-wrapper span.close",
      function () {
        removeResults($(this).parents(".content-wrapper"));
      }
    );

    function contact() {
      console.log("Befroe Submit");
      var data = $(contactForm).serialize();
      $.ajax({
        url: $(contactForm).attr("action"),
        type: "POST",
        data: data,
        beforeSend: showLoader.bind(null, "#contact .content-wrapper"),
        success: function (response) {
          showResults("#contact .content-wrapper", response);
        },
        error: function (jqXHR, errMsg) {
          console.log("Contact error: ", errMsg);
          showResults("#contact .content-wrapper", errorMessage);
        },
      });
      return false; // prevent default submit
    }

    function applyJob(event) {
      console.log("Apply Kivoon");

      var job = SearchForm.getJob();
      var formData = new FormData(applyForm);
      if (job) {
        formData.append("jobCode", job.jobCode);
        formData.append("jobId", job.jobId);
      }

      $.ajax({
        url: $(applyForm).attr("action"),
        type: "POST",
        data: formData,
        beforeSend: showLoader.bind(null, "#apply .content-wrapper"),
        success: function (response) {
          showResults("#apply .content-wrapper", response);
        },
        error: function (jqXHR, errMsg) {
          console.log("Apply error: ", errMsg);
          showResults("#apply .content-wrapper", errorMessage);
        },
      });
      return false;
    }

    function showLoader(el) {
      $(el).children().hide();
      $(el).append($(loader));
    }

    function showResults(el, result) {
      $(el).find("#nls-loader").remove();
      $(el).children().hide();
      $(el).append(
        '<div class="results-wrapper"><span class="close">X</span>' +
          result +
          "</div>"
      );
    }

    function removeResults(el) {
      $(el).find(".results-wrapper").remove();
      $(el).children().show();
    }

    function resetApply() {
      $(applyFormSelector).yiiActiveForm("resetForm");
      applyForm.reset();
    }
    function resetContact() {
      $(contactFormSelector).yiiActiveForm("resetForm");
      contactForm.reset();
    }
    return {
      version: version,
      applyJob: applyJob,
      removeResults: removeResults,
      resetApply: resetApply,
      resetContact: resetContact,
    };
  })(jQuery);
