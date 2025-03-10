<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Guid\Guid;

#[ORM\Entity]
#[ORM\Table(name: 'files')]
class File{
	#[ORM\Id]
	#[ORM\Column(type: 'string', unique: true)]
	private string $id;

	#[ORM\Column(type: 'string', nullable: true)]
	private string $filename;

	#[ORM\Column(type: 'string', nullable: true)]
	private string $filePath;

	private ?Prompt $prompt;

	public function __construct(
		string $filename,
		string $filePath
	){
		$this->id = Guid::uuid4()->toString();
		$this->filename = $filename;
		$this->filePath = $filePath;
	}

	public function getId(): ?string{
		return $this->id;
	}

	public function setId(string $id): self{
		$this->id = $id;
		return $this;
	}

	public function getFilename(): ?string{
		return $this->filename;
	}

	public function setFilename(string $filename): self{
		$this->filename = $filename;
		return $this;
	}

	public function getFilePath(): ?string{
		return $this->filePath;
	}

	public function setFilePath(string $filePath): self{
		$this->filePath = $filePath;
		return $this;
	}

	public function getPrompt(): ?Prompt{
		return $this->prompt;
	}

	public function setPrompt(?Prompt $prompt): self{
		$this->prompt = $prompt;
		return $this;
	}
}
