
$.fn.DataTable.defaults.oLanguage.sSearch = "";
$.fn.DataTable.defaults.oLanguage.sSearchPlaceholder = "Search";
function map_datatable_columns(coldef, options) {
  options = options ? options : {};

  function htmlEscapeEntities(d) {
      return d.replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
  }

  function toString(data) {
      return data ? data.toString() : '';
  }

  return coldef.map(function(e, i) {
      var col = e.data ? e : {
          data: e
      };
      col.targets = i;
      col.defaultContent = "";
      if (options.disabled_cols) {
          col.searchable = options.disabled_cols.indexOf(i) < 0;
          col.orderable = options.disabled_cols.indexOf(i) < 0;
      }
      if (options.hidden_cols) {
          col.visible = options.hidden_cols.indexOf(i) < 0;
      }

      if ((!col.render) && (typeof col.data === 'string')) {
          col.render = function(data, type) {
              return type === 'display' ? htmlEscapeEntities(toString(data)) : data;
          }
      }
      return col;
  });
}
