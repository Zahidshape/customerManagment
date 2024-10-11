@extends("layouts.layout")

@section("content")
   
     <div class="container mt-5">
    <div class="mb-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Upload Customer's File</h6>
              </div>
            </div>

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
        <div class="container-fluid py-4">
        <form action="{{ url('upload') }}" method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-3">
            @csrf
            <div class="mb-3 col-sm-6">
                <input type="file" name="file" accept=".csv" class="form-control" required style="border-color: #d63384;">
            </div>
            <div class="mb-3 col-sm-6">
                <input type="text" name="source" class="form-control" placeholder="Source" required style="border-color: #d63384;">
            </div>

            <div class="mb-3 col-sm-3">
                <button type="submit" class="btn btn-primary">Upload</button>

            </div>
        </form>
        </div>
    </div>

  
    </div>
    </div>
    @endsection
