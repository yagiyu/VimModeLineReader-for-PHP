<?php

function modeline($modeline, $range = 5) {
    $modeline = explode("\n", $modeline);
    array_splice($modeline, $range, - $range);
    $modeline = implode("\n", $modeline);

    $modeline = preg_split('/\s(vim?|ex): */', $modeline);
    if (count($modeline) == 1) return NULL;
    $modeline = $modeline[1];
    if (preg_match('/^set? /', $modeline)) {
        $modeline = preg_replace('/^set? /', '', $modeline);
        $modeline = explode("\n", $modeline);
        $modeline = explode(':', $modeline[0]);
        $modeline = explode(' ', $modeline[0]);
    } else {
        $modeline = explode("\n", $modeline);
        $modeline = preg_split('/[ :]+/', $modeline[0]);
    }

    $mode = array();
    foreach($modeline as $option) {
        $option = explode('=', trim($option));
        if (count($option) == 1)
            $mode[$option[0]] = TRUE;
        else
            $mode[$option[0]] = $option[1];
    }

    return $mode;
}
