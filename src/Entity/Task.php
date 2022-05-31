<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    #[Groups('task:readAll')]
    private $name_task;

    #[ORM\Column(type: 'text')]
    #[Groups('task:readAll')]
    private $content_task;

    #[ORM\Column(type: 'datetime')]
    #[Groups('task:readAll')]
    private $date_task;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'tasks')]
    #[Groups('task:readAll')]
    private $id_user;

    #[ORM\ManyToOne(targetEntity: Cat::class, inversedBy: 'tasks')]
    #[Groups('task:readAll')]
    private $id_cat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameTask(): ?string
    {
        return $this->name_task;
    }

    public function setNameTask(string $name_task): self
    {
        $this->name_task = $name_task;

        return $this;
    }

    public function getContentTask(): ?string
    {
        return $this->content_task;
    }

    public function setContentTask(string $content_task): self
    {
        $this->content_task = $content_task;

        return $this;
    }

    public function getDateTask(): ?\DateTimeInterface
    {
        return $this->date_task;
    }

    public function setDateTask(\DateTimeInterface $date_task): self
    {
        $this->date_task = $date_task;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getIdCat(): ?Cat
    {
        return $this->id_cat;
    }

    public function setIdCat(?Cat $id_cat): self
    {
        $this->id_cat = $id_cat;

        return $this;
    }
}
