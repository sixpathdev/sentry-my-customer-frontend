@extends('layout.base')
@section("custom_css")
<link href="/backend/assets/build/css/intlTelInput.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
<link rel="stylesheet" href="backend/assets/css/all_users.css">
@stop
@section('content')
<div class="content">
    <div class="container-fluid">
        @if(Session::has('message') || $errors->any())
        <br>
        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>
        @endif
        <div class="row page-title">
            <div class="col-md-12">
                <h4 class="mb-1 mt-0 float-left">My Customers</h4>
                <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#CustomerModal">
                    New &nbsp;<i class="fa fa-plus my-float"></i>
                </a>
            </div>
            @if(session('success-alert'))
                <div class="alert alert-success">
                    {{ session('success-alert') }}
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p class="sub-header pb-0 mb-0">
                            Customer Search
                        </p>
                        <small><em>Enter customer details to start search</em></small>
                        <div class="container-fluid">
                            <div class="row">

                                <div class="form-group col-lg-6 mt-4">
                                    <label class="form-control-label">Customer Name</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="uil uil-atm-card"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="password">
                                    </div>
                                </div>

                                <div class="form-group col-lg-6 mt-4">
                                    <label class="form-control-label">Phone Number</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">

                                        </div>
                                        <input type="tel" id="phone" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>


        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-activity" role="tabpanel"
                            aria-labelledby="pills-activity-tab">
                            <div class="row">
                                <div class="col-md-7 col-sm-6">
                                    <p class="sub-header float-left">
                                        Showing all customers
                                    </p>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0" id="basic-datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Tel</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($collection['customers'] as $key => $customer)
                                        <tr>
                                            <td scope="row">{{ $key }}</td>
                                            
                                            <td> {{ $customer->name }} </td>

                                            <td>{{ $customer->phone_number }}<br>
                                                <td>{{ $customer->email }}<br>
                                            </td>
                                            <td>
                                                <div class="btn-group mt-2 mr-1">
                                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        Actions<i class="icon"><span
                                                                data-feather="chevron-down"></span></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{ route('customer.edit', ['customer' => $customer->_id]) }}">Edit Customer</a>
                                                        <a class="dropdown-item" href="{{ route('customer.show', ['customer' => $customer->_id]) }}">ViewProfile</a>
                                                        {{-- <a class="dropdown-item" href="{{ route('transaction.show', ['customer' => $customer->_id]) }}">ViewTransaction</a> --}}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $collection['customers']->links() }}
                            </div>
                        </div>

                        <!-- messages -->
                        <div class="tab-pane" id="pills-messages" role="tabpanel" aria-labelledby="pills-messages-tab">
                            <div class="row">
                                <div class="col-md-7 col-sm-6">
                                    <p class="sub-header float-left">
                                        List of Creditors
                                    </p>
                                    <p class="sub-header float-right">
                                        <span class="badge badge-pill badge-soft-danger">You owe: &#8358; 3500</span>
                                    </p>
                                </div>
                                <div class="col-md-5 col-sm-6">
                                    <a href="#" class="btn btn-sm btn-primary float-right" data-toggle="modal"
                                        data-target="#CreditModal">
                                        <i class="fa fa-plus my-float"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <table class="table mb-0" id="basic-datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Avatar</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Tel</th>
                                                <th scope="col">Credit</th>
                                                <th scope="col">Balance</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row">1</td>
                                                <td><img src="/backend/assets/images/users/avatar-5.jpg"
                                                        class="avatar-sm rounded-circle" alt="Shreyu" /></td>
                                                <td>Lynda Doe <br>
                                                    <span class="badge badge-danger">Has Credit</span>
                                                </td>
                                                <td>+234 90 000 000 00<br>
                                                </td>
                                                <td>
                                                    <span> &#8358; 1 500</span> <br>
                                                    <span class="badge badge-primary">You Paid: 1000</span>
                                                </td>
                                                <td>
                                                    <span class="text-danger">&#8358; 500</span>
                                                </td>
                                                <td>
                                                    <div class="btn-group mt-2 mr-1">
                                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            Actions<i class="icon"><span
                                                                    data-feather="chevron-down"></span></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="{{ route('customer.edit', 1) }}">Edit Customer</a>
                                                            <a class="dropdown-item" href="{{ route('customer.show', 1) }}">ViewProfile</a>
                                                            <a class="dropdown-item" href="{{ route('transaction.show', 1) }}">ViewTransaction</a>
                                                            <a class="dropdown-item" href="{{ route('debtor.create') }}">SendReminder</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td scope="row">2</td>
                                                <td><img src="/backend/assets/images/users/avatar-3.jpg"
                                                        class="avatar-sm rounded-circle" alt="Shreyu" /></td>
                                                <td>Henry Doe <br>
                                                    <span class="badge badge-danger">Has Credit</span>
                                                </td>
                                                <td>+44 0000 123456 <br>
                                                </td>
                                                <td>
                                                    <span> &#8358; 2 560</span> <br>
                                                    <span class="badge badge-primary">You Paid: 2 000</span>
                                                </td>
                                                <td>
                                                    <span class="text-danger">&#8358; 560</span>
                                                </td>
                                                <td>
                                                    <div class="btn-group mt-2 mr-1">
                                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            Actions<i class="icon"><span
                                                                    data-feather="chevron-down"></span></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="{{ route('customer.edit', 1) }}">Edit Customer</a>
                                                            <a class="dropdown-item" href="{{ route('customer.show', 1) }}">ViewProfile</a>
                                                            <a class="dropdown-item" href="{{ route('transaction.show', 1) }}">ViewTransaction</a>
                                                            <a class="dropdown-item" href="{{ route('debtor.create') }}">SendReminder</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-projects" role="tabpanel"
                            aria-labelledby="pills-projects-tab">
                            <div class="col-md-12">
                                <p class="sub-header float-left">
                                    List of Regitered Customers
                                </p>
                                <a href="#" class="btn btn-sm btn-primary float-right" data-toggle="modal"
                                    data-target="#CustomerModal">
                                    <i class="fa fa-plus my-float"></i>
                                </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table mb-0" id="basic-datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Avatar</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Tel</th>
                                            <th scope="col">Amount Due</th>
                                            <th scope="col">Balance</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td scope="row">1</td>
                                            <td><img src="/backend/assets/images/users/avatar-5.jpg"
                                                    class="avatar-sm rounded-circle" alt="Shreyu" /></td>
                                            <td>John Doe <br>
                                                <span class="badge badge-danger">Has Credit</span>
                                            </td>
                                            <td>+2348136478080<br>
                                            </td>
                                            <td>
                                                <span> &#8358; 1 500</span> <br>
                                                <span class="badge badge-primary">You Paid: 1000</span>
                                            </td>
                                            <td>
                                                <span class="text-danger">&#8358; 500</span>
                                            </td>
                                            <td>
                                                <div class="btn-group mt-2 mr-1">
                                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        Actions<i class="icon"><span
                                                                data-feather="chevron-down"></span></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{ route('customer.edit', 1) }}">Edit Customer</a>
                                                        <a class="dropdown-item" href="{{ route('customer.show', 1) }}">ViewProfile</a>
                                                        <a class="dropdown-item" href="{{ route('transaction.show', 1) }}">ViewTransaction</a>
                                                        <a class="dropdown-item" href="{{ route('debtor.create') }}">SendReminder</a>
                                                    </div>
                                                </div>
                                            </td>

                                    </tbody>
                                </table>
                            </div>
                            {{-- {{$response->links()}} --}}
                        </div>
                    </div>

                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
</div>
<div id="CustomerModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Add New Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('customer.store') }}">
                    @csrf
                    <div class="form-group row mb-3">
                        <label for="phone_number" class="col-3 col-form-label">Phone Number</label>
                        <div class="col-9">
                            <input type="number" class="form-control" id="phone_number" placeholder="Phone Number"
                                name="phone_number">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputPassword3" class="col-3 col-form-label">Customer Name</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="name" placeholder="Customer name"
                                name="name">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputPassword3" class="col-3 col-form-label">Store Name</label>
                        <div class="col-9">
                            <select name="store" id="store" class="form-control">
                                @foreach ($collection['stores'] as $store)
                                    <option value="{{ $store->_id }}">
                                        {{ $store->store_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="inputPassword5" class="col-3 col-form-label">Email</label>
                        <div class="col-9">
                            <input type="email" class="form-control" id="email" placeholder="Customer email" name="email">
                        </div>
                    </div> 
                    <div class="form-group mb-0 justify-content-end row">
                        <div class="col-9">
                            <button type="submit" class="btn btn-primary btn-block ">Create User</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection


@section("javascript")
<script src="/backend/assets/build/js/intlTelInput.js"></script>
<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
        // any initialisation options go here
    });

</script>
@stop
