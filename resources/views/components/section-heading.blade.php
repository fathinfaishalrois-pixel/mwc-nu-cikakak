<div class="section-heading {{ $align ?? '' }}">
    @if(!empty($eyebrow))<span class="eyebrow">{{ $eyebrow }}</span>@endif
    <h2>{{ $title }}</h2>
    @if(!empty($text))<p>{{ $text }}</p>@endif
</div>
