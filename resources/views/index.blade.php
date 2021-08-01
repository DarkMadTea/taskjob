@extends('base')

@section('title')
    123
@endsection

@section('content')
    <div class="container">
        <div class="row mt-5">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('fileupload.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Выберите файл</label>
                    <input type="file" name="fileUpload" id="fileUpload" class="form-control">
                </div>
                <button style="margin-top: 10px;" type="submit" class="btn btn-success">Upload</button>
            </form>
        </div>

        <table class="table" style="margin-top: 20px">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Filename</th>
                <th scope="col">File Size</th>
                <th scope="col">Downloaded At</th>
                <th scope="col">Download</th>
            </tr>
            </thead>
            <tbody>
            @foreach($files as $file)
                <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td>{{ $file->filename }}</td>
                    <td>{{ $file->filesize }} KB</td>
                    <td>{{ $file->created_at }}</td>
                    <td><a href="{{ url('/download', $file->filename) }}" class="btn btn-success">download</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
