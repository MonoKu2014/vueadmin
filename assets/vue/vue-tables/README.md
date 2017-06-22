# Vue Tables 2

[![npm version](https://badge.fury.io/js/vue-tables-2.svg)](https://badge.fury.io/js/vue-tables-2) [![GitHub stars](https://img.shields.io/github/stars/matfish2/vue-tables-2.svg)](https://github.com/matfish2/vue-tables-2/stargazers) [![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/matfish2/vue-tables-2/master/LICENSE)

- [Usage](#usage)
    - [Dependencies](#dependencies)
    - [Installation](#installation)
    - [Client Side](#client-side)
    - [Server Side](#server-side)
        - [Implementations](#implementations)
- [Templates](#templates)
    - [JSX](#jsx)
    - [Vue Component](#vue-component)
    - [Scoped Slots](#scoped-slots)
- [Child Rows](#child-rows)
- [Methods](#methods)
- [Events](#events)
- [Custom Filters](#custom-filters)
    - [Client Side Filters](#client-side-filters)
    - [Server Side Filters](#server-side-filters)
- [List Filters](#list-filters)
- [Custom Sorting](#custom-sorting)
    - [Client Side Sorting](#client-side-sorting)
    - [Server Side Sorting](#server-side-sorting)
- [Options](#options)
- [VueJS 1](#vuejs-1)

# Usage

## Dependencies

* Vue.js (>=2.0)
* Server Side: axios OR vue-resource (>=0.9.0) OR jQuery for the AJAX requests

## Compatibility

* Vuex (>=2.0)
* Bootstrap 3 compatible html output

## Installation

```js
npm install vue-tables-2
```

Require the script:

```js
import {ServerTable, ClientTable, Event} from 'vue-tables-2';
```

## Register the component(s)

```js
Vue.use(ClientTable, [options], [useVuex], [customTemplate]);
```

Or/And:

```js
Vue.use(ServerTable, [options], [useVuex], [customTemplate]);
```

* `useVuex` is a boolean indicating whether to use `vuex` for state management, or manage state on the component itself.
If you set it to `true` you must add a `name` prop to your table, which will be used to to register a module on your store.
Use `vue-devtools` to look under the hood and see the current state.

* `customTemplate` argument allows you to pass a custom template for the entire table.
You can find the main template file under `lib/template.js`, which in turn requires the partials in the `template` folder.
The template is written using `jsx`, so you will need a [jsx compiler](https://github.com/vuejs/babel-plugin-transform-vue-jsx) to modify it (the package is using the compiled version under the `compiled` folder).
Copy it to your project and modify to your needs.

> Note: The template file is a function that receives a `source` parameter (`client` or `server`). E.g:

```js
Vue.use(ClientTable, {}, false, require('./template.js')('client'))
```

## Client Side

Add the following element to your page wherever you want it to render.
Make sure to wrap it with a parent element you can latch your vue instance into.

```html
<div id="people">
  <v-client-table :data="tableData" :columns="columns" :options="options"></v-client-table>
</div>
```

Create a new Vue instance (You can also nest it within other components). An example works best to illustrate the syntax:

```js
new Vue({
    el:"#people",
    data: {
        columns: ['id','name','age'],
        tableData: [
            {id:1, name:"John",age:"20"},
            {id:2, name:"Jane",age:"24"},
            {id:3, name:"Susan",age:"16"},
            {id:4, name:"Chris",age:"55"},
            {id:5, name:"Dan",age:"40"}
        ],
        options: {
            // see the options API
        }
    }
});
```

  You can access the filtered dataset at any given moment by fetching the `filteredData` computed property of the table, using `ref` as a pointer (`this.$refs.myTable.filteredData`);

> Important: when loading data asynchronously add a `v-if` conditional to the component along with some `loaded` flag, so it will only compile once the data is attached.

## Server side

```html
<div id="people">
  <v-server-table url="/people" :columns="columns" :options="options"></v-server-table>
</div>
```

Javascript:

```js
new Vue({
    el: "#people",
    data: {
        columns: ['id','name','age'],
        options: {
            // see the options API
        }
    }
});
```

All the data is passed in the following GET parameters:
* `query`,
* `limit`,
* `page`,
* `orderBy`,
* `ascending`,
* `byColumn`.

You need to return a JSON object with two properties:
* `data` : `array` - An array of row objects with identical keys.
* `count`: `number` - Total count before limit.

> Note: If you are calling a foreign API or simply want to use your own keys, refer to the `responseAdapter` option.

### Implementations

  I have included [an Eloquent implementation](https://github.com/matfish2/vue-tables/tree/master/server/PHP) for Laravel Users.

  If you happen to write other implementations for PHP or other languages, a pull request would be most welcome, under the following guidelines:

  1. Include the class under `./server/{language}`.
  1. Name it according to convention: `{concrete}VueTables`.
  1. if this is the first implementation in this language add an interface similar to the one found in the PHP folder.
  1. Have it implement the interface.
  1. TEST IT.

# Templates

Templates allow you to wrap your cells with vue-compiled HTML.

Their syntax is similar to that of `render` functions, as it leverages the virtual DOM to bind the templates into the main table template.

## JSX
It is recommended to use JSX, which closely resembles HTML, to write the templates (To compile jsx you need to install the [vue jsx transform](https://github.com/vuejs/babel-plugin-transform-vue-jsx)).

E.g.:

```js
data : {
    columns: ['erase'],
    options: {
        ...
        templates: {
            erase: function(h, row) {
                return <delete id={row.id}></delete>
            }
        }
        ...
    }
}
```

The first parameter is the `h` scope used to compile the element. It MUST be called `h`.
The second parameter gives you access to the row data.
In addition a `this` context will be available, which refers to the root vue instance. This allows you to call your own instance methods directly.
Note: when using a `.vue` file `jsx` must be imported from a dedicated `.jsx` file in order to compile correctly. E.g

edit.jsx

```js
export default function(h, row) {
   return <a class='fa fa-edit' href={'#/' + row.id + '/edit'}></a>
}
```

app.vue

```html
<script>
import edit from './edit'

templates: {
   edit
}
</script>
```

## Vue Component
A Second option to for creating templates is to encapsulate the template within a component and pass the name. The component must have a `data` property, which will receive the row object. E.g:

```js
Vue.component('delete', {
    props:['data'],
    template:`<a class='delete' @click='erase'></a>`,
    methods:{
        erase() {
            let id = this.data.id; // delete the item
        }
    }
});
```

```js
options: {
    ...
    templates: {
        erase: 'delete'
    }
    ...
}
```

This method allows you to also use single page .vue files for displaying the template data
E.g:
edit.vue

```html
<template>
    <a class="fa fa-edit" :href="edit(data.id)">Edit</a>
</template>
<script>
    export default {
        props:['data'],
    }
</script>
```

app.vue

```html
<script>
import edit from './edit'

templates:{
   edit
}
</script>
```

## Scoped Slots
If you are using Vue 2.1.0 and above, you can use [scoped slots](https://vuejs.org/v2/guide/components.html#Scoped-Slots) to create templates:

```html
<v-client-table :data="entries" :columns="['id', 'name' ,'age', 'edit']">
    <template slot="edit" scope="props">
    <div>
        <a class="fa fa-edit" :href="edit(props.row.id)"></a>
    </div>
    </template>
</v-client-table>
```

**Important**:
* To use components in your templates they must be declared **globally** using `Vue.component()`.
* Templates must be declared in the `columns` prop

> Note: Don't include HTML directly in your dataset, as it will be parsed as plain text.

> CSS Note: to center the pagination apply `text-align:center` to the wrapping element

# Child Rows

Child rows allow for a custom designed output area, namely a hidden child row underneath each row, whose content you are free to set yourself.

When using the `childRow` option you must pass a unqiue `id` property for each row, which is used to track the current state.
If your identifer key is not `id`, use the `uniqueKey` option to set it.

The syntax is identincal to that of templates:

```js
options:{
    ...
    childRow: function(h, row) {
        return <div>My custom content for row {row.id}</div>
    }
    ...
}
```

Or you can pass a component name: (See [Templates](#templates) above for a complete example)

```js
options:{
    ...
    childRow: 'row-component'
    ...
}
```

When the plugin detects a `childRow` function it appends the child rows and prepends to each row an additional toggler column with a `span` you can design to your liking.

Example styling (also found in `style.css`):
```css
.VueTables__child-row-toggler {
  width:16px;
  height:16px;
  line-height: 16px;
  display: block;
  margin: auto;
  text-align: center;
}

.VueTables__child-row-toggler--closed::before {
   content: "+";
}

.VueTables__child-row-toggler--open::before  {
    content: "-";
}
```

You can also trigger the child row toggler programmtically. E.g, to toggle the row with an id of 4:

```js
this.$refs.myTable.toggleChildRow(4); // replace myTable with your own ref
```

# Methods

Call methods on your instance using the [`ref`](http://vuejs.org/api/#ref) attribute.

* `setPage(page)`
* `setLimit(recordsPerPage)`
* `setOrder(column, isAscending)`
* `setFilter(query)` - `query` should be a string, or an object if `filterByColumn` is set to `true`.
* `refresh()` Server component only

### Events

Using Custom Events (For child-parent communication):

```html
<v-server-table :columns="columns" url="/getData" @loaded="onLoaded"></v-server-table>
```

* Using the event bus:

```js
Event.$on('vue-tables.loaded', function (data) {
    // Do something
});
```

* Using Vuex:

```js
mutations:{
    ['tableName/LOADED'] (state, data) {
        // Do something
    }
}
```

1. `vue-tables.loading` / `tableName/LOADING` (server)

    Fires off when a request is sent to the server. Sends through the request data.

1. `vue-tables.loaded` / `tableName/LOADED` (server)

    Fires off after the response data has been attached to the table. Sends through the response.

    You can listen to those complementary events on a parent component and use them to add and remove a *loading indicator*, respectively.

1. `vue-tables.error` / `tableName/ERROR` (server)

    Fires off if the server returns an invalid code. Sends through the error

1. `vue-tables.row-click` / `tableName/ROW_CLICK`

    Fires off after a row was clicked. sends through the row and the mouse event.
    When using the client component, if you want to recieve the *original* row, so that it can be directly mutated, you must have a unique row identifier.
    The key defaults to `id`, but can be changed using the `uniqueKey` option.

    > Note: As of version 0.5.0 the `row-click` event sends along an object containing the row and the mouse event.

# Custom Filters

Custom filters allow you to integrate your own filters into the plugin using Vue's events system.

## Client Side Filters

1. use the `customFilters` option to declare your filters, following this syntax:

```js
customFilters: [{
    name:'alphabet',
    callback: function(row, query) {
        return row.name[0] == query;
    }
}]
```

1. Using the event bus:

```js
Event.$emit('vue-tables.filter::alphabet', query);
```

1. Using `vuex`:

```js
this.$store.commit('myTable/SET_CUSTOM_FILTER', {filter:'alphabet', value:query})
```

## Server Side Filters

A. use the `customFilters` option to declare your filters, following this syntax:

```js
customFilters: ['alphabet','age-range']
```

B. the same as in the client component.

# List Filters

When filtering by column (option `filterByColumn:true`), the `listColumns` option allows for filtering columns whose values are part of a list, using a select box instead of the default free-text filter.

For example:

```js
options: {
    filterByColumn: true,
    listColumns: {
        animal: [
            { id: 1, text: 'Dog' },
            { id: 2, text: 'Cat' },
            { id: 3, text: 'Tiger' },
            { id: 4, text: 'Bear' }
        ]
    }
}
```

> Note: The values of this column should correspond to the `id`'s passed to the list.
They will be automatically converted to their textual representation.

# Custom Sorting

## Client Side Sorting

Sometimes you may one to override the default sorting logic which is applied uniformly to all columns.
To do so use the `customSorting` option. This is an object that recieves custom logic for specific columns.
E.g, to sort the `name` column by the last character:

```js
customSorting:{
    name: function(ascending) {
        return function(a, b) {
            var lastA = a.name[a.name.length-1].toLowerCase();
            var lastB = b.name[b.name.length-1].toLowerCase();

            if (ascending)
                return lastA <= lastB?1:-1;

            return lastA >= lastB?1:-1;
        }
    }
}
```

## Server Side Sorting

This depends entirely on your backend implemetation as the library sends the sorting direction trough the request.

# Options

Options are set in three layers, where the more particular overrides the more general.

1. Pre-defined component defaults.
2. Applicable user-defined defaults for the global Vue Instance. Passed as the second paramter to the `Use` statement.
3. Options for a single table, passed through the `options` prop.

Option | Type | Description | Default
-------|------|-------------|--------
childRow | Function| [See documentation](#child-rows) | `false`
columnsClasses | Object | Add class(es) to the specified columns.<br> Takes key-value pairs, where the key is the column name and the value is a string of space-separated classes | `{}`
columnsDisplay | Object | Responsive display for the specified columns.<br><br> Columns will only be shown when the window width is within the defined limits. <br><br>Accepts key-value pairs of column name and device.<br><br> Possible values are `mobile` (x < 480), `mobileP` (x < 320), `mobileL` (320 <= x < 480), `tablet` (480 <= x < 1024), `tabletP` (480 <= x < 768), `tabletL` (768 <= x < 1024), `desktop` (x >= 1024).<br><br> All options can be preceded by the logical operators min,max, and not followed by an underscore.<br><br>For example, a column which is set to `not_mobile` will be shown when the width of the window is greater than or equal to 480px, while a column set to `max_tabletP` will only be shown when the width is under 768px | `{}`
customFilters | Array | See [documentation](#custom-filters) | `[]`
customSorting | Object | See [documentation](#custom-sorting) | `{}`
dateColumns | Array | Use daterangepicker as a filter for the specified columns (when filterByColumn is set to true).<br><br>Dates should be passed as moment objects, or as strings in conjunction with the toMomentFormat option | `[]`
dateFormat (client-side) | String | Format to display date objects. Using [momentjs](https://momentjs.com/) | `DD/MM/YYYY`
datepickerOptions | Object | Options for the daterangepicker when using a date filter (see dateColumns) | `{ locale: { cancelLabel: 'Clear' } }`
debounce (server-side) | Number | Number of idle milliseconds (no key stroke) to wait before sending a request. Used to detect when the user finished his query in order to avoid redundant requests | `500`
filterable | Array / Boolean | Filterable columns `true` - All columns. | Set to `false` or an `empty array` to hide the filter(s)
footerHeadings | Boolean | Display headings at the bottom of the table too | `false`
headings | Object | Table headings. | Can be either a string or a function, if you wish to inject vue-compiled HTML.<br>E.g: `function(h) { return <h2>Title</h2>}`<br>Note that this example uses jsx, and not HTML.<br>The `this` context inside the function refers to the direct parent of the table instance.<br><br>The default rule is to extract from the first row properties with the underscores become spaces and the first letter capitalized
highlightMatches | Boolean | Highlight matches | `false`
initFilters | Object | Set initial values for all filter types: generic, by column or custom.<br><br> Accepts an object of key-value pairs, where the key is one of the following: <br><br>a. "GENERIC" - for the generic filter<br>b. column name - for by column filters.<br>c. filter name - for custom filters. <br><br>In case of date filters the date range should be passed as an object comprised of start and end properties, each being a moment object. | `{}`
listColumns | Object | See [documentation](#list-filters) | {}
orderBy.ascending | Boolean | initial order direction | `orderBy: { ascending:true }`
orderBy.column | String | initial column to sort by | First column
pagination.chunk | Number | maximum pages in a chunk of pagination | `pagination: { chunk:10 }`
pagination.dropdown | Boolean | use a dropdown select pagination next to the records-per-page list, instead of links at the bottom of the table. | `pagination: { dropdown:false }`
params (server-side) | Object | Additional parameters to send along with the request | `{}`
perPage | number | Initial records per page | `10`
perPageValues | Array | Records per page options | `[10,25,50,100]`
requestKeys (server-side) | Object | Set your own request keys | `{ query:'query', limit:'limit', orderBy:'orderBy', ascending:'ascending', page:'page', byColumn:'byColumn' }`
responseAdapter (server-side) | Function | Transform the server response to match the format expected by the client. This is especially useful when calling a foreign API, where you cannot control the response on the server-side | `function(resp) { return { data: resp.data, count: resp.count } }`
rowClassCallback | Function | Add dynamic classes to table rows.<br><br> E.g function(row) { return `row-${row.id}`} <br><br>This can be useful for manipulating the appearance of rows based on the data they contain | `false`
saveState | Boolean | Constantly save table state and reload it each time the component mounts. When setting it to true, use the `name` prop to set an identifier for the table | `false`
skin | String | Space separated Bootstrap table styling classes | `table-striped table-bordered table-hover`
sortIcon | String | Sort icon classes | `{ base:'glyphicon', up:'glyphicon-chevron-up', down:'glyphicon-chevron-down' }`
sortable | Array |  Sortable columns | All columns
storage | String | Which persistance mechanism should be used when saveState is set to true: `local` - localStorage. `session` - sessionStorage | `local`
templates | Object | See [documentation](#templates) | {}
texts | Object | Table default labels:<br><br>`{ count:'Showing {from} to {to} of {count} records {count} records One record', filter:'Filter Results:',filterPlaceholder:'Search query', limit:'Records:', noResults:'No matching records', page:'Page:', // for dropdown pagination filterBy: 'Filter by {column}', // Placeholder for search fields when filtering by column loading:'Loading...', // First request to server defaultOption:'Select {column}' // default option for list filters }`
toMomentFormat (client-side) | String | transform date columns string values to momentjs objects using this format. If this option is not used the consumer is expected to pass momentjs objects himself | `false`
uniqueKey | String | The key of a unique identifier in your dataset, used to track the child rows, and return the original row in row click event | `id`

> Note: You can check this [demo](https://jsfiddle.net/matfish2/823jzuzc/) of the Client Side implementation and a nicer way to go over the options.

# VueJS 1

Users of VueJS 1 should use [this package](https://github.com/matfish2/vue-tables) .
