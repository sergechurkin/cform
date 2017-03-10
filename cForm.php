<?php

namespace sergechurkin\cform;

class cForm
{
    public $dircss = './css/';

    private function bldButtons($buttons) {
        echo '<div class="btn-toolbar">'."\n";
        foreach ($buttons as $key=>$button) {
            if ($button[1] !== 'submit') {
                if (strripos($button[3], '/') !== false) {
                    $txt = '"document.location.href=';
                    $txt1 = '\'';
                } else {
                    $txt = '"';
                    $txt1 = '';
                }
                echo '<button id="button' . $key . '" type = "' . $button[1] . '" class = "' . $button[2] . '" onclick=' . $txt . $txt1 . $button[3] . $txt1 . ';">' . $button[0] . '</button>'."\n";
            } else {
                echo '<button type = "' . $button[1] . '" class = "' . $button[2] . '" >' . $button[0] . '</button>'."\n";
            }
        }
        echo '</div>'."\n";
    }
    
    public function bldHeader($tytle) {
        echo '<!DOCTYPE html>' . "\n";
        echo '<html lang="ru">' . "\n";
        echo '<head>' . "\n";
        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />' . "\n";
        echo '<title>' . $tytle . '</title>' . "\n";
        echo '<link href="' . $this->dircss . 'bootstrap.css" rel="stylesheet">' . "\n";
        echo '</head>' . "\n";
        echo '<body>' . "\n";
        
    }
    public function bldFutter($txt = '') {
        if ($txt !== '') {
            echo '<p>'."\n";        
            echo '<footer class="panel-footer navbar-fixed-bottom row-fluid">'."\n";
            echo '<p class="text-muted">' . $txt . '</p>'."\n";
            echo '</footer>'."\n";        
        }    
        echo '</body>'."\n";
        echo '</html>'."\n";
    }
    /*
     * $menu = [['Имя', 'class(active)', 'url'], [...]];
     * $menuridht = ['Имя', 'class(active)', 'url'];
     */
    public function bldMenu($menu, $menuridht) {
        echo '<nav role="navigation" class="navbar navbar-default">'."\n";
        echo '  <!-- Brand and toggle get grouped for better mobile display -->'."\n";
        echo '  <div class="navbar-header">'."\n";
        echo '    <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">'."\n";
        echo '      <span class="sr-only">Toggle navigation</span>'."\n";
        echo '      <span class="icon-bar"></span>'."\n";
        echo '      <span class="icon-bar"></span>'."\n";
        echo '      <span class="icon-bar"></span>'."\n";
        echo '    </button>'."\n";
        echo '    <a href="./" class="navbar-brand">Мой сайт</a>'."\n";
        echo '  </div>'."\n";
        echo '  <!-- Collection of nav links, forms, and other content for toggling -->'."\n";
        echo '  <div id="navbarCollapse" class="collapse navbar-collapse">'."\n";
        echo '    <ul class="nav navbar-nav">'."\n";
        foreach($menu as $key=>$m) {
            echo '<li class="' . $m[1] . '"><a href="' . $m[2] . '">' . $m[0] . '</a></li>'."\n";
        }
        echo '    </ul>'."\n";
        echo '    <ul class="nav navbar-nav navbar-right">'."\n";
        echo '<li class="' . $menuridht[1] . '"><a href="' . $menuridht[2] . '">' . $menuridht[0] . '</a></li>'."\n";
        echo '    </ul>'."\n";
        echo '  </div>'."\n";
        echo '</nav>'."\n";
    }
    /*
     * $fields[]  = [lsbel, lsbelwidth, name, namewidth, type, value, errormessage, readonly]
     * $buttons[] = ['Отмена', 'button', 'btn btn-default', './'];
     */
    public function bldForm( $tytle, $tytleform, $width, $fields, $buttons, $stringOnly = false) {
        $widthlr = (12 - $width) / 2;
        echo '<div class="container">'."\n";
        echo ' <div class="row row-offcanvas row-offcanvas-center">'."\n";
        if (!empty($tytle)) {
            echo ' <div class="col-xs-12 col-sm-12 col-md-12"><h3 align="center">' . $tytle . '</h3></div>'."\n";
        }    
        echo ' <div class="col-xs-' . $widthlr . ' col-sm-' . $widthlr . ' col-md-' . $widthlr . '"></div>' . "\n";
        echo '  <div class="col-xs-' . $width . ' col-sm-' . $width . ' col-md-' . $width . '">' . "\n";
        echo '   <div class="panel panel-info">'."\n";
        echo '    <div class="panel-heading">'."\n";
        echo $tytleform . "\n";
        echo '    </div>'."\n";
        echo '    <div class="panel-body">'."\n";
        echo '     <form class="form-horizontal" action="" method="post" onSubmit="">'."\n";
        echo '     <input type="hidden" name="action" value="validate">'."\n";
        foreach ($fields as $key=>$field) {
            if (!$stringOnly) {
                 echo '<div class="form-group row"' . ((mb_substr($field[7], 0, 6) == 'hidden') ? (' ' . $field[7]) : '') . '>'."\n";
            }     
            if(count($field[0]) > 1) {
                $label = $field[0][0] . $field[0][1];
            } elseif(isset($field[0])) {
                $label = $field[0];
            } else {
                $label = '';
            }    
            echo '<label for="' . $field[2] . '" class="col-sm-' . $field[1] . ' control-label">' . $label . '</label>'."\n";
            echo '<div class="col-sm-' . $field[3] . '  ' . ((!empty($field[6]))? 'has-error' : '') . '">'."\n";
            if ($field[4] == 'textarea') {
               echo '<textarea name="body" class="form-control" rows="5" ' . $field[7] . '>' . $field[5] . '</textarea>'."\n";
            } else {    
                if ($field[4] !== 'checkbox') {
                    echo '<input type="' . $field[4] . '" class="form-control" id="' . $field[2] . '" name="' . $field[2] . '" value="' . $field[5] . '" ' . $field[7] . (($key == 0) ? ' autofocus' : '') . '>'."\n";
                } else {
                    echo '<input type="' . $field[4] . '" class="form-control" id="' . $field[2] . '" name="' . $field[2] . '" value="' . 'checked' . '" ' . $field[7] . (($key == 0) ? ' autofocus' : '') . ' ' . $field[5] . '>'."\n";
                }
            }
            echo '<div class="help-block with-errors">' . $field[6] . '</div>'."\n";
            echo '</div>'."\n";
            if (!$stringOnly) {
                echo '</div>'."\n";
            }    
        }
        $this->bldButtons($buttons);
        echo '     </form>'."\n";
        echo '    </div>'."\n";
        echo '   </div>'."\n";
        echo '  </div>'."\n";
        echo ' </div>'."\n";
        echo '</div>'."\n";

    }
    /*
     * $fields[]  = [['Имя', 'name',],...];
     * $buttons[] = ['Отмена', 'button', 'btn btn-default', './'];
     */
    public function bldTable($tytle, $tytleform, $width, $fields, $rows, $buttons, 
                             $count_entrys, $entry_on_page, $current_page, $max_pages_list,
                             $numup, $numto, $url = './?', $lsort = false, $sort = 0) {
        if (empty($rows)) {
            $this->bldMessage(2, 'Таблица пустая');
            return;
        }
        $widthlr = (12 - $width) / 2;
        echo '<div class="container">' . "\n";
        echo ' <div class="row row-offcanvas row-offcanvas-center">' . "\n";
        if (!empty($tytle)) {
            echo ' <div class="col-xs-12 col-sm-12 col-md-12"><h3 align="center">' . $tytle . '</h3></div>' . "\n";
        }
        echo ' <div class="col-xs-' . $widthlr . ' col-sm-' . $widthlr . ' col-md-' . $widthlr . '"></div>' . "\n";
        echo '  <div class="col-xs-' . $width . ' col-sm-' . $width . ' col-md-' . $width . '">' . "\n";
        echo '   <div class="panel panel-info">' . "\n";
        echo '    <div class="panel-heading">' . "\n";
        echo $tytleform . "\n";
        echo '    </div>' . "\n";
        echo '    <div class="panel-body">' . "\n";
        echo '<table class="table table-striped table-bordered">' . "\n";
        echo '<thead>' . "\n";
        echo '<tr>' . "\n";
        foreach($fields as $key=>$field) {
            if (!$lsort) {
                $txt1 = '';
                $txt2 = '';
            } else {
                $url1 = $url . 'sort=' . $key;
                $url2 = $url . 'sort=' . $sort;
                $txt1 = '<a href="' . $url1 . '">';
                $txt2 = '</a>';
            }
            echo '<th>' . $txt1 . $field . $txt2 . '</th>' . "\n";
        }
        if (isset($url2)) {
            $url = $url2 . '&';
        }
        echo '</tr>' . "\n";
        echo '</thead>' . "\n";
        echo '<tbody>' . "\n";
        foreach($rows as $key=>$row){
            echo '<tr>' . "\n";
            foreach($row as $k=>$r){
                echo '<td>' . $r . '</td>' . "\n";
            }
            echo '</tr>' . "\n";
        }
        echo '</tbody>' . "\n";
        echo '</table>' . "\n";
        if ($numup !== $numto) {
            echo 'Строки с ' . $numup . ' по ' . $numto . ', всего ' . $count_entrys . "\n";
        } else {
            echo 'Строка ' . $numup . ', всего ' . $count_entrys . "\n";
        }
        if ($max_pages_list > 0 && $count_entrys > $entry_on_page) {
            $this->bldPaginator($count_entrys, $entry_on_page, $current_page, $max_pages_list, $url);
        }    
        $this->bldButtons($buttons);
        echo '    </div>' . "\n";
        echo '   </div>' . "\n";
        echo '  </div>' . "\n";
        echo ' </div>' . "\n";
        echo '</div>' . "\n";
    }

    public function bldPaginator($count_entrys, $entry_on_page, $current_page, $max_pages_list, $url) {
        echo '<nav aria-label = "Page navigation">' . "\n";
        echo '<ul class = "pagination">' . "\n";
        echo '<li>' . "\n";
        echo '<a href = "' . $url . 'current_page=' . '1' . '" aria-label = "Previous">' . "\n";
        echo '<span aria-hidden = "true">&laquo;' . "\n";
        echo '</span>' . "\n";
        echo '</a>' . "\n";
        echo '</li >' . "\n";
            
        $count_pages = ceil($count_entrys / $entry_on_page);
        $first_page = $current_page - (int) ($max_pages_list / 2);
        if ($first_page <= 1) {
            $first_page = 1;
        }
        else {
            if ($count_pages - $first_page < $max_pages_list) {
                $first_page = $count_pages - $max_pages_list + 1;
                if ($first_page <= 1) {
                    $first_page = 1;
                }    
            }
        }
        $last_page = $first_page + $max_pages_list - 1;
        if ($last_page > $count_pages) {
            $last_page = $count_pages;
        }
        for ($i = $first_page; $i <= $last_page; $i++) {
            echo '<li ' . (($i == $current_page) ? 'class="active"' : '') .
                 '><a href="' . $url . 'current_page=' . $i . '">' . $i . '</a></li>' . "\n";
        }
        echo '<li>' . "\n";
        echo '<a href = "' . $url . 'current_page=' . $count_pages . '" aria-label = "Next">' . "\n";
        echo '<span aria-hidden = "true">&raquo;' . "\n";
        echo '</span>' . "\n";
        echo '</a>' . "\n";
        echo '</li>' . "\n";
        echo '</ul>' . "\n";
        echo '</nav>' . "\n";
    }
    public function bldMessage($ntype, $txt) {
        $ctype[0] = 'success';
        $ctype[1] = 'warning';
        $ctype[2] = 'danger';
        echo '<div id="mess" class="alert alert-' . $ctype[$ntype] . '" onclick="document.getElementById(\'mess\').remove();">' . "\n";
        echo '<a href="#" class="close" data-dismiss="alert">×</a>' . "\n";
        echo $txt . "\n";
        echo '</div>' . "\n";
    }
    public function bldImg($img) {
        echo '<a class="logo" href="./" ><img alt="Схема БД" src="' . $img . '" title="Схема БД" /></a>' . "\n";
    }
}
