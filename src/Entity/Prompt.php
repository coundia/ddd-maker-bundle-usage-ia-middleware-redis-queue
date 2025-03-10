<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Guid\Guid;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity]
#[ORM\Table(name: 'prompts')]
class Prompt{
	#[ORM\Id]
	#[ORM\Column(type: 'string', length: 36)]
	#[ORM\GeneratedValue(strategy: 'NONE')]
	private string $id;

	#[ORM\Column(type: 'text')]
	private string $prompt;

	#[ORM\Column(type: 'string', nullable: true)]
	private string $userId;

	#[ORM\Column(type: 'datetime', nullable: true)]
	private \DateTime $createdAt;

	#[ORM\Column(type: 'text', nullable: true)]
	private ?string $response;

	#[ORM\Column(type: 'string', nullable: true)]
	private string $status;

	#[ORM\OneToMany(targetEntity: 'App\Entity\File', mappedBy: 'prompt', cascade: ['persist'])]
	private Collection $files;

	public function __construct(
		string $prompt,
		?string $userId = null,
		#[ORM\Column(type: 'string', nullable: true)]
		public ? string $requestId = null,
	){
		$this->id = Guid::uuid4()->toString();
		$this->prompt = $prompt;
		$this->userId = $userId;
		$this->createdAt = new \DateTime();
		$this->status = 'queued';
		$this->files = new ArrayCollection();
		$this->requestId = $requestId;
	}

	public function getId(): ?string{
		return $this->id;
	}

	public function setId(string $id): self{
		$this->id = $id;
		return $this;
	}

	public function getPrompt(): ?string{
		return $this->prompt;
	}

	public function setPrompt(string $prompt): self{
		$this->prompt = $prompt;
		return $this;
	}

	public function getUserId(): ?string{
		return $this->userId;
	}

	public function setUserId(string $userId): self{
		$this->userId = $userId;
		return $this;
	}

	public function getCreatedAt(): ?\DateTimeInterface{
		return $this->createdAt;
	}

	public function setCreatedAt(\DateTimeInterface $createdAt): self{
		$this->createdAt = $createdAt;
		return $this;
	}

	public function getResponse(): ?string{
		return $this->response;
	}

	public function setResponse(?string $response): self{
		$this->response = $response;
		return $this;
	}

	public function getStatus(): ?string{
		return $this->status;
	}

	public function setStatus(string $status): self{
		$this->status = $status;
		return $this;
	}

	public function getFiles(): Collection{
		return $this->files;
	}

	public function addFile(File $file): self{
		if (!$this->files->contains($file)){
			$this->files[] = $file;
			$file->setPrompt($this);
		}
		return $this;
	}

	public function removeFile(File $file): self{
		if ($this->files->contains($file)){
			$this->files->removeElement($file);
			if ($file->getPrompt() === $this){
				$file->setPrompt(null);
			}
		}
		return $this;
	}

	public function getRequestId(): ?string{
		return $this->requestId;
	}

	public function setRequestId(?string $requestId): void{
		$this->requestId = $requestId;
	}


}
