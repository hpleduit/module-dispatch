<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES., JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 3/9/2010 23:25
 */

if ( ! defined( 'NV_IS_MOD_CONGVAN' ) ) die( 'Stop!!!' );

global $module_data, $module_name, $module_file, $global_array_cat, $lang_module, $my_head, $db, $module_info;

$xtpl = new XTemplate( "block_hits.tpl", NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/" . $module_file );
$xtpl->assign( 'BASESITE', NV_BASE_SITEURL );
$xtpl->assign( 'LANG', $lang_module );

$sql = "SELECT id, alias, title, code FROM `" . NV_PREFIXLANG . "_" . $module_data . "_document`  ORDER BY `view` DESC, `id` DESC LIMIT 0 , 10";

$result = $db->query( $sql );
$chk_topview = $result->rowCount();

if ( $chk_topview )
{
    $i = 1;
    while ( $row = $result->fetch() )
    {
       
        $row['link'] = NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=detail/" . $row['alias'];
        
        $xtpl->assign( 'topviews', $row );
        $xtpl->parse( 'main.topviews.loop' );
    }
    $xtpl->parse( 'main.topviews' );
}


$xtpl->parse( 'main' );
$content = $xtpl->text( 'main' );

?>