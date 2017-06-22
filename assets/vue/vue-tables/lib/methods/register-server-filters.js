import bus from '../bus';

module.exports = function() {

  this.opts.customFilters.forEach(function(filter) {
		bus.$off('vue-tables.filter::' + filter);
        bus.$on('vue-tables.filter::' + filter, function(value) {
          this.customQueries[filter] = value;
          this.updateState('customQueries', this.customQueries);
          this.refresh();
        }.bind(this));
  }.bind(this));
}
