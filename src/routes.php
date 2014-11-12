<?php
 
Route::controller('tenant/', 'TenantController', [
	'getChose' => 'multitenant.chose',
	'getApply' => 'multitenant.apply',
]);