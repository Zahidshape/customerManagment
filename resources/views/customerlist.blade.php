@extends("layouts.layout")

@section("content")

    <div class="container mt-4">
    <div class="mb-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        </div>
        <div class="container-fluid py-4">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                  <h6 class="text-white text-capitalize ps-3">Customer's Data</h6>
                </div>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>first_name</th>
                    <th>last_name</th>
                    <th>phone_number</th>
                    <th>email</th>
                    <th>address</th>
                    <th>postcode</th>
                    <th>county</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->first_name }}</td>
                        <td>{{ $customer->last_name }}</td>
                        <td>{{ $customer->phone_number }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>{{ $customer->postcode }}</td>
                        <td>{{ $customer->county }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="row">
            {{$customers->links()}}
        </div>
    </div>
    @endsection
