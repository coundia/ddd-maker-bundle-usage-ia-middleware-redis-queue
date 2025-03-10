<?php
declare(strict_types=1);

namespace App\Core\Infrastructure\HttpClient;
use App\Core\Domain\UseCase\ApiProvider;
use Symfony\Contracts\HttpClient\HttpClientInterface;

readonly class ApiProviderHuggingFace implements ApiProvider {


	public function __construct(
		private HttpClientInterface $httpClient,
	){
	}

	public function callApi(string $prompt): string{
		return $this->fakers($prompt);
		//return $this->callHuggingFace($prompt);
	}

	private function callHuggingFace(string $prompt): string
	{
		$response = $this->httpClient->request('POST', $_ENV['API_URI'], [
			'headers' => [
				'Authorization' => 'Bearer ' . $_ENV['API_KEY'],
				'Content-Type' => 'application/json',
			],
			'json' => ['inputs' => $prompt],
		]);

		$data = $response->toArray();
		return $data[0]['generated_text'] ?? 'No response';
	}

	private function fakers(String $prompt): String{
		return $prompt." this is a fake response";
	}
}