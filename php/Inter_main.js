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
        			$('#externeInput').addClass("hide");
        			$('#moneyinput').addClass("hide");
        			$("#selectNature").addClass("hide");
        			$("#selectNatureTwo").addClass("hide");

        			$("input:radio[name=moneyType]").click(function() {  //check if autre option was selected
    					var value = $(this).val();
    					if(value == "")  //if so, show the text box (note the autre option does not have any value) 
    					{
    						$('#moneyinput').removeClass("hide");
    						$('#moneyinput').addClass("show");
    					}
    					else  //or else hide it
    					{
    						$('#moneyinput').addClass("hide");
    						$('#moneyinput').val("");
    					}
					});

					$("input:radio[name=money]").click(function() {  //check if the user selected yes
						var value = $(this).val();
						if(value == "Oui")   //if so, enable the radio buttons
						{
							$("input:radio[name=moneyType]").removeAttr( "disabled" );
							$("#moneyinput").removeAttr( "disabled" );
						}
						if(value == "Non")
						{
							$("input:radio[name=moneyType]").attr('disabled',true);
							$('input[name=moneyType]:checked').prop('checked', false);
							$("#moneyinput").val("");
							$('#moneyinput').addClass("hide");
							$("#typeOfMoney").val("");
						}
					});

					$("input:radio[name=externe]").click(function() {  //check if autre option was selected
    					var value = $(this).val();
    					if(value == "")  //if so, show the text box(note the autre option does not have any value) 
    					{
    						$('#externeInput').removeClass("hide");
    						$('#externeInput').addClass("show");
    					}
    					else  //or else hide it
    					{
    						$('#externeInput').addClass("hide");
    						$('#externeInput').val("");
    					}
					});

					$("input:radio[name=niveau]").click(function() {  //check if the user selected externe in the parameter tab
						var value = $(this).val();
						if (value == "Externe")
						{
							$("input:radio[name=externe]").removeAttr( "disabled" );
							$("#externeInput").removeAttr( "disabled" );
						}
						if(value != "Externe")
						{
							$("input:radio[name=externe]").attr('disabled',true);
							$('input[name=externe]:checked').prop('checked', false);
							$("#externeInput").val("");
							$('#externeInput').addClass("hide");
						}
					});

    				$( "#tabs-2" ).tabs(//the tab that displays mroe info on the first page
    				{
     				 	collapsible: true,
     				 	selected: -1  //collapse the "en savoir plus" tab by default
    				});

    				$( "#tabs-3" ).tabs(//the tab that displays mroe info
    				{
     					collapsible: true,
     					selected: -1  //collapse the "en savoir plus" tab by default
    				});

    				$( "#tabs-4" ).tabs(//the tab that displays mroe info on the questions page
    				{
     					collapsible: true,
     					selected: -1  //collapse the "en savoir plus" tab by default
    				}); 

        			$( ".ui-selected" ).selectable({ tolerance: "fit" });  //fixes the issue with the click event not firing from time to time

        			$('.infoDivs').hide();  //hide all the information blocks on the ecological services

        			$(".ui-state-default").hover(function(){  //display the info of the currently selected ecological service and hide all other info divs
							var id=$(this).attr('id'); //get the id of the highlighted selectable
							$('[id^=infoDiv]').hide();
							$('#infoDiv'+id).show();
					})

        			$('.infoClassDivs').hide();  //hide all the information blocks on the classifications


        			$('.classExampleDivs').hide();  //hide all the examples of the classifications

        			$(".ui-state-default").hover(function(){  //display the info of the currently selected classification and hide all other info divs
							$(this).addClass('ui-selecting');
							var id=$(this).attr('id');
							
							$('[id^=infoClassDiv]').hide();
							$('#infoClassDiv'+id).show();

							$('[id^=classExampleDiv]').hide();
							$('#classExampleDiv'+id).show();

						})

					$('.ui-state-default').mouseleave(function(){  //hide the current classification divs(descriptions and examples)
							var id=$(this).attr('id');
							$('#infoClassDiv'+id).hide();
							$('#classExampleDiv'+id).hide();
							
					})
					

					$('.ui-state-default').mouseleave(function(){  //hide the current ecological service descriptions
							var id=$(this).attr('id');
							$('#infoDiv'+id).hide();
							$(this).removeClass('ui-selecting');
					})

					$(".ui-state-default").hover(function(){  //display the info for the highlighted nature of the interdependency
        				var id=$(this).attr('id');
        				$('[id^=inter]').hide();
						$('#inter'+id).show();
        			})

        			$('.ui-state-default').mouseleave(function(){  //hide the current classification divs(descriptions and examples)
							var id=$(this).attr('id');
							$('#inter'+id).hide();
					})

					$('.OptionDivs').hide();  //hide all the rankings of the interdependence slider
					$('#displayOption1').show();  //show the first inital ranking of the interdependance slider
					
					$('.ImpactDivs').hide(); 
					$('#displayImpact1').show();

					var userRole = jQuery('#userRole').val();
        			if ( userRole == "Unauthenticated" ){
        				var elem = document.getElementById('tab5');  //2
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('userview');
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('tab6');  //3
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('servicetab');
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('tab7');  //4
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('classificationtab');
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('tab8');  //5
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('entreprisetab');
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('tab9'); //6
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('naturetab');
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('tab10'); //7
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('risktab');
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('tab11'); //8
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('dependencetab');
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('tab12'); //9
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('impacttab');
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('tab13'); //10
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('moneytab');
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('tab14'); //11
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('parametertab');
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('tab15'); //12
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('qualifytab');
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('tab16'); //13
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('sendData');
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('tab17'); //14
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('viewOpinions');
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('tab18'); //15
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('adminOpinion');
        				elem.parentNode.removeChild(elem);
						$('#tabs').tabs(); // Generate Tabs With The Default Settings.
					}
					if ( userRole == "Unauthenticated" || userRole == "Participant" ){
						var elem = document.getElementById('tab4');
						elem.parentNode.removeChild(elem);
						var elem = document.getElementById('admintools');
						elem.parentNode.removeChild(elem);
						var elem = document.getElementById('tab14');
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('parametertab');
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('tab17'); 
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('viewOpinions');
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('tab18'); 
        				elem.parentNode.removeChild(elem);
        				var elem = document.getElementById('adminOpinion');
        				elem.parentNode.removeChild(elem);
					}
					if ( userRole != "Unauthenticated" ){  //removes the following tab(s) 
						var elem = document.getElementById('tab3');
						elem.parentNode.removeChild(elem);
						var elem = document.getElementById('login');
						elem.parentNode.removeChild(elem);
						$('#servicetab').hide();
						$('#classificationtab').hide();
						$('#naturetab').hide();
						$('#dependencetab').hide();
						$('#moneytab').hide();
						$('#impacttab').hide();
						$('#risktab').hide();
						$('#parametertab').hide();
						$('#qualifytab').hide();
						$('#sendData').hide();

						if ( userRole == "Administration" ){
							var disableTabs = [5,6,7];
							var compensateTab = 1;
						}
						else {
							var disableTabs = [3,4,5];
							var compensateTab = 0;
						}
						$('#tabs').tabs({disabled: disableTabs}); // Generate Tabs With The Default Settings.
					
						var se_item; // keeping track of selected service ecologic
						var c_item; // keeing track of selected classification
						var c_example;//gets the id of the selected example
						var i_item; //gets the id of the selected interdependency
						var i2_item;//gets the id of the selected impact
						var n_item;  //gets the id of the selected nature of the risk
						var examplesCounter;  //number of examples submitted by the user
						var newCounter = 1; // counter for the new HTML element
						var exiCounter = 1; // counter for the existing HTML elements
						var report_id;
						var valid_input;
						if(userRole	== "Participant" || userRole== "Unauthenticated")  //there should be one less tab for participant
							var tabCounter = 2; //keeps track of which tab we're at
						if(userRole == "Administration")
							var tabCounter = 3; //keeps track of which tab we're at

						$('.lists').hide(); // hiding all the divs corresponding to different classification selectable lists
							
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

							$(".selectable_c").selectable({  //make the classification selectable
								selected: function(event, ui) { 
									$(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");
									var result = $( "#select-result" ).empty();
									$( ".ui-selected", this ).each(function() {
										c_item = $(this).attr("id"); // getting the id of selected classification
									}); 
								}
								
							});

							$(".select_example").selectable({  //make the examples selectable
								selected: function(event, ui) { 
									$(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");
									var result = $( "#select-result" ).empty();
									$( ".ui-selected", this ).each(function() {
										c_example = $(this).attr("id"); // getting the id of selected example
						}); 
								}
							});
			
						$(".selectable_i").selectable({  //make the dependent interdependencies selectable
								selected: function(event, ui) { 
									$(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");
									var result = $( "#select-result" ).empty();
									$( ".ui-selected", this ).each(function() {
										i_item = $(this).attr("id"); // getting the id of selected dependent interdependency
									}); 
								}	
						});

						$(".selectable_i2").selectable({  //make the impact interdependencies selectable
								selected: function(event, ui) { 
									$(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");
									var result = $( "#select-result" ).empty();
									$( ".ui-selected", this ).each(function() {
										i2_item = $(this).attr("id"); // getting the id of selected impact interdependency
									}); 
								}	
						});

						$(".selectable_n").selectable({  //make the nature of the risk/opuurtunity selectable
								selected: function(event, ui) { 
									$(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");
									var result = $( "#select-result" ).empty();
									$( ".ui-selected", this ).each(function() {
										n_item = $(this).attr("id"); // getting the id of selected slectable
									}); 
								}	
						});

						$(".selectable_n2").selectable({  //make the nature of the risk/opuurtunity selectable
								selected: function(event, ui) { 
									$(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");
									var result = $( "#select-result" ).empty();
									$( ".ui-selected", this ).each(function() {
										n2_item = $(this).attr("id"); // getting the id of selected slectable
									}); 
								}	
						});


		function resetEverything()
		{
			$('#newExample').val(""); //clear the text from the example textbox
			
			$('#selectable'+' .ui-selected').removeClass('ui-selected'); //unselects the chosen selectable
			se_item=0;  //resets the value

			$('.selectable_c'+' .ui-selected').removeClass('ui-selected'); //unselects the chosen selectable
			c_item=0;  //resets the value

			$('.select_example'+' .ui-selected').removeClass('ui-selected'); //unselects the chosen selectable
			c_example=0;  //resets the value

			$('.selectable_i'+' .ui-selected').removeClass('ui-selected'); //unselects the chosen selectable
			i_item=0;  //resets the value

			$('.selectable_i2'+' .ui-selected').removeClass('ui-selected'); //unselects the chosen selectable
			i2_item=0;  //resets the value
			
			$('.selectable_n'+' .ui-selected').removeClass('ui-selected'); //unselects the chosen selectable
			n_item=0;  //resets the value

			$('.selectable_n2'+' .ui-selected').removeClass('ui-selected'); //unselects the chosen selectable
			n2_item=0;  //resets the value
			
			$("#slider").slider('value', 1);  //set the value back to default for the slider
			$( "#slides" ).val('1'); //set the value back to default for the dropdown 
			$('.OptionDivs').hide();  //hide all the rankings of the interdependence slider
			$('#displayOption1').show();  //show the first inital ranking of the interdependance slider

			$("#impactSlider").slider('value', -5);  //set the value back to default for the slider
			$( "#impact" ).val('-5'); //set the value back to default for the dropdown 
			$('.ImpactDivs').hide();
			$('#displayImpact1').show();

			$('input[name=moneyType]:checked').prop('checked', false);  //uncheck the selected radio buton
			$('input[name=money]:checked').prop('checked', false);  //uncheck the selected radio buton
			$("#moneyinput").val("");  //clear the text
			$("#moneyinput").removeClass("show");
			$("#moneyinput").addClass("hide");

			$('input[name=NegOrPos]:checked').prop('checked', false);  //uncheck the selected radio buton

			$("#typeOfMoney").val("");
			$("#c_i").val("");
			$("#chosenExample").val("");
			$("#inter").val("");
			$("#inter2").val("");
			$("#riskOrOpp").val("");
			$("#riskOrOpp2").val("");
			$("#interdependance").val("");
			$("#hiddenImpact").val("");
			$("#gotMoney").val("");
			$("#qualifyImpact").val("");
			$("niveauDependance").val("");
			$("niveauImpact").val("");
		}


		function goToNextTab()  //this counter will allow us to navigate forward through the tabs, starting at tab 3(reports list)
		{
			tabCounter++;  //increment to the current tab
			$( "#tabs" ).tabs('enable', tabCounter).tabs('select', tabCounter); // go to the next tab and disable the 2rd one
			tabCounter--;  //decrememnt to last tab
			$( "#tabs" ).tabs( 'disable',tabCounter );
			tabCounter++;  //incrememnt back to current tab
		}

		function goToPrevTab()  //this counter will allow us to navigate backward through the tabs, starting at tab 3(reports list)
		{
			tabCounter--;  //decrememnt to current tab
			$( "#tabs" ).tabs('enable', tabCounter).tabs('select', tabCounter); // go to the next tab and disable the 2rd one
			tabCounter++;  //incrememnt to last tab
			$( "#tabs" ).tabs( 'disable',tabCounter );
			tabCounter--;  //decrement back to current tab
		}

//WHEN ONE OF THESE BUTTONS ARE CLICKED, THEY SHOW THE OPINIONS TABLE RELATED TO THE SELECTED REPORT
$("[id^=show]").button().click(function(){
	var id = $(this).attr('id');  //get the id of the button
	var choppedID = id.substring(4); //get the id of the table
	$('[id^=opinions').hide();  //hide all the tables
	$('#opinions'+choppedID).show();  //show the selected table
	$('#report_selected').val($('#'+id).val());  //keep track of the current report selected
})

$("#delete_opinions").button().click(function(){
	
	totalOpinions = $('#numOfOpinions').val();
	checkedboxes = [];
	looper = 0;  //keeps track of the position in the array checkedboxes
	for (var loop = 0; loop < totalOpinions; loop++) {  //gets all the values(row ids in the table) from the checked checkboxes in order to delete the data
		if($('input[name=chk_box_delete_'+loop+']:checked').val())  //is the delete checkbox checked?
		{
			checkedboxes[looper] = $('input[name=chk_box_delete_'+loop+']').val();  //get the row id(the value)
			looper++;
		}
	};

	adminID = $('#AdminID').val();
	reportID = $('#report_selected').val();
	$.post("http://quebio.ca/testing/Jason/php/delete_opinions.php", {adminid: adminID, reportid: reportID, chkdbxs : checkedboxes}, function(data) {})
})

$("#insert_adminOp").button().click(function(){  //check if this works and use the hidden fields which contain the examples!
	
	totalChangedOps = $('#numOfOps').val();
	filledTxts = [];
	adminOpinions = [];
	report_ids = [];
	potAvgs = [];
	var loop = 0;

	for (var i = 0; i < totalChangedOps; i++) {  //prepare to send over the examples and opinions, report ids and whether its potential or average
		if ($("#adminFinalOpinion"+i).val()){
			adminOpinions[loop] = $("#adminFinalOpinion"+i).val();
			filledTxts[loop] = $("#unique_example"+i).val();		
			report_ids[loop] = $("#report_id"+i).val();
			potAvgs[loop] = $("#potentialAvg"+i).val();
			loop++;
		}
	};
	adminID = $('#AdminID').val();
	reportID = $('#report_selected').val();
	$.post("http://quebio.ca/testing/Jason/php/admin_opinions.php", {adminid: adminID, reportid: reportID, examples: filledTxts, adminFinalOpinions: adminOpinions, reportIds: report_ids, potavgs: potAvgs}, function(data) {alert(data);})
})

$("[id^=showReport]").button().click(function(){
	var id = $(this).attr('id');  //get the id of the button
	var choppedID = id.substring(10); //get the id of the table
	$('[id^=adminOps').hide();  //hide all the tables
	$('#adminOps'+choppedID).show();  //show the selected table
	$('#modify_report').val($('#'+id).val());  //keep track of the current report selected
})

$('#RE_BTN_NEXT').button().click(function() { // NEXT button on the 1st tab

	if(report_id){

		resetEverything();

		$("#the_report").val(report_id);

		if((userRole == "Participant" || userRole== "Unauthenticated") && tabCounter > 2)  //Is the user visiting this tab again?If so, then reset the counter
		{
			tabCounter=2;
			$('#tabs').tabs('disable', 5);  //disable the examples tab
		}
		if(userRole == "Administration" && tabCounter > 4)
		{
			tabCounter=4;
			$('#tabs').tabs('disable', 7);  //disable the examples tab
		}
		goToNextTab();
		$('#tabs').tabs('enable', tabCounter-1);  //leave the current tab(reports) enabled
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
									
									if(userRole == "Participant" || userRole== "Unauthenticated")  //Is the user visiting this tab again?If so, then reset the counter
										if (tabCounter > 2)
										{
											tabCounter=2;
											$('#tabs').tabs('disable', 5);  //disable the examples tab
										}
									if(userRole == "Administration")
										if(tabCounter > 4)
										{
											tabCounter=4;
											$('#tabs').tabs('disable', 7);  //disable the examples tab
										}

								goToNextTab();
								$('#tabs').tabs('enable', tabCounter-1);  //leave this tab enabled

								}
								else{
									report_id = null;
									alert(theValid+" Mauvais numéro de rapport! Entre un nouveau");
									$("#new_report").focus();
								}
							}

						});


						$('#SE_BTN_BACK').button().click(function() {  //Back button on the ecological services
							
							goToPrevTab();  //disable tab 3, enable and select tab 2
							
						});
						
						$('#SE_BTN_NEXT').button().click(function() { // NEXT button on the ecological services tab
							
							$('.lists').hide();// hiding all of the seletables
							if(se_item){ // than only showing the one which conrresponds to the selected sevive ecologic
							 	$('#list'+se_item).show();
								$("#se_i").val(se_item);
								$("#se_name").val($("#"+se_item).text());
								goToNextTab();
							}
							else{
								alert("Aucune valeur n'a été sélectionnée"); //else give an error
							}
						});

$('#TAB9_BTN_NEXT').button().click(function() 
{
	if(c_example && $('#newExample').val() != '' )  //did the user try to enter a new example AND select an existing example?
	{
		alert("SVP creer une nouvelle example ou choissisez une do ses examples!");
		$('#selectable'+c_item+' .ui-selected').removeClass('ui-selected'); //unselects the chosen example
		c_example = 0;  //0 means that there are no examples selected
		$('#newExample').val(""); //clear the text from the example textbox
	}
	else
	{
			if(userRole == "Participant" || userRole== "Unauthenticated")  //Is the user visiting this tab again?If so, then reset the counter
				if (tabCounter > 5)
					tabCounter=5;
			if(userRole == "Administration")
				if(tabCounter > 7)
					tabCounter=7;

		if(c_example)  //was one of the examples selected 
		{
			goToNextTab();
			$("#chosenExample").val($("#"+c_example).text());  //get the example for the database
		}
		else if( $('#newExample').val() != '')  //was the testbox used?
		{
			goToNextTab();
			$("#chosenExample").val($('#newExample').val());  //get the example for the database
		}
		else  //were there no examples given?
		{
			alert("Vous devez choisir une de ses examples ou creer un nouveau example(rien n'etez choisi)!");
		}

		$('#tabs').tabs('enable', tabCounter-1);  //enable this tab for the rest of the evaluation
	}

	$(".se_label").text("Service écologique: " + $("#se_i").val());  //show which ecological service the user chose

	$(".c_label").text("Classification: " + $("#c_i_val").val());  //show which classification the user chose

	$(".example_label").text("Example: " + $("#chosenExample").val());  //show which example the user chose
	
	$('.selectable_n'+' .ui-selected').removeClass('ui-selected'); //unselects the chosen selectable
	n_item=0;  //resets the value

	$('.selectable_n2'+' .ui-selected').removeClass('ui-selected'); //unselects the chosen selectable
	n2_item=0;  //resets the value
	
	$("#slider").slider('value', 1);  //set the value back to default for the slider
	$( "#slides" ).val('1'); //set the value back to default for the dropdown 
	$('.OptionDivs').hide();  //hide all the rankings of the interdependence slider
	$('#displayOption1').show();  //show the first inital ranking of the interdependance slider

	$("#impactSlider").slider('value', -5);  //set the value back to default for the slider
	$( "#impact" ).val('-5'); //set the value back to default for the dropdown 
	$('.ImpactDivs').hide();
	$('#displayImpact1').show();

	$('input[name=NegOrPos]:checked').prop('checked', false);  //uncheck the selected radio buton

});
$('#TAB9_BTN_BACK').button().click(function() 
{
	$("#inter").val("");
	$("inter2").val("");

	$('.selectable_i'+' .ui-selected').removeClass('ui-selected'); //unselects the chosen selectable
	i_item = 0; 
	$('.selectable_i2'+' .ui-selected').removeClass('ui-selected'); //unselects the chosen selectable
	i2_item = 0; 
	goToPrevTab();
});

$('#TAB10_BTN_NEXT').button().click(function() {
	$('#dep_txt').val("");
	$('#impact_txt').val("");
	if(i_item || i2_item) //was one of the interdependencies selected?
	{
		if(i_item && !i2_item)  //was dependance the only option chosen?
			tabCounter++;	
		
		if(i_item && i2_item)  //were both impact and dependancy chosen
			tabCounter++;
		
		goToNextTab();
		
		$("#inter2").val($("#"+i2_item).text());
		$("#inter").val($("#"+i_item).text());
	}
	else  //tell the user to enter a choice
	{
		alert("SVP choissisez une de ses choix!");
	}

	if($("#inter").val())
	{
		$(".dependance_label").text("Dépendance: La nature de l’interdépendance est " + $("#inter").val());  //show which interdependancy(dependance) the user chose
	}

	if($("#inter2").val())
	{
		$(".impact_label").text("Impact: La nature de l’interdépendance est " + $("#inter2").val());  //show which interdependancy(impact) the user chose
	}
	
});

$('#TAB10_BTN_BACK').button().click(function() 
{		
	$("qualifyImpact").val("");
	$('input[name=NegOrPos]:checked').prop('checked', false);  //uncheck the selected radio buton
	goToPrevTab();
});

$('#TAB11_BTN_NEXT').button().click(function() {

	if($('input[name=NegOrPos]:checked').val())  //was one of the values selected?
	{
		$("#qualifyImpact").val($('input[name=NegOrPos]:checked').val());  //store the selected value, to be used for database

		if(i_item && i2_item)  //did the user select a risk and/or oppurtunity, an impact and a dependence?
		{
	 	 	//go to the dependence tab
			goToNextTab();
		}
		else if (i_item && !i2_item)  //did the user only select a dependency and not an impact?
		{
			//go directly to the financial tab
			tabCounter+=3;  //go to tab 12(financial tab)
			$('#tabs').tabs('enable', tabCounter).tabs('select', tabCounter);
		}
		else
		{
					tabCounter++;
					goToNextTab();
		}
	}
	else
	alert("S'il vous plaît sélectionnez une des options disponibles");	
});

$('#TAB11_BTN_BACK').button().click(function() {
	$('#dep_txt').val("");
	$("#interdependancePotential").val("");
	$("#interdependance").val("");
	$("#interdependanceAverage").val("");
	$("#niveauDependance").val("");
	$("#slider").slider('value', 1);  //set the value back to default for the slider
	$( "#slides" ).val('1'); //set the value back to default for the dropdown 
	$('.OptionDivs').hide();  //hide all the rankings of the interdependence slider
	$('#displayOption1').show();  //show the first inital ranking of the interdependance slider
	tabCounter--;  //skip the tab before the current tab, since it's only meant to be accessed when the user only chose an impact in the interdependancy tab 
	goToPrevTab();
});

$('#C_BTN_BACK').button().click(function() {
	goToPrevTab();
});

$('#C_BTN_NEXT').button().click(function() { 
	if(c_item){
		$("#c_i").val(c_item);
		$("#c_i_val").val(($("#"+c_item).text()));
		
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
								
								goToNextTab();

								$('.selectExamples').hide(); //hide all the examples
								$('#example'+c_item).show();  //show the corresponding examples

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

$('#BTN_RE_SE').button().click(function() // retour to services ecologique
{ 
	resetEverything();
	event.preventDefault();
	removeHTMLElements();

	if(userRole	== "Participant" || userRole== "Unauthenticated") 
	{	
		tabCounter=2; //reset the counter
		$('#tabs').tabs('disable', 5);  //disable the examples tab
	}
	if(userRole == "Administration")
	{
		tabCounter=4; //reset the counter
		$('#tabs').tabs('disable', 7);  //disable the examples tab
	}
	
	goToNextTab();

	if(userRole	== "Participant"  || userRole== "Unauthenticated") 
		$('#tabs').tabs('enable', 2);  //keep this tab enabled
	if(userRole == "Administration")
		$('#tabs').tabs('enable', 4);  //keep this tab enabled
});

$('#submit').button().click(function() {  //submit to the database
	examplesCounter++;
	$("#numOfExamples").val(examplesCounter.val());
}); 

$('#LAST_BTN_BACK').button().click(function() { // on the last tab when the back button, it's removing all the HTML elements 
	
		if(userRole == "Participant" || userRole== "Unauthenticated")  //Is the user visiting this tab again?If so, then reset the counter
				tabCounter=5;
		if(userRole == "Administration")
				tabCounter=7;

	$('#selectable'+c_item+' .ui-selected').removeClass('ui-selected'); //unselects the chosen example
	c_example = 0;  //0 means that there are no examples selected

	$('#newExample').val(""); //clear the text from the example textbox

	event.preventDefault(); // preventing from doing a post back when the button is clicked

	$("c_i").val("");
	$("chosenExample").val("");


	goToPrevTab();

	removeHTMLElements(); // remove all HTML elements
							
});

$('#impact_btn_next').button().click(function() { 
	$('#impact_txt').val("");

	if(!i2_item && i_item)  //do we go to the impact tab?
		tabCounter++;
	goToNextTab();

	if($("#inter").val() == "Une dépendance avérée")
	{	
		$("#interdependanceAverage").val($( "#slides option:selected" ).text());  //inserts the chosen value into a hidden field
	}

	if($("#inter").val() == "Une dépendance potentielle")
	{	
		$("#interdependancePotential").val($( "#slides option:selected" ).text());  //inserts the chosen value into a hidden field
	}

	$("#niveauDependance").val($( "#slides option:selected" ).text());  
});	

$('#back_to_money').button().click(function() {
	$('#impact_txt').val("");
	$("#hiddenImpact").val("");
	$("#hiddenImpactAverage").val("");
	$("#hiddenImpactPotential").val("");
	$("#impactSlider").slider('value', -5);  //set the value back to default for the slider
	$( "#impact" ).val('-5'); //set the value back to default for the dropdown 
	$('.ImpactDivs').hide();
	$('#displayImpact1').show();
	$("niveauImpact").val("");
	if(!i_item)  //do we skip the dependence tab when going back?
		tabCounter--;
	goToPrevTab();
});

$('#after_impact_btn').button().click(function() { 
	goToNextTab();
	
	if($("#inter2").val() == "Un impact avéré")
	{	
		$("#hiddenImpactAverage").val($( "#impact option:selected" ).text());  //inserts the chosen value into a hidden field
	}
	if($("#inter2").val() == "Un impact potentiel")
	{	
		$("#hiddenImpactPotential").val($( "#impact option:selected" ).text());  //inserts the chosen value into a hidden field
	}

	$("#niveauImpact").val($( "#impact option:selected" ).text());
});

$('#back_to_impact_btn').button().click(function() { //financial back button

	$("input:radio[name=moneyType]").attr('disabled',true);
	$('input[name=moneyType]:checked').prop('checked', false);
	$('input[name=money]:checked').prop('checked', false);
	$("#moneyinput").val("");
	$('#moneyinput').addClass("hide");
	$("#typeOfMoney").val("");

	if(!i2_item)  //do we go back to the interdependancy tab, skipping the impact tab
		tabCounter--;
	goToPrevTab();
});

$('#MONEY_NEXT_BTN').button().click(function() { //financial next button
	if($('input[name=money]:checked').val()) //were all the questions answered?
	{
		$("#gotMoney").val($('input[name=money]:checked').val());  //insert 
		$("#typeOfMoney").val($('input[name=moneyType]:checked').val());
		if($("#moneyinput").val())  //does the textbox have text?
		{
			$("#typeOfMoney").val($("#moneyinput").val());
		}

		if($("#inter").val())  //did the user select dependant in the interdependance tab, if so, show the selection menu 
		{
			$("#selectNature").removeClass("hide");
			$("#selectNature").addClass("show");
		}
		else  //hide the dependant related selection menu
		{
			$("#selectNature").removeClass("show");
			$("#selectNature").addClass("hide");
		}

		if($("#inter2").val())  //did the user select impact in the interdependance tab , if so, show the selection menu
		{
			$("#selectNatureTwo").removeClass("hide");
			$("#selectNatureTwo").addClass("show");
		}
		else  //hide the impact related selection menu
		{
			$("#selectNatureTwo").removeClass("show");
			$("#selectNatureTwo").addClass("hide");
		}

		goToNextTab();
	}
	else
		alert("S'il vous plaît sélectionnez une des options disponibles!");
});

$('#TAB14_BTN_BACK').button().click(function() {
	$('input[name=niveau]:checked').prop('checked', false);
	$("input:radio[name=externe]").attr('disabled',true);
	$('input[name=externe]:checked').prop('checked', false);
	$("#externeInput").val("");
	$('#externeInput').addClass("hide");
	goToPrevTab();
	tabCounter++;
});

$('#TAB14_CREATE_BTN').button().click(function() { 
	var errorMessage = ""; 
	if($('#objectiveText').val() == "")
		errorMessage+="Indiquez l'objectif!"
	if($('#defineText').val() == "")
		errorMessage+="Indiquez le Définition!"
	if($('#limitText').val() == "")
		errorMessage+="Indiquez les limites!"
	if(!$('input[name=cir]:checked').val())
		errorMessage+="Indiquez le circonscription du périmètre d’analyse!"
	if(!$('input[name=sysFunc]:checked').val())
		errorMessage+="Indiquez le Fonction du système!"
	if(!$('input[name=niveau]:checked').val())
		errorMessage+="Indiquez le Niveau d’évaluation!"
	if (errorMessage == "")
	{
	goToPrevTab();
	AdID=$('#AdminID').val();  //gets the administrator's ID
	var organisationName = $('#OrgaName').val(); // Get The Organisation Name From The Drupal PHP Profile2 Fields.
	
	//gets the file through the url, the next paramteer is the data being sent in for the file to se and then finally the last paramter
	//is doing soemthing in a function as a response, in this case it would be calling another ajax post  
	$.post("http://quebio.ca/testing/Jason/php/rapport.php", { orgname: organisationName, adminid: AdID, userid: $('#the_user').val()}, function(data) {alert(data);
			$.post("http://quebio.ca/testing/Jason/php/insertParameter.php", { objectiveText: $('#objectiveText').val(), limitText: $('#limitText').val(), 
			defineText: $('#defineText').val(), circonscription: $('#cir').val(), represent: $('#sysRep').val(), fonction: $('#sysFunc').val(),
			niveau: $('#niveau').val(), reportid: data, userid: AdID}, function(data){
			// Call The Rapport.php to do The Report Creating And Refresh The Page on Finish To Show The New Report.
			window.location.reload();
			window.location.replace("http://quebio.ca/entreprisebio/#tab4");});
	});
	}
	else
		alert(errorMessage);
});

$('#LAST_BACK_BTN').button().click(function() { //next button for risk/oppurtunity tab
	$('.selectable_n'+' .ui-selected').removeClass('ui-selected'); //unselects the selected selectable
	n_item = 0; //reset the selected id to null

	$('.selectable_n2'+' .ui-selected').removeClass('ui-selected'); //unselects the selected selectable
	n2_item = 0; //reset the selected id to null

	$("riskOrOpp").val("");
	$("riskOrOpp2").val("");

	goToPrevTab();
});

$('#LAST_NEXT_BTN').button().click(function() { //back button of risk/oppurtunity tab
	if(i_item && !i2_item)  //did the user only select a dependancy and not a impact?
	{ 	
		$("#hiddenImpactAverage").val(""); 
		$("#hiddenImpactPotential").val("");
	}

	if(!i_item && i2_item)  //did the user only select an impact and not a dependancy?
	{ 	$("#interdependanceAverage").val("");
		$("#interdependancePotential").val("");
	}

	$("#riskOrOpp").val($("#"+n_item).text());
	$("#riskOrOpp2").val($("#"+n2_item).text());
	if (n_item && i_item)  //did the user select anything?
	{
		goToNextTab();
	}
	else if(n2_item && i2_item)
	{
		goToNextTab();
	}
	else if(n2_item && i2_item && n_item && i_item)
	{
		goToNextTab();
	}		
	else  //the user did not select anything
		alert("SVP choisissez une de ses Opportunité/risques et leur nature!");
});

$('#data_back_btn').button().click(function() {
	goToPrevTab();
});

$(function() {  //slider for the interdependencies
    var select = $( "#slides" );
    var slider = $('#slider').slider({
      orientation: "vertical",
      min: 1,
      max: 5,
      range: "min",
      value: select[ 0 ].selectedIndex + 1,
      slide: function( event, ui ) {
        select[ 0 ].selectedIndex = ui.value - 1;
        $('.OptionDivs').hide();
        var id= ui.value;  //get the id from the slider
		$('#displayOption'+id).show();  //show the ranking
      }
    });
    $( "#slides" ).change(function() {
      slider.slider( "value", this.selectedIndex + 1 );
      $('.OptionDivs').hide();
      var id= this.selectedIndex + 1; //get the id from the drop dwon list
	  $('#displayOption'+id).show();  //show the ranking
    });
  });


$(function() {  //slider for impact ranking
    var impact = $( "#impact" );
    var impactSlider = $('#impactSlider').slider({
      orientation: "vertical",
      min: 1,
      max: 11,
      range: "min",
      value: impact[ 0 ].selectedIndex + 1,
      slide: function( event, ui ) {
        	impact[ 0 ].selectedIndex = ui.value - 1; 
        	var impactID= ui.value;  //get the id from the slider
        	$('.ImpactDivs').hide();
        	$('#displayImpact'+impactID).show();  //show the ranking
    	}
	});
    $( "#impact" ).change(function() {
      impactSlider.slider( "value", this.selectedIndex + 1 );
      var impactID= this.selectedIndex + 1;  //get the id from the drop down list
      $('.ImpactDivs').hide();
      $("#displayImpact" + impactID).show(); //show the ranking
    });
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
							if(tabCounter > 2)
								tabCounter=2;
							goToNextTab();
							$('#tabs').tabs('enable', tabCounter-1);
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
								$.post("http://quebio.ca/testing/Jason/php/getAdminInfo.php", {adminid: adminID, reportid: reportID}, function(data) { 
									alert(data);
									document.getElementById('ajax').style.visibility = 'visible';
									var adminInfo = JSON.parse(data);
									var xaxisarray = [];
									
									var ii=0;
									while (ii<adminInfo.xaxis.c_names.length){  //formatting of the x Axis values
										adminInfo.xaxis.c_names[ii]=adminInfo.xaxis.c_names[ii];
										ii=ii+1;
									}
									
									var alldata = [];  // temporarly store data in this array to sort it
									for (var loop = 0; loop < adminInfo.xaxis.avg_impct_size - 1; loop++)  //put the average impacts and c_names into the array
									{
										alldata[loop] = [adminInfo.xaxis.c_names[loop], adminInfo.xaxis.c_name_average_impact[loop]];
									}
									
									alldata.sort(function(a,b){return a[1]-b[1]});  //sort the average impacts and the c_names

									var avg_impacts = [];
									var classifications = [];
									for(var loop = 0; loop < adminInfo.xaxis.avg_impct_size - 1; loop++)  //extract the data from the array
									{
										avg_impacts[loop] = alldata[loop][1];  //extract the vales
										classifications[loop] = alldata[loop][0];  //extract the x-axis values
									}
									

									var ii=0;
									while (ii<adminInfo.xaxis.avg_impct_size - 1){	//average impacts series
										avg_impacts[ii]=parseInt(avg_impacts[ii]);
										ii=ii+1;
									}

									$('#impacts_avg').highcharts( {
										chart:{
											type: 'column',
											marginLeft: 120
										},
										title: {
											text: 'Les impacts avérés',
											labels: {
                								style: {
                    								color: 'purple',
                    								fontSize:'20px'
                										}
            										}
										},
										xAxis: {	
											categories:classifications,
											labels: {
												rotation: -90,
												align: 'right',
                								style: {
                    								color: 'red',
                    								fontSize:'16px'
                								}
            								}
										},
										yAxis: {
											tickPositions: [-5, -4, -3, -2, -1, 0, 1, 2, 3, 4, 5],
											min: -5,
											max: 5,
											labels: {
                								style: {
                    								
                    								fontSize:'25px'
                								}
           									 }
										},
										 legend: {
                							layout: 'vertical',
                							align: 'right',
                							verticalAlign: 'middle',
                							borderWidth: 0,
                							itemStyle: {
										        color: '#000000',
										        fontWeight: 'bold',
										        fontSize: '16px'
									    	}
                						},
                						series: [{
											name: 'Impacts avérés',
											data: avg_impacts
										}
										]
									});
							
									var ii=0;
									while (ii<adminInfo.xaxis.pot_c_names.length){  //formatting of the x Axis values
										adminInfo.xaxis.pot_c_names[ii]=adminInfo.xaxis.pot_c_names[ii];
										ii=ii+1;
									}
									
									var all_pot_impacts = [];  // temporarly store data in this array to sort it
									for (var loop = 0; loop < adminInfo.xaxis.pot_impct_size - 1; loop++)  //put the average impacts and c_names into the array
									{
										all_pot_impacts[loop] = [adminInfo.xaxis.pot_c_names[loop], adminInfo.xaxis.potential_impacts[loop]];
									}
									
									all_pot_impacts.sort(function(a,b){return a[1]-b[1]});  //sort the average impacts and the c_names

									var pot_impacts = [];
									var classifications2 = [];
									for(var loop = 0; loop < adminInfo.xaxis.pot_impct_size - 1; loop++)  //extract the data from the array
									{
										pot_impacts[loop] = all_pot_impacts[loop][1];  //extract the vales
										classifications2[loop] = all_pot_impacts[loop][0];  //extract the x-axis values
									}
									
									var ii=0;
									while (ii<adminInfo.xaxis.pot_impct_size - 1){	//average impacts series
										pot_impacts[ii]=parseInt(pot_impacts[ii]);
										ii=ii+1;
									}


$('#impacts_pot').highcharts( {
										chart:{
											type: 'column',
											marginLeft: 120
										},
										title: {
											text: 'Les impacts potentiels',
											labels: {
                								style: {
                    								color: 'purple',
                    								fontSize:'20px'
                										}
            										}
										},
										xAxis: {	
											categories:classifications2,
											labels: {
												rotation: -90,
												align: 'right',
                								style: {
                    								color: 'red',
                    								fontSize:'16px'
                								}
            								}
										},
										yAxis: {
											tickPositions: [-5, -4, -3, -2, -1, 0, 1, 2, 3, 4, 5],
											min: -5,
											max: 5,
											labels: {
                								style: {
                    								
                    								fontSize:'25px'
                								}
           									 }
										},
										 legend: {
                							layout: 'vertical',
                							align: 'right',
                							verticalAlign: 'middle',
                							borderWidth: 0,
                							itemStyle: {
										        color: '#000000',
										        fontWeight: 'bold',
										        fontSize: '16px'
									    	}
                						},
                						series: [{
											name: 'Impacts potentiels',
											data: pot_impacts,
										}
										]
									});



var ii=0;
while (ii<adminInfo.xaxis.avg_dep_size.length){  //formatting of the x Axis values
	adminInfo.xaxis.avg_dep_c_names[ii]=adminInfo.xaxis.avg_dep_c_names[ii];
	ii=ii+1;
}

var all_avg_dependances = [];  // temporarly store data in this array to sort it
for (var loop = 0; loop < adminInfo.xaxis.avg_dep_size - 1; loop++)  //put the average dependances and c_names into the array
{
	all_avg_dependances[loop] = [adminInfo.xaxis.avg_dep_c_names[loop], adminInfo.xaxis.avg_deps[loop]];
}

all_avg_dependances.sort(function(a,b){return a[1]-b[1]});  //sort the average dependances and the c_names

var avg_dependances = [];
var classifications3 = [];
for(var loop = 0; loop < adminInfo.xaxis.avg_dep_size - 1; loop++)  //extract the data from the array
{
	avg_dependances[loop] = all_avg_dependances[loop][1];  //extract the values
	classifications3[loop] = all_avg_dependances[loop][0];  //extract the x-axis values
}

var ii=0;
while (ii<adminInfo.xaxis.avg_dep_size - 1){	//average deoendance series
	avg_dependances[ii]=parseInt(avg_dependances[ii]);
	ii=ii+1;
}


$('#dependance_avg').highcharts( {
	chart:{
		type: 'column',
		marginLeft: 120
	},
	title: {
		text: 'Les Dépendances avérés',
		labels: {
			style: {
				color: 'purple',
				fontSize:'20px'
					}
				}
	},
	xAxis: {	
		categories:classifications2,
		labels: {
			rotation: -90,
			align: 'right',
			style: {
				color: 'red',
				fontSize:'16px'
			}
		}
	},
	yAxis: {
		tickPositions: [0, 1, 2, 3, 4, 5],
		min: 0,
		max: 5,
		labels: {
			style: {
				
				fontSize:'25px'
			}
			 }
	},
	 legend: {
		layout: 'vertical',
		align: 'right',
		verticalAlign: 'middle',
		borderWidth: 0,
		itemStyle: {
	        color: '#000000',
	        fontWeight: 'bold',
	        fontSize: '16px'
    	}
	},
	series: [{
		name: 'Dépendances avérés',
		data: avg_dependances,
	}
	]
});

var ii=0;
while (ii<adminInfo.xaxis.pot_dep_size.length){  //formatting of the x Axis values
	adminInfo.xaxis.pot_dep_c_names[ii]=adminInfo.xaxis.pot_dep_c_names[ii];
	ii=ii+1;
}

var all_pot_dependances = [];  // temporarly store data in this array to sort it
for (var loop = 0; loop < adminInfo.xaxis.pot_dep_size - 1; loop++)  //put the average dependances and c_names into the array
{
	all_pot_dependances[loop] = [adminInfo.xaxis.pot_dep_c_names[loop], adminInfo.xaxis.potential_deps[loop]];
}

all_pot_dependances.sort(function(a,b){return a[1]-b[1]});  //sort the average dependances and the c_names

var pot_dependances = [];
var classifications4 = [];
for(var loop = 0; loop < adminInfo.xaxis.pot_dep_size - 1; loop++)  //extract the data from the array
{
	pot_dependances[loop] = all_pot_dependances[loop][1];  //extract the values
	classifications4[loop] = all_pot_dependances[loop][0];  //extract the x-axis values
}

var ii=0;
while (ii<adminInfo.xaxis.pot_dep_size - 1){	//average deoendance series
	pot_dependances[ii]=parseInt(pot_dependances[ii]);
	ii=ii+1;
}

$('#dependance_pot').highcharts( {
										chart:{
											type: 'column',
											marginLeft: 120
										},
										title: {
											text: 'Les Dépendances potentiels',
											labels: {
                								style: {
                    								color: 'purple',
                    								fontSize:'20px'
                										}
            										}
										},
										xAxis: {	
											categories:classifications4,
											labels: {
												rotation: -90,
												align: 'right',
                								style: {
                    								color: 'red',
                    								fontSize:'16px'
                								}
            								}
										},
										yAxis: {
											tickPositions: [0, 1, 2, 3, 4, 5],	
											min: 0,
											max: 5,
											labels: {
                								style: {
                    								
                    								fontSize:'25px'
                								}
           									 }
										},
										 legend: {
                							layout: 'vertical',
                							align: 'right',
                							verticalAlign: 'middle',
                							borderWidth: 0,
                							itemStyle: {
										        color: '#000000',
										        fontWeight: 'bold',
										        fontSize: '16px'
									    	}
                						},
                						series: [{
											name: 'Dépendances potentiels',
											data: pot_dependances,
											
										}
										]
									});

var all_se_averages = [];  // temporarly store data in this array to sort it

for (var loop = 0; loop < adminInfo.xaxis.se_categories_avgs.length; loop++)  //put the average dependances and c_names into the array
{	if (loop != 0)
		all_se_averages[loop] = [adminInfo.xaxis.se_categories[loop], adminInfo.xaxis.se_categories_avgs[loop]];
}

all_se_averages.sort(function(a,b){return a[1]-b[1]});  //sort the average dependances and the c_names

var se_averages = [];
var se_names = [];
for(var loop = 0; loop < adminInfo.xaxis.se_categories_avgs.length - 1; loop++)  //extract the data from the array
{	if (all_se_averages[loop][1] == null || all_se_averages[loop][1] == "") 
		se_averages[loop] = 0;
	else
		se_averages[loop] = all_se_averages[loop][1];  //extract the values
	se_names[loop] = all_se_averages[loop][0];  //extract the x-axis values
}

var ii=0;
while (ii<adminInfo.xaxis.se_categories_avgs.length - 1){	//average deoendance series
	se_averages[ii]=parseInt(se_averages[ii] / adminInfo.totalPpl * 100);
	ii=ii+1;
}

$('#average_ranking_se').highcharts( {
										chart:{
											type: 'column',
											marginLeft: 120
										},
										title: {
											text: 'Pourcentage de classifications par category',
											labels: {
                								style: {
                    								color: 'purple',
                    								fontSize:'20px'
                										}
            										}
										},
										xAxis: {	
											categories:se_names,
											labels: {
												rotation: -90,
												align: 'right',
                								style: {
                    								color: 'red',
                    								fontSize:'16px'
                								}
            								}
										},
										yAxis: {
											title: {
                    							text: 'Pourcentage (%)'
               								 },
											tickPositions: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100],	
											min: 0,
											max: adminInfo.totalPpl,
											labels: {
                								style: {
                    								fontSize:'25px'
                								}
           									 }
										},
										 tooltip: {
                							valueSuffix: '%'
            							},
										 legend: {
                							layout: 'vertical',
                							align: 'right',
                							verticalAlign: 'middle',
                							borderWidth: 0,
                							itemStyle: {
										        color: '#000000',
										        fontWeight: 'bold',
										        fontSize: '16px'
									    	}
                						},
                						series: [{
											name: 'Pourcentage de categories',
											data: se_averages,										
										}]
									});

se_money_neg = [];
se_money_pos = [];
ii=0;
while(ii < adminInfo.se_money_neg.length)
{
	se_money_neg[ii] = parseInt(adminInfo.se_money_neg[ii] * -1 / adminInfo.totalPpl * 100);
	ii++;
}


ii=0;
while(ii < adminInfo.se_money_pos.length )
{
	se_money_pos[ii] = parseInt(adminInfo.se_money_pos[ii] / adminInfo.totalPpl * 100);
	ii++;
}


$('#money_ranking').highcharts( {
chart:{
	type: 'column',
	marginLeft: 120
},
title: {
	text: 'I.4.	Les paiements pour bénéficier des BSE' ,
	labels: {
		style: {
			color: 'purple',
			fontSize:'20px'
				}
			}
},
xAxis: {	
	categories:se_names,
	labels: {
		rotation: -90,
		align: 'right',
		style: {
			color: 'red',
			fontSize:'16px'
		}
	}
},
yAxis: {
	title: {
		text: 'Pourcentage(%)'
		 },
	tickPositions: [-100,-80,-60,-40,-20,0,20,40,60,80,100],	
	min: -100,
	max: adminInfo.totalPpl,
	labels: {
		style: {
			fontSize:'25px'
		}
		 }
},
 tooltip: {
	valueSuffix: '%'
},
 legend: {
	layout: 'vertical',
	align: 'right',
	verticalAlign: 'middle',
	borderWidth: 0,
	itemStyle: {
        color: '#000000',
        fontWeight: 'bold',
        fontSize: '16px'
	}
},
series: [{
	name: 'argent sans perte',
	data: se_money_pos,
	
},{
	name:'pertre d\'argent',
	data: se_money_neg
	}]
});

var iii= parseInt(adminInfo.taxMoney) + parseInt(adminInfo.redMoney) + parseInt(adminInfo.envirMoney) + parseInt(adminInfo.autreMoney);
var tax = parseInt(adminInfo.taxMoney) / iii * 100;
var envi = parseInt(adminInfo.envirMoney) / iii * 100;
var red = parseInt(adminInfo.redMoney) / iii * 100;
var autre = parseInt(adminInfo.autreMoney) / iii * 100;

$('#money_detail').highcharts( {
chart:{
	type: 'column',
	marginLeft: 120
},
title: {
	text: 'Présente le nombre de paiements / nombre d’IDBSE identifiées dans chaque catégorie' ,
	labels: {
		style: {
			color: 'purple',
			fontSize:'20px'
				}
			}
},
xAxis: {	
	categories:['Taxe','Paiement pour services environnementaux', 'Redevance', 'Autre'],
	labels: {
		rotation: -90,
		align: 'right',
		style: {
			color: 'red',
			fontSize:'16px'
		}
	}
},
yAxis: {
	title: {
		text: 'Importance relative (%) – paiements pour IDBSE'
		 },
	tickPositions: [0,10,20,30,40,50,60,70,80,90,100],	
	min: 0,
	max: 100,
	labels: {
		style: {
			fontSize:'25px'
		}
		 }
},
 tooltip: {
	valueSuffix: '%'
},
 legend: {
	layout: 'vertical',
	align: 'right',
	verticalAlign: 'middle',
	borderWidth: 0,
	itemStyle: {
        color: '#000000',
        fontWeight: 'bold',
        fontSize: '16px'
	}
},
series: [{
	name: 'money',
	data: [tax, envi, red, autre]	
}]
});

var iii= parseInt(adminInfo.finance_pro) + parseInt(adminInfo.mar_pro) + parseInt(adminInfo.rep_pro) + parseInt(adminInfo.op_pro) + parseInt(adminInfo.rule_pro);
var finance = parseInt(adminInfo.finance_pro) / iii * 100;
var mar = parseInt(adminInfo.mar_pro) / iii * 100;
var rep = parseInt(adminInfo.rep_pro) / iii * 100;
var op = parseInt(adminInfo.op_pro) / iii * 100;
var rule = parseInt(adminInfo.rule_pro) / iii * 100;

$('#Operations').highcharts( {
chart:{
	type: 'column',
	marginLeft: 120
},
title: {
	text: 'Operations' ,
	labels: {
		style: {
			color: 'purple',
			fontSize:'20px'
				}
			}
},
xAxis: {	
	categories:['Les finances', 'La gestion des opérations', 'Les opérations quotidiennes', 'Les ressources humaines', 'Le marketing (réputation, image, etc.)'],
	labels: {
		rotation: -90,
		align: 'right',
		style: {
			color: 'red',
			fontSize:'16px'
		}
	}
},
yAxis: {
	title: {
		text: 'Importance relative (%) – fonctions touchees par l’IDBSE'
		 },
	tickPositions: [0,10,20,30,40,50,60,70,80,90,100],	
	min: 0,
	max: 100,
	labels: {
		style: {
			fontSize:'25px'
		}
		 }
},
 tooltip: {
	valueSuffix: '%'
},
 legend: {
	layout: 'vertical',
	align: 'right',
	verticalAlign: 'middle',
	borderWidth: 0,
	itemStyle: {
        color: '#000000',
        fontWeight: 'bold',
        fontSize: '16px'
	}
},
series: [{
	name: 'Operations',
	data: [finance, mar, rep, op, rule]	
}]
});

totalF = 0;
count=0;
while(count < adminInfo.operation_f.length) //this gets the total number of services that have this operation
{
	totalF+= +adminInfo.operation_f[count];
	count++;
}

totalM = 0;
count = 0;
while(count < adminInfo.operation_m.length)
{
	totalM+= +adminInfo.operation_m[count];
	count++;
}

totalR = 0;
count = 0;
while(count < adminInfo.operation_r.length)
{
	totalR+= +adminInfo.operation_r[count];
	count++;
}

totalO = 0;
count = 0;
while(count < adminInfo.operation_o.length)
{
	totalO+= +adminInfo.operation_o[count];
	count++;
}

totalRU = 0;
count = 0;
while(count < adminInfo.operation_ru.length)
{
	totalRU+= +adminInfo.operation_ru[count];
	count++;
}

var operation_f = [];
var operation_m = [];
var operation_r = [];
var operation_o = [];
var operation_ru = [];

var count =0;
while(count < adminInfo.operation_f.length)  //turn the data into percentage by dividing it by the total
{
	operation_f[count] = parseInt(adminInfo.operation_f[count]) / totalF * 100;
	count++;
}

count = 0;
while(count < adminInfo.operation_m.length)
{
	operation_m[count] = parseInt(adminInfo.operation_m[count] / totalM * 100);
	count++;
}

count = 0;
while(count < adminInfo.operation_r.length)
{
	operation_r[count] = parseInt(adminInfo.operation_r[count]) / totalR * 100;
	count++;
}

count = 0;
while(count < adminInfo.operation_o.length)
{
	operation_o[count] = parseInt(adminInfo.operation_o[count]) / totalO * 100;
	count++;
}

count = 0;
while(count < adminInfo.operation_ru.length)
{
	operation_ru[count] = parseInt(adminInfo.operation_ru[count]) / totalRU * 100;
	count++;
}

$('#Operations_par_se').highcharts( {
chart:{
	type: 'column',
	marginLeft: 120
},
title: {
	text: 'Operations' ,
	labels: {
		style: {
			color: 'purple',
			fontSize:'16px'
				}
			}
},
xAxis: {	
	categories:se_names,
	labels: {
		rotation: -90,
		align: 'right',
		style: {
			color: 'red',
			fontSize:'16px'
		}
	}
},
yAxis: {
	title: {
		text: 'Importance relative (%) – fonctions touchees par l’IDBSE'
		 },
	tickPositions: [0,50,100,150,200,250,300,350,400,450,500],	
	min: 0,
	max: 500,
	  stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                   }
                }	 
},
 tooltip: {
	valueSuffix: '%'
},
 legend: {
	layout: 'vertical',
	align: 'right',
	verticalAlign: 'middle',
	borderWidth: 0,
	itemStyle: {
        color: '#000000',
        fontWeight: 'bold',
        fontSize: '16px'
	}
},
plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                       style: {
                            textShadow: '0 0 3px black, 0 0 3px black'
                        }
                    }
                }
            },
series: [{
	name: 'Les finances',
	data: operation_f
},
{	name: 'La gestion des opérations',
	data: operation_m
},
{
	name: 'Les opérations quotidiennes',
	data: operation_r
},
{
	name: 'Les ressources humaines',
	data: operation_o
},
{
	name: 'Le marketing (réputation, image, etc.)',
	data: operation_ru
}]
});

  	var chartBF = $('#impacts_avg').highcharts(); 
  	var svgBF = chartBF.getSVG();

  	var chartBS = $('#impacts_pot').highcharts();
  	var svgBS = chartBS.getSVG();
	
  	var chartSF = $('#dependance_avg').highcharts();
  	var svgSF = chartSF.getSVG();

  	var chartSS = $('#dependance_pot').highcharts();
  	var svgSS = chartSS.getSVG();

  	var chartAR = $('#average_ranking_se').highcharts();
  	var svgAR = chartAR.getSVG();

  	var chartMO = $('#money_ranking').highcharts();
  	var svgMO = chartMO.getSVG();

  	var chartMD = $('#money_detail').highcharts();
  	var svgMD = chartMD.getSVG();

  	var chartOP = $('#Operations').highcharts();
  	var svgOP = chartOP.getSVG();

	var chartOPS = $('#Operations_par_se').highcharts();
	var svgOPS = chartOPS.getSVG();

	var data = ({chartBF: svgBF, chartBS: svgBS, chartSF: svgSF, chartSS: svgSS, chartAR: svgAR, chartMO: svgMO, chartMD: svgMD, chartOP: svgOP, chartOPS: svgOPS});

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