@extends('layouts.app')

@section('content')

<!-- Bootstrap Boilerplate... -->

<div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')

    <form action="/album" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="album-name" class="col-sm-3 control-label">Album</label>
            <div class="col-sm-6">
                <input type="text" name="album_name" id="album-name" class="form-control">
            </div>
        </div>

        <!-- Add new album -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Add Album
                </button>
            </div>
        </div>

    </form>

    <!-- Albums list -->
    @if (count($albums) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Albums
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <thead>
                        <th>Album</th>
                        <th>&nbsp;</th>
                    </thead>

                    <tbody>
                    @foreach ($albums as $album)
                        <tr>
                            <td class="table-text">
                                <div>{{ $album->name }}</div>
                            </td>
                            <td>
                                <form action="{{ url('album/'.$album->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</div>

@endsection