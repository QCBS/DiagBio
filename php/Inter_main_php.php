<?php
// This is The Default Drupal Login Block Form With The Links to Normal Account Registration Removed.
function user_login_bloc($form) {
	$form['#action'] = url(current_path(), array('query' => drupal_get_destination(), 'external' => FALSE));
	$form['#id'] = 'user-login-form';
	$form['#validate'] = user_login_default_validators();
	$form['#submit'][] = 'user_login_submit';
	$form['name'] = array(
		'#type' => 'textfield',
		'#title' => t('Username'),
		'#maxlength' => USERNAME_MAX_LENGTH,
		'#size' => 15,
		'#required' => TRUE,
		);
	$form['pass'] = array(
		'#type' => 'password',
		'#title' => t('Password'),
		'#size' => 15,
		'#required' => TRUE,
		);
	$form['actions'] = array('#type' => 'actions');
	$form['actions']['submit'] = array(
		'#type' => 'submit',
		'#value' => t('Log in'),
		);
	$items = array();
	return $form;
}
function getRole($data){
	if ( $data[6] != null ) {
		return "Administration";
	}else if ( $data[5] != null ) {
		return "Participant";
	}else if ( $data[7] != null ){
		return "Externe";
	}else{
		return "Unauthenticated";
	}
}

function mymodule_form_alter(&$form, &$form_state, $form_id){
	if ($form_id == "user_register_form") {
	  $form['account']['name']['#title'] = t('Full name');

	  $form['city'] = array(
	    '#type' => 'textfield', 
	    '#title' => t('City'),
	    '#size' => 15,
	    '#required' => TRUE,
	  );

	  $form['state'] = array(
	    '#type' => 'textfield', 
	    '#title' => t('State'),
	    '#size' => 15,
	    '#required' => TRUE,
	   );

	   $form['#submit'][] = 'hook_from_alter_submit';
	}

}

function mymodule_form_alter_submit($form, &$form_state) {
	$city = $form_state['values']['city'];
	$state = $form_state['values']['state'];
}

global $user;
$account = user_load($user->uid); // Load Temporary User with "Administration" Role.
$role = getRole($account->roles);
if ( $role == "Administration" ){
	$profile = profile2_load_by_user($account); // Load The Profile2 Data Associated to The User.
	$field = field_get_items('profile2', $profile['administration'], 'field_nom_de_l_organisation'); // Get The Organisation Name From the Profile2 Data.
}
?>