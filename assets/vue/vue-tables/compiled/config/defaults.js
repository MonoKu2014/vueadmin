"use strict";

module.exports = function () {
  return {
    dateColumns: [],
    listColumns: {},
    datepickerOptions: {
      locale: {
        cancelLabel: 'Clear'
      }
    },
    perPage: 10,
    perPageValues: [10, 25, 50, 100],
    params: {},
    sortable: true,
    filterable: true,
    initFilters: {},
    customFilters: [],
    templates: {},
    debounce: 500,
    dateFormat: "DD/MM/YYYY",
    toMomentFormat: false,
    skin: "table-striped table-bordered table-hover",
    columnsDisplay: {},
    texts: {
      count: "Showing {from} to {to} of {count} records|{count} records|One record",
      filter: "Filter Results:",
      filterPlaceholder: "Search query",
      limit: "Records:",
      page: "Page:",
      noResults: "No matching records",
      filterBy: "Filter by {column}",
      loading: 'Loading...',
      defaultOption: 'Select {column}'
    },
    sortIcon: {
      base: 'glyphicon',
      up: 'glyphicon-chevron-up',
      down: 'glyphicon-chevron-down'
    },
    customSorting: {},
    filterByColumn: false,
    highlightMatches: false,
    orderBy: false,
    footerHeadings: false,
    headings: {},
    pagination: {
      dropdown: false,
      chunk: 10
    },
    childRow: false,
    childRowKey: 'id',
    uniqueKey: 'id',
    responseAdapter: function responseAdapter(resp) {
      return {
        data: resp.data,
        count: resp.count
      };
    },
    requestKeys: {
      query: 'query',
      limit: 'limit',
      orderBy: 'orderBy',
      ascending: 'ascending',
      page: 'page',
      byColumn: 'byColumn'
    },
    rowClassCallback: false,
    config: false,
    saveState: false,
    storage: 'local',
    columnsClasses: {}
  };
};