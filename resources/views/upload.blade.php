<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Customer Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
  <a class="navbar-brand" href="#">Customer Management System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
  <ul class="navbar-nav ms-auto"> 
      
      <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
      </li>
      
    </ul>
  </div>
</nav>
=======
@extends("layouts.layout")
>>>>>>> 9e8ef1d686c7d134e2e8aff4d249149f4798af23

@section("content")
   
     <div class="container mt-5">
    <div class="mb-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Upload Customer's File</h6>
              </div>
            </div>

   
        <div class="container-fluid py-4">


             <!-- Success Message -->
             @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
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
            <div class="mb-3 col-sm-6">
                <input type="file" name="file" accept=".csv" class="form-control" required style="border-color: #d63384;">
            </div>
            <div class="mb-3 col-sm-6">
                <input type="text" name="source" class="form-control" placeholder="Source" required style="border-color: #d63384;">
            </div>

            <div class="mb-3 col-sm-3">
                <button type="submit" class="btn btn-primary" >Upload</button>

            </div>
        </form>
        </div>
    </div>

<<<<<<< HEAD
    Uploaded Files List
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
=======
  
>>>>>>> 9e8ef1d686c7d134e2e8aff4d249149f4798af23
    </div>
    </div>
    @endsection
