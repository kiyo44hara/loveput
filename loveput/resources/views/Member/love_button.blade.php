<!-- いいねボタン、非同期 -->
<!-- いいねボタンを押すことで、関数が呼び出され、発火する。 -->
<button id="loveButton_{{ $post->id }}" class="btn" onclick="toggleLove({{ $post->id }})">
<!-- もし、現在ログインしているユーザーがいいねをした場合 -->
  @if($post->isLovedByUser(auth()->user()->id))
    <!-- いいね取り消し -->
    <i class="fas fa-heart" style="color: red"></i>
  @else
    <!-- いいねする -->
    <i class="far fa-heart" style="color: red"></i>
  @endif
</button>
<!-- いいねカウント数 -->
<span id="loveCount">{{ $loveCount }}</span>
<!-- javascript処理。詳細は実際のビューをチェック -->
<script src="{{ asset('js/ajaxlove.js') }}"></script>
