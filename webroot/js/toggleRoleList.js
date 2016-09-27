var toggleRoleList = function($, roles){
  var roles_json = JSON.parse(roles);
  var roles_html = createRoleList(roles_json);
  $(roles_html).appendTo(".checkbox>label");

  $('.checkbox>label').each(function (index, element) {
    var checkboxValue = $(this).children("input[type=checkbox]").attr('value');
    $(this).children("div.role-select").children("input").attr('name', 'roles['+checkboxValue+']');
    $(this).children("div.role-select").children("select").attr('name', 'roles['+checkboxValue+'][]');
  });

  $('input[type=checkbox]').change(function () {
    var $selectbox = $(this).parent().children(".select");
    if ($(this).prop('checked')) {
      $selectbox.show();
    } else {
      $selectbox.hide();
    }
  });

  function createRoleList(roles) {
    var html = '<div class="form-group select role-select" style="display: none;">'
      + '  <input type="hidden" value="">'
      + '  <select class="form-control" multiple="multiple">';
    $.each(roles, function() {
      html += '<option value="' + this['id'] + '">' + this['name'] + '</option>';
    });
    html += '  </select></div>';

    return html;
  }
};
