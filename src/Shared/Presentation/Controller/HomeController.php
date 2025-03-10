<?php
declare(strict_types=1);

namespace App\Shared\Presentation\Controller;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Created by Papa COUNDIA on 09/03/2025
 * @author: pcoundia
 * @date: 09/03/2025
 * @email: papacoundia@gmail.com
 */
class HomeController extends BaseController{

	#[Route('/', name: 'home')]
	public function index(){
		return $this->render('home/index.html.twig');
	}

}