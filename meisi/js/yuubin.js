//company_add.php company_edit.phpより（郵便番号検索）

(function() {
    //該当フォーム
    var hadr = document.querySelector(".h-adr"), 
        cancelFlag = true;

    //イベントをキャンセルするリスナ
    var onKeyupCanceller = function(e) {
        if(cancelFlag){
            e.stopImmediatePropagation();
        }
        return false;
    };

    // 郵便番号の入力欄
    var postalcode = hadr.querySelectorAll(".p-postal-code"),
        postalField = postalcode[postalcode.length - 1];

    //通常の挙動をキャンセルできるようにイベントを追加
    postalField.addEventListener("keyup", onKeyupCanceller, false);

    //ボタンクリック時
    var btn = hadr.querySelector(".input-zip__btn");
    btn.addEventListener("click", function(e) {
        //キャンセルを解除
        cancelFlag = false;

        //発火
        let event;
        if (typeof Event === "function") {
            event = new Event("keyup");
        } else {
            event = document.createEvent("Event");
            event.initEvent("keyup", true, true);
        }
        postalField.dispatchEvent(event);

        //キャンセルを戻す
        cancelFlag = true;
    });
  
    //エンター時
    var ent = hadr.querySelector(".p-postal-code");
    ent.addEventListener("keypress", function(e) {
      if (e.keyCode === 13) {
        //キャンセルを解除
        cancelFlag = false;

        //発火
        let event;
        if (typeof Event === "function") {
            event = new Event("keyup");
        } else {
            event = document.createEvent("Event");
            event.initEvent("keyup", true, true);
        }
        postalField.dispatchEvent(event);

        //キャンセルを戻す
        cancelFlag = true;
      }
    });
  
})();

