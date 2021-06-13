@extends('Layout.app')
@section('content')



<div id="mainDivCourse" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">

<button id="addNewCourseBtnId" class="btn my-3 btn-sm btn-danger">Add New</button>

<table id="courseDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Fee</th>
	  <th class="th-sm">Class</th>
	  <th class="th-sm">Enroll</th>
	  <th class="th-sm">Details</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
 </thead>
 <tbody id="course_table">

 </tbody>
</table>

</div>
</div>
</div>


<div id="loaderDivCourse" class="container">
<div class="row">
<div class="col-md-12 text-center p-5">

		<img class="loading-icon m-5" src="{{ asset('images/loader.svg') }}">

</div>
</div>
</div>

<div id="WrongDivCourse" class="container d-none">
<div class="row">
<div class="col-md-12 text-center p-5">

			<h3>Somthing Went Wrong !</h3>

</div>
</div>
</div>


<!--Add New Course Modal Here-->
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Course</h5>
        <button type="button" class="close" data-mdb-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameId" type="text" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesId" type="text" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeId" type="text" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollId" type="text" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassId" type="text" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkId" type="text" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgId" type="text" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-mdb-dismiss="modal">Cancel</button>
        <button  id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>






<!--Update Course Modal Here-->
<div class="modal fade" id="updateCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Course</h5>
        <button type="button" class="close" data-mdb-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">


       <div id="courseEditFrom" class="container d-none">

		<h5 id="CourseEditId" class="visually-hidden"></h5>
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameUpdateId" type="text" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesUpdateId" type="text" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeUpdateId" type="text" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollUpdateId" type="text" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassUpdateId" type="text" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkUpdateId" type="text" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgUpdateId" type="text" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>

            <img id="courseEditLoader" class="loading-icon m-5" src="{{ asset('images/loader.svg') }}">
            <h3 id="courseEditWrong" class="d-none">Somthing Went Wrong !</h3>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-mdb-dismiss="modal">Cancel</button>
        <button  id="CourseUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-body text-center">
			<h5 class="mt-4">Do you want to delete ?</h5>
			<h4 id="CourseDeleteId" class="mt-4 visually-hidden"></h4>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-sm btn-primary" data-mdb-dismiss="modal">
			No
		  </button>
		  <button id="CourseDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
		</div>
	  </div>
	</div>
  </div>



<!--Details Course Modal Here-->
<div class="modal fade" id="detailsCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Details Course</h5>
        <button type="button" class="close" data-mdb-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">


       <div id="courseDetailsFrom" class="container d-none">

		<h5 id="CourseDetailsId" class="visually-hidden"></h5>
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameDetailsId" type="text" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesDetailsId" type="text" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeDetailsId" type="text" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollDetailsId" type="text" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassDetailsId" type="text" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkDetailsId" type="text" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgDetailsId" type="text" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>

            <img id="courseDetailsLoader" class="loading-icon m-5" src="{{ asset('images/loader.svg') }}">
            <h3 id="courseDetailsWrong" class="d-none">Somthing Went Wrong !</h3>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-mdb-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>



@endsection

@section('script')
	<script type="text/javascript">
	getCoursesData();
	function getCoursesData() {
    axios.get('/getCoursesData')
        .then(function(response) {
            if (response.status == 200) {

                $('#mainDivCourse').removeClass('d-none');
                $('#loaderDivCourse').addClass('d-none');

                $('#courseDataTable').DataTable().destroy();
                $('#course_table').empty();



                var jsonData = response.data;

                $.each(jsonData, function(i, item) {
                    $('<tr>').html(

                        "<td>" + jsonData[i].course_name + "</td>" +
                        "<td>" + jsonData[i].course_fee + "</td>" +
                        "<td>" + jsonData[i].course_totalclass + "</td>" +
                        "<td>" + jsonData[i].course_totalenroll + "</td>" +
                        "<td><a class='courseViewDetailsBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-eye'></i></a></td>" +
                        "<td><a class='courseEditBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='courseDeleteBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"

                    ).appendTo('#course_table');
                });
                $('.courseViewDetailsBtn').click(function() {
                    var id = $(this).data(id);
                    CourseDetails(id);
                    $('#CourseDetailsId').html(id);
                    $('#detailsCourseModal').modal('show');
                });
                $('.courseDeleteBtn').click(function() {
                    var id = $(this).data('id');
                    $('#CourseDeleteId').html(id);
                    $('#deleteCourseModal').modal('show');
                });
                $('.courseEditBtn').click(function() {
                    var id = $(this).data('id');
                    CourseUpdateDetails(id);
                    $('#CourseEditId').html(id);
                    $('#updateCourseModal').modal('show');
                });


                $('#courseDataTable').DataTable({
                    "order": false
                });
                $('.dataTables_length').addClass('bs-select');


            } else {
                $('#loaderDivCourse').addClass('d-none');
                $('#WrongDivCourse').removeClass('d-none');
            }
        }).catch(function(error) {
            $('#loaderDivCourse').addClass('d-none');
            $('#WrongDivCourse').removeClass('d-none');
        });
}

$('#addNewCourseBtnId').click(function() {
    $("#addCourseModal").modal('show');
});

$('#CourseAddConfirmBtn').click(function() {
    var CourseName = $('#CourseNameId').val();
    var CourseDes = $('#CourseDesId').val();
    var CourseFee = $('#CourseFeeId').val();
    var CourseEnroll = $('#CourseEnrollId').val();
    var CourseClass = $('#CourseClassId').val();
    var CourseLink = $('#CourseLinkId').val();
    var CourseImg = $('#CourseImgId').val();

    CourseAdd(CourseName, CourseDes, CourseFee, CourseEnroll, CourseClass, CourseLink, CourseImg);

});

function CourseAdd(CourseName, CourseDes, CourseFee, CourseEnroll, CourseClass, CourseLink, CourseImg) {

    if (CourseName.length == 0) {
        toastr.error('Course Name is required');
    } else if (CourseDes.length == 0) {
        toastr.error('Course Des is required');
    } else if (CourseFee.length == 0) {
        toastr.error('Course Fee is required');
    } else if (CourseEnroll.length == 0) {
        toastr.error('Course Enroll is required');
    } else if (CourseClass.length == 0) {
        toastr.error('Course Class is required');
    } else if (CourseLink.length == 0) {
        toastr.error('Course Link is required');
    } else if (CourseImg.length == 0) {
        toastr.error('Course Img is required');
    } else {
        $('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation
        axios.post('/CoursesAdd', {
                course_name: CourseName,
                course_des: CourseDes,
                course_fee: CourseFee,
                course_totalenroll: CourseEnroll,
                course_totalclass: CourseClass,
                course_link: CourseLink,
                course_img: CourseImg
            })
            .then(function(response) {
                $('#CourseAddConfirmBtn').html("Save");
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#addCourseModal').modal('hide');
                        toastr.success('Add Successfully');
                        getCoursesData();
                    } else {
                        $('#addCourseModal').modal('hide');
                        toastr.error('Add Faild');
                        getCoursesData();
                    }

                } else {
                    $('#addCourseModal').modal('hide');
                    toastr.error('Something Went Wrong !');
                }



            })
            .catch(function(error) {
                $('#addCourseModal').modal('hide');
                toastr.error('Something Went Wrong !');
            });
    }



}

$('#CourseDeleteConfirmBtn').click(function() {
    var id = $('#CourseDeleteId').html();
    CourseDelete(id);
});


function CourseDelete(deleteId) {
    $('#CourseDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation
    axios.post('/CoursesDelete', {
            id: deleteId
        })
        .then(function(response) {
            $('#CourseDeleteConfirmBtn').html("Yes");
            if (response.status == 200) {
                if (response.data == 1) {
                    $('#deleteCourseModal').modal('hide');
                    toastr.success('Delete Successfully');
                    getCoursesData();
                } else {
                    $('#deleteCourseModal').modal('hide');
                    toastr.error('Delete Faild');
                    getCoursesData();
                }

            } else {
                $('#deleteCourseModal').modal('hide');
                toastr.error('Something Went Wrong !');
            }
        })
        .catch(function(error) {
            $('#deleteCourseModal').modal('hide');
            toastr.error('Something Went Wrong !');
        });

}

//course Details

function CourseUpdateDetails(detailsId) {
    axios.post('/CoursesDetails', {
            id: detailsId
        })
        .then(function(response) {

            if (response.status == 200) {

                $('#courseEditFrom').removeClass('d-none');
                $('#courseEditLoader').addClass('d-none');

                var jsonData = response.data;

                $('#CourseNameUpdateId').val(jsonData[0].course_name);
                $('#CourseDesUpdateId').val(jsonData[0].course_des);
                $('#CourseFeeUpdateId').val(jsonData[0].course_fee);
                $('#CourseEnrollUpdateId').val(jsonData[0].course_totalenroll);
                $('#CourseClassUpdateId').val(jsonData[0].course_totalclass);
                $('#CourseLinkUpdateId').val(jsonData[0].course_link);
                $('#CourseImgUpdateId').val(jsonData[0].course_img);

            } else {
                $('#courseEditWrong').removeClass('d-none');
                $('#courseEditLoader').addClass('d-none');
            }

        })
        .catch(function(error) {
            $('#courseEditWrong').removeClass('d-none');
            $('#serviceEditLoader').addClass('d-none');
        });
}

$('#CourseUpdateConfirmBtn').click(function() {
    var courseID = $('#CourseEditId').html();
    var courseName = $('#CourseNameUpdateId').val();
    var courseDes = $('#CourseDesUpdateId').val();
    var courseFee = $('#CourseFeeUpdateId').val();
    var courseEnroll = $('#CourseEnrollUpdateId').val();
    var courseClass = $('#CourseClassUpdateId').val();
    var courseLink = $('#CourseLinkUpdateId').val();
    var courseImg = $('#CourseImgUpdateId').val();
    CourseUpdate(courseID, courseName, courseDes, courseFee, courseEnroll, courseClass, courseLink, courseImg);
});


function CourseUpdate(courseID, courseName, courseDes, courseFee, courseEnroll, courseClass, courseLink, courseImg) {

    if (courseName.length == 0) {
        toastr.error('Course Name is required');
    } else if (courseDes.length == 0) {
        toastr.error('Course Des is required');
    } else if (courseFee.length == 0) {
        toastr.error('Course Fee is required');
    } else if (courseEnroll.length == 0) {
        toastr.error('Course Enroll is required');
    } else if (courseClass.length == 0) {
        toastr.error('Course Class is required');
    } else if (courseLink.length == 0) {
        toastr.error('Course Link is required');
    } else if (courseImg.length == 0) {
        toastr.error('Course Img is required');
    } else {
        $('#CourseUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation
        axios.post('/CoursesUpdate', {
                id: courseID,
                course_name: courseName,
                course_des: courseDes,
                course_fee: courseFee,
                course_totalenroll: courseEnroll,
                course_totalclass: courseClass,
                course_link: courseLink,
                course_img: courseImg
            })
            .then(function(response) {
                $('#CourseUpdateConfirmBtn').html("Save");
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#updateCourseModal').modal('hide');
                        toastr.success('Updated Successfully');
                        getCoursesData();
                    } else {
                        $('#updateCourseModal').modal('hide');
                        toastr.error('Update Faild');
                        getCoursesData();
                    }

                } else {
                    $('#updateCourseModal').modal('hide');
                    toastr.error('Something Went Wrong !');
                }



            })
            .catch(function(error) {
                $('#updateCourseModal').modal('hide');
                toastr.error('Something Went Wrong !');
            });
    }



}


function CourseDetails(detailsId) {
    axios.post('/CoursesDetails', {
            id: detailsId
        })
        .then(function(response) {

            if (response.status == 200) {

                $('#courseDetailsFrom').removeClass('d-none');
                $('#courseDetailsLoader').addClass('d-none');

                var jsonData = response.data;

                $('#CourseNameDetailsId').val(jsonData[0].course_name);
                $('#CourseDesDetailsId').val(jsonData[0].course_des);
                $('#CourseFeeDetailsId').val(jsonData[0].course_fee);
                $('#CourseEnrollDetailsId').val(jsonData[0].course_totalenroll);
                $('#CourseClassDetailsId').val(jsonData[0].course_totalclass);
                $('#CourseLinkDetailsId').val(jsonData[0].course_link);
                $('#CourseImgDetailsId').val(jsonData[0].course_img);

            } else {
                $('#courseDetailsWrong').removeClass('d-none');
                $('#courseDetailsLoader').addClass('d-none');
            }

        })
        .catch(function(error) {
            $('#courseDetailsWrong').removeClass('d-none');
            $('#courseDetailsLoader').addClass('d-none');
        });
}


	</script>
@endsection