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
		onPageLoad('tab1');
		$("#info a,#question a,#parametertab a,#userview a,#infoForUser a,#entreprisetab a,#admintools a").click(function(){
			var tab=$(this).attr('href').replace('#','');
			var userid=$("#AdminID").val();
			var reportid=$("#the_report").val();
			$(".tabcontent").html("");
			$('#'+tab).html("<img src='/evaluationbse/images/ajax-loader.gif' style='margin:0 auto;display:block;background-color:#fff;border:0px;'>");
			$.post("http://quebio.ca/evaluationbse/php/get_tab.php",{tab: tab, userid: userid, reportid: reportid},
				function(data){
					$('#'+tab).html(data);
					onPageLoad(tab); 
				}
			);
		});
	});

function onPageLoad(tab) {
		var tabCounter;
		//var tab;
		var userRole = jQuery('#userRole').val();
		if ( userRole == "Unauthenticated" ){
			$('#tab5,#userview,#tab6,#servicetab,#tab7,#classificationtab,#tab8,#entreprisetab,#tab9,#naturetab,#tab10,#risktab,#tab11,#dependencetab,#tab12,#impacttab,#tab13,#moneytab,#tab14,#parametertab,#tab15,#qualifytab,#tab16,#sendData,#tab17,#viewOpinions,#tab18,#adminOpinion,#tab19,#infoForUser').remove();
			$('#tabs').tabs(); // Generate Tabs With The Default Settings.
		}
		if ( userRole == "Unauthenticated" || userRole == "Participant" || userRole== "Externe"){
			$('#tab4,#admintools,#tab14,#parametertab,#tab17,#viewOpinions,#tab18,#adminOpinion,#infoForUser,#entreprisetab').hide();
		}
		if (userRole == "Administration"){
			$('#parametertab, #infoForUser, #entreprisetab').hide();
		}
		if ( userRole != "Unauthenticated" ){  //removes the following tab(s) 
			$('#tab3,#login').remove();
			//$('#servicetab,#classificationtab,#naturetab,#dependencetab,#moneytab,#impacttab,#risktab,#parametertab,#qualifytab,#sendData').remove();
			if ( userRole == "Administration" ){
				//var disableTabs = [5,6,7];
				var disableTabs = [];
				var compensateTab = 1;
			}
			else {
				//var disableTabs = [5];
				var disableTabs = [];
				var compensateTab = 0;
			}
		}
		$('#tabs').tabs({disabled: disableTabs}); // Generate Tabs With The Default Settings.

		// JS specific to each TAB
		if(tab=='tab1'){
			$('#tab1').html("<img src='/evaluationbse/images/ajax-loader.gif' style='margin:0 auto;display:block;background-color:#fff;border:0px;'>");
			$.post("http://quebio.ca/evaluationbse/php/get_tab.php",{tab: 'tab1'}, 
				function(data){
					$('#tab1').html(data);
					onPageLoad(tab1);
				}
			);
		} else if(tab=='tab2') {
			$( "#tabs-2" ).tabs(//the tab that displays mroe info on the first page
			{
				collapsible: true,
				selected: 0  //collapse the "en savoir plus" tab by default
			});			
		} else if(tab=='tab3') {
			$( "#tabs-3" ).tabs(//the tab that displays mroe info
			{
				collapsible: true,
				selected: 0  //collapse the "en savoir plus" tab by default
			});			
		} else if(tab=='tab4') {
			$( "#tabs-4" ).tabs(//the tab that displays mroe info on the questions page
    		{
    			collapsible: true,
     			selected: 0  //collapse the "en savoir plus" tab by default
     		}); 
     		admin_tab();
		} else if(tab=='tab5') {
			// Selectable list of tab 1
			$("#selectable0").selectable({ //creating a selectable list which contains all the reports anwsered by certain user 
				selected: function(event, ui) { 
					$(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");// this will restrict the user to select only one item
					var result = $( "#select-result" ).empty();
					$( ".ui-selected", this ).each(function() { 
						report_id = $(this).attr("id");  // getting the id of the selected item (reportID)
						$('#new_report').val(report_id);
					}); 
				}
			});
			$('#NEW_RE_BTN').button().click(function() {

					var theValid;
					var ridInput = $("#new_report"); // getting the textbox field on 1st tab
					
					if (ridInput && ridInput.val()) { // ckeching if the textbox has value

						valid_input = true;

						var request = new XMLHttpRequest();
						var url = "/evaluationbse/php/get_examples.php";
						var params = "newRid="+ridInput.val();
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
							report_id = ridInput.val();// assigning the textbox value to the global variable REPORT
							$("#the_report").val(report_id);
							var active = $('#tabs').tabs('option', 'selected');
							$( '#infoForUser a' ).trigger('click');
					}
					else{
						report_id = null;
						alert(theValid+" Mauvais numéro de rapport! Entrez un nouveau");
						$("#new_report").focus();
					}
				}
			});
		} else if(tab=='tab14') {
			create_evaluation_tab();
		} else if(tab=='tab19') {
			Drupal.behaviors.diagbio_map.geography = $("input[name='geography']");
			Drupal.behaviors.diagbio_map.clearOverlays();
			$.when( Drupal.behaviors.diagbio_map.createMap('map1') ).done(function() {
					google.maps.event.trigger(Drupal.behaviors.diagbio_map.map, "resize");
			});
			$('#TAB19_BTN_NEXT').button().click(function(){
				var active = $('#tabs').tabs('option', 'selected');
				$( '#entreprisetab a' ).trigger('click');
			});
			$('#TAB19_BTN_BACK').button().click(function(){
				var active = $('#tabs').tabs('option', 'selected');
				$( '#userview a' ).trigger('click');
			});
		} else if(tab=='tab18') {
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
				$.post("http://www.quebio.ca/evaluationbse/php/delete_opinions.php", {adminid: adminID, reportid: reportID, chkdbxs : checkedboxes}, function(data) {})
			})

			$("#insert_adminOp").button().click(function(){  //check if this works and use the hidden fields which contain the examples!
				
				totalChangedOps = $('#numOfOps').val();
				filledTxts = [];
				adminOpinions = [];
				payments = [];  //admin's answers of payments
				report_ids = [];
				potAvgs = [];
				var loop = 0;

				for (var i = 0; i < totalChangedOps; i++) {  //prepare to send over the examples and opinions, report ids and whether its potential or average
					if ($("#adminFinalOpinion"+i).val()){
						adminOpinions[loop] = $("#adminFinalOpinion"+i).val();
						payments[loop] = $("#adminAltPay"+i).val();
						filledTxts[loop] = $("#unique_example"+i).val();		
						report_ids[loop] = $("#report_id"+i).val();
						potAvgs[loop] = $("#potentialAvg"+i).val();
						loop++;
					}
				};
				adminID = $('#AdminID').val();
				reportID = $('#report_selected').val();
				$.post("http://www.quebio.ca/evaluationbse/php/admin_opinions.php", {adminid: adminID, reportid: reportID, examples: filledTxts, adminFinalOpinions: adminOpinions, reportIds: report_ids, potavgs: potAvgs, altPay: payments}, function(data) {alert(data);})
			})

			$("[id^=showReport]").button().click(function(){
				var id = $(this).attr('id');  //get the id of the button
				var choppedID = id.substring(10); //get the id of the table
				$('[id^=adminOps').hide();  //hide all the tables
				$('#adminOps'+choppedID).show();  //show the selected table
				$('#modify_report').val($('#'+id).val());  //keep track of the current report selected
			})
		} else if(tab=='tab_eval') {
			eval_tab();
		}


		$( ".ui-selected" ).selectable({ tolerance: "fit" });  //fixes the issue with the click event not firing from time to time
}

function goToNextTab(tabCounter)  //this counter will allow us to navigate forward through the tabs, starting at tab 3(reports list)
	{
			var active = $('#evaltabs').tabs('option', 'active');
			$( "#evaltabs" ).tabs('enable', active+1)
			$( "#evaltabs" ).tabs({ active: active+1 });
			$( "#evaltabs" ).tabs('disable',active );
			$('html,body').animate({
  				 scrollTop: $('h1.title').offset().top
			});
    		/*tabCounter++;  //increment to the current tab
			$( "#evaltabs" ).tabs('enable', tabCounter).tabs('select', tabCounter); // go to the next tab and disable the 2rd one
			tabCounter--;  //decrememnt to last tab
			$( "#evaltabs" ).tabs( 'disable',tabCounter );
			tabCounter++;  //incrememnt back to current tab
			*/
	}

function goToPrevTab(tabCounter)  //this counter will allow us to navigate backward through the tabs, starting at tab 3(reports list)
	{
			$('#evaltabs').tabs( { show: { effect: "slide", direction: "left", duration: 500}});
			var active = $('#evaltabs').tabs('option', 'active');
			$( "#evaltabs" ).tabs('enable', active-1);
			//$( active ).slideDown()
			$( "#evaltabs" ).tabs({ active: active-1 });
			$( "#evaltabs" ).tabs( 'disable',active );
			$('html,body').animate({
  				 scrollTop: $('h1.title').offset().top
			});
			$('#evaltabs').tabs( { show: { effect: "slide", direction: "right", duration: 500}});
			/*
			tabCounter--;  //decrememnt to current tab
			$( "#evaltabs" ).tabs('enable', tabCounter).tabs('select', tabCounter); // go to the next tab and disable the 2rd one
			tabCounter++;  //incrememnt to last tab
			$( "#evaltabs" ).tabs( 'disable',tabCounter );
			tabCounter--;  //decrement back to current tab
			*/
	}

function eval_tab(){
	$('#evaltabs').tabs( { show: { effect: "slide", direction: "right", duration: 500}});
	//$('#evaltabs').tabs({ fxFade: true, fxSpeed: 'slow' });
	$('#evaltabs ul').hide();
	//$('#servicetab,#classificationtab,#naturetab,#dependencetab,#moneytab,#impacttab,#risktab,#parametertab,#qualifytab,#sendData','#exampletab').hide();
	//$('#tabs').tabs({ hide: { effect: "slide", direction: 'left' }, show: { effect: "slide", direction: 'right' } });
	$('#externeInput').addClass("hide");
	$('#moneyinput').addClass("hide");
	$("#selectNature").addClass("hide");
	$("#selectNatureTwo").addClass("hide");
	$("#sendData").addClass("hide");
	$('#newExample').click(function() {
		$('#selectable'+c_item+' .ui-selected').removeClass('ui-selected'); //unselects the chosen example
		c_example = 0;  //0 means that there are no examples selected
	});
	$("input:radio[name=sysFunc1]").click(function(){
		$( "#sysFunc2" ).prop( "checked", false );
		$('#hidden_text').show();
		$('#funcTxt').val('');
		$('#funcTxt').focus();
	})
	$("input:radio[name=sysFunc2]").click(function(){
		$( "#sysFunc1" ).prop( "checked", false );
		$('#hidden_text').show();
		$('#funcTxt').val('');
		$('#funcTxt').focus();
	})
		$("input:radio[name=cir1]").click(function() {  //the select list for the circonscriptions in the evalauation creation tab
		$('[id^=sites]').hide();
		$('#sites1').show();
		$( "#cir2" ).prop( "checked", false );
		$( "#cir3" ).prop( "checked", false );
	})

	$("input:radio[name=cir2]").click(function() {  //the select list for the circonscriptions in the evalauation creation tab
		$('[id^=sites]').hide();
		$('#sites2').show();
		$( "#cir1" ).prop( "checked", false );
		$( "#cir3" ).prop( "checked", false );
	})

	$("input:radio[name=cir3]").click(function() {  //the select list for the circonscriptions in the evalauation creation tab
		$('[id^=sites]').hide();
		$('#sites3').show();
		$( "#cir1" ).prop( "checked", false );
		$( "#cir2" ).prop( "checked", false );
	})

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
		if(value == "autre")  //if so, show the text box(note the autre option does not have any value) 
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

			/*$("input:radio[name=niveau]").click(function() {  //check if the user selected externe in the parameter tab
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
			});*/  

	$('[id^="niveau"]').click(function () { //checks if the user selected/unselected externe, and fires some events accordingly
		var value = $(this).val();

		if (value == "Externe")
		{
			$("input:radio[name=externe]").removeAttr( "disabled" );
			$("#externeInput").removeAttr( "disabled" );
			$("#hideList").show();
		}
		if ($('#niveau3').prop('checked') == false) {
			$("#hideList").hide(); 
			$('input[name=externe]:checked').prop('checked', false); 
			$("#externeInput").val("");
			$('#externeInput').removeClass("show"); 
			$('#externeInput').addClass("hide"); 
		}
	})

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

	$('.infoDivs').hide();  //hide all the information blocks on the ecological services

	$(".ui-state-default").hover(function(){  //display the info of the currently selected ecological service and hide all other info divs
		var id=$(this).attr('id'); //get the id of the highlighted selectable
		$('[id^=infoDiv]').hide();
		$('#infoDiv'+id).show();
	})

	$('.infoClassDivs').hide();  //hide all the information blocks on the classifications
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
	if(userRole	== "Administration"){  //there should be one less tab for participant
		var tabCounter = 3; //keeps track of which tab we're at
	}else{
		var tabCounter = 2; //keeps track of which tab we're at
	}

	$('.lists').hide(); // hiding all the divs corresponding to different classification selectable lists

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

	$('#SE_BTN_BACK').button().click(function() {  //Back button on the ecological services
		
		goToPrevTab();  //disable tab 3, enable and select tab 2
		
	});
	
	$('#SE_BTN_NEXT').button().click(function() { // NEXT button on the ecological services tab
		
		$('.lists').hide();// hiding all of the seletables
		if(se_item){ // than only showing the one which conrresponds to the selected sevive ecologic
			$('#list'+se_item).show();
			$("#se_i").val(se_item); //ecological service id
			
			$("#se_name").val($("#"+se_item).text());
			goToNextTab(tabCounter);
		}
		else{
			alert("Aucune valeur n'a été sélectionnée"); //else give an error
		}
	});


	$('#TAB9_BTN_NEXT').button().click(function() {
		if(c_example && $('#newExample').val() != '' )  //did the user try to enter a new example AND select an existing example?
		{
			alert("SVP créer un nouvel exemple ou choissisez un des exemples!");
			$('#selectable'+c_item+' .ui-selected').removeClass('ui-selected'); //unselects the chosen example
			c_example = 0;  //0 means that there are no examples selected
			$('#newExample').val(""); //clear the text from the example textbox
		}
		else
		{
				if(userRole == "Participant" || userRole== "Unauthenticated" || userRole== "Externe")  //Is the user visiting this tab again?If so, then reset the counter
					if (tabCounter > 5)
						tabCounter=5;
					if(userRole == "Administration")
						if(tabCounter > 7)
							tabCounter=7;

			if(c_example)  //was one of the examples selected 
			{
				goToNextTab(tabCounter);
				$("#chosenExample").val($("#"+c_example).text());  //get the example for the database
			}
			else if( $('#newExample').val() != '')  //was the testbox used?
			{
				goToNextTab(tabCounter);
				$("#chosenExample").val($('#newExample').val());  //get the example for the database
			}
			else  //were there no examples given?
			{
				alert("Vous devez choisir un des exemples ou en créer un nouveau");
			}
		}

		$(".se_label").text("Service écologique: " + $("#se_i").val());  //show which ecological service the user chose

		$(".c_label").text("Classification: " + $("#c_i_val").val());  //show which classification the user chose

		$(".example_label").text("Example: " + $("#chosenExample").val());  //show which example the user chose

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
			
			goToNextTab(tabCounter);
			
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
		 	 	goToNextTab(tabCounter);
		 	 }
			else if (i_item && !i2_item)  //did the user only select a dependency and not an impact?
			{
				//go directly to the financial tab
				goToNextTab(tabCounter);
				goToNextTab(tabCounter);
			}
			else
			{
				tabCounter++;
				goToNextTab(tabCounter);
			}
		}
		else
			alert("S'il vous plaît sélectionnez une des options disponibles");	
	});

	$('#TAB11_BTN_BACK').button().click(function() {
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
			var url = "/evaluationbse/php/get_examples.php";
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

				goToNextTab(tabCounter);

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

	$('#BTN_RE_LEAVE, #BTN_RESTART').button().click(function() // retour to services ecologique
	{ 
		var self=$(this);
		event.preventDefault();
		the_user=$('#the_user').val();
		adminID = $('#AdminID').val();
		userRole = $('#userRole').val();
		the_report=$('#the_report').val();
		se_i=$("input[name='se_i']" ).val();
		se_name=$("input[name='se_name']" ).val();
		c_i=$("input[name='c_i']" ).val();
		c_i_val=$("input[name='c_i_val']" ).val();
		chosenExample=$("input[name='chosenExample']" ).val();
		inter=$("input[name='inter']" ).val();
		inter2=$("input[name='inter2']" ).val();
		riskOrOpp=$("input[name='riskOrOpp']" ).val();
		riskOrOpp2=$("input[name='riskOrOpp2']" ).val();
		interdependanceAverage=$("input[name='interdependanceAverage']" ).val();
		interdependancePotential=$("input[name='interdependancePotential']" ).val();
		hiddenImpactAverage=$("input[name='hiddenImpactAverage']" ).val();
		hiddenImpactPotential=$("input[name='hiddenImpactPotential']" ).val();
		gotMoney=$("input[name='gotMoney']").val();
		typeOfMoney=$("input[name='typeOfMoney']" ).val();
		qualifyImpact=$("input[name='qualifyImpact']" ).val();
		niveauDependance=$("input[name='niveauDependance']" ).val();
		niveauImpact=$("input[name='niveauImpact']" ).val();
		impact_txt=$("#impact_txt" ).val();
		dep_txt=$("#dep_txt" ).val();

	$.post("http://quebio.ca/evaluationbse/php/formSubmit.php", {adminid: adminID, the_report: the_report, the_user: the_user, se_i: se_i, se_name: se_name, c_i: c_i, c_i_val: c_i_val, chosenExample: chosenExample, inter: inter, inter2: inter2, riskOrOpp: riskOrOpp, riskOrOpp2: riskOrOpp2, interdependanceAverage: interdependanceAverage, interdependancePotential: interdependancePotential, hiddenImpactAverage: hiddenImpactAverage, hiddenImpactPotential: hiddenImpactPotential, gotMoney: gotMoney, typeOfMoney: typeOfMoney, qualifyImpact: qualifyImpact, niveauDependance: niveauDependance, niveauImpact: niveauImpact, impact_txt: impact_txt, dep_txt: dep_txt}, function(data) { 
		if (self.attr('id')=="BTN_RE_LEAVE"){
			$( '#info a' ).trigger('click');
		}else{
			$( '#entreprisetab a' ).trigger('click');
		}
	}
	)

	});

	$('#submit').button().click(function() {  //submit to the database
		examplesCounter++;
		$("#numOfExamples").val(examplesCounter.val());
	}); 

	$('#LAST_BTN_BACK').button().click(function() { // on the last tab when the back button, it's removing all the HTML elements 
		event.preventDefault(); // preventing from doing a post back when the button is clicked

		goToPrevTab();

	});

	$('#impact_btn_next').button().click(function() { 
		$('#impact_txt').val("");

		if(!i2_item && i_item)  //do we go to the impact tab?
			tabCounter++;
		goToNextTab(tabCounter);

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
		goToPrevTab();
	});

	$('#after_impact_btn').button().click(function() { 
		if(userRole=='Externe'){ //Skip the monetary part for external evaluators
			goToNextTab(tabCounter);
		}
		goToNextTab(tabCounter);
		
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
			newDropDownDiv.html('<div style="float: left; width: 150px;">'+'<label>Nature d\'interdependance</label>'+'<br>'+
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
				'<select name="newTheEvalu' + newCounter +'" title="Accordez une importance a votre exemple ou 1 est très bas et 10 est une trés haut"  >'+
				'<option name="newTheEvalu' + newCounter +'" value="1">1</option>'+
				'<option name="newTheEvalu' + newCounter +'" value="2">2</option>'+
				'<option name="newTheEvalu' + newCounter +'" value="3">3</option>'+
				'<option name="newTheEvalu' + newCounter +'" value="4">4</option>'+
				'<option name="newTheEvalu' + newCounter +'" value="5">5</option>'+
				'</select>'+'</div>');


			newSDDiv.html('<div style="float: left; width: 75px;">'+'<br>'+'<label title="TODO">0</label>'+'</div>');


			newSelect2Div.html('<div style="float: left; width: 100px;">'+'<br>'+
				'<select name="newTheMoney' + newCounter +'" title="Accordez une importance monétaire ou 1 est très bas et 10 est une trés haut" >'+
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
			'<select name="exiTheEvalu' + exiCounter +'" title="Accordez une importance à votre exemple ou 1 est très bas et 10 est un très élevé" >'+
			'<option name="exiTheEvalu' + exiCounter +'" value="1">1</option>'+
			'<option name="exiTheEvalu' + exiCounter +'" value="2">2</option>'+
			'<option name="exiTheEvalu' + exiCounter +'" value="3">3</option>'+
			'<option name="exiTheEvalu' + exiCounter +'" value="4">4</option>'+
			'<option name="exiTheEvalu' + exiCounter +'" value="5">5</option>'+
			'</select>'+'</div>');


		newSDDiv.html('<div style="float: left; width: 75px;">'+'<br>'+'<label title="TODO">0</label>'+'</div>');


		newSelect2Div.html('<div style="float: left; width: 100px;">'+'<br>'+
			'<select name="exiTheMoney' + exiCouncter +'" title="Accordez une importance monétaire ou 1 est très bas et 10 est un très élevé" >'+
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

			goToNextTab(tabCounter);
		}
		else
			alert("S'il vous plaît sélectionnez une des options disponibles!");
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

	if (userRole == 'Externe'){
		goToNextTab(tabCounter);
	}else{
		if((i_item && !n_item) || (i2_item && !n2_item))  //is the user selecting the available selectable lists?
		{
			alert("SVP choisissez une de ses Opportunité/risques et leur nature!");
		}
		else
		{
			goToNextTab(tabCounter);
		}
	}

	});

	$('#data_back_btn').button().click(function() {
		goToPrevTab();
	});

	$(function() { 
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
}

function admin_tab() {
		$("#selectableadmin").selectable({ // Creates a Selectable List And Allows Only For The Selection of a Single Element.
			selected: function(event, ui) { 
				$(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");
				$( ".ui-selected", this ).each(function() {
					idd=$(this).attr("id");
				$('#the_report').val(idd); // Set The Report ID in a Hidden Field at The Bottom of The Page
			});
			},
			unselecting: function(event, ui) {
				$('#selectableadmin .ui-selected').removeClass('ui-selected');
				$('#the_report').value = null;
			}
		});

		$('#create_report').button().click(function() { // The Report Creation Button.
			$("#parametertab a").trigger('click');
		});


		$('#edit_report').button().click(function() { // Edit Report Button.
			var reportID = $('#the_report').val(); // Get The Current Selected Report ID From The Hidden Field at The Bottome of The Page.

			if (reportID === "")  //did the user not select any report?
			{
				alert("Sélectionnez un rapport");
			}
			else
			{
			$('#firstTime').val('no');

			var active = $('#tabs').tabs('option', 'active');
			$( "#tabs" ).tabs('enable', active+1)
			$( "#tabs" ).tabs({ active: active+1 });
			$( "#tabs" ).tabs('disable',active );
			$("#parametertab a").trigger('click');

			$.get("http://www.quebio.ca/evaluationbse/php/get_edit_data.php", { reportId: reportID , userId: $('#AdminID').val()}, 
				function(editData){
					//var editData = JSON.parse(data);
				//set the data was already inserted into the database
				$('#nameEval').val(editData.evalName);
				$('#orgEval').val(editData.orgname);
				$('#objectiveText').val(editData.objective);
				$('#limitText').val(editData.limits);
				$('#geography').val(editData.perimeter);
				Drupal.behaviors.diagbio_map.readGeoJSON();
				if(editData.pre_circonscription == 'Opérationnel')
				{
					$( "#cir1" ).prop( "checked", true );
					$("#sites1").show();
					if (editData.circonscription == 'site')
						$("#sites1").val("site");
					if (editData.circonscription == 'ensemble site')
						$("#sites1").val("ensemble site");
					if (editData.circonscription == 'groupe')
						$("#sites1").val("groupe");
				}
				if (editData.pre_circonscription == 'Spatial')
				{
					$( "#cir2" ).prop( "checked", true );
					$("#sites2").show();
					if (editData.circonscription == 'province')
						$("#sites2").val("province");
					if (editData.circonscription == 'region')
						$("#sites2").val("region");
					if (editData.circonscription == 'commune')
						$("#sites2").val("commune");
					if (editData.circonscription == 'site')
						$("#sites2").val("site");
				}
				if (editData.pre_circonscription == 'Intrant')
				{
					$( "#cir3" ).prop( "checked", true );
					$("#sites3").show();
					if (editData.circonscription == 'approvisionnements')
						$("#sites3").val("approvisionnements");
					if (editData.circonscription == 'exportations')
						$("#sites3").val("exportations");
				}

				$('#sysRep').val(editData.represent); 

				if (editData.fonction == 'principales') 
					$( "#sysFunc1" ).prop( "checked", true );
				if (editData.fonction == 'secondaires') 
					$( "#sysFunc2" ).prop( "checked", true );

				$('#hidden_text').show();
				$('#funcTxt').val(editData.function_text); 

				if (editData.niveau1 != 'null')
				{
					$( "#niveau1" ).prop( "checked", true );
				}

				if (editData.niveau2 != 'null')
				{
					$( "#niveau2" ).prop( "checked", true );
				}

				if (editData.niveau3 != 'null')
				{
					$('#hideList').show();

					$( "#niveau3" ).prop( "checked", true );
					
					if(editData.externe == 'habitants')
						$( "#externe1" ).prop( "checked", true );
					else if(editData.externe == 'autre organisation')
						$( "#externe2" ).prop( "checked", true );
					else if(editData.externe == 'gouvernement')
						$( "#externe3" ).prop( "checked", true );
					else if(editData.externe == 'agence')
						$( "#externe4" ).prop( "checked", true );
					else if(editData.externe == 'ong')
						$( "#externe5" ).prop( "checked", true );
					else
					{
						$( "#externe6" ).prop( "checked", true );
						$('#externeInput').removeClass("hide");
						$('#externeInput').addClass("show");
						$("#externeInput").prop('disabled',false);
						$('#externeInput').val(editData.externe);
					}
				}
			});
			}
		});

		$('#delete_report').button().click(function() { // Create The Report Deletion Button.
			var reportID = $('#select-resultadmin').value; // Get The Current Selected Report ID From The Hidden Field at The Bottome of The Page.
			var missingFields = "";
			var deleteReport = 'yes';

			if ( reportID == "" || reportID == null ){ // Make Sure a Valid Report ID is Available.
			missingFields += "No report were selected.\n";
			}
			if ( missingFields=="" ){
			if ( confirm("Are you sure you wish to delete this report?") ) // Prompt For Confirmation Incase of a Miss-click.
			// Call The Rapport.php to do The Report Deletion And Refresh The Page on Finish TO Show The Updated Report List.
			$.post("http://quebio.ca/evaluationbse/php/rapport.php", { deleteRep: deleteReport, reportid: reportID}, function(data) { alert(data); window.location.reload(); window.location.replace("http://quebio.ca/entreprisebio/#tab4");});
			}
			else{
			alert(missingFields); // Alert User Regarding The Missing Report ID.
			}
		});

		$('#view_report').button().click(function() { // Create The View Report Button.

			var adminID = $('#AdminID').val();
			var reportID = $('#the_report').val();

			var missingFields = "";

			if ( reportID=="" || reportID==null ){ // Make Sure a Valid Report ID is Available.
				missingFields += "No report were selected.\n";
			}

			if ( missingFields=="" ){
				$.post("http://quebio.ca/evaluationbse/php/getAdminInfo.php", {adminid: adminID, reportid: reportID}, function(data) { 
					alert(data);
					//$('#ajax').style.visibility = 'visible';
					//var adminInfo = JSON.parse(data);
					var adminInfo = data;
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
				text: 'Les Dépendances avérées',
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
				name: 'Dépendances avérées',
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
			url: 'http://quebio.ca/evaluationbse/php/hcexport.php',
			async: false,
			success: function(data){
		 	$.post("http://quebio.ca/evaluationbse/php/report.php", { reportInfo: adminInfo}, function(data) { $('#ajax').style.visibility = 'hidden'; window.location.replace("http://quebio.ca/evaluationbse/php/rapport.pdf")}); // After Successfully Creating The .PNG Send The User To The PDF Generation Script.
		 }
		});	
		});
		}
		else{
								alert(missingFields); // Alert User Regarding The Missing Report ID.
			}
		});
		$('#viewable_report').button().click(function() { // Create View Switching Button.
			var reportID = $('#select-resultadmin').value;
			var missingFields = "";

			if ( reportID=="" || reportID=="" ){ // Make Sure a Valid Report ID is Available.
				missingFields += "No report were selected.\n";
			}
			if ( missingFields=="" ){
				// Call The Rapport.php to Invert The Current View Of The Selected Report (Admin Only or All Users).
				$.post("http://quebio.ca/evaluationbse/php/rapport.php", { reportid: reportID, viewable: 1}, function(data) {alert(data)});
			}
			else{
				alert(missingFields); // Alert User Regarding The Missing Report ID.
			}
		});
		$('#submit_email').button().click(function() {
			var emailRecipient = $('#recipient').val(); // Get E-Mails.
			var information = $('#information').val(); // Get Extra Details to Append to The Emails.
			var reportID = $('#the_report').val(); // Get Report ID to Link to.
			var organisationName = $('#OrgaName').val(); // Get The Organisation Name From The Drupal PHP Profile2 Fields.
			var missingFields = "";
			var adminId = $('#AdminID').val();


			if ( emailRecipient=="" || emailRecipient==null){ // Make Sure a E-mail Was Entered (Let Drupal_mail() see if it's valid of not).
				missingFields += "Veuillez enter au moins une adresse courriel.\n";
		}
			if ( reportID=="" ){ // Make Sure a Valid Report ID is Available.
				missingFields += "Aucun rapport n'a été sélectionné.\n";
			}
			if ( missingFields=="" ){
				// Call The Email.php to Send Out The E-mail Invitations Including all The Information We Appended.
				$.post("http://quebio.ca/evaluationbse/php/email.php", {reportID: reportID, information: information, orgname: organisationName, toEmail: emailRecipient, userid: adminId}, function(data) { alert(data); });
			}
			else{
				alert(missingFields);// Alert User Regarding The Missing Report ID or E-mail Addresses.
			}
		});
}

function create_evaluation_tab() {
		$('#parametertab').show();
		Drupal.behaviors.diagbio_map.diagbio_mode='edit';
		Drupal.behaviors.diagbio_map.geography = $("input[name='geography']");
		Drupal.behaviors.diagbio_map.clearOverlays();
		Drupal.behaviors.diagbio_map.attachEvents();
		$.when( Drupal.behaviors.diagbio_map.createMap('map') ).done(function() {
			google.maps.event.trigger(Drupal.behaviors.diagbio_map.map, "resize");
		});
		$('#TAB14_BTN_BACK').button().click(function() {
			var active = $('#tabs').tabs('option', 'active');
			$( "#tabs" ).tabs('enable', active-1);
			$( "#tabs" ).tabs({ active: active-1 });
			$( "#tabs" ).tabs( 'disable',active );
			$( "#admintools a").trigger("click");
			$('#parametertab').hide();
		});
		$('#TAB14_CREATE_BTN').button().click(function() { 
			$('#parametertab').hide();
			var errorMessage = "";  //keeps track of fields the user didn't fill in
			if ($('#nameEval').val() == "") 
				errorMessage += "Indiquez le nom d'évaluation! "; 
			if ($('#orgEval').val() == "") 
				errorMessage += "Indiquez le nom de l'organisation! "; 
			if($('#objectiveText').val() == "")
				errorMessage+="Indiquez l'objectif! "
			if($('#defineText').val() == "")
				errorMessage+="Indiquez la définition! "
			if($('#limitText').val() == "")
				errorMessage+="Indiquez les limites! "
			if(!$('input[name=cir1]:checked').val() && !$('input[name=cir2]:checked').val() && !$('input[name=cir3]:checked').val())
				errorMessage+="Indiquez le circonscription du périmètre d’analyse! "
			if(!$('input[name=sysFunc1]:checked').val() && !$('input[name=sysFunc2]:checked').val())
				errorMessage+="Indiquez le fonction du système! "
			if(!$('input[name=niveau1]:checked').val() && !$('input[name=niveau2]:checked').val() && !$('input[name=niveau3]:checked').val())
				errorMessage+="Indiquez le niveau d’évaluation! "
			if (errorMessage == "")  //did the user fill in all the fields?
			{
				var circonscription = "";
				var cir = "";
				var niveau1 = "";
				var niveau2 = "";
				var niveau3 = "";
				if ($('input[name=cir1]:checked').val()) 
				{ 	
					circonscription = $('#sites1').val();
					cir = $('input[name=cir1]:checked').val();
				};

				if ($('input[name=cir2]:checked').val()) 
				{ 
					circonscription = $('#sites2').val();
					cir = $('input[name=cir2]:checked').val();
				};

				if ($('input[name=cir3]:checked').val()) 
				{ 
					circonscription = $('#sites3').val();
					cir = $('input[name=cir3]:checked').val();
				};

				if ($('input[name=sysFunc1]:checked').val()) 
				{
					sysFunc = $('input[name=sysFunc1]:checked').val();
				}
				
				if ($('input[name=sysFunc2]:checked').val()) 
				{
					sysFunc = $('input[name=sysFunc2]:checked').val();
				}

				if ($('input[name=niveau1]:checked').val()) 
				{
					niveau1 = $('input[name=niveau1]:checked').val();
				};

				if ($('input[name=niveau2]:checked').val()) 
				{
					niveau2 += $('input[name=niveau2]:checked').val();
				};

				externe = "";

				if ($('input[name=niveau3]:checked').val()) 
				{
					niveau3 = $('input[name=niveau3]:checked').val();
					
					if ($('input[name=externe]:checked').val()) 
						externe = $('input[name=externe]:checked').val();
					
					if (externe == 'autre') 
						externe = $('#externeInput').val(); 	
				};

			if (externe == '' && $('input[name=niveau3]:checked').val())  //is the textbox externeInput empty?
			{
				alert('Aucune valeur choisie ou texte entré!');
			}
			else{
				var reportID = $('#select-resultadmin').value;
					var firstTime = $('#firstTime').val();  //determines whether the user is editing or creating an evaluation
					goToPrevTab();
					AdID=$('#AdminID').val();  //gets the administrator's ID
					var organisationName = $('#orgEval').val(); // Get The Organisation Name
					//gets the file through the url, the next paramteer is the data being sent in for the file to se and then finally the last paramter
					//is doing soemthing in a function as a response, in this case it would be calling another ajax post  
					$.post("http://www.quebio.ca/evaluationbse/php/rapport.php", { orgsname: organisationName, adminid: AdID, userid: $('#the_user').val(), nameEval: $('#nameEval').val(), createOrEdit: firstTime, reportid: reportID}, function(data) {alert(data);
							//var insertData = JSON.parse(data);
							//alert(insertData);
							$.post("http://www.quebio.ca/evaluationbse/php/insertParameter.php", { objectiveText: $('#objectiveText').val(), limitText: $('#limitText').val(), 
								cir: circonscription, preCir: cir, represent: $('#sysRep').val(), fonction: sysFunc, perimeter: $('#geography').val(),
								niv1: niveau1, niv2: niveau2, niv3: niveau3, funcTxt: $('#funcTxt').val(),reportid: reportID, newReportid: data, userid: AdID, Externe: externe, createOrEdit: firstTime}, function(data){
							// Call The Rapport.php to do The Report Creating And Refresh The Page on Finish To Show The New Report.
										$("#admintools a").trigger("click")
							});
						});
				}
			}
			else{
				alert(errorMessage);
			}
		});
}

})(jQuery); 