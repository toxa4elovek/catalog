<li class="item-parent" data-id="{{ $collaborator->id }}" data-status="{{ (count($collaborator->child) > 0) ? 'visible' : 'none'  }}">
    <span class="glyphicon glyphicon-{{ (count($collaborator->child) > 0) ? 'minus' : 'plus' }} more-collaborators-icon"></span>
    {{ $collaborator->name }} ( {{ $collaborator->position->name }} )
</li>
@if (count($collaborator->child) > 0)
    <ul class="items">
        @foreach($collaborator->child as $collaborator)
            @include('main.partials.item', $collaborator)
        @endforeach
    </ul>
@endif
