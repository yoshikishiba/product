//peason_add.html peason_edit.htmlより（ファイル添付ボタン）

$("#input-file").on('change', function () {
    var file = $(this).prop('files')[0];
    $(".input-file__name").text(file.name);
});