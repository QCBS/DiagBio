function getValueOrZero(data) { // Simple Conditional Operator To Get A Zero If The Value Is Null Or Undefined.
	var temp = (data == null || data == undefined) ? 0 : data;
	return parseFloat(temp, 10);
}
function getUrlVars() {
	var vars = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
		vars[key] = value;
	});
	return vars;
}


        	// These Are All The jQuery UI Element Function Call.
        	
(function ($) {
        		$(document).ready(function() {

        			$('.infoDivs').hide();  //hide all the information blocks on the ecological services

        			$(".ui-state-default").hover(function(){  //display the info of the currently selected ecological service and hide all other info divs
							var id=$(this).attr('id');
							$('[id^=infoDiv]').hide();
							$('#infoDiv'+id).show();
							
						})

        			$('.infoClassDivs').hide();  //hide all the information blocks on the classification of ecological services


        			$('.classExampleDivs').hide();  //hide all the examples of the classifications

        			$(".ui-state-default").hover(function(){  //display the info of the currently selected classification and hide all other info divs
							$(this).addClass('ui-selecting');
							var id=$(this).attr('id');

							$('[id^=classExampleDiv]').hide();
							$('#classExampleDiv'+id).show();

							$('[id^=infoClassDiv]').hide();
							$('#infoClassDiv'+id).show();

						})


					$('.ui-state-default').mouseleave(function(){  //hide the current classification divs(descriptions and examples)
							var id=$(this).attr('id');
							$('#classExampleDiv'+id).hide();
							$('#infoClassDiv'+id).hide();
					})
					

					$('.ui-state-default').mouseleave(function(){  //hide the current ecological service descriptions
							var id=$(this).attr('id');
							$('#infoDiv'+id).hide();
							$(this).removeClass('ui-selecting');
					})


					//so this where you put the tabs and it gets set to a number so far tere's 1-4, easy enough

					var userRole = jQuery('#userRole').val();
        			if ( userRole == "Unauthenticated" ){
        				var elem = document.getElementById('tab5');  //1
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('userview');
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('tab6');  //2
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('servicetab');
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('tab7');  //3
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('classificationtab');
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('tab8');  //4
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('entreprisetab');
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('tab9'); //5
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('naturetab');
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('tab10'); //6
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('evaltab');
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('tab11'); //7
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('moneytab');
        				elem.parentNode.removeChild(elem);
						$('#tabs').tabs(); // Generate Tabs With The Default Settings.
					}
					if ( userRole == "Unauthenticated" || userRole == "Participant" ){
						var elem = document.getElementById('tab4');
						elem.parentNode.removeChild(elem);
						var elem = document.getElementById('admintools');
						elem.parentNode.removeChild(elem);
					}
					if ( userRole != "Unauthenticated" ){
						var elem = document.getElementById('tab1');
						elem.parentNode.removeChild(elem);
						var elem = document.getElementById('info');
						elem.parentNode.removeChild(elem);
						var elem = document.getElementById('tab2');
						elem.parentNode.removeChild(elem);
						var elem = document.getElementById('question');
						elem.parentNode.removeChild(elem);
						var elem = document.getElementById('tab3');
						elem.parentNode.removeChild(elem);
						var elem = document.getElementById('login');
						elem.parentNode.removeChild(elem);
						if ( userRole == "Administration" ){
							var disableTabs = [2, 3, 4,5,6,7];
							var compensateTab = 1;
						}
						else {
							var disableTabs = [1, 2, 3,4,5,6];
							var compensateTab = 0;
						}
						$('#tabs').tabs({disabled: disableTabs}); // Generate Tabs With The Default Settings.

						var se_item; // keeping track of selected service ecologic
						var c_item; // keeing track of selected classification
						var newCounter = 1; // counter for the new HTML element
						var exiCounter = 1; // counter for the existing HTML elements
						var report_id;
						var valid_input;

						$('.lists').hide(); // hiding all 10 divs which are corresponding to different classification selectable lists
							
						// Selectable list of tab 1
						$("#selectable0").selectable({ //creating a selectable list which contains all the reports anwsered by certain user 
							selected: function(event, ui) { 
								$(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");
								var result = $( "#select-result" ).empty();
							$( ".ui-selected", this ).each(function() { // this will restricting the user to select only one item
							report_id = $(this).attr("id");  // getting the id of the selected item (reportID)
							$('#new_report').val(report_id);
						}); 
						}
					});
						// Selectable list of tab 2				
						$("#selectable").selectable({ 
							selected: function(event, ui) { 
								$(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");
								var result = $( "#select-result" ).empty();
								$( ".ui-selected", this ).each(function() {
							se_item = $(this).attr("id"); // getting the id of selected service ecologic
						}); 
							}
						});
						// Selectable lists of tab 3
						//for(var i=1;i<=10;i++){ // 10 list based on whichever service ecologic is selected

							$(".selectable_c").selectable({
								selected: function(event, ui) { 
									$(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");
									var result = $( "#select-result" ).empty();
									$( ".ui-selected", this ).each(function() {
							c_item = $(this).attr("id"); // getting the id of selected classification
						}); 
								}
								
							});
					//	}

						$('#RE_BTN_NEXT').button().click(function() { // NEXT button on the 1st tab

							if(report_id){

								$("#the_report").val(report_id);
								$( "#tabs" ).tabs('enable', 1+compensateTab).tabs('select', 1+compensateTab);
								$( "#tabs" ).tabs( 'disable', 0+compensateTab );

							}
							else{
								alert("Aucune valeur n'a été sélectionnée ou entrée"); // otherwise give an error
							}
						});
						
						$('#NEW_RE_BTN').button().click(function() {
							
							var theValid;
							var ridInput = document.getElementById("new_report"); // getting the textbox field on 1st tab
							

							if (ridInput && ridInput.value) { // ckeching if the textbox has value

								valid_input = true;

								var request = new XMLHttpRequest();
								var url = "/testing/Jason/php/get_examples.php";
								var params = "newRid="+ridInput.value;
								request.open('GET',url+"?"+params,false);
								request.send(null);

								var xml = request.responseXML;
								$xml = $( xml );

								$xml.find("info").each(function(){
									theValid = $(this).attr("validation");
								});
							}

							else{
								alert("Aucune valeur n'a été entrée"); // otherwise give an error
								$("#new_report").focus();
								
							}

							if(valid_input){
								if(theValid > 0){
									report_id = ridInput.value;// assigning the textbox value to the global variable REPORT
									$("#the_report").val(report_id);
									$( "#tabs" ).tabs('enable', 1+compensateTab).tabs('select', 1+compensateTab);
									$( "#tabs" ).tabs( 'disable', 0+compensateTab );
								}
								else{
									report_id = null;
									alert(theValid+" Mauvais numéro de rapport! Entre un nouveau");
									$("#new_report").focus();
								}
							}

						});

						$('#SE_BTN_BACK').button().click(function() {// BACK button on the 1st tab
							$( "#tabs" ).tabs('enable', 0+compensateTab).tabs('select', 0+compensateTab); // go to the pervious tab and disable the current one
							$( "#tabs" ).tabs( 'disable', 1+compensateTab );
							
						});
						
						$('#SE_BTN_NEXT').button().click(function() { // NEXT button on the 2rd tab
							
							$('.lists').hide();// hindding all the seletable list
								
		
							if(se_item){ // than only showing the one which conrresponds to the selected sevive ecologic
							 	$('#list'+se_item).show();	
							 	
								/*if (se_item == '1'){
									$('#list1').show();	
								}
								else if (se_item == '2'){
									$('#list2').show();
								}
								else if (se_item == '3'){
									$('#list3').show();
								}
								else if (se_item == '4'){
									$('#list4').show();
								}
								else if (se_item == '5'){
									$('#list5').show();
								}
								else if (se_item == '6'){
									$('#list6').show();
								}
								else if (se_item == '7'){
									$('#list7').show();
								}
								else if (se_item == '8'){
									$('#list8').show();
								}
								else if (se_item == '9'){
									$('#list9').show();
								}
								else if (se_item == '10'){
									$('#list10').show();
								}*/
								$("#se_i").val(se_item);
								$( "#tabs" ).tabs('enable', 2+compensateTab).tabs('select', 2+compensateTab); // go to the next tab (3rd tab) and disable the 2rd one
								$( "#tabs" ).tabs( 'disable', 1+compensateTab );
							}
							else{
								alert("Aucune valeur n'a été sélectionnée"); //else give an error
							}
							
						});

$('#TAB9_BTN_NEXT').button().click(function() {
						
							$( "#tabs" ).tabs( "enable", 5).tabs('select', 5);;
							$( "#tabs" ).tabs( 'disable', 4);
						});
$('#TAB9_BTN_BACK').button().click(function() {
						
							$( "#tabs" ).tabs( "enable", 4 ).tabs('select', 4);;
							$( "#tabs" ).tabs( 'disable', 5);
						});


$(function() {
   // var select = $( "#slides" );
    $( "#slider" ).slider( "enable" );
    $('#slider').slider();
    /*var slider = $('#slider').slider({
      min: 1,
      max: 5,
      range: "min",
      value: select[ 0 ].selectedIndex + 1,
      slide: function( event, ui ) {
        select[ 0 ].selectedIndex = ui.value - 1;
      }
    });
    $( "#slides" ).change(function() {
      slider.slider( "value", this.selectedIndex + 1 );
    });
*/
  });

$('#TAB10_BTN_NEXT').button().click(function() {
						
							$( "#tabs" ).tabs( "enable", 6).tabs('select', 6);;
							$( "#tabs" ).tabs( 'disable', 5);
						});
$('#TAB10_BTN_BACK').button().click(function() {
						
							$( "#tabs" ).tabs( "enable", 5 ).tabs('select', 5);;
							$( "#tabs" ).tabs( 'disable', 6);
						});

$('#TAB11_BTN_NEXT').button().click(function() {
						
							$( "#tabs" ).tabs( "enable", 7).tabs('select', 7);;
							$( "#tabs" ).tabs( 'disable', 6);
						});
$('#TAB11_BTN_BACK').button().click(function() {
						
							$( "#tabs" ).tabs( "enable", 6 ).tabs('select', 6);;
							$( "#tabs" ).tabs( 'disable', 7);
						});

$('#C_BTN_BACK').button().click(function() {
							$( "#tabs" ).tabs('enable', 1+compensateTab).tabs('select', 1+compensateTab); //go back to tab 2 and disable the tab 3
							$( "#tabs" ).tabs( 'disable', 2+compensateTab );
							
						});

$('#C_BTN_NEXT').button().click(function() { 
	if(c_item){
		alert(c_item);

		$("#c_i").val(c_item);
								var theDropdownDiv = $(document.createElement('div')) // a div which will contain a textbox
								.attr("id", 'theDD');

								var request = new XMLHttpRequest();
								var url = "/testing/sidra/php/get_examples.php";
								var params = "rid="+report_id+"&cid="+c_item;
								request.open('GET',url+"?"+params,false);
								request.send(null);
								
								var xml = request.responseXML;
								$xml = $( xml );

								var theDropdown =  '<select id="existingSelect">';
								
								$xml.find("info").each(function(){
									theDropdown += '<option value"'+$(this).attr("the_example_name")+'">'+$(this).attr("the_example_name")+'</option>';

								});
								theDropdown += '</select>';
								theDropdownDiv .html(theDropdown);
								theDropdownDiv.appendTo("#divDD");

								var theDD = document.getElementById("existingSelect");
								if(theDD.value == "") // if the dropdown list doesn't have values
								{
										$("#divDD").hide(); // hide the div which has the dropdown list
										$("#dd_btn").hide();

									}
								$( "#tabs" ).tabs('enable', 3+compensateTab).tabs('select', 3+compensateTab); // go to tab 4 and disable tab 3
								$( "#tabs" ).tabs( 'disable', 2+compensateTab );
							}
							else{
								
								alert("Aucune valeur n'a été sélectionnée"); // no classification selected
							}
							
});

$('#BTN_QUIT').button().click(function() { // close the window which is not currently working
	event.preventDefault();
	var r=confirm("Etes-vous sûr de vouloir quitter cette application")
	if (r==true){
		alert("You pressed OK!");
		window.close();
	}

	else{
		alert("You pressed Cancel!");
	}
});

$('#BTN_RE_SE').button().click(function() { // retour to services ecologique

	event.preventDefault();
	removeHTMLElements();
							$( "#tabs" ).tabs('enable', 1+compensateTab).tabs('select', 1+compensateTab); // go to tab 4 and disable tab 3
							$( "#tabs" ).tabs( 'disable', 3+compensateTab );
						});

$('#submit').button().click(function() {}); //just to style the submit button

$('#LAST_BTN_BACK').button().click(function() { // on the last tab when the back button, it's removing all the HTML elements 

							event.preventDefault(); // preventing from doing a post back when the button is clicked

							$( "#tabs" ).tabs('enable', 2+compensateTab).tabs('select', 2+compensateTab); //go back to tab 3 and disable tab 4
							$( "#tabs" ).tabs( 'disable', 3+compensateTab );

							removeHTMLElements(); // remove all HTML elements
							
});

function removeHTMLElements(){

	if(newCounter > 0){
		for (i = 1; i<newCounter; i++){ 
									$("#nTB" + i ).remove(); // remove the row of new example
									$("#nNature" + i).remove();
									$("#nEvalu" + i).remove();
									$("#nSD" + i).remove();
									$("#nMoney" + i).remove();		
								};
								newCounter = 1; // set counter back to 0
								$("#hiddenNewExamples").val("");

							}

							if(exiCounter > 0){
								for (j = 1; j<exiCounter; j++){
									$("#eTB" + j).remove(); // remove the row of existing example
									$("#eNature" + j).remove();
									$("#eEvalu" + j).remove();
									$("#eSD" + j).remove();
									$("#eMoney" + j).remove();		
								};
								exiCounter = 1; // set counter back to 0
								$("#hiddenExistingExamples").val("");
							}

							$("#theDD").remove();

						}

						$('#theNewExample').button().click(function() { // button to insert a new example with its evaluation elements

							//event.preventDefault(); // preventing from doing a post back when the button is clicked
							
							if(newCounter>10){ // can't have more than 10 examples
								alert("Pas plus que 10 exemples permit");
							return false;
							}   

							var newTextBoxDiv = $(document.createElement('div')) // a div which will contain a textbox
							.attr("id", 'nTB' + newCounter);

			     			var newDropDownDiv = $(document.createElement('div')) // a div which will contain a dropdown list (nature)
			     			.attr("id", 'nNature' + newCounter);

			     			var newSelect1Div = $(document.createElement('div')) // (evaluation)
			     			.attr("id", 'nEvalu' + newCounter);

			     			var newSelect2Div = $(document.createElement('div')) // (cout)
			     			.attr("id", 'nMoney' + newCounter);

			     			var newSDDiv = $(document.createElement('div'))  // a div which will contain label for standard deviation
			     			.attr("id", 'nSD' + newCounter);


			     			if(newCounter == 1) // if it's the first time creating the row of HTML elements! It will contain the label heading for each one of them
			     			{
		 						// textbox for the example of interdependances
		 						newTextBoxDiv.html('<div style="width: 1000px; hight:800px">'+'<div style="float: left; width: 250px;">'+ 
		 							'<label>Une nouvelle exemple</label>' + '<br><br>'+'<input type="text" name="newTheExample' + newCounter + 
		 							'"placeholder="Entrez une exemple" title="Entrez une nouvelle exemple" style="width: 200px;" />' + '</div></div>');
								//dropdown list for the nature
								newDropDownDiv.html('<div style="float: left; width: 150px;">'+'<label>Nature dinterdependance</label>'+'<br>'+
									'<select name="newTheNature' + newCounter +'" title="Choisissez la nature pour votre exemple"  >'+
									'<option name="newTheNature' + newCounter +'" value="Risque">Risque</option>'+
									'<option name="newTheNature' + newCounter +'" value="Atout">Atout</option>'+
									'<option name="newTheNature' + newCounter +'" value="Opportunité">Opportunité</option>'+
									'</select>'+'</div>');

				      			//dropdown list for the evaluation (1 to 10)
				      			newSelect1Div.html('<div style="float: left; width: 150px;">'+'<label>Evaluez Votre Interdependance</label>' +'<br>'+
				      				'<select name="newTheEvalu' + newCounter +'" title="Accordez une importance a votre exemple ou 1 est une trés base et 10 est une trés haute"  >'+
				      				'<option name="newTheEvalu' + newCounter +'" value="1">1</option>'+
				      				'<option name="newTheEvalu' + newCounter +'" value="2">2</option>'+
				      				'<option name="newTheEvalu' + newCounter +'" value="3">3</option>'+
				      				'<option name="newTheEvalu' + newCounter +'" value="4">4</option>'+
				      				'<option name="newTheEvalu' + newCounter +'" value="5">5</option>'+
				      				'</select>'+'</div>');
				      			

				      			newSDDiv.html('<div style="float: left; width: 75px;">'+'<label>SD</label>'+'<br><br>'+'<label title="TODO">0</label>'+'</div>');

				      			//dropdown list for the Impact Monétaire (1 to 10)
				      			newSelect2Div.html('<div style="float: left; width: 100px;">'+'<label>Impact Monétaire</label>' +'<br>'+
				      				'<select name="newTheMoney' + newCounter +'" title="Accordez une importance monétaire ou 1 est une trés base et 10 est une trés haute" >'+
				      				'<option name="newTheMoney' + newCounter +'" value="1">1</option>'+
				      				'<option name="newTheMoney' + newCounter +'" value="2">2</option>'+
				      				'<option name="newTheMoney' + newCounter +'" value="3">3</option>'+
				      				'<option name="newTheMoney' + newCounter +'" value="4">4</option>'+
				      				'<option name="newTheMoney' + newCounter +'" value="5">5</option>'+
				      				'</select>'+'</div>'+'<br style="clear: left;" /><br style="clear: left;" />');
				      		}
							else // in this else condition everthing is the same but there's no label headings
							{
								newTextBoxDiv.html('<div style="width: 1000px; hight:800px">'+'<div style="float: left; width: 250px;">'+ 
									'<br>'+'<input type="text" name="newTheExample' + newCounter + 
									'" placeholder="Entrez une exemple" style="width: 200px;" />' + '</div></div>');

								newDropDownDiv.html('<div style="float: left; width: 150px;">'+'<br>'+
									'<select name="newTheNature' + newCounter +'" title="Choisissez la nature pour votre exemple" >'+
									'<option name="newTheNature' + newCounter +'" value="Risque">Risque</option>'+
									'<option name="newTheNature' + newCounter +'" value="Atout">Atout</option>'+
									'<option name="newTheNature' + newCounter +'" value="Opportunité">Opportunité</option>'+
									'</select>'+'</div>');
															

								newSelect1Div.html('<div style="float: left; width: 150px;">'+'<br>'+
									'<select name="newTheEvalu' + newCounter +'" title="Accordez une importance a votre exemple ou 1 est une trés base et 10 est une trés haute"  >'+
									'<option name="newTheEvalu' + newCounter +'" value="1">1</option>'+
									'<option name="newTheEvalu' + newCounter +'" value="2">2</option>'+
									'<option name="newTheEvalu' + newCounter +'" value="3">3</option>'+
									'<option name="newTheEvalu' + newCounter +'" value="4">4</option>'+
									'<option name="newTheEvalu' + newCounter +'" value="5">5</option>'+
									'</select>'+'</div>');


								newSDDiv.html('<div style="float: left; width: 75px;">'+'<br>'+'<label title="TODO">0</label>'+'</div>');


								newSelect2Div.html('<div style="float: left; width: 100px;">'+'<br>'+
									'<select name="newTheMoney' + newCounter +'" title="Accordez une importance monétaire ou 1 est une trés base et 10 est une trés haute" >'+
									'<option name="newTheMoney' + newCounter +'" value="1">1</option>'+
									'<option name="newTheMoney' + newCounter +'" value="2">2</option>'+
									'<option name="newTheMoney' + newCounter +'" value="3">3</option>'+
									'<option name="newTheMoney' + newCounter +'" value="4">4</option>'+
									'<option name="newTheMoney' + newCounter +'" value="5">5</option>'+
									'</select>'+'</div>'+'<br style="clear: left;" /><br style="clear: left;" />');

							}
							// add the HTML elements to DIV
							newTextBoxDiv.appendTo("#theSecondGroup");
							newDropDownDiv.appendTo("#theSecondGroup")
							newSelect1Div.appendTo("#theSecondGroup");
							newSDDiv.appendTo("#theSecondGroup");
							newSelect2Div.appendTo("#theSecondGroup");

							$("#hiddenNewExamples").val(newCounter); // populate the hidden field with the counter value

							newCounter++; // incrementing the counter
							
						});


						$('#theExistingExample').button().click(function() { // button to insert a existing with its evaluation(dropdown lists) elements
																  // it has the same functionalaty as the $('#theNewExamples') method

						event.preventDefault(); // preventing from doing a post back when the button is clicked

						var selectedValue = $("#existingSelect option:selected").val(); // get the seleted item from the dropdown list that has the 																existing examples!

						if(exiCounter > 10){ // can not have more tahn 10 examples
							alert("Pas plus que 10 exemples permit");
							return false;
						}   

						var newTextBoxDiv = $(document.createElement('div'))
						.attr("id", 'eTB' + exiCounter);

						var newDropDownDiv = $(document.createElement('div'))
						.attr("id", 'eNature' + exiCounter);

						var newSelect1Div = $(document.createElement('div'))
						.attr("id", 'eEvalu' + exiCounter);

						var newSDDiv = $(document.createElement('div'))
						.attr("id", 'eSD' + exiCounter);

						var newSelect2Div = $(document.createElement('div'))
						.attr("id", 'eMoney' + exiCounter);

						if( exiCounter == 1){

							newTextBoxDiv.html('<div style="width: 1000px; hight:800px">'+'<div style="float: left; width: 250px;">'+ 
								'<label>Une nouvelle exemple</label>' + '<br><br>'+'<input type="text" name="exiTheExample' + exiCounter + 
								'" value="'+ selectedValue +'" readonly="true" placeholder="Entre quelques examples"style="width: 200px;" />' + '</div></div>');

							newDropDownDiv.html('<div style="float: left; width: 150px;">'+'<label>Nature dinterdependance</label>'+'<br>'+
								'<select name="exiTheNature' + exiCounter +'" title="Choisissez la nature pour votre exemple" >'+
								'<option name="exiTheNature' + exiCounter +'" value="Risque">Risque</option>'+
								'<option name="exiTheNature' + exiCounter +'" value="Atout">Atout</option>'+
								'<option name="exiThenature' + exiCounter +'" value="Opportunité">Opportunité</option>'+
								'</select>'+'</div>');


							newSelect1Div.html('<div style="float: left; width: 150px;">'+'<label>Evaluez Votre Interdependance</label>' +'<br>'+
								'<select name="exiTheEvalu' + exiCounter +'" title="Accordez une importance a votre exemple ou 1 est une trés base et 10 est une trés haute" >'+
								'<option name="exiTheEvalu' + exiCounter +'" value="1">1</option>'+
								'<option name="exiTheEvalu' + exiCounter +'" value="2">2</option>'+
								'<option name="exiTheEvalu' + exiCounter +'" value="3">3</option>'+
								'<option name="exiTheEvalu' + exiCounter +'" value="4">4</option>'+
								'<option name="exiTheEvalu' + exiCounter +'" value="5">5</option>'+
								'</select>'+'</div>');


							newSDDiv.html('<div style="float: left; width: 75px;">'+'<label>SD</label>'+'<br><br>'+'<label title="TODO">0</label>'+'</div>');


							newSelect2Div.html('<div style="float: left; width: 100px;">'+'<label>Impact Monétaire</label>' +'<br>'+
								'<select name="exiTheMoney' + exiCounter +'" title="Accordez une importance monétaire ou 1 est une trés base et 10 est une trés haute" >'+
								'<option name="exiTheMoney' + exiCounter +'" value="1" >1</option>'+
								'<option name="exiTheMoney' + exiCounter +'" value="2" >2</option>'+
								'<option name="exiTheMoney' + exiCounter +'" value="3" >3</option>'+
								'<option name="exiTheMoney' + exiCounter +'" value="4" >4</option>'+
								'<option name="exiTheMoney' + exiCounter +'" value="5" >5</option>'+
								'</select>'+'</div>'+'<br style="clear: left;" /><br style="clear: left;" />');
						}
						else{
							newTextBoxDiv.html('<div style="width: 1000px; hight:800px">'+'<div style="float: left; width: 250px;">'+ 
								'<br>'+'<input type="text" name="exiTheExample' + exiCounter + 
								'" value="'+ selectedValue +'" readonly="true" style="width: 200px;" />' + '</div></div>');

							newDropDownDiv.html('<div style="float: left; width: 150px;">'+'<br>'+
								'<select name="exiTheNature' + exiCounter +'" title="Choisissez la nature pour votre exemple" >'+
								'<option name="exiTheNature' + exiCounter +'" value="Risque">Risque</option>'+
								'<option name="exiTheNature' + exiCounter +'" value="Atout">Atout</option>'+
								'<option name="exiTheNature' + exiCounter +'" value="Opportunité">Opportunité</option>'+
								'</select>'+'</div>');


							newSelect1Div.html('<div style="float: left; cwidth: 150px;">' +'<br>'+
								'<select name="exiTheEvalu' + exiCounter +'" title="Accordez une importance a votre exemple ou 1 est une trés base et 10 est une trés haute" >'+
								'<option name="exiTheEvalu' + exiCounter +'" value="1">1</option>'+
								'<option name="exiTheEvalu' + exiCounter +'" value="2">2</option>'+
								'<option name="exiTheEvalu' + exiCounter +'" value="3">3</option>'+
								'<option name="exiTheEvalu' + exiCounter +'" value="4">4</option>'+
								'<option name="exiTheEvalu' + exiCounter +'" value="5">5</option>'+
								'</select>'+'</div>');


							newSDDiv.html('<div style="float: left; width: 75px;">'+'<br>'+'<label title="TODO">0</label>'+'</div>');


							newSelect2Div.html('<div style="float: left; width: 100px;">'+'<br>'+
								'<select name="exiTheMoney' + exiCouncter +'" title="Accordez une importance monétaire ou 1 est une trés base et 10 est une trés haute" >'+
								'<option name="exiTheMoney' + exiCounter +'" value="1" >1</option>'+
								'<option name="exiTheMoney' + exiCounter +'" value="2" >2</option>'+
								'<option name="exiTheMoney' + exiCounter +'" value="3" >3</option>'+
								'<option name="exiTheMoney' + exiCounter +'" value="4" >4</option>'+
								'<option name="exiTheMoney' + exiCounter +'" value="5" >5</option>'+
								'</select>'+'</div>'+'<br style="clear: left;" /><br style="clear: left;" />');
						}
							// add the HTML elements to DIV of the 4th tab
							newTextBoxDiv.appendTo("#theFirstGroup");
							newDropDownDiv.appendTo("#theFirstGroup")
							newSelect1Div.appendTo("#theFirstGroup");
							newSDDiv.appendTo("#theFirstGroup");
							newSelect2Div.appendTo("#theFirstGroup");
							
							$("#hiddenExistingExamples").val(exiCounter); // populating the hidden field with the counter value
							exiCounter++; // incrementing the counter
							
						});

var getReport = getUrlVars()["reportid"];

if ( getReport != null ){
	$('#new_report').val(getReport);
	document.getElementById("NEW_RE_BTN").click();
}
}

if ( userRole == "Administration" ) {
						$("#selectableadmin").selectable({ // Creates a Selectable List And Allows Only For The Selection of a Single Element.
							selected: function(event, ui) { 
								$(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");
								$( ".ui-selected", this ).each(function() {
								idd=$(this).attr("id");
								$('#select-resultadmin').val(idd); // Set The Report ID in a Hidden Field at The Bottom of The Page
								});
							},
							unselecting: function(event, ui) {
								$('#selectableadmin .ui-selected').removeClass('ui-selected');
								document.getElementById('select-resultadmin').value = null;
							}
						});

						$('#create_report').button().click(function() { // Create The Report Creation Button.
							var organisationName = $('#OrgaName').val(); // Get The Organisation Name From The Drupal PHP Profile2 Fields.
							// Call The Rapport.php to do The Report Creating And Refresh The Page on Finish To Show The New Report.
							AdID=$('#AdminID').val();
							$.post("http://quebio.ca/testing/Jason/php/rapport.php", { orgname: organisationName, adminid: AdID}, function(data) { alert(data); window.location.reload(); window.location.replace("http://quebio.ca/entreprisebio/#tab4");});
						});

						$('#delete_report').button().click(function() { // Create The Report Deletion Button.
							var reportID = document.getElementById('select-resultadmin').value; // Get The Current Selected Report ID From The Hidden Field at The Bottome of The Page.
							var missingFields = "";

							if ( reportID == "" || reportID == null ){ // Make Sure a Valid Report ID is Available.
								missingFields += "No report were selected.\n";
							}
							if ( missingFields=="" ){
								if ( confirm("Are you sure you wish to delete this report?") ) // Prompt For Confirmation Incase of a Miss-click.
									// Call The Rapport.php to do The Report Deletion And Refresh The Page on Finish TO Show The Updated Report List.
								$.post("http://quebio.ca/testing/Jason/php/rapport.php", { reportid: reportID}, function(data) { alert(data); window.location.reload(); window.location.replace("http://quebio.ca/entreprisebio/#tab4");});
							}
							else{
								alert(missingFields); // Alert User Regarding The Missing Report ID.
							}
						});

						$('#view_report').button().click(function() { // Create The View Report Button.

							var reportID = document.getElementById('select-resultadmin').value;
							var adminID = document.getElementById(reportID).value;

							var missingFields = "";

							if ( reportID=="" || reportID==null ){ // Make Sure a Valid Report ID is Available.
								missingFields += "No report were selected.\n";
							}
							if ( missingFields=="" ){
								$.post("http://quebio.ca/testing/Jason/php/getAdminInfo.php", { adminid: adminID, reportid: reportID}, function(data) { 
									document.getElementById('ajax').style.visibility = 'visible';
									var adminInfo = JSON.parse(data);
									$('#barchartFull').highcharts({
										chart: {
											type: 'column',
											marginLeft: 120
										},
										title: {
											text: 'Liste des interdépendances a la biodiversité et aux services écologiques'
										},
										subtitle: {
											text: 'Détaillé'
										},
										xAxis: {
											categories: [
											'Production végétale',
											'Production animale',
											'Produits biotiques marins',
											'Produits biotiques d\'eau douce',
											'Aquaculture',
											'Eau potable',
											'Matières issues de vivant',
											'Matières minérales',
											'Energie renouvelable issue du vivant',
											'Energie non renouvelable issue du  vivant',
											'Energie renouvelable abiotique',
											'Dépollution',
											'Assimilation des déchets',
											'Régulation des flux gazeux',
											'Régulation des flux hydriques',
											'Régulation des phénomènes érosifs',
											'Régulation de la qualité de l\'air',
											'Régulation de la qualité de l\'eau',
											'Régulation de la qualité des sols',
											'Régulation du climat global',
											'Régulation du climat local',
											'Maintenance du cycle de vie et  protection des habitats',
											'Régulation des pathogènes et parasites',
											'Conservation des stocks génétiques',
											'Recherche scientifique',
											'Education',
											'Esthétiques et culturels',
											'Religieux',
											'Récréation',
											'Volontariat'
											],
											labels: {
												rotation: -45,
												align: 'right',
												style: {
													fontSize: '16px',
													fontFamily: 'Verdana, sans-serif'
												}
											}

										},
										yAxis: {
											tickPositions: [0, 0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5],
											min: 0,
											max: 5,
										},
										tooltip: {
											headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
											pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
											'<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
											footerFormat: '</table>',
											shared: true,
											useHTML: true
										},
										plotOptions: {
											column: {
												pointPadding: 0.2,
												borderWidth: 0
											}
										},
										series: [{
											name: 'Dépendances aux SE',
											data: [getValueOrZero(adminInfo.detail.interdependances['1']), getValueOrZero(adminInfo.detail.interdependances['2']), getValueOrZero(adminInfo.detail.interdependances['3']), getValueOrZero(adminInfo.detail.interdependances['4']), 
											getValueOrZero(adminInfo.detail.interdependances['5']), getValueOrZero(adminInfo.detail.interdependances['6']), getValueOrZero(adminInfo.detail.interdependances['7']), getValueOrZero(adminInfo.detail.interdependances['8']),
											getValueOrZero(adminInfo.detail.interdependances['9']), getValueOrZero(adminInfo.detail.interdependances['10']), getValueOrZero(adminInfo.detail.interdependances['11']), getValueOrZero(adminInfo.detail.interdependances['12']),
											getValueOrZero(adminInfo.detail.interdependances['13']), getValueOrZero(adminInfo.detail.interdependances['14']), getValueOrZero(adminInfo.detail.interdependances['15']), getValueOrZero(adminInfo.detail.interdependances['16']),
											getValueOrZero(adminInfo.detail.interdependances['17']), getValueOrZero(adminInfo.detail.interdependances['18']), getValueOrZero(adminInfo.detail.interdependances['19']), getValueOrZero(adminInfo.detail.interdependances['20']),
											getValueOrZero(adminInfo.detail.interdependances['21']), getValueOrZero(adminInfo.detail.interdependances['22']), getValueOrZero(adminInfo.detail.interdependances['23']), getValueOrZero(adminInfo.detail.interdependances['24']),
											getValueOrZero(adminInfo.detail.interdependances['25']), getValueOrZero(adminInfo.detail.interdependances['26']), getValueOrZero(adminInfo.detail.interdependances['27']), getValueOrZero(adminInfo.detail.interdependances['28']),
											getValueOrZero(adminInfo.detail.interdependances['29']), getValueOrZero(adminInfo.detail.interdependances['30'])]

										}, {
											name: 'Transactions monétaires associées',
											data: [getValueOrZero(adminInfo.detail.money['1']), getValueOrZero(adminInfo.detail.money['2']), getValueOrZero(adminInfo.detail.money['3']), getValueOrZero(adminInfo.detail.money['4']), 
											getValueOrZero(adminInfo.detail.money['5']), getValueOrZero(adminInfo.detail.money['6']), getValueOrZero(adminInfo.detail.money['7']), getValueOrZero(adminInfo.detail.money['8']),
											getValueOrZero(adminInfo.detail.money['9']), getValueOrZero(adminInfo.detail.money['10']), getValueOrZero(adminInfo.detail.money['11']), getValueOrZero(adminInfo.detail.money['12']),
											getValueOrZero(adminInfo.detail.money['13']), getValueOrZero(adminInfo.detail.money['14']), getValueOrZero(adminInfo.detail.money['15']), getValueOrZero(adminInfo.detail.money['16']),
											getValueOrZero(adminInfo.detail.money['17']), getValueOrZero(adminInfo.detail.money['18']), getValueOrZero(adminInfo.detail.money['19']), getValueOrZero(adminInfo.detail.money['20']),
											getValueOrZero(adminInfo.detail.money['21']), getValueOrZero(adminInfo.detail.money['22']), getValueOrZero(adminInfo.detail.money['23']), getValueOrZero(adminInfo.detail.money['24']),
											getValueOrZero(adminInfo.detail.money['25']), getValueOrZero(adminInfo.detail.money['26']), getValueOrZero(adminInfo.detail.money['27']), getValueOrZero(adminInfo.detail.money['28']),
											getValueOrZero(adminInfo.detail.money['29']), getValueOrZero(adminInfo.detail.money['30'])]

										}],

										legend: {
											itemStyle: {
												width: 100
											},
										}
									});
$('#barchartSmall').highcharts({
	chart: {
		type: 'column',
		marginLeft: 100
	},
	title: {
		text: 'Liste des interdépendances a la biodiversité et aux services écologiques'
	},
	subtitle: {
		text: 'Agrégé'
	},
	xAxis: {
		categories: [
		'Nourriture et boissons',
		'Matériaux',
		'Energie',
		'Régulation des processus  d’assimilation de déchets',
		'Régulation des  risques naturels',
		'Régulation des conditions biophysiques',
		'Régulation des interactions  biologiques',
		'Informations',
		'Symboles',
		'Expériences'
		],
		labels: {
			rotation: -45,
			align: 'right',
			style: {
				fontSize: '16px',
				fontFamily: 'Verdana, sans-serif'
			}
		}
	},
	yAxis: {
		tickPositions: [0, 0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5],
		min: 0,
		max: 5,
	},
	tooltip: {
		headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
		pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
		'<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
		footerFormat: '</table>',
		shared: true,
		useHTML: true
	},
	plotOptions: {
		column: {
			pointPadding: 0.2,
			borderWidth: 0
		}
	},
	series: [{
		name: 'Dépendances aux SE',
		data: [getValueOrZero(adminInfo.agrege.interdependances['0']), 
		getValueOrZero(adminInfo.agrege.interdependances['1']), 
		getValueOrZero(adminInfo.agrege.interdependances['2']), 
		getValueOrZero(adminInfo.agrege.interdependances['3']), 
		getValueOrZero(adminInfo.agrege.interdependances['4']), 
		getValueOrZero(adminInfo.agrege.interdependances['5']), 
		getValueOrZero(adminInfo.agrege.interdependances['6']), 
		getValueOrZero(adminInfo.agrege.interdependances['7']), 
		getValueOrZero(adminInfo.agrege.interdependances['8']), 
		getValueOrZero(adminInfo.agrege.interdependances['9'])]

	}, {
		name: 'Transactions monétaires associées',
		data: [getValueOrZero(adminInfo.agrege.money['0']), 
		getValueOrZero(adminInfo.agrege.money['1']), 
		getValueOrZero(adminInfo.agrege.money['2']), 
		getValueOrZero(adminInfo.agrege.money['3']), 
		getValueOrZero(adminInfo.agrege.money['4']), 
		getValueOrZero(adminInfo.agrege.money['5']), 
		getValueOrZero(adminInfo.agrege.money['6']), 
		getValueOrZero(adminInfo.agrege.money['7']), 
		getValueOrZero(adminInfo.agrege.money['8']), 
		getValueOrZero(adminInfo.agrege.money['9'])]

	}],

	legend: {
		itemStyle: {
			width: 100
		},
	}
});
$('#spiderchartFull').highcharts({
	chart: {
		polar: true,
		type: 'line',
		marginLeft: 120,
		marginRight: 120
	},
	title: {
		text: 'Liste des interdépendances a la biodiversité et aux services écologiques'
	},
	subtitle: {
		text: 'Détaillé'
	},
	xAxis: {
		categories: [
		'Production végétale',
		'Production animale',
		'Produits biotiques marins',
		'Produits biotiques d\'eau douce',
		'Aquaculture',
		'Eau potable',
		'Matières issues de vivant',
		'Matières minérales',
		'Energie renouvelable issue du vivant',
		'Energie non renouvelable issue du  vivant',
		'Energie renouvelable abiotique',
		'Dépollution',
		'Assimilation des déchets',
		'Régulation des flux gazeux',
		'Régulation des flux hydriques',
		'Régulation des phénomènes érosifs',
		'Régulation de la qualité de l\'air',
		'Régulation de la qualité de l\'eau',
		'Régulation de la qualité des sols',
		'Régulation du climat global',
		'Régulation du climat local',
		'Maintenance du cycle de vie et  protection des habitats',
		'Régulation des pathogènes et parasites',
		'Conservation des stocks génétiques',
		'Recherche scientifique',
		'Education',
		'Esthétiques et culturels',
		'Religieux',
		'Récréation',
		'Volontariat'
		],
		labels: {
			style: {
				fontSize: '16px',
				fontFamily: 'Verdana, sans-serif',
				width: 150
			}
		},
		tickmarkPlacement: 'on',
		lineWidth: 0
	},
	yAxis: {
		tickPositions: [0, 0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5],
		gridLineInterpolation: 'polygon',
		lineWidth: 0,
		min: 0,
		max: 5,
	},
	tooltip: {
		headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
		pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
		'<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
		footerFormat: '</table>',
		shared: true,
		useHTML: true
	},
	plotOptions: {
		column: {
			pointPadding: 0.2,
			borderWidth: 0
		}
	},
	series: [{
		name: 'Dépendances aux SE',
		data: [getValueOrZero(adminInfo.detail.interdependances['1']), getValueOrZero(adminInfo.detail.interdependances['2']), getValueOrZero(adminInfo.detail.interdependances['3']), getValueOrZero(adminInfo.detail.interdependances['4']), 
		getValueOrZero(adminInfo.detail.interdependances['5']), getValueOrZero(adminInfo.detail.interdependances['6']), getValueOrZero(adminInfo.detail.interdependances['7']), getValueOrZero(adminInfo.detail.interdependances['8']),
		getValueOrZero(adminInfo.detail.interdependances['9']), getValueOrZero(adminInfo.detail.interdependances['10']), getValueOrZero(adminInfo.detail.interdependances['11']), getValueOrZero(adminInfo.detail.interdependances['12']),
		getValueOrZero(adminInfo.detail.interdependances['13']), getValueOrZero(adminInfo.detail.interdependances['14']), getValueOrZero(adminInfo.detail.interdependances['15']), getValueOrZero(adminInfo.detail.interdependances['16']),
		getValueOrZero(adminInfo.detail.interdependances['17']), getValueOrZero(adminInfo.detail.interdependances['18']), getValueOrZero(adminInfo.detail.interdependances['19']), getValueOrZero(adminInfo.detail.interdependances['20']),
		getValueOrZero(adminInfo.detail.interdependances['21']), getValueOrZero(adminInfo.detail.interdependances['22']), getValueOrZero(adminInfo.detail.interdependances['23']), getValueOrZero(adminInfo.detail.interdependances['24']),
		getValueOrZero(adminInfo.detail.interdependances['25']), getValueOrZero(adminInfo.detail.interdependances['26']), getValueOrZero(adminInfo.detail.interdependances['27']), getValueOrZero(adminInfo.detail.interdependances['28']),
		getValueOrZero(adminInfo.detail.interdependances['29']), getValueOrZero(adminInfo.detail.interdependances['30'])],
		pointPlacement: 'on'
	}, {
		name: 'Transactions monétaires associées',
		data: [getValueOrZero(adminInfo.detail.money['1']), getValueOrZero(adminInfo.detail.money['2']), getValueOrZero(adminInfo.detail.money['3']), getValueOrZero(adminInfo.detail.money['4']), 
		getValueOrZero(adminInfo.detail.money['5']), getValueOrZero(adminInfo.detail.money['6']), getValueOrZero(adminInfo.detail.money['7']), getValueOrZero(adminInfo.detail.money['8']),
		getValueOrZero(adminInfo.detail.money['9']), getValueOrZero(adminInfo.detail.money['10']), getValueOrZero(adminInfo.detail.money['11']), getValueOrZero(adminInfo.detail.money['12']),
		getValueOrZero(adminInfo.detail.money['13']), getValueOrZero(adminInfo.detail.money['14']), getValueOrZero(adminInfo.detail.money['15']), getValueOrZero(adminInfo.detail.money['16']),
		getValueOrZero(adminInfo.detail.money['17']), getValueOrZero(adminInfo.detail.money['18']), getValueOrZero(adminInfo.detail.money['19']), getValueOrZero(adminInfo.detail.money['20']),
		getValueOrZero(adminInfo.detail.money['21']), getValueOrZero(adminInfo.detail.money['22']), getValueOrZero(adminInfo.detail.money['23']), getValueOrZero(adminInfo.detail.money['24']),
		getValueOrZero(adminInfo.detail.money['25']), getValueOrZero(adminInfo.detail.money['26']), getValueOrZero(adminInfo.detail.money['27']), getValueOrZero(adminInfo.detail.money['28']),
		getValueOrZero(adminInfo.detail.money['29']), getValueOrZero(adminInfo.detail.money['30'])],
		pointPlacement: 'on'
	}],

	legend: {
		itemStyle: {
			width: 100
		},
	}
});
$('#spiderchartSmall').highcharts({
	chart: {
		polar: true,
		type: 'line',
		marginLeft: 120,
		marginRight: 120
	},
	title: {
		text: 'Liste des interdépendances a la biodiversité et aux services écologiques'
	},
	subtitle: {
		text: 'Agrégé'
	},
	xAxis: {
		categories: [
		'Nourriture et boissons',
		'Matériaux',
		'Energie',
		'Régulation des processus  d’assimilation de déchets',
		'Régulation des  risques naturels',
		'Régulation des conditions biophysiques',
		'Régulation des interactions  biologiques',
		'Informations',
		'Symboles',
		'Expériences'
		],
		labels: {
			style: {
				fontSize: '16px',
				fontFamily: 'Verdana, sans-serif',
				width: 150
			}
		}
	},
	yAxis: {
		tickPositions: [0, 0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5],
		min: 0,
		max: 5,
	},
	tooltip: {
		headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
		pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
		'<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
		footerFormat: '</table>',
		shared: true,
		useHTML: true
	},
	plotOptions: {
		column: {
			pointPadding: 0.2,
			borderWidth: 0
		}
	},
	series: [{
		name: 'Dépendances aux SE',
		data: [getValueOrZero(adminInfo.agrege.interdependances['0']), 
		getValueOrZero(adminInfo.agrege.interdependances['1']), 
		getValueOrZero(adminInfo.agrege.interdependances['2']), 
		getValueOrZero(adminInfo.agrege.interdependances['3']), 
		getValueOrZero(adminInfo.agrege.interdependances['4']), 
		getValueOrZero(adminInfo.agrege.interdependances['5']), 
		getValueOrZero(adminInfo.agrege.interdependances['6']), 
		getValueOrZero(adminInfo.agrege.interdependances['7']), 
		getValueOrZero(adminInfo.agrege.interdependances['8']), 
		getValueOrZero(adminInfo.agrege.interdependances['9'])],
		pointPlacement: 'on'
	}, {
		name: 'Transactions monétaires associées',
		data: [getValueOrZero(adminInfo.agrege.money['0']), 
		getValueOrZero(adminInfo.agrege.money['1']), 
		getValueOrZero(adminInfo.agrege.money['2']), 
		getValueOrZero(adminInfo.agrege.money['3']), 
		getValueOrZero(adminInfo.agrege.money['4']), 
		getValueOrZero(adminInfo.agrege.money['5']), 
		getValueOrZero(adminInfo.agrege.money['6']), 
		getValueOrZero(adminInfo.agrege.money['7']), 
		getValueOrZero(adminInfo.agrege.money['8']), 
		getValueOrZero(adminInfo.agrege.money['9'])],
		pointPlacement: 'on'
	}],

	legend: {
		itemStyle: {
			width: 100
		},
	}
});

									// Get The Highcharts From The Hidden Containers at The Bottom of The Page.
									var chartBF = $('#barchartFull').highcharts(); 
									var chartBS = $('#barchartSmall').highcharts();
									var chartSF = $('#spiderchartFull').highcharts(); 
									var chartSS = $('#spiderchartSmall').highcharts();
								   	// Get The SVG For The Charts.
								   	var svgBF = chartBF.getSVG();
								   	var svgBS = chartBS.getSVG();
								   	var svgSF = chartSF.getSVG();
								   	var svgSS = chartSS.getSVG();

								    var data = ({chartBF: svgBF, chartBS: svgBS, chartSF: svgSF, chartSS: svgSS}) // Create An Array For The SVG to be Passed.
								    // Ajax Call to Create a .PNG of The SVG on The Server to be Able to load it With TCPDF.
								    $.ajax({
								    	type: 'POST',
								    	data: data,
								    	url: 'http://quebio.ca/testing/Jason/php/hcexport.php',
								    	async: false,
								    	success: function(data){
								     	$.post("http://quebio.ca/testing/Jason/php/report.php", { reportInfo: adminInfo}, function(data) { document.getElementById('ajax').style.visibility = 'hidden'; window.location.replace("http://quebio.ca/testing/Jason/php/rapport.pdf")}); // After Successfully Creating The .PNG Send The User To The PDF Generation Script.
								     }
								 });
								});
}
else{
								alert(missingFields); // Alert User Regarding The Missing Report ID.
							}
						});

						$('#viewable_report').button().click(function() { // Create View Switching Button.
							var reportID = document.getElementById('select-resultadmin').value;
							var missingFields = "";

							if ( reportID=="" || reportID=="" ){ // Make Sure a Valid Report ID is Available.
								missingFields += "No report were selected.\n";
							}
							if ( missingFields=="" ){
								// Call The Rapport.php to Invert The Current View Of The Selected Report (Admin Only or All Users).
								$.post("http://quebio.ca/testing/Jason/php/rapport.php", { reportid: reportID, viewable: 1}, function(data) { alert(data); window.location.reload(); window.location.replace("http://quebio.ca/entreprisebio/#tab4")});
							}
							else{
								alert(missingFields); // Alert User Regarding The Missing Report ID.
							}
						});
						$('#submit_email').button().click(function() {
							var emailRecipient = document.getElementById('recipient').value; // Get E-Mails.
							var information = document.getElementById('information').value; // Get Extra Details to Append to The Emails.
							var reportID = document.getElementById('select-resultadmin').value; // Get Report ID to Link to.
							var organisationName = $('#OrgaName').val(); // Get The Organisation Name From The Drupal PHP Profile2 Fields.
							var missingFields = "";

							if ( emailRecipient=="" || emailRecipient==null){ // Make Sure a E-mail Was Entered (Let Drupal_mail() see if it's valid of not).
								missingFields += "E-mail field is empty.\n";
						}
							if ( reportID=="" || reportID=="" ){ // Make Sure a Valid Report ID is Available.
								missingFields += "No report were selected.\n";
							}
							if ( missingFields=="" ){
								// Call The Email.php to Send Out The E-mail Invitations Including all The Information We Appended.
								$.post("http://quebio.ca/testing/Jason/php/email.php", {reportID: reportID, information: information, orgname: organisationName, toEmail: emailRecipient}, function(data) { alert(data); });
							}
							else{
								alert(missingFields);// Alert User Regarding The Missing Report ID or E-mail Addresses.
							}
						});
}
});
})(jQuery); 