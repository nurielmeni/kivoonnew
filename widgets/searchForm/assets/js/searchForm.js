var SearchForm = (function ($) {
  var formWrapperSelector, resultsWrapperSelector, applyUrl;
  var loader = $('<div class="loader"></div>');

  function init(options) {
    console.log("Search Form: Init");

    formWrapperSelector = "#" + options.name;
    resultsWrapperSelector = "#" + options.resultsWrapperElementId;
    applyUrl = options.applyUrl;

    initUrlHandler();
    // EVENT LISTENERS
    $(window).on("popstate", function (event) {
      popStateHandler();
    });

    // SUBMIT CLICKED
    $(formWrapperSelector + ' button[type="submit"]').on("click", function (e) {
      e.preventDefault();

      var formData = new FormData();
      formData.append("search", 1);
      formData.append("categories", $("#select-category").val());
      formData.append("regions", $("#select-location").val());
      searchJobs(formData);
    });

    //
    $(document).on(
      "click",
      "#search-results button.show-job-details",
      function () {
        $(this).toggleClass("up");
        $(this).parents(".job-wrapper").find(".job-details").toggle();
      }
    );
  }

  function initUrlHandler() {
    var searchParams = new URLSearchParams(window.location.search);
    if (
      window.location.pathname === "/" &&
      searchParams.get("search") === "1"
    ) {
      history.replaceState({}, "", "");
      searchJobs(searchParams);
    }
  }

  function popStateHandler() {
    var searchParams = new URLSearchParams(window.location.search);
    if (
      window.location.pathname === "/" &&
      searchParams.get("search") === "1"
    ) {
      history.replaceState({}, "", "");
      $(".home-element").show();
      $(resultsWrapperSelector).html("");
    } else if (
      window.location.pathname === "/" &&
      searchParams.keys.length === 0
    ) {
      $(".home-element").show();
      $(resultsWrapperSelector).html("");
    }
  }

  function searchJobs(formData) {
    var searchParams = new URLSearchParams(formData).toString();
    $.ajax({
      url: applyUrl,
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      dataType: "html",
      beforeSend: function () {
        history.pushState({ fd: searchParams }, "search", "?" + searchParams);
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
