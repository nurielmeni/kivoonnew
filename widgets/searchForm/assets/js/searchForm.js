var SearchForm = (function ($) {
  var page = {
    home: "home",
    searchResults: "searchResults",
    apply: "apply",
  };

  var formWrapperSelector,
    resultsWrapperSelector,
    applyResultsWrapperSelector,
    applyUrl,
    searchUrl,
    jobCode,
    jobId,
    searchParams,
    currentPage = page.home;
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

      searchParams = new FormData();
      searchParams.append("action", "search");
      searchParams.append("categories", $("#select-category").val());
      searchParams.append("regions", $("#select-location").val());

      searchJobs();
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

  function showSearchResults() {
    setHistory(page.searchResults);

    $(".home-element").hide();
    $(".search-results-element").show();
    $(resultsWrapperSelector).html(
      '<div id="apply-response" class="shadowed-box rounded"><div id="nls-loader" class="loader">אנא המתן...</div></div>'
    );

    offsetElement(resultsWrapperSelector);
  }

  function showHomePage() {
    setHistory(page.home);

    $(".home-element").show();
    $(resultsWrapperSelector).html("");
    $(applyResultsWrapperSelector).html("");
  }

  function showApplyForm(job) {
    job.preventDefault();

    jobCode = $(job.target).data("job-code");
    jobId = $(job.target).data("job-id");

    setHistory(page.apply);

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
    searchParams = new URLSearchParams(window.location.search);
    if (
      window.location.pathname === "/" &&
      searchParams.get("action") === "search"
    ) {
      searchJobs();
    }
  }

  function setHistory(routeTo) {
    var lastSearchParams = new URLSearchParams(searchParams);

    switch (currentPage) {
      case page.searchResults:
        history.pushState({}, "search", "?" + lastSearchParams);
        break;
      case page.apply:
        break;
      default:
        history.pushState({}, "Home", "");
    }

    switch (routeTo) {
      case page.searchResults:
        history.replaceState({}, "search", "?" + lastSearchParams);
        break;
      case page.apply:
        var applyParams = new URLSearchParams();
        applyParams.append("action", "apply");

        history.replaceState({}, "Apply", "?" + applyParams);
        break;
      default:
        history.replaceState({}, "Home", "");
    }
  }

  function popStateHandler() {
    var sParams = new URLSearchParams(window.location.search);
    if (
      window.location.pathname === "/" &&
      sParams.get("action") === "search"
    ) {
      searchJobs();
    } else if (
      window.location.pathname === "/" &&
      sParams.get("action") === "apply"
    ) {
      showApplyForm("");
    } else if (window.location.pathname === "/" && sParams.keys.length === 0) {
      showHomePage();
    }
  }

  function applyJob(event) {
    event.preventDefault();

    var formData = new FormData($("#apply form")[0]);
    formData.append("jobCode", jobCode);
    formData.append("jobId", jobId);

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

  function searchJobs() {
    $.ajax({
      url: searchUrl,
      data: searchParams,
      contentType: false,
      cache: false,
      processData: false,
      dataType: "html",
      beforeSend: showSearchResults,
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
