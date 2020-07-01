<?php defined('BASEPATH') or exit('No direct script access allowed');

render_datatable([
    _l('FirstName'),
    _l('LastName'),
   
    [
        'name'     => _l('payments_table_client_heading'),
        'th_attrs' => ['class' => (isset($client) ? 'not_visible' : '')],
    ],
  
], (isset($class) ? $class : 'paymentss'), [], [
    //'data-last-order-identifier' => 'payments',
   // 'data-default-order'         => get_table_last_order('payments'),
]);