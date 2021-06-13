@extends('Layout.app')
@section('content')


<div id="mainDivProjects" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">

<button id="addNewProjectBtnId" class="btn my-3 btn-sm btn-danger">Add New</button>

<table id="projectTableId" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
	  	<th class="th-sm">Name</th>
	  	<th class="th-sm">Description</th>
	  	<th class="th-sm">Edit</th>
	  	<th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="Project_table">
  
	
  </tbody>
</table>

</div>
</div>
</div>

<div id="loaderDivProject" class="container">
<div class="row">
<div class="col-md-12 text-center p-5">

		<img class="loading-icon m-5" src="{{ asset('images/loader.svg') }}">

</div>
</div>
</div>

<div id="WrongDivProject" class="container d-none">
<div class="row">
<div class="col-md-12 text-center p-5">

			<h3>Somthing Went Wrong !</h3>

</div>
</div>
</div>



<!--Add New Project Modal Here-->
<div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Project</h5>
        <button type="button" class="close" data-mdb-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">

            <h6 class="mb-4">Add New Service</h6>
            <input id="projectNameAddID" type="text" class="form-control mb-4" placeholder="Project Name" />
            <input id="projectDescAddID" type="text" class="form-control mb-4" placeholder="Project Des" />
            <input id="projectLinkAddID" type="text" class="form-control mb-4" placeholder="Project Link" />
            <input id="projectImgAddID" type="text" class="form-control" placeholder="Project Image" />

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-mdb-dismiss="modal">Cancel</button>
        <button  id="ProjectAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>



@endsection

@section('script')
	<script type="text/javascript">
		getProjectData();
	</script>
@endsection