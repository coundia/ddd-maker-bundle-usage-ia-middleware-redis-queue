<?php
declare(strict_types=1);

namespace App\Core\Domain\UseCase;



interface ApiProvider{
	public function callApi( string $prompt): string;

}