import bus from '../bus';

module.exports = function(event, payload) {
  if (this.vuex) {
    this.commit(event.toUpperCase().replace('-','_'), payload);
  } else {
    bus.$emit(`vue-tables.${event}`, payload);
    this.$emit(event, payload);
  }
}
