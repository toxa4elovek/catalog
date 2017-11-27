
@foreach($collaborators as $collaborator)
    <tr>
        <td>{{ $collaborator->id }}</td>
        <td><a href="{{ route('collaborator-view', ['id' => $collaborator->id]) }} ">{{ $collaborator->name }}</a></td>
        <td>{{ $collaborator->position->name }}</td>
        <td>{{ $collaborator->created_at }}</td>
        <td>{{ $collaborator->pay }} &#8381</td>
        <td><a href="{{ route('collaborator-view', ['id' => $collaborator->id])}}" class="collaborator-delete">
                <span class="glyphicon  glyphicon-trash"></span>
            </a>
        </td>
    </tr>
@endforeach
