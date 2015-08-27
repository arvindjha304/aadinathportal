
var baseUrl = $('#baseUrl').val();
 
function floorPlanInfo(floorPlanId,divId,project_id){
     $.post(baseUrl + '/front-end/index/get-floor-plan-info', {project_id: project_id,floorPlanId:floorPlanId}, function (response) {
         if(floorPlanId==''){
            $('#area_'+divId).text(response.maxMinFloorSize.minFloorSize+' - '+response.maxMinFloorSize.maxFloorSize);
            $('#totalPrice_'+divId).text(response.min_floor_plan_price+' - '+response.max_floor_plan_price);
            $('#floorPlanCount_'+divId).text(response.countFloorPlan+' Floor Plan');
         }else{
            $('#area_'+divId).text(response.floorPlanDetail.size+' '+response.floorPlanDetail.unit);
            $('#totalPrice_'+divId).text(response.floorPlanDetail.price+' '+response.floorPlanDetail.price_unit);
            $('#floorPlanCount_'+divId).html('<a class="yo" href="'+baseUrl+'/public/uploadfiles/'+response.floorPlanDetail.floor_plan_image+'" title=""><span class="glyphicon glyphicon-open" aria-hidden="true"></span>Click to view Floor Plan</a>');
             
         }
     },'json');
//    alert(floorPlanId+'==='+divId);
//    return false;
}
function addRemoveCompare(project_id,is_menu=0){
    
    if(project_id!==''){
        if ($.inArray(project_id, CompareProjectsArr) !== -1) {
            $('#compareCheckBox'+project_id).removeClass('glyphicon-check').addClass('glyphicon-unchecked');
            $('#compareText'+project_id).text('Add to Compare');
            var index = CompareProjectsArr.indexOf(project_id);
            CompareProjectsArr.splice(index, 1);
        }else{    
            if(CompareProjectsArr.length > 2){
                alert('Maximum 3 projects can be compared');
                return false; 
            }   
            $('#compareCheckBox'+project_id).removeClass('glyphicon-unchecked').addClass('glyphicon-check');
            $('#compareText'+project_id).text('Remove from Compare');
            CompareProjectsArr.push(project_id);
        }
        $.post(baseUrl + '/front-end/index/addcompare', {project_id: project_id,allCompareProjects:CompareProjectsArr}, function (response) {

                var liString = '';
                var kk = 0;
                $.each(response, function(id,value) {
                    liString += '<li ><div class="col-md-12" style="border-bottom: 1px solid #ddd;"><div class="compare-dropdown-menu"><a href="'+baseUrl+'/projects/'+value.projectSlug+'">'+value.project_title+'</a></div><div onclick="addRemoveCompare('+value.id+',1)" class="cursor compare-dropdown-menu-remove"><a   class="compare-dropdown-menu-remove-btn"><span class="glyphicon glyphicon-remove-circle"></span></a></div></div></li>';
                    kk++;
                });
                if(response.length > 0){
                    var disabled = (response.length < 2) ? 'disabled' : '';
                    $('.compareProjectsList').html(liString+'<li><button '+disabled+' type="button" class="btn btn-danger btn-xs" style="width:100%;">Compare</button></li>');             if(is_menu!=0) $('.openCompare').addClass('open');
                }else{
                  $('.compareProjectsList').html('<li><div class="col-md-12" style="border-bottom: 1px solid #ddd;"><div class="compare-dropdown-menu">No Project Selected</div></div></li>');   
                }
                $('#countCompare').text(kk);

        },'json'); 
    }
}

