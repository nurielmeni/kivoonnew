var SearchForm = (function ($) {
  var formWrapperSelector,
    resultsWrapperSelector,
    applyResultsWrapperSelector,
    applyUrl,
    searchUrl,
    jobCode,
    jobId;
  var loader = $('<div class="loader"></div>');

  function init(options) {
    console.log("Search Form: Init");

    formWrapperSelector = "#" + options.name;
    resultsWrapperSelector = "#" + options.resultsWrapperElementId;
    applyResultsWrapperSelector = "#" + options.applyResultsWrapperSelector;
    applyUrl = options.applyUrl;
    searchUrl = options.searchUrl;

    initUrlHandler();
    // EVENT LISTENERS
    $(window).on("popstate", function (event) {
      popStateHandler();
    });

    // SEARCH CLICKED
    $(formWrapperSelector + ' button[type="submit"]').on("click", function (e) {
      e.preventDefault();

      var formData = new FormData();
      formData.append("action", "search");
      formData.append("categories", $("#select-category").val());
      formData.append("regions", $("#select-location").val());
      searchJobs(formData);
    });

    // TOGGLE JOB DETAILS
    $(document).on(
      "click",
      "#search-results button.show-job-details",
      function () {
        $(this).toggleClass("up");
        $(this).parents(".job-wrapper").find(".job-details").toggle();
      }
    );

    // APPLY FORM
    $(document).on(
      "click",
      ".job-wrapper button.apply",
      showApplyForm.bind(this)
    );

    // APPLY JOB
    $(document).on(
      "click",
      '#apply button[type="submit"]',
      applyJob.bind(this)
    );
  }

  function showSearchResults(searchParams) {
    history.pushState({ fd: searchParams }, "search", "?" + searchParams);
    $(".home-element").hide();
    $(resultsWrapperSelector).show();
    $(resultsWrapperSelector).html(
      '<div id="apply-response" class="shadowed-box rounded"><div id="nls-loader" class="loader">אנא המתן...</div></div>'
    );

    offsetElement(resultsWrapperSelector);
  }

  function showHomePage() {
    $(".home-element").show();
    $(resultsWrapperSelector).html("");
    $(applyResultsWrapperSelector).html("");
  }

  function showApplyForm(job) {
    job.preventDefault();
    jobCode = $(job.target).data("job-code");
    jobId = $(job.target).data("job-id");

    history.pushState({}, "apply", "apply");
    $(".home-element").hide();
    $(".search-results-element").hide();
    $(".apply-element").show();
    offsetElement(".apply-element");
  }

  function showApplyResult() {
    $(".home-element").hide();
    $(".search-results-element").hide();
    $(".apply-element").hide();
    $(applyResultsWrapperSelector).show();
    $(applyResultsWrapperSelector).html(
      '<div id="apply-response" class="shadowed-box rounded"><div id="nls-loader" class="loader">אנא המתן...</div></div>'
    );

    offsetElement(applyResultsWrapperSelector);
  }

  function offsetElement(el) {
    var offset = $(el).offset();
    if (offset) {
      $("html, body").animate({
        scrollTop: offset.top - 100,
      });
    }
  }

  function initUrlHandler() {
    var searchParams = new URLSearchParams(window.location.search);
    if (
      window.location.pathname === "/" &&
      searchParams.get("action") === "search"
    ) {
      history.replaceState({}, "", "");
      searchJobs(searchParams);
    }
  }

  function popStateHandler() {
    var searchParams = new URLSearchParams(window.location.search);
    if (
      window.location.pathname === "/" &&
      searchParams.get("action") === "search"
    ) {
      history.replaceState({}, "", "");
      showHomePage();
    } else if (
      window.location.pathname === "/" &&
      searchParams.get("action") === "apply"
    ) {
      showApplyForm("");
    } else if (
      window.location.pathname === "/" &&
      searchParams.keys.length === 0
    ) {
      showHomePage();
    }
  }

  function applyJob(event) {
    event.preventDefault();

    var formData = new FormData($("#apply form")[0]);
    formData.append("jobCode", jobCode);
    formData.append("jobId", jobId);

    var searchParams = new URLSearchParams(formData).toString();

    $.ajax({
      url: applyUrl,
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      dataType: "html",
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

  function searchJobs(formData) {
    var searchParams = new URLSearchParams(formData).toString();
    $.ajax({
      url: searchUrl,
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      dataType: "html",
      beforeSend: showSearchResults.bind(this, searchParams),
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
