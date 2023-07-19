<?php

require 'includes/_database.php';

function verifyToken()
{
    if (!array_key_exists('myToken', $_SESSION) || !array_key_exists('token', $_REQUEST) || $_SESSION['myToken'] !== $_REQUEST['token']) {
        header('location: index.php?msg=wrongToken');
        exit;
    }
};

function verifyOrigin()
{
    if (!str_contains($_SERVER['HTTP_REFERER'], $_ENV['URL'])) {
        header('location: index.php?msg=originUnknown');
        exit;
    }
};


//--------------------------------
// GETTING DYNAMIC LIST LINK TO DB 
//--------------------------------

function getList(array $array): string
{
    $html = '';
    foreach ($array as $row) {
        $date = $row['date_transaction'];
        $date = str_replace('-', '/', $date);
        $name = $row['name'];
        $amount = $row['amount'];
        $idCat = $row['id_cat'];
        $idTransac = $row['id_transac'];
        $icnClass = $row['icon_class'];

        $html .= '<tr>
                            <td width="50" class="ps-3">';
        if ($idTransac == $idCat) {
            $html .= '<i class="bi bi-' . $icnClass . ' fs-3""></i>';
        }
        $html .= '
                            </td><td>';
        $html .= '<time datetime="' . $date . '" class="d-block fst-italic fw-light">' . $date . '</time>
                                ' . $name . '
                            </td>
                            <td class="text-end">';
        if ($amount > 0) {
            $html .= '<span class="rounded-pill text-nowrap bg-success-subtle px-2">';
        } else {
            $html .= '<span class="rounded-pill text-nowrap bg-warning-subtle px-2">';
        }
        $html .= $amount . '
                                </span>
                            </td>
                            <td class="text-end text-nowrap">
                                <a href="#" class="btn btn-outline-primary btn-sm rounded-circle">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>';
    }
    return $html;
}

getAmount