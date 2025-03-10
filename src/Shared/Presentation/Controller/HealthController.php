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
class HealthController extends BaseController{

	#[Route('/api/health', name: 'health', methods: ['GET'])]
	public function index(){
		return $this->json(
			[
				'status' => 'ok',
				'code' => 200,
				'message' => 'Health OK',
				'date' => date('Y-m-d H:i:s'),
				'APP_ENV' => $_ENV['APP_ENV'] ?? 'null',
				'DATABASE_NAME' =>  $_ENV['DATABASE_NAME'] ?? 'null',
			]);
	}

}