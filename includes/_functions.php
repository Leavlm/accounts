<?php
session_start();
require 'includes/_database.php';


//---------------------------
// ERROR OR CONFIRMATION MSG
//---------------------------

$msg = [
    'transSuccess' => 'Votre transaction a bien été ajouté.',
    'transFail' => 'L\'ajout de votre transaction a échoué',
    'tokenFail' => 'Le token est inconnu'
];

function displayMsg(array $array):string{
    $msgReceived = $_GET['msg'] ?? '';
    if (array_key_exists($msgReceived, $array)) {
        $html = '<div class="alert ';
        if(str_contains($msgReceived, 'Success')){
           $html .= 'alert-success"';
        }
        if(str_contains($msgReceived, 'Fail')){
           $html .= 'alert-danger"';
        }
        return $html .= ' role="alert">'.$array[$msgReceived].'</div>';
    }
    return '';
}


//---------
//SECURITY
//---------

function verifyToken()
{
    if (!array_key_exists('token', $_SESSION) || !array_key_exists('token', $_POST) || $_SESSION['token'] !== $_POST['token']) {
        header('location: add.php?msg=tokenFail');
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
                            <form >
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
};

