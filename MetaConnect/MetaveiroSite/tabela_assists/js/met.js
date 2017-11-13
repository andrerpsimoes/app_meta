$(function() {

  // v2.24.6, change popup print & close button text
  // See print_now description
  $.tablesorter.language.button_print = "Print";
  $.tablesorter.language.button_close = "Close";

  $(".tablesorter").tablesorter({
    theme: 'blue',
    widgets: ["zebra", "filter", "print", "columnSelector"],
    widgetOptions : {
      columnSelector_container : $('#columnSelector'),
      columnSelector_name : 'data-name',

      print_title      : '',          // this option > caption > table id > "table"
      print_dataAttrib : 'data-name', // header attrib containing modified header name
      print_rows       : 'f',         // (a)ll, (v)isible, (f)iltered, or custom css selector
      print_columns    : 's',         // (a)ll, (v)isible or (s)elected (columnSelector widget)
      print_extraCSS   : '',          // add any extra css definitions for the popup window here
      print_styleSheet : '../css/theme.blue.css', // add the url of your print stylesheet
      print_now        : true,        // Open the print dialog immediately if true
      // callback executed when processing completes - default setting is null
      print_callback   : function(config, $table, printStyle){
        // do something to the $table (jQuery object of table wrapped in a div)
        // or add to the printStyle string, then...
        // print the table using the following code
        $.tablesorter.printTable.printOutput( config, $table.html(), printStyle );
      }
    }
  });
    

  $('#button').click(function(){
    $('.tablesorter').trigger('printTable');
  });

    $(".tablesorter").tablesorter({
			theme : 'blue',
			// this is the default setting
			cssChildRow: "tablesorter-childRow"
		})
		.tablesorterPager({
			container: $("#pager"),
			positionFixed: false
		});

    
});

