<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Customer Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h1 class="mb-4">Customer Data Management</h1>

    <!-- File Upload Form -->
    <div class="mb-4">
        <h2>Upload Customer Data File</h2>

        <!-- Success Message -->
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Error Message -->
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Info Message -->
        @if(session('message'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form action="{{ url('upload') }}" method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-3">
            @csrf
            <div class="mb-3">
                <input type="file" name="file" accept=".csv" class="form-control" required>
            </div>
            <div class="mb-3">
                <input type="text" name="source" class="form-control" placeholder="Source" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>

    <!-- Uploaded Files List -->
    <div>
        <h2>Uploaded Files</h2>
        @if($uploads->isEmpty())
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                No files have been uploaded yet.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @else
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>File Name</th>
                        <th>Source</th>
                        <th>Date</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($uploads as $upload)
                        <tr>
                            <td>{{ $upload->file_name }}</td>
                            <td>{{ $upload->source }}</td>
                            <td>{{ \Carbon\Carbon::parse($upload->date)->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('download.unique.customers') }}" class="btn btn-primary">Unique Customers</a>
                                <a href="{{ route('download.duplicate.customers') }}" class="btn btn-primary">Duplicate Customers</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>