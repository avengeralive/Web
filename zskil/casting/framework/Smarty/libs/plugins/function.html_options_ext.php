<?php
/**
MACROS FOR CODE:

{section name=index loop=$o_type}
{if $o_type[index].value == $selected.o_type}
<option value="{$o_type[index].value}" selected=”selected”>{$o_type[index].html}</option>
{else}
<option value="{$o_type[index].value}">{$o_type[index].html}</option>
{/if}
{/section}
 */
function smarty_function_options_ext($params, $template)
{
    static $counters = array();

    $name = (isset($params['name'])) ? $params['name'] : 'default';
    if (!isset($counters[$name])) {
        $counters[$name] = array(
            'start'=>1,
            'skip'=>1,
            'direction'=>'up',
            'count'=>1
            );
    }
    $counter =& $counters[$name];

    if (isset($params['start'])) {
        $counter['start'] = $counter['count'] = (int)$params['start'];
    }

    if (!empty($params['assign'])) {
        $counter['assign'] = $params['assign'];
    }

    if (isset($counter['assign'])) {
        $template->assign($counter['assign'], $counter['count']);
    }
    
    if (isset($params['print'])) {
        $print = (bool)$params['print'];
    } else {
        $print = empty($counter['assign']);
    }

    if ($print) {
        $retval = $counter['count'];
    } else {
        $retval = null;
    }

    if (isset($params['skip'])) {
        $counter['skip'] = $params['skip'];
    }
    
    if (isset($params['direction'])) {
        $counter['direction'] = $params['direction'];
    }

    if ($counter['direction'] == "down")
        $counter['count'] -= $counter['skip'];
    else
        $counter['count'] += $counter['skip'];
    
    return $retval;
    
}

?>