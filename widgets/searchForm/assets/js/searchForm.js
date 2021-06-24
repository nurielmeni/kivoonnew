var SearchForm = (function ($) {
  var page = {
    home: "home",
    searchResults: "searchResults",
    apply: "apply",
  };

  var formWrapperSelector,
    resultsWrapperSelector,
    searchUrl,
    jobCode,
    jobId,
    searchParams,
    currentPage = page.home;

  function getJob() {
    return {
      jobCode: jobCode,
      jobId: jobId,
    };
  }

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

    Kivoon && Kivoon.removeResults();

    $(".home-element").hide();
    $(".search-results-element").hide();
    $(".apply-element").show();
    $("#applyform-firstname").focus();
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
    } else {
      history.replaceState({}, "Home", "/");
      showHomePage();
    }
  }

  function setHistory(routeTo) {
    var lastSearchParams = new URLSearchParams(searchParams);

    if (currentPage === page.searchResults && routeTo === page.searchResults) {
      history.replaceState({}, "Home", "/");
      showHomePage();
      return;
    }

    if (currentPage === page.home && routeTo === page.home) {
      return;
    }

    switch (routeTo) {
      case page.searchResults:
        if (currentPage === page.home) {
          history.pushState({}, "search", "?" + lastSearchParams);
        } else {
          history.replaceState({}, "search", "?" + lastSearchParams);
        }
        currentPage = page.searchResults;
        break;
      case page.apply:
        var applyParams = new URLSearchParams();
        applyParams.append("action", "apply");
        history.pushState({}, "Apply", "?" + applyParams);
        currentPage = page.apply;
        break;
      default:
        history.replaceState({}, "Home", "/");
        currentPage = page.home;
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
    getJob: getJob,
  };
})(jQuery);
