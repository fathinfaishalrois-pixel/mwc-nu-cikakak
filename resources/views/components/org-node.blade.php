<div class="org-node" data-reveal>
    <button class="person-card" type="button" data-modal-open="person-{{ $node['item']->id }}" aria-label="Lihat profil {{ $node['item']->nama }}">
        <span class="person-photo"><x-media :path="$node['item']->foto" :alt="$node['item']->nama" /></span>
        <span class="person-info"><strong>{{ $node['item']->nama }}</strong><small>{{ $node['item']->jabatan }}</small>@if($node['item']->bidang)<em>{{ $node['item']->bidang }}</em>@endif</span>
        <span class="person-link">Lihat profil ↗</span>
    </button>
    @if(count($node['children']))
        <span class="org-connector" aria-hidden="true"></span>
        <div class="org-children">@foreach($node['children'] as $child) @include('components.org-node',['node'=>$child]) @endforeach</div>
    @endif
</div>
