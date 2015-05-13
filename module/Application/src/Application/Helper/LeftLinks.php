<?php
/**
 * Created by PhpStorm.
 * User: otavio
 * Date: 5/13/15
 * Time: 1:01 PM
 */

namespace Application\Helper;


use Zend\View\Helper\AbstractHelper;

class LeftLinks extends AbstractHelper {
    public function __invoke($values, $urlPrefix){
        $li = [];
        foreach ($values as $item){
            $li[] = '<li> <a href="'.$urlPrefix.'/'.$item.'">'.$item.'</a>';
        }
        return '<ul>'. implode('',$li).'</ul>';
    }
}