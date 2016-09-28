/**
 * controller の action へ POST メソッドで ajax による通信を行う
 * WARNING: コントローラ直下のURLでメソッド名でのみ実行すると，パスの関係で失敗する
 * 絶対パスを指定したほうが良い ex) /コントローラ名/アクション名
 *
 * @param action データ送信先の action
 * @param send_data action へ送信するデータ
 * @param args done ブロック等に引数でデータを渡したい場合には，ここに記述する
 * @returns {*}
 */
function sendPost(action, send_data, args) {
  return $.ajax({
    type: "POST",
    url: action,
    data: send_data,
    context: args
  });
}
