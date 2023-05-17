// いいね非同期処理
function toggleLove(postId) {
          // ↓このURLに対してPOSTリクエストを送信。ルートで定義した、いいねする動作を行う。
  axios.post(`/posts/${postId}/love`)
  // POSTリクエストが成功した後の処理
    .then(response => {
      // blade.php側で設定したIDを指定している。
      const loveButton = document.getElementById(`loveButton_${postId}`);
      const loveCount = document.getElementById('loveCount');
      // もしステータスがloved（未いいね）の場合
      if (response.data.status === 'loved') {
        // いいねする時の処理。ハートの色を赤くし、カウント数を増やす。
        loveButton.innerHTML = '<i class="fas fa-heart" style="color: red">LOVEを有り難う御座います!</i>';
        // textContentを,parseIntを用いて整数に変換することで、カウントの増減を可能にしている。
        loveCount.textContent = parseInt(loveCount.textContent) + 1;
      } else {
        // いいねを取り消す時の処理。ハートの色が消え、カウント数が減る。
        loveButton.innerHTML = '<i class="far fa-heart" style="color: red">Loveを取り消しました</i>';
        loveCount.textContent = parseInt(loveCount.textContent) - 1;
      }
    })
    // エラーが発覚した時にF12で確認できる
    .catch(error => {
      console.log(error);
    });
}
