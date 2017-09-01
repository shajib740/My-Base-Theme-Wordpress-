<?php
  
  // how to use

//     extract(pranon_base_split_option(array(
//         'listing_menu_type'  => array('', 'opt-switch-page'),
//     )));


    // extract(pranon_base_split_option(array(
    //     'listing_menu_type'  => array('transparent', 'opt-checkbox'),
    // )));


  if(!function_exists('pranon_base_split_option')) {
    function pranon_base_split_option($helper) {
      foreach ($helper as $option_key => $option_fallback) {
        if(is_array($option_fallback)){
          $fallback         = $option_fallback[0];
          $main_key         = array_key_exists(1, $option_fallback) ? $option_fallback[1] : '';
          $sub_key        = array_key_exists(2, $option_fallback) ? $option_fallback[2] : '';
          $helper[$option_key]  =  pranon_base_option($main_key, $fallback, $sub_key);
        }else{
          $helper[$option_key]  =  pranon_base_option($option_key, $option_fallback, '');
        }
      }

      return $helper;
    }
  }

  if (!function_exists('pranon_base_option')) {
    function pranon_base_option($key, $fallback, $sub_key=''){
      $option_data = pranon_helper_get_option_data();
      if(!empty($sub_key)){
        if (isset($option_data[$key][$sub_key]) && !empty($option_data[$key][$sub_key])){
          return $option_data[$key][$sub_key];
        }
      }else{
        if (isset($option_data[$key]) && !empty($option_data[$key])){
          return $option_data[$key];
        }
      }
      return $fallback;
    }
  }

  if (!function_exists('pranon_helper_get_option_data')) {
    function pranon_helper_get_option_data(){      
      $pranon_option_data = get_option('pranon_base_opt');
      return $pranon_option_data;
    }
  }