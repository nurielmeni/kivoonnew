var SearchForm = (function ($) {
  var resultsWrapperElementId;
  var loader = $('<div class="loader"></div>');

  function init(options) {
    console.log("Search Form: Init");
  }

  function show(selectedJobs) {}

  return {
    init: init,
    show: show,
  };
})(jQuery);
