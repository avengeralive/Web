<?php
if (isset($request->parameters['lq']['formrequest']) && $request->parameters['lq']['formrequest'] == "ajax")
{
    if(!isset($qbit_jquery_loaded)){
        $qbit_jquery_loaded = 1;

        echo '<script src="'.Backstage::gi()->EXTERNAL_URL.'jquery/jquery.js"></script>';
        echo '<script src="'.Backstage::gi()->VIEWS_URL.'common/js/app.js"></script>';
    }
}
echo $block;
