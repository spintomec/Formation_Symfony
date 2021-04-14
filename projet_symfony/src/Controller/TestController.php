<?php 

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class TestController {

public function index(): Response {

$number = random_int(1,3);
$string = '';

if ($number == 1)
	$string = 'Pierre';
if ($number == 2)
	$string = 'Feuille';
if ($number == 3)
	$string = 'Ciseaux';

return new Response(
            '<html><body>Nombre: '.$number.'<br> <br>'.$string.'</body></html>'
        );
    }
}    