function toggleLove(postId) {
    // AJAXリクエストの送信
    axios.post(`/posts/${postId}/love`)
      .then(response => {
        // レスポンスの処理
        if (response.data.status === 'loved') {
          // いいねが成功した場合の処理
          document.getElementById(`loveButton_${postId}`).innerText = '❤';
        } else {
          // いいねを取り消した場合の処理
          document.getElementById(`loveButton_${postId}`).innerText = '♡';
        }
      })
      .catch(error => {
        // エラーハンドリング
        console.log(error);
      });
  }
  