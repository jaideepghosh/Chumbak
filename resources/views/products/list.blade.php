@extends('layouts.app')
@section('title', '- Products')


@section('header')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
@endsection


@section('content')
    <div class="card">
        <div class="card-header">
            Chumbak Products
            <a href="<?php echo url('/');?>/products/create" class="btn btn-primary float-md-right">Create New Product</a>
        </div>
        <div class="card-body">
            @if(session()->get('success'))
                <div class="alert alert-success">
                {{ session()->get('success') }}  
                </div><br />
            @endif
            <table id="products" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection


@section('footer')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>
<script>
$(document).ready(function () {
            var feedTable = $('#products').DataTable({
                "ajax":"<?php echo url('/'); ?>/index.php/api/get/products",
                "columns": [
                    { "data": "id" },
                    {
                        "data": "name",
                        "fnCreatedCell": function (cell, cellData, rowData, rowIndex, colIndex) {
                            $(cell).html("<a href='' target='_blank'>"+rowData.name+"</a>");
                        }
                    },
                    { "data": "price" },
                    {
                        "data": "id",
                        "fnCreatedCell": function (cell, cellData, rowData, rowIndex, colIndex) {
                            $(cell).html("<a href='<?php echo url('/');?>/products/"+rowData.id+"/edit' title='Edit'><i class='far fa-edit'></i></a> <button title='Delete' class='btn btn-link' onclick='deleteCategory("+rowData.id+")'><i class='far fa-trash-alt'></i></button>");
                        },
                        "orderable": false
                    },
                ],
                "pageLength": 10
            });
});

function deleteCategory(id){
    $.ajax({
    type: "DELETE",
    url: '/products/' + id,
    data: {_method: 'delete', _token : "{{ csrf_token() }}"},
    success: function (data) {
        data = JSON.parse(data)
        if(data.status==true){
            Swal.fire(
                '',
                data.message,
                'success'
            ).then(function() {
                location.reload();
            });
            
        }
    },
    error: function (data) {
        console.log('Error:', data);
    }
});
}
</script>
@endsection