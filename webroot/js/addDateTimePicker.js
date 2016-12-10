function addDateTimePicker(id) {
  $("#datepicker").datepicker({dateFormat: 'yy/mm/dd'});
  jQuery(id).datetimepicker({
    datepicker:false,
    format:'H:i'
  });
}
