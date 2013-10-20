/* $('body').fadeOut(0);
$('body').fadeIn(400);
 */
nbMultipleResponses = 0;
nbSingleResponses = 0;

$(document).ready(function () {
        $('ul.nav > li').click(function (e) {
            
            $('ul.nav > li').removeClass('active');
            $(this).addClass('active');   
			//e.preventDefault();			
        }); 
		
});
 
 
$('#myTab a').click(function (e) {
 // e.preventDefault();
  $(this).tab('show');
});


/* submit de qcm creation form */

$('#qcmQuestionsForm').submit(function(){
    alert($('#inputMultiResponse1').val());
});


/**
 * CONTROLLEUR CREERQCM
 * @param {type} link
 * @returns {undefined}
 */

//$('#myTab a:first').tab('show');
//
//$('a[data-toggle="tab"]').on('shown', function (e) {
//  e.target // activated tab
//  e.relatedTarget // previous tab
//});



$('#responseRadioList').hide(); 
$('#responseCheckboxList span i').show();
$('#responseCheckboxList span i').last().hide(); 
$('#responseRadioList span i').show();
$('#responseRadioList span i').last().hide(); 
    
$('#selectType').change(function(){ 
  if($('#selectType').val() === 'uniquechoice'){
      $('#responseCheckboxList').hide();
      $('#responseRadioList').fadeIn(500);
      $('#responseCheckboxList span i').show();
      $('#responseCheckboxList span i').last().hide(); 
      $('#responseRadioList span i').show();
      $('#responseRadioList span i').last().hide(); 
  }  
  else
  { 
      $('#responseRadioList').hide();
      $('#responseCheckboxList').fadeIn(500);
      $('#responseCheckboxList span i').show();
      $('#responseCheckboxList span i').last().hide(); 
      $('#responseRadioList span i').show();
      $('#responseRadioList span i').last().hide(); 
  }
});

$('#selectTheme').change(function(){
    if($('#selectTheme').val() == ""){
        $('#inputTheme').removeAttr("disabled");
        $('#inputTheme').focus();
    }
    else
    {
         $('#inputTheme').attr('disabled', 'disabled');
    }
});

function removeMultipleResponse(link){ 
    if(link.parentNode.parentNode.removeChild(link.parentNode)){
       nbMultipleResponses--; 
       $('#addMultipleResponses').show();
    }    
}

function removeSingleResponse(link){ 
    if(link.parentNode.parentNode.removeChild(link.parentNode)){
        nbSingleResponses--;
        $('#addSingleResponse').show();
    }   
    
}

  
 
function TodoCtrl($scope) {
  $scope.todos = [
    {text:'learn angular', done:true},
    {text:'build an angular app', done:false}];
 
 
  $scope.addTodoMultipleResponse = function() {
    nbMultipleResponses++;
    if(nbMultipleResponses === 2){ 
        //2 => 6 réponses possibles 
        $('#addMultipleResponses').hide();
    }
    $scope.todos.push({text:$scope.todoText, done:true});
    $('#responseCheckboxList span i').show();
    $('#responseCheckboxList span i').last().hide(); 
 
  };
  
  $scope.addTodoSingleResponse = function(){
     nbSingleResponses++; 
     if(nbSingleResponses === 2){ 
        //2 => 6 réponses possibles 
        $('#addSingleResponse').hide();
     }
     $scope.todos.push({text:$scope.todoText, done:true});   
     $('#responseRadioList span i').show();
     $('#responseRadioList span i').last().hide(); 
  };
 
  $scope.remaining = function() {
    var count = 0;
    angular.forEach($scope.todos, function(todo) {
      count += todo.done ? 0 : 1;
    });
    return count;
  };
  
//  $scope.remove = function(element){
//   //   alert(element);
//        $scope.thing= element;
//        $scope.thing.$destroy();
//  };
  
  $scope.archive = function() {
    var oldTodos = $scope.todos;
    $scope.todos = [];
    angular.forEach(oldTodos, function(todo) {
      if (!todo.done) $scope.todos.push(todo);
    });
  };
}


/*
* Fin Controller creerqcm
 */
 
 
 