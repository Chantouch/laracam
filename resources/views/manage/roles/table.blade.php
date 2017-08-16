<div class="body table-responsive">
    @if(count($roles))
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Display Name</th>
                <th>Description</th>
                <th>Date Created</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <th scope="row">{!! $role->id !!}</th>
                    <td>{!! $role->name !!}</td>
                    <td>{!! $role->display_name !!}</td>
                    <td>{!! $role->description !!}</td>
                    <td>{!! $role->created_at !!}</td>
                    <td>
                        <a href="{!! route('admin.security.roles.show', [$role->id]) !!}"
                           class='btn btn-default btn-xs'>
                            <i class="material-icons">remove_red_eye</i>
                        </a>
                        <a href="{!! route('admin.security.roles.edit', [$role->id]) !!}"
                           class='btn btn-default btn-xs'>
                            <i class="material-icons">mode_edit</i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>There is no data here.</p>
    @endif
</div>