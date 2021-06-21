var SearchForm = (function ($) {
  var formWrapperSelector, resultsWrapperSelector, applyUrl;
  var loader = $('<div class="loader"></div>');

  function init(options) {
    console.log("Search Form: Init");

    formWrapperSelector = "#" + options.name;
    resultsWrapperSelector = "#" + options.resultsWrapperElementId;
    applyUrl = options.applyUrl;

    // EVENT LISTENERS

    // SUBMIT CLICKED
    $(formWrapperSelector + ' button[type="submit"]').on("click", function (e) {
      e.preventDefault();

      var formData = new FormData();
      formData.append("categories", $("#select-category").val());
      formData.append("regions", $("#select-location").val());
      searchJobs(formData);
    });
  }

  function searchJobs(formData) {
    $.ajax({
      url: applyUrl,
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      dataType: "html",
      beforeSend: function () {
        $(".home-element").hide();
        $(resultsWrapperSelector).show();
        $(resultsWrapperSelector).html(
          '<div id="apply-response" class="shadowed-box rounded"><div id="nls-loader" class="loader">אנא המתן...</div></div>'
        );
        var offset = $(resultsWrapperSelector).offset();
        $("html, body").animate({
          scrollTop: offset.top - 100,
        });
      },
      success: function (response) {
        $(resultsWrapperSelector).html(response);
      },
      error: function (response) {
        console.log(response);
        $(resultsWrapperSelector).html(
          '<h3 style="text-align: center; padding-top: 40px;">התרחשה שגיאה</h3><p style="text-align: center">לא הייתה אפשרות לבצע את החיפוש.</p>'
        );
      },
      type: "POST",
    });
  }

  function show() {
    $(formWrapperSelector).show();
  }

  function hide() {
    $(formWrapperSelector).hide();
  }

  $(document).ready(function () {});

  return {
    init: init,
    show: show,
    hide: hide,
  };
})(jQuery);
