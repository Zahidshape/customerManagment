@extends("layouts.layout")

@section("content")
    <div class="container mt-4">
    <div class="mb-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        </div>
        <div class="container-fluid py-4">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">

                    <h6 class="text-white text-capitalize ps-3">Files Data</h6>
                </div>
                <div class="container-fluid py-3">
                    <!--  Unique Error Message -->
                    @if (session('error'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    @endif
                    <!--  Duplicate Error Message -->
                    @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    @endif

                    
                </div>
                <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>File Name</th>
                        <th>Source</th>
                        <th>unique</th>
                        <th>Duplicate</th>
                        <th>Date</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($uploads as $upload)
                    
                        <tr>
                            <td>{{ $upload->file_name }}</td>
                            <td>{{ $upload->source }}</td>
                            <td> {{ $upload->customers->count() }} </td>
                            <td>{{ $upload->CustomerUploadMap->count() }}</td>
                            <td>{{ \Carbon\Carbon::parse($upload->date)->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('download.unique.customers', ['uploadId' => $upload->id]) }}" class="btn btn-primary">Unique</a>
                                <a href="{{ route('download.duplicate.customers', ['uploadId' => $upload->id]) }}" class="btn btn-primary">Duplicate</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        <div class="row">
            {{$uploads->links()}}
        </div>
    </div>
@endsection