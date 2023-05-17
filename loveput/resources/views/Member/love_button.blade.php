<button id="loveButton_{{ $post->id }}" class="btn" onclick="toggleLove({{ $post->id }})">
    @if($post->isLovedByUser(auth()->user()->id))
        ♡
    @else
        ♥
    @endif
</button>

<script src="{{ asset('js/ajaxlove.js') }}"></script>
