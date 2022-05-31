<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups('task:readAll')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    #[Groups('task:readAll')]
    private $name_user;

    #[ORM\Column(type: 'string', length: 50)]
    #[Groups('task:readAll')]
    private $first_name_user;

    #[ORM\Column(type: 'string', length: 50)]
    #[Groups('task:readAll')]
    private $login_user;

    #[ORM\Column(type: 'string', length: 100)]
    #[Groups('task:readAll')]
    private $mdp_user;

    #[ORM\OneToMany(mappedBy: 'id_user', targetEntity: Task::class)]
    private $tasks;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameUser(): ?string
    {
        return $this->name_user;
    }

    public function setNameUser(string $name_user): self
    {
        $this->name_user = $name_user;

        return $this;
    }

    public function getFirstNameUser(): ?string
    {
        return $this->first_name_user;
    }

    public function setFirstNameUser(string $first_name_user): self
    {
        $this->first_name_user = $first_name_user;

        return $this;
    }

    public function getLoginUser(): ?string
    {
        return $this->login_user;
    }

    public function setLoginUser(string $login_user): self
    {
        $this->login_user = $login_user;

        return $this;
    }

    public function getMdpUser(): ?string
    {
        return $this->mdp_user;
    }

    public function setMdpUser(string $mdp_user): self
    {
        $this->mdp_user = $mdp_user;

        return $this;
    }

    /**
     * @return Collection<int, Task>
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): self
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks[] = $task;
            $task->setIdUser($this);
        }

        return $this;
    }

    public function removeTask(Task $task): self
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getIdUser() === $this) {
                $task->setIdUser(null);
            }
        }

        return $this;
    }
}
