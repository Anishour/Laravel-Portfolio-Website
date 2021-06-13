function getProjectData(){
	axios.get('/getProjectsData')
		.then(function(response){

			if(response.status==200){
				$('#mainDivProjects').removeClass('d-none');
				$('#loaderDivProject').addClass('d-none');


				$('#projectTableId').DataTable().destroy();
				$('#Project_table').empty();

				var jsonData = response.data;

				$.each(jsonData, function(i, item){
					$('<tr>').html(
						"<td>"+jsonData[i].project_name+"</td>"+
						"<td>"+jsonData[i].project_desc+"</td>"+
                        "<td><a class='projectEditBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='projectDeleteBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"
					).appendTo('#Project_table');
				});



				$('#projectTableId').DataTable({"order":false});
				$('.dataTables_length').addClass('bs-select');

			}else{

			}


		}).catch(function(error){

		})
}


//add new Project
$('#addNewProjectBtnId').click(function(){
	$('#addProjectModal').modal('show');
});

$('#ProjectAddConfirmBtn').click(function(){
	var projectName = $('#projectNameAddID').val();
	var projectDesc = $('#projectDescAddID').val();
	var projectLink = $('#projectLinkAddID').val();
	var projectImg = $('#projectImgAddID').val();
	ProjectAdd(projectName,projectDesc,projectLink,projectImg);
});
function ProjectAdd(projectName,projectDesc,projectLink,projectImg){
	if(projectName.length==0){
		toastr.error("Name is required");
	}else if(projectDesc.length==0){
		toastr.error("Description is required");
	}else if(projectLink.length==0){
		toastr.error("Link is required");
	}else if(projectImg.length==0){
		toastr.error("Image is required");
	}else{
	$('#ProjectAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation
	axios.post('/ProjectAdd',{
		project_name: projectName,
		project_desc: projectDesc,
		project_link: projectLink,
		project_img: projectImg
	})
		.then(function(response){

			$('#ProjectAddConfirmBtn').html("Save");
			if (response.status==200){
				if(response.data==1){
					$('#addProjectModal').modal('hide');
					getProjectData();
					toastr.success("Data inserted");
				}else{
					$('#addProjectModal').modal('hide');
					getProjectData();
					toastr.error("Failed");
				}
			}else{
				$('#addProjectModal').modal('hide');
				toastr.error("Something went wrong !");
			}


		}).catch(function(error){
			$('#addProjectModal').modal('hide');
			toastr.error("Something went wrong !");
		});

	}

}