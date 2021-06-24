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

    // APPLY JOB
    $(document).on("beforeSubmit", applyFormSelector, applyJob.bind(this));

    // CONTACT
    $(document).on("beforeSubmit", contactFormSelector, contact.bind(this));

    function contact() {
      console.log("Befroe Submit");
      var data = $(contactForm).serialize();
      $.ajax({
        url: $(contactForm).attr("action"),
        type: "POST",
        data: data,
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
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: "html",
        success: function (response) {
          showResults("#apply .content-wrapper", response);
        },
        error: function (jqXHR, errMsg) {
          console.log("Apply error: ", errMsg);
          showResults("#apply .content-wrapper", errorMessage);
        },
        type: "POST",
      });
      return false;
    }

    function showResults(el, result) {
      $(el + ">*").hide();
      $(el).append('<div class="results-wrapper">' + result + "</div>");
    }

    function removeResults(el) {
      $(el).find(".results-wrapper").remove();
      $(el + ">*").show();
    }

    return {
      version: version,
      applyJob: applyJob,
      removeResults: removeResults,
    };
  })(jQuery);
