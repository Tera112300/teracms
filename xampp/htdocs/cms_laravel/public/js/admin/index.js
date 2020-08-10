$(function() {
    $('.connectedSortable').sortable({
      placeholder         : 'sort-highlight',
      connectWith         : '.connectedSortable',
      handle              : '.card-header, .nav-tabs',
      forcePlaceholderSize: true,
      zIndex              : 999999,
      update: function(event,ui){
        $(".object_cover").each(function(){
              var object_width = $(this).width();
              $(this).height(object_width);
          });
    }
    });
    $('.connectedSortable .card-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move');
      $("#datepicker").datepicker({
          // 日付が選択された時、日付をテキストフィールドへセット
          onSelect: function(dateText, inst) {
                      $("#date_val").val(dateText);
                  }
      });
  });