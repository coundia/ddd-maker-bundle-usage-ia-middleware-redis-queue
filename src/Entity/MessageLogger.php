<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Guid\Guid;

#[ORM\Entity]
#[ORM\Table(name: 'message_loggers')]
class MessageLogger{
	#[ORM\Id]
	#[ORM\Column(type: 'string', length: 36)]
	#[ORM\GeneratedValue(strategy: 'NONE')]
	private string $id;

	#[ORM\Column(type: 'text')]
	private string $message;

	#[ORM\Column(type: 'datetime', nullable: true)]
	private \DateTime $createdAt;

	#[ORM\Column(type: 'text', nullable: true)]
	private ?string $response;

	#[ORM\Column(type: 'string', nullable: true)]
	private string $status;


	public function __construct(
		string $message,
		string $status = "init",
		#[ORM\Column(type: 'string', nullable: true)]
		public ? string $requestId = null,
	){
		$this->id = Guid::uuid4()->toString();
		$this->message = $message;
		$this->createdAt = new \DateTime();
		$this->status = $status;
	}

	public function getId(): string{
		return $this->id;
	}

	public function setId(string $id): void{
		$this->id = $id;
	}

	public function getMessage(): string{
		return $this->message;
	}

	public function setMessage(string $message): void{
		$this->message = $message;
	}

	public function getCreatedAt(): \DateTime{
		return $this->createdAt;
	}

	public function setCreatedAt(\DateTime $createdAt): void{
		$this->createdAt = $createdAt;
	}

	public function getResponse(): ?string{
		return $this->response;
	}

	public function setResponse(?string $response): void{
		$this->response = $response;
	}

	public function getStatus(): string{
		return $this->status;
	}

	public function setStatus(string $status): void{
		$this->status = $status;
	}


}
