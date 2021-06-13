@extends('Layout.app')
@section('content')

<div id="mainDiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">

<button id="addNewBtnId" class="btn my-3 btn-sm btn-danger">Add New</button>

<table id="serviceTableId" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Image</th>
	  	<th class="th-sm">Name</th>
	  	<th class="th-sm">Description</th>
	  	<th class="th-sm">Edit</th>
	  	<th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="service_table">
  
	
  </tbody>
</table>

</div>
</div>
</div>



<div id="loaderDiv" class="container">
<div class="row">
<div class="col-md-12 text-center p-5">

		<img class="loading-icon m-5" src="{{ asset('images/loader.svg') }}">

</div>
</div>
</div>

<div id="WrongDiv" class="container d-none">
<div class="row">
<div class="col-md-12 text-center p-5">

			<h3>Somthing Went Wrong !</h3>

</div>
</div>
</div>






<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center">
      		<h5 class="mt-4">Do you want to delete ?</h5>
          <h4 id="serviceDeleteId" class="mt-4 visually-hidden"></h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-mdb-dismiss="modal">
          No
        </button>
        <button id="serviceDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Update Services</h5>
            <button type="button" class="close" data-mdb-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
      <div class="modal-body p-4 text-center">

            <div class="w-100 d-none" id="serviceEditForm" >

            <h5 id="serviceEditId" class="mt-4 visually-hidden"></h5>              
            <input id="serviceNameID" type="text" class="form-control mb-4" placeholder="Service Name" />
            <input id="serviceDesID" type="text" class="form-control mb-4" placeholder="Service Des" />
            <input id="serviceImgID" type="text" class="form-control" placeholder="Service Image Link" />
            </div>

            <img id="serviceEditLoader" class="loading-icon m-5" src="{{ asset('images/loader.svg') }}">
            <h3 id="serviceEditWrong" class="d-none">Somthing Went Wrong !</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-mdb-dismiss="modal">
          Cancel
        </button>
        <button id="serviceEditConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body p-5 text-center">

            <div class="w-100" id="serviceAddForm" >
              <h6 class="mb-4">Add New Service</h6>
            <input id="serviceNameAddID" type="text" class="form-control mb-4" placeholder="Service Name" />
            <input id="serviceDesAddID" type="text" class="form-control mb-4" placeholder="Service Des" />
            <input id="serviceImgAddID" type="text" class="form-control" placeholder="Service Image Link" />
            </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-mdb-dismiss="modal">
          Cancel
        </button>
        <button id="serviceAddConfirmBtn" type="button" class="btn btn-sm btn-danger">Add</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
	<script type="text/javascript">
		getServicesData();
//Service Table Data
function getServicesData() {


    axios.get('/getServicesData')
        .then(function(response) {

            if (response.status == 200) {

                $('#mainDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');


                $('#serviceTableId').DataTable().destroy();
                $('#service_table').empty();


                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td class='th-sm'><img class='table-img' src=" + jsonData[i].service_img + "></td>" +
                        "<td class='th-sm'>" + jsonData[i].service_name + "</td>" +
                        "<td class='th-sm'>" + jsonData[i].service_des + "</td>" +
                        "<td class='th-sm'><a class='ServiceEditBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                        "<td class='th-sm'><a class='ServiceDeleteBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"
                    ).appendTo('#service_table');
                });

                //Services Delete Icon Click
                $('.ServiceDeleteBtn').click(function() {
                    var id = $(this).data('id');
                    $('#serviceDeleteId').html(id);
                    $('#deleteModal').modal('show');
                })

                //Service Edit Icon Click     
                $('.ServiceEditBtn').click(function() {
                    var id = $(this).data('id');
                    $('#serviceEditId').html(id);
                    ServiceUpdateDetails(id);
                    $('#editModal').modal('show');
                })



                $('#serviceTableId').DataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');



            } else {
                $('#loaderDiv').addClass('d-none');
                $('#WrongDiv').removeClass('d-none');
            }


        }).catch(function(error) {
            $('#loaderDiv').addClass('d-none');
            $('#WrongDiv').removeClass('d-none');
        });



}


//service Delete Model Yes button
$('#serviceDeleteConfirmBtn').click(function() {
    var id = $('#serviceDeleteId').html();
    ServicesDelete(id);
})


function ServicesDelete(deleteId) {
    $('#serviceDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation
    axios.post('/ServiceDelete', {
            id: deleteId
        })
        .then(function(response) {
            $('#serviceDeleteConfirmBtn').html("Yes");
            if (response.status == 200) {
                if (response.data == 1) {
                    $('#deleteModal').modal('hide');
                    toastr.success('Delete Successfully');
                    getServicesData();
                } else {
                    $('#deleteModal').modal('hide');
                    toastr.error('Delete Faild');
                    getServicesData();
                }

            } else {
                $('#deleteModal').modal('hide');
                toastr.error('Something Went Wrong !');
            }
        })
        .catch(function(error) {
            $('#deleteModal').modal('hide');
            toastr.error('Something Went Wrong !');
        });

}



//each Services Update Details
function ServiceUpdateDetails(detailsId) {

    axios.post('/ServiceDetails', {
            id: detailsId
        })
        .then(function(response) {

            if (response.status == 200) {
                $('#serviceEditForm').removeClass('d-none');
                $('#serviceEditLoader').addClass('d-none');
                var jsonData = response.data;
                $('#serviceNameID').val(jsonData[0].service_name);
                $('#serviceDesID').val(jsonData[0].service_des);
                $('#serviceImgID').val(jsonData[0].service_img);
            } else {
                $('#serviceEditWrong').removeClass('d-none');
                $('#serviceEditLoader').addClass('d-none');
            }

        })
        .catch(function(error) {
            $('#serviceEditWrong').removeClass('d-none');
            $('#serviceEditLoader').addClass('d-none');
        });

}

//service Update Model Save button
$('#serviceEditConfirmBtn').click(function() {

    var id = $('#serviceEditId').html();
    var name = $('#serviceNameID').val();
    var des = $('#serviceDesID').val();
    var img = $('#serviceImgID').val();

    ServiceUpdate(id, name, des, img);
})

function ServiceUpdate(serviceID, serviceName, serviceDes, serviceImg) {

    if (serviceName.length == 0) {
        toastr.error('service Name is required');
    } else if (serviceDes.length == 0) {
        toastr.error('service Des is required');
    } else if (serviceImg.length == 0) {
        toastr.error('service Img is required');
    } else {
        $('#serviceEditConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation
        axios.post('/ServiceUpdate', {
                id: serviceID,
                name: serviceName,
                des: serviceDes,
                img: serviceImg
            })
            .then(function(response) {
                $('#serviceEditConfirmBtn').html("Save");
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#editModal').modal('hide');
                        toastr.success('Updated Successfully');
                        getServicesData();
                    } else {
                        $('#editModal').modal('hide');
                        toastr.error('Update Faild');
                        getServicesData();
                    }

                } else {
                    $('#editModal').modal('hide');
                    toastr.error('Something Went Wrong !');
                }



            })
            .catch(function(error) {
                $('#editModal').modal('hide');
                toastr.error('Something Went Wrong !');
            });
    }



}

//Add New btn click
$('#addNewBtnId').click(function() {
    $('#addModal').modal('show');
});

//service Add Model Add button
$('#serviceAddConfirmBtn').click(function() {

    var name = $('#serviceNameAddID').val();
    var des = $('#serviceDesAddID').val();
    var img = $('#serviceImgAddID').val();

    ServiceAdd(name, des, img);
})



function ServiceAdd(serviceName, serviceDes, serviceImg) {

    if (serviceName.length == 0) {
        toastr.error('service Name is required');
    } else if (serviceDes.length == 0) {
        toastr.error('service Des is required');
    } else if (serviceImg.length == 0) {
        toastr.error('service Img is required');
    } else {
        $('#serviceAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation
        axios.post('/ServiceAdd', {
                name: serviceName,
                des: serviceDes,
                img: serviceImg
            })
            .then(function(response) {
                $('#serviceAddConfirmBtn').html("Add");
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#addModal').modal('hide');
                        toastr.success('Add Successfully');
                        getServicesData();
                    } else {
                        $('#addModal').modal('hide');
                        toastr.error('Add Faild');
                        getServicesData();
                    }

                } else {
                    $('#addModal').modal('hide');
                    toastr.error('Something Went Wrong !');
                }



            })
            .catch(function(error) {
                $('#addModal').modal('hide');
                toastr.error('Something Went Wrong !');
            });
    }



}
	</script>
@endsection