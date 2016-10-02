var toggleRoleList = function($, roles, members){
  var roles_json = JSON.parse(roles);
  var roles_html = createRoleList(roles_json);
  $(roles_html).appendTo(".checkbox>label");

  $('.checkbox>label').each(function (index, element) {
    var checkboxValue = $(this).children("input[type=checkbox]").attr('value');
    $(this).children("div.role-select").children("input").attr('name', 'roles['+checkboxValue+']');
    $(this).children("div.role-select").children("select").attr('name', 'roles['+checkboxValue+'][]');
    var dom = this;

    if (members != null) {
      $.each(JSON.parse(members), function() {
        var member = this;
        if (member["user_id"] == checkboxValue) {
          $(dom).children("div.role-select").show();
          $(dom).children("div.role-select").children(".form-control").prop('required', true);
          var $option = $(dom).children("div.role-select").children(".form-control").children("option");
          if (member['role'] != undefined) {
            $.each($option, function () {
              if ($(this).val() == member['role']['id']) {
                $(this).prop("selected", true);
              }
            });
          }
        }
      });
    }
  });

  $('input[type=checkbox]').change(function () {
    var $selectbox = $(this).parent().children(".select");
    if ($(this).prop('checked')) {
      $selectbox.show();
      $selectbox.children(".form-control").prop('required', true);
    } else {
      $selectbox.hide();
      $selectbox.children(".form-control").prop('required', false);
      $(this).prop('required', false);
    }
  });

  function createRoleList(roles) {
    var html = '<div class="select role-select" style="display: none;">'
      + '  <input type="hidden" value="">'
      + '  <select class="form-control" multiple="multiple">';
    $.each(roles, function() {
      html += '<option value="' + this['id'] + '">' + this['name'] + '</option>';
    });
    html += '  </select></div>';

    return html;
  }
};
