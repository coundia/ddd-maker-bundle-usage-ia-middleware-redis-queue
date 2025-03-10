<?php

declare(strict_types=1);

namespace App\Core\Application\DTO;

use Symfony\Component\Serializer\Annotation\Groups;
use OpenApi\Attributes as OA;

abstract class PromptDTO
{
	public function __construct(
		#[Groups(['default'])]
		#[OA\Property(example: "Quel est l'impact du changement climatique sur l'agriculture ?")]
		public readonly ?string $prompt

	) {
	}
}
