@if (count($collaborators) > 0)
    <ul class="items">
        @foreach ($collaborators as $collaborator)
            @include('main.partials.item', $collaborator)
        @endforeach
    </ul>
@endif