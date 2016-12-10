function sortable(id, minute_id) {
  $(id).sortable({
    update: function(event, ui) {
      var order = [];
      var i=0;
      $(".table-content.no").each(function (item, index) {
        if (i==0) { i++; return; }
        order.push($(this).text().replace(/\s+/g, ""));
        $(this).text(i);
        i++;
      });
      var json = JSON.stringify(order);
      console.log(json);

      sendPost(
        "/webminutes/minutes/ajaxUpdateItemOrder/" + minute_id,
        {
          order: json,
          minute_id: minute_id
        },
        null)
        .done(function(result) {
          console.log(result);
          if (result == "success") {
            alert("案件の順序を更新しました");
          } else {
            alert("案件の順序の更新に失敗しました．ページをリロードして再度お試しください");
          }
        });
    }
  });
  $(id).disableSelection();
}
